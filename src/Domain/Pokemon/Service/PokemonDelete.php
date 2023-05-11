<?php

namespace App\Domain\Pokemon\Service;

use App\Domain\Pokemon\Repository\PokemonRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;
use stdClass;

/**
 * Service.
 */
final class PokemonDelete
{
    /**
     * @var PokemonRepository
     */
    private $repository;
    
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(PokemonRepository $repository, LoggerFactory $loggerFactory)
    {
        $this->repository = $repository;
        $this->logger = $loggerFactory
            ->addFileHandler('PokemonLog.log')
            ->createLogger('deleteMovie');
    }

    /**
     * Supprime un pokemon dans la base de données.
     * 
     * @param int $idPokemon Le id du pokemon à supprimer
     *
     * @return array Le pokemon supprimé
     */
    public function removePokemon(int $idPokemon): array
    {

      
        $pokemonToDelete = $this->repository->selectPokemonById($idPokemon);
        // Par défaut le code de statut sera 200 - Succès
        $codeStatus = 200;

        // Si le pokemon n'existe pas on change pour le code 404, sinon on supprime le pokemon
        if(empty($pokemonToDelete)) {
            $codeStatus = 404;
        } else {
            if($this->repository->deletePokemon($idPokemon)) {
                $this->logger->info('Le film "' . $pokemonToDelete['nom'] . '" id [' . $idPokemon . '] a été supprimé.');
            };
        }
        
        
        $resultat = [
            "pokemon" => empty($pokemonToDelete) ? new stdClass : $pokemonToDelete,
            "codeStatus" => $codeStatus
        ];

        return $resultat;
    }


}