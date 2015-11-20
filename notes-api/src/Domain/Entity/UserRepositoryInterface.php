<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/17/15
 * Time: 5:50 PM
 */

namespace Notes\Domain\Entity;


interface UserRepositoryInterface
{
    /**
     * @param User $user
     * @return mixed
     */
    public function add(User $user);


    public function getByUsername($username);


    public function getUsers();


    public function modify(User $user);


    public function remove(User $user);


    public function removeByUsername($username);

    public function count();
}
