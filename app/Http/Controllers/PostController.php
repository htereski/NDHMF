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
            'posts' => $data['posts']
        ]);
    }

    public function show(Post $post): Response
    {
        $data = $this->postService->show($post);

        return Inertia::render('Post/Show', [
            'post' => $data['post'],
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Post/Create', []);
    }

    public function store(Request $request): Response
    {
        $data = $this->postService->store($request);

        return Inertia::render('Post/Show', [
            'post' => $data['post']
        ]);
    }

    public function edit(Post $post): Response
    {
        $data = $this->postService->edit($post);

        return Inertia::render('Post/Edit', [
            'post' => $data['post']
        ]);
    }

    public function update(Request $request, string $id): Response
    {
        $data = $this->postService->update($request, $id);

        return Inertia::render('Post/Show', [
            'post' => $data['post']
        ]);
    }

    public function destroy(string $id): Response
    {
        $data = $this->postService->destroy($id);

        return Inertia::render('Post/Index', [
            'posts' => $data['posts']
        ]);
    }
}
