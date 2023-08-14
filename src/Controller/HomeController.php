<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectsRepository;
use App\Repository\ProjectSkillsRepository;
use App\Repository\ProjectPictureRepository;
use App\Entity\ProjectPicture;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ProjectsRepository $projectsRepository, ProjectPictureRepository $projectPictureRepository, ProjectSkillsRepository $projectSkillsRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'projects' => $projectsRepository->findAll(),
            'projectPictures' => $projectPictureRepository->findAll(),
            'projectSkills' => $projectSkillsRepository->findAll(),
        ]);
    }
}
