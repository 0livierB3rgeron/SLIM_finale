<?php

namespace App\Action\Pokemon;

use App\Domain\Pokemon\Service\PokemonView;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class PokemonViewAction
{
    private $PokemonView;

    public function __construct(PokemonView $PokemonView)
    {
        $this->PokemonView = $PokemonView;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération des parametres
        $userId = $request->getAttribute('id');

        $resultat = $this->PokemonView->viewAllPokemon();

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
