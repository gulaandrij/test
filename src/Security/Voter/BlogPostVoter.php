<?php

namespace App\Security\Voter;

use App\Entity\BlogPost;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class BlogPostVoter
 *
 * @package App\Security\Voter
 */
class BlogPostVoter extends Voter
{
    public const EDIT = 'edit';
    public const CREATE = 'create';
    public const DELETE = 'delete';
    public const CHANGE_STATUS = 'change_status';

    /**
     * @param  string $attribute
     * @param  mixed  $subject
     * @return bool
     */
    protected function supports($attribute, $subject): bool
    {
        return \in_array(
            $attribute,
            [
             self::DELETE,
             self::CREATE,
             self::EDIT,
             self::CHANGE_STATUS,
            ],
            true
        )
            && $subject instanceof BlogPost;
    }

    /**
     * @param  string         $attribute
     * @param  BlogPost       $subject
     * @param  TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EDIT:
                $user->getRoles();
                break;
            case self::CREATE:
                // logic to determine if the user can VIEW
                // return true or false
                break;
            case self::CHANGE_STATUS:
                // logic to determine if the user can VIEW
                // return true or false
                break;
            case self::DELETE:
                // logic to determine if the user can VIEW
                // return true or false
                break;
        }

        return false;
    }
}
