<?php

namespace spec\App\Security;

use App\Entity\Post;
use App\Entity\User;
use App\Security\PostVoter;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class PostVoterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PostVoter::class);
    }

    function it_should_vote_abstain_for_unknown_attribute(TokenInterface $token, Post $subject)
    {
        $attributes = ['unknown'];

        $this->vote($token, $subject, $attributes)->shouldReturn(VoterInterface::ACCESS_ABSTAIN);
    }

    function it_should_vote_granted_for_post_user(TokenInterface $token, Post $subject, User $user)
    {
        $attributes = ['edit'];

        $subject->getAuthor()->willReturn($user);
        $token->getUser()->willReturn($user);

        $this->vote($token, $subject, $attributes)->shouldReturn(VoterInterface::ACCESS_GRANTED);
    }

    function it_should_vote_denied_for_another_user(TokenInterface $token, Post $subject, User $user, User $user2)
    {
        $attributes = ['edit'];

        $subject->getAuthor()->willReturn($user);
        $token->getUser()->willReturn($user2);

        $this->vote($token, $subject, $attributes)->shouldReturn(VoterInterface::ACCESS_DENIED);
    }
}
