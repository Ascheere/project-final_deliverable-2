<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/17/15
 * Time: 6:45 PM
 */

namespace Notes\Persistence\Entity;


use Notes\Domain\Entity\User;
use Notes\Domain\Entity\UserRepositoryInterface;

class InMemoryUserRepository implements UserRepositoryInterface
{

    protected $users;
    // an array of users


    public function __construct()
    {
        $this->users = []; // creates a new empty array
    }
    /**
     * @param User $user
     * @return mixed
     */
    public function add(User $user)
    {
        if(!$user instanceof User){
            throw new \InvalidArgumentException(
                __METHOD__. '():$user has to be a User Object'
            );
        }
        $this->users[] = $user;
    }

    public function getByUsername($username)
    {
        $results = [];
        foreach($this->users as $user){
            /**
             * @var \Notes\Domain\Entity\User $user
             */
            if ($user->getUsername()->__toString() === $username)
            {
                $results[] = $user;
            }
        }
        return $results;
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function modify(User $user)
    {
        foreach($this->users as $user){
            /**
             * @var \Notes\Domain\Entity\User $user
             */
            if ($user->getUserID() === $user->getUserID())
            {

            }
        }
    }

    public function remove(User $user)
    {
        // TODO: Implement remove() method.
    }

    public function removeByUsername($username)
    {
        // TODO: Implement removeByUsername() method.
    }

    public function count()
    {
        return count($this->users);
    }
}
