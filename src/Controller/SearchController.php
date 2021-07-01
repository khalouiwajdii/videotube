<?php

namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(Request $request, VideoRepository $videoRepository): Response
    {
        $search = $request->query->get('search_query', '');

        // If search empty, redirect to Home page.
        if (empty($search)) {
            return $this->redirectToRoute('home');
        }

        // SELECT * FROM video;
        $videos = $videoRepository->findBySearch($search);

        // Dump variables content into profiler (web browser)
//        dump($videos);

        return $this->render('search/index.html.twig', [
            'videos' => $videos,
            'search' => $search,
        ]);
    }
}
