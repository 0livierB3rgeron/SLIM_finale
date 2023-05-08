<?php

namespace App\Action\Pokemon;

use App\Domain\Pokemon\Service\PokemonCreate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class PokemonCreateAction
{
    private $PokemonCreate;

    public function __construct(PokemonCreate $PokemonCreate)
    {
        $this->PokemonCreate = $PokemonCreate;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération des données du corps de la requête
        $data = (array)$request->getParsedBody();

        $resultat = $this->PokemonCreate->addPokemon($data);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}
