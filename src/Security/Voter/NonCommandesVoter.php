<?php

namespace App\Security\Voter;

use App\Entity\User;
use App\Entity\NonCommandes;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class NonCommandesVoter extends Voter
{
    public const VIEW = 'NONCOMMANDES_VIEW';
    public const EDIT = 'NONCOMMANDES_EDIT';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::VIEW, self::EDIT])
            && $subject instanceof NonCommandes;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // If the user is anonymous, do not grant access
        if (!$user instanceof User) {
            return false;
        }

        if ($attribute === self::EDIT) {
            return $this->canEdit($user);
        }

        if ($attribute === self::VIEW) {
            return $this->canView($user);
        }

        return false;
    }

    private function canEdit(User $user): bool
    {
        // Only admins can edit Noncommandes
        return in_array('ROLE_ADMIN', $user->getRoles());
    }

    private function canView(User $user): bool
    {
        // Admins, readers, and editors can view NonCommandes
        return in_array('ROLE_ADMIN', $user->getRoles())
            || in_array('ROLE_LECTEUR', $user->getRoles())
            || in_array('ROLE_EDITOR', $user->getRoles());
    }
}
