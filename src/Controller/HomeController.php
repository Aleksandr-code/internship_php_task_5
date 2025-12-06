<?php

namespace App\Controller;

use App\Service\SongService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(SongService $songService): JsonResponse
    {
        //input data
        $data = [
            'language' => 'english',
            'seed' => 123456,
            'avgLikes' => 5
        ];

        $songs = $songService->create($data);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'songs' => $this->json($songs)->getContent(),
        ]);
    }
}
