<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Inertia\Response;

class HomeController extends Controller
{

    public function __construct(private HomeService $homeService) {}

    public function index(): Response
    {
        return $this->homeService->principal();
    }
}