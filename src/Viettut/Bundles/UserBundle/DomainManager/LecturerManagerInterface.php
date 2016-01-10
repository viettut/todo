<?php

namespace Viettut\Bundles\UserBundle\DomainManager;

use FOS\UserBundle\Model\UserInterface as FOSUserInterface;
use FOS\UserBundle\Model\UserInterface;
use Viettut\Exception\InvalidUserRoleException;
use Viettut\Model\User\Role\LecturerInterface;
use Viettut\Model\User\UserEntityInterface;

interface LecturerManagerInterface
{
    /**
     * @see \Tagcade\DomainManager\ManagerInterface
     *
     * @param FOSUserInterface|string $entity
     * @return bool
     */
    public function supportsEntity($entity);

    /**
     * @param FOSUserInterface $user
     * @return void
     */
    public function save(FOSUserInterface $user);

    /**
     * @param FOSUserInterface $user
     * @return void
     */
    public function delete(FOSUserInterface $user);

    /**
     * Create new Broker only
     * @return FOSUserInterface
     */
    public function createNew();

    /**
     * @param int $id
     * @return FOSUserInterface|UserEntityInterface|null
     */
    public function find($id);

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @return FOSUserInterface[]
     */
    public function all($limit = null, $offset = null);

    /**
     * @return array
     */
    public function allLecturers();


    /**
     * @param int $id
     * @return LecturerInterface|bool
     * @throws InvalidUserRoleException
     */
    public function findLecturer($id);

    /**
     * Finds a user by its username or email.
     *
     * @param string $usernameOrEmail
     *
     * @return UserInterface or null if user does not exist
     */
    public function findUserByUsernameOrEmail($usernameOrEmail);

    /**
     * Updates a user.
     *
     * @param UserInterface $token
     *
     * @return void
     */
    public function updateUser(UserInterface $token);

    /**
     * Finds a user by its confirmationToken.
     *
     * @param string $token
     *
     * @return UserInterface or null if user does not exist
     */
    public function findUserByConfirmationToken($token);

    public function updateCanonicalFields(UserInterface $user);

    public function findUserByActiveCode($code);

    public function findUserByFacebookId($fbId);
}