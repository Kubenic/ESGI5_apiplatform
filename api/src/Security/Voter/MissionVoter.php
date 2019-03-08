<?php

namespace App\Security\Voter;

use App\Entity\Mission;
use App\Entity\Plane;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class MissionVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['MISSION_UPDATE'])
            && $subject instanceof Mission;
    }

    /**
     * @param string $attribute
     * @param Mission $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof User) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'MISSION_UPDATE':
                $companies = $subject->getPlanes()->map(function (Plane $plane) {
                    return $plane->getCompany();
                });

                // logic to determine if the user can EDIT
                // return true or false
                return in_array($user->getCompany(), $companies->toArray());
                break;
        }

        return false;
    }
}
