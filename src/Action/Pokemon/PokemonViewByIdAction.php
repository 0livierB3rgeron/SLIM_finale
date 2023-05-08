<?php

namespace App\Action\Pokemon;

use App\Domain\Pokemon\Service\PokemonView;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use stdClass;

final class PokemonViewByIdAction
{
    private $pokemonView;

    public function __construct(PokemonView $pokemonView)
    {
        $this->pokemonView = $pokemonView;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération des parametres
        $pokemonId = $request->getAttribute('id');

        $resultat = $this->pokemonView->viewPokemonById($pokemonId);
        $codeStatus = 200;

        if (empty($resultat)) {
            $resultat = new stdClass; 
            // new stdClass est une astuce pour créer un objet vide, c'est plus consistent comme ça de retourner un objet avec le film
            // quand on le trouve et un objet vide quand il n'y a rien. Par défaut c'est un tableau vide qui serait retourné.
            $codeStatus = 404;
        }
        
        

        // Construit la réponse HTTP
        $response->getBody()->write(json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($codeStatus);
    }
}