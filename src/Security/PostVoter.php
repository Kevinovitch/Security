<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class PostVoter extends Voter
{

    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    protected function supports(string $attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::VIEW, self::EDIT]))
        {
            return false;
        }

        // only vote on 'Post' objects
        if(!$subject instanceof Post)
        {
            return false;
        }
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User)
        {
            // the user must be in logged id; if not, deny access
            return false;
        }

        // ROLE_SUPER_ADMIN can do anything! The power!
        if($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }

        // you know $subject is a Post object, thanks to 'supports()'
        /** @var Post $post */
        $post = $subject;

        switch ($attribute){
            case self::VIEW:
                return $this->canView($post, $user);
            case self::EDIT:
                return $this->canEdit($post, $user);
        }

        throw new \LogicException('This code should not be reached');
    }

    private function canView(Post $post, User $user)
    {
        // if they can edit, they can view
        if($this->canEdit($post, $user)){
            return true;
        }

        // the Post object could have, for example, a method 'isPrivate()'
        return !$post->isPrivate();
    }

    private function canEdit(Post $post, User $user)
    {
        // this assumes that the Post object has a 'getOwner()' method
        return $user === $post->getOwner();
    }
}