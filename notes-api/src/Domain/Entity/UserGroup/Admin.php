<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/10/15
 * Time: 7:06 PM
 */
// user group for admins implements UserGroupInterface
namespace Notes\Domain\Entity\UserGroup;


use Notes\Domain\Entity\User;
use Notes\Persistence\Entity\InMemoryUserRepository;
use Notes\Domain\Entity\Roles\AdminRole;
use Notes\Domain\ValueObject\StringLiteral;
use Notes\Domain\ValueObject\Uuid;

class Admin implements UserGroupInterface
{
    protected $adminRepository; // is just going to be an array at this point
    protected $groupRole;
    protected $name;
    protected $id;

    public function __construct(Uuid $adminGroupID, $name = '', $initialUsers)
    {
        $this->id = $adminGroupID;

        $this->name = new StringLiteral($name);

        $this->adminRepository = $initialUsers;
    }


    public function setRole(RoleInterface $role)
    {
        $this->groupRole = $role;
    }

    public function getRole()
    {
        return $this->groupRole;
    }
    public function setName($name)
    {
        $this->name = new StringLiteral($name);
        return $this;
    }

    /**
     * @return String
     */
    public function getName()
    {
       return $this->name->__toString();
    }

    public function getGroupID()
    {
      return $this->id->__toString();
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->adminRepository;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function addUser(User $user)
    {
        $userID = $user->getUserID();
        $this->adminRepository["$userID"] = $user;
        return $this;
    }

    /**
     * @param $userID
     * @param string $newFirstName
     * @param string $newLastName
     * @param string $newPassword
     * @param string $newEmail
     * @param string $newUsername
     * @return bool
     */
    public function updateUser(
        $userID,
        $newFirstName = '',
        $newLastName = '',
        $newPassword = '',
        $newEmail = '',
        $newUsername = ''
    ) {
        /*
         * @var $user Notes\Domain\Entity\User;
         */
        $user = $this->adminRepository[$userID];

        if($newFirstName != '')
        {
            $user->setFirstName($newFirstName);
        }
        if($newLastName != '')
        {
            $user->setLastName($newLastName);
        }
        if($newPassword != '')
        {
            $user->setPassword($newPassword);
        }
        if($newEmail != '')
        {
            $user->setEmail($newEmail);
        }
        if($newUsername != '')
        {
            $user->setUsername($newUsername);
        }


        $this->adminRepository[$userID] = $user;
        return true;

    }

    /**
     * @return int
     */
    public function count()
    {
       return count($this->adminRepository);
    }

    /**
     * @param $userID
     * @return bool
     */
    public function containsUser($userID)
    {
        if(array_key_exists($userID, $this->adminRepository))
            return true;
        else
            return false;

    }

    /**
     * @param $userID
     * @return bool
     */
    public function removeUser($userID)
    {
        unset($this->adminRepository[$userID]);
        return true;
    }

    /**
     * @param $userID
     * @return User
     */
    public function getUser($userID)
    {
        return $this->adminRepository[$userID];
    }
}
