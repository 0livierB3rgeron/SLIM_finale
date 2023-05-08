<?php

use Slim\App;

return function (App $app) {

    $app->get('/', \App\Action\HomeAction::class)->setName('home');

    // Documentation de l'api (À CHANGER PLUS TARD)
    $app->get('/docs', \App\Action\Docs\SwaggerUiAction::class);

    // Listes de tout les pokemons
    $app->get('/pokemon', \App\Action\Pokemon\PokemonViewAction::class);
    // Selectionne un pokemon par son ID
    $app->get('/pokemon/{id}', \App\Action\Pokemon\PokemonViewByIdAction::class);
    // Insère un nouveau pokemon dans la BD
    $app->post('/pokemon', \App\Action\Pokemon\PokemonCreateAction::class);
    // Supprime un pokemon grâce à son ID
    $app->delete('/pokemon/{id}', \App\Action\Pokemon\PokemonDeleteAction::class);
    // Modifie un pokemon grâce à son ID
    $app->put('/pokemon/{id}', \App\Action\Pokemon\PokemonUpdateAction::class);

};

