<?php

namespace App\Controller;

use App\Service\SongService;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(
        SongService $songService,
        #[MapQueryParameter] ?string $locale = 'en_US',
        #[MapQueryParameter] ?int $seed = 123456,
        #[MapQueryParameter] ?float $avgLikes = 5,
        #[MapQueryParameter] int $page = 1,
        #[MapQueryParameter] int $count = 1,
        #[MapQueryParameter] int $maxPerPage = 5,
        #[MapQueryParameter] int $isGalleryViewChecked = 1,
    ): Response
    {
//        //input data
//        $data = [
//            'locale' => 'en_US',
//            'seed' => 123456,
//            'page' => 1,
//            'avgLikes' => 5
//        ];

        $songs = $songService->create($locale, $seed, $avgLikes, $page);
//        $songs = ['1', '2', '1', '2','1', '2','1', '2','1', '2','1', '2','1', '2'];

        $pager = Pagerfanta::createForCurrentPageWithMaxPerPage(
            new ArrayAdapter($songs),
            $page,
            $maxPerPage
        );

//        dd($pager);

        return $this->render('main/homepage.html.twig', [
            'songs' => $pager
        ]);

//        return $this->json([
//            'message' => 'Welcome to your new controller!',
//            'songs' => $this->json($songs)->getContent(),
//        ]);
    }
}
