<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{

    public function __construct(private PostService $postService) {}

    public function index(): Response
    {
        $data = $this->postService->index();

        return Inertia::render('Post/Index', [
            'user' => $data['user'],
            'posts' => $data['posts']
        ]);
    }

    public function show(Post $post): Response
    {
        $data = $this->postService->show($post);

        return Inertia::render('Post/Show', [
            'user' => $data['user'],
            'post' => $data['post'],
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Post/Create', [
            'user' => $this->postService->create()
        ]);
    }

    public function store(Request $request): Response
    {
        return Inertia::render('Post/Show', [
            'post' => $this->postService->store($request)
        ]);
    }

    public function edit(Post $post): Response
    {
        $data = $this->postService->edit($post);

        return Inertia::render('Post/Edit', [
            'user' => $data['user'],
            'post' => $data['post']
        ]);
    }

    public function update(Request $request, string $id): Response
    {
        return Inertia::render('Post/Show', [
            'post' => $this->postService->update($request, $id),
        ]);
    }

    public function destroy(string $id): Response
    {
        $data = $this->postService->destroy($id);

        return Inertia::render('Post/Index', [
            'user' => $data['user'],
            'posts' => $data['posts']
        ]);
    }
}
