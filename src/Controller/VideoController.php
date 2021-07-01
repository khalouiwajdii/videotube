<?php

namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
    /**
     * @Route("/video/{id}", name="video")
     */
    public function index(Video $video, VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findBy([], [
            'publishedAt' => 'DESC',
        ], 12);

        return $this->render('video/index.html.twig', [
            'video' => $video,
            'suggested_videos' => $videos,
        ]);
    }
}
