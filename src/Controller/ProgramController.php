<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Faker\Factory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPSTORM_META\type;

class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'program_index')]
    public function index(ProgramRepository $programRepository): Response
    {        
        $programs = $programRepository->findAll();
        
        return $this->render('program/index.html.twig', [
            'programs' => $programs,
         ]);
    }
    
    #[Route('/program/{id}', methods:['GET'], name:'program_show', requirements:['id' => '\d+'])]
    public function show(Program $program): Response
    {           
        return $this->render('/program/show.html.twig', ['program' => $program]);
    }
    
    #[Route('/program/{program}/seasons/{seasonsId}', methods:['GET'], name:'program_season_show', requirements:['id' => '\d+'])]
    public function showSeason(Program $program, Season $season): Response
    {
        return $this->render('/program/season_show.html.twig', ['program' => $program, 'season' => $season]);
    }

    #[Route('/program/{program_id}/season/{season_id}/episode/{episode_id}', methods:['GET'], name:'program_episode_show')]
    #[Entity('program', options: ['id' => 'program_id'])]
    #[Entity('season', options: ['id' => 'season_id'])]
    #[Entity('episode', options: ['id' => 'episode_id'])]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', ['program' => $program, 'season' => $season, 'episode' => $episode]);
    }
 
}
