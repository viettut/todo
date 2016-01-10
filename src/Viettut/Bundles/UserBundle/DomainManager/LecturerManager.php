<?php

namespace Viettut\Bundles\UserBundle\DomainManager;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserInterface as FOSUserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Viettut\Model\User\Role\BrokerInterface;
use Viettut\Model\User\Role\LecturerInterface;
use Viettut\Model\User\UserEntityInterface;

/**
 * Most of the other handlers talk to doctrine directly
 * This one is wrapping the bundle-specific FOSUserBundle
 * whilst keep a consistent API with the other handlers
 */
class LecturerManager implements LecturerManagerInterface
{
    const ROLE_LECTURER = 'ROLE_LECTURER';
    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * @var UserManagerInterface
     */
    protected $FOSUserManager;

    public function __construct(UserManagerInterface $userManager)
    {
        $this->FOSUserManager = $userManager;
    }

    /**
     * @inheritdoc
     */
    public function supportsEntity($entity)
    {
        return is_subclass_of($entity, FOSUserInterface::class);
    }

    /**
     * @inheritdoc
     */
    public function save(FOSUserInterface $user)
    {
        $this->FOSUserManager->updateUser($user);
    }

    /**
     * @inheritdoc
     */
    public function delete(FOSUserInterface $user)
    {
        $this->FOSUserManager->deleteUser($user);
    }

    /**
     * @inheritdoc
     */
    public function createNew()
    {
        return $this->FOSUserManager->createUser();
    }

    /**
     * @inheritdoc
     */
    public function find($id)
    {
        return $this->FOSUserManager->findUserBy(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function all($limit = null, $offset = null)
    {
        return $this->FOSUserManager->findUsers();
    }

    /**
     * @inheritdoc
     */
    public function allLecturers()
    {
        $brokers = array_filter($this->all(), function(UserEntityInterface $user) {
            return $user->hasRole(static::ROLE_LECTURER);
        });

        return array_values($brokers);
    }

    /**
     * @inheritdoc
     */
    public function findLecturer($id)
    {
        $lecturer = $this->find($id);

        if (!$lecturer) {
            return false;
        }

        if (!$lecturer instanceof LecturerInterface) {
            return false;
        }

        return $lecturer;
    }

    /**
     * @inheritdoc
     */
    public function findUserByUsernameOrEmail($usernameOrEmail)
    {
        return $this->FOSUserManager->findUserByUsernameOrEmail($usernameOrEmail);
    }

    /**
     * @inheritdoc
     */
    public function updateUser(UserInterface $token)
    {
        $this->FOSUserManager->updateUser($token);
    }

    /**
     * @inheritdoc
     */
    public function findUserByConfirmationToken($token)
    {
        return $this->FOSUserManager->findUserByConfirmationToken($token);
    }

    public function updateCanonicalFields(UserInterface $user)
    {
        $this->FOSUserManager->updateCanonicalFields($user);
    }

    public function findUserByActiveCode($code)
    {
        return $this->FOSUserManager->findUserBy(['activeCode' => $code]);
    }

    public function findUserByFacebookId($fbId)
    {
        return $this->FOSUserManager->findUserBy(['facebookId' => $fbId]);
    }
}
