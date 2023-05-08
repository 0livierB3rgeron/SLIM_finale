<?php

namespace App\Action\Pokemon;

use App\Domain\Pokemon\Service\PokemonUpdate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class PokemonUpdateAction
{
    private $pokemonUpdate;

    public function __construct(PokemonUpdate $pokemonUpdate)
    {
        $this->pokemonUpdate = $pokemonUpdate;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération des données du corps de la requête
        $data = (array)$request->getParsedBody();

        // Récupération du paramètre de route 'id'
        $id = $request->getAttribute('id', 0);


        $resultat = $this->pokemonUpdate->updatePokemon($id, $data);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat["pokemon"]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($resultat["codeStatus"]);
    }
}