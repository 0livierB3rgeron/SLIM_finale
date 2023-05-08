<?php

namespace App\Action;

use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class HomeAction
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
        
        $result = json_encode([
            'message' => 'API - Projet Finale - POKEMON - fait par : Olivier Bergeron'
        ]);
        
        $response->getBody()->write($result);

        return $response->withHeader('Content-Type', 'application/json');

    }
}
