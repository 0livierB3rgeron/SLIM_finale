<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;

/**
 * Service.
 */
final class UserCreate
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 
     * 
     * @param array 
     *
     * @return array 
     */
    public function addUser(array $data): array
    {

        $user = $this->repository->createUser($data);

        return $user ?? [];
    }


}