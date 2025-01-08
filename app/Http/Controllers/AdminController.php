<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function __construct(private AdminService $adminService) {}

    public function index(): Response
    {
        $data = $this->adminService->index();
        
        return Inertia::render('Admin/Index', ['users' => $data]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Create', []);
    }

    public function store(Request $request): Response
    {
        $data = $this->adminService->store($request);

        return Inertia::render('Admin/Create', ['message' => $data['message']]);
    }

    public function edit(User $user): Response
    {
        $data = $this->adminService->edit($user);

        return Inertia::render('Admin/Edit', ['user' => $data['user']]);
    }

    public function update(Request $request, string $id): Response
    {
        $data = $this->adminService->update($request, $id);

        return Inertia::render('Admin/Edit', ['message' => $data['message']]);
    }

    public function destroy(string $id): Response
    {
        $data = $this->adminService->destroy($id);

        return Inertia::render('Admin/Index', ['users' => $data]);
    }
}
