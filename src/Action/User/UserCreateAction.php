<?php

namespace App\Action\User;

use App\Domain\User\Service\UserCreate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserCreateAction
{
    private $UserCreate;

    public function __construct(UserCreate $UserCreate)
    {
        $this->UserCreate = $UserCreate;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération des données du corps de la requête
        $data = (array)$request->getParsedBody();

        $resultat = $this->UserCreate->addUser($data);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}