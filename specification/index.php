<?php


class  User
{
    public $email = 'ahmed@gmail.com';
}

class  UserRepository
{
    public function getUserByEmail($email)
    {
        return true;
    }
}

class EmailIsAvailable
{
    public $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function isSatisfiedBy($email)
    {

        if ($this->repository->getUserByEmail($email)) {
            return false;
        }
        return true;
    }
}

$userRepository=new UserRepository();

$spec=new EmailIsAvailable($userRepository);

var_dump($spec->isSatisfiedBy('ahmed@gmail.com'));

