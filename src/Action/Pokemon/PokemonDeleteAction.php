<?php

namespace App\Action\Pokemon;

use App\Domain\Pokemon\Service\PokemonDelete;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class PokemonDeleteAction
{
    private $pokemonDelete;

    public function __construct(PokemonDelete $pokemonDelete)
    {
        $this->pokemonDelete = $pokemonDelete;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération du paramètre de route 'id'
        $id = $request->getAttribute('id', 0);

        $resultat = $this->pokemonDelete->removePokemon($id);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat["pokemon"]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($resultat["codeStatus"]);
    }
}