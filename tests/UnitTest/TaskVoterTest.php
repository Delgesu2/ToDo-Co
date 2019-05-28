<?php

namespace Tests\UnitTest;

use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use AppBundle\Security\TaskVoter;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class TaskVoterTest
 *
 * @package Tests\UnitTest
 */
class TaskVoterTest extends TestCase
{
    /**
     * @var TaskVoter
     */
    private $voter;

    protected function setUp(): void
    {
        $this->voter = new class() extends TaskVoter {
            public function supports($attribute, $subject)
            {
                return parent::supports($attribute, $subject);
            }
            public function voteOnAttribute($attribute, $subject, TokenInterface $token)
            {
                return parent::voteOnAttribute($attribute, $subject, $token);
            }
        };
    }

    /**
     * @dataProvider provideSupportsData
     *
     * @param string $attribute
     * @param $subject
     * @param bool $supports
     */
    public function testSupports(string $attribute, $subject, bool $supports)
    {
        $this->assertEquals($supports, $this->voter->supports($attribute, $subject));
    }

    /**
     * @return \Generator
     */
    public function provideSupportsData()
    {
        yield [TaskVoter::DEL,  new Task(),         true];
        yield ["fail",          new Task(),         false];
        yield [TaskVoter::DEL,  new \stdClass(),    false];
    }

    /**
     * @param string $attribute
     * @param $subject
     * @param $user
     * @param bool $vote
     *
     * @throws \ReflectionException
     */
    public function testVoteOnAttribute(string $attribute, $subject, $user, bool $vote)
    {
        $token = $this->createMock(TokenInterface::class);
        $token->method("getUser")->willReturn($user);

        $this->assertEquals($vote, $this->voter->voteOnAttribute($attribute, $subject, $token));
    }

    /**
     * @return \Generator
     */
    public function provideVoteOnAttributeData()
    {
        $task = new Task();
        $user = new User();
        $task->setAuthor($user);
        yield [TaskVoter::DEL, $task, $user, true];
        $admin = new User();
        $admin->setRole("ROLE_ADMIN");
        yield [TaskVoter::DEL, new Task(), $admin, true];
        $task = new Task();
        $user = new User();
        $task->setAuthor($user);
        yield [TaskVoter::DEL, $task, new User(), false];
        yield [TaskVoter::DEL, new Task(), new User(), false];
        yield [TaskVoter::DEL, new Task(), new \stdClass(), false];
    }

    /**
     * @throws \ReflectionException
     */
    public function testVoteOnAttributeException()
    {
        $token = $this->createMock(TokenInterface::class);
        $token->method("getUser")->willReturn(new User());
        $this->expectException(\LogicException::class);
        $this->voter->voteOnAttribute("fail", new Task(), $token);
    }

    public function testCanDelete()
    {

    }
}