<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{

    public function __construct(private HomeService $homeService) {}

    public function index(): Response
    {
        $data = $this->homeService->principal();

        return Inertia::render('Index', [
            'isAuthenticated' => $data['isAuthenticated'],
            'user' => $data['user'],
            'chat' => $data['chat'],
        ]);
    }
}
