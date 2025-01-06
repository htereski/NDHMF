<?php

namespace App\Services;

use App\Models\Post;
use App\Helper\UserHelper;
use App\Http\Resources\SimplePostResource;
use App\Http\Resources\PostResource;
use App\Models\PostEdit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostService
{
    private string $path;

    public function __construct(private ImageService $imageService) {}

    public function index(): array
    {
        $posts = Post::latest()->get();

        $posts = $posts->map(function ($post) {
            return (new SimplePostResource($post))->toArray(request());
        });

        return array('posts' => $posts);
    }

    public function show(Post $post): array
    {
        $post->load('user');
        $post->load('editors');
        $post->imagem = asset($post->imagem);

        $post = new PostResource($post);

        return array('post' => $post->toArray(request()));
    }

    public function store(Request $request): array
    {
        $request->validate([
            'titulo' => ['required', 'max:255', 'unique:posts'],
            'texto' => ['required'],
            'imagem' => ['file', 'nullable', 'max:2048', 'mimes:jpeg,png,jpg']
        ]);

        $this->createURLImage($request);

        $user = UserHelper::authenticated();

        $post = Post::create([
            'titulo' => $request->titulo,
            'texto' => $request->texto,
            'imagem' => $this->path,
            'user_id' => $user->id,
        ]);

        $post->load('user');
        $post->imagem = asset($post->imagem);

        $post = new PostResource($post);

        return array('post' => $post->toArray(request()));
    }

    private function createURLImage(Request $request): void
    {
        $this->path = $this->imageService->storeImage($request);
    }

    public function edit(Post $post): array
    {
        $post->imagem = asset($post->imagem);

        $post = new SimplePostResource($post);

        return array('post' => $post->toArray(request()));
    }

    public function update(Request $request, string $id): array
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'titulo' => ['required', 'max:255', 'unique:posts,titulo,' . $post->id],
            'texto' => ['required'],
        ]);

        if ($request->hasFile('imagem')) {

            $request->validate([
                'imagem' => ['file', 'nullable', 'max:2048', 'mimes:jpeg,png,jpg']
            ]);

            $this->createURLImage($request);
            $post->imagem = $this->path;
        }

        $post->titulo = $request->titulo;
        $post->texto = $request->texto;
        $post->save();

        PostEdit::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
        ]);

        $post->load('user');
        $post->load('editors');
        $post->imagem = asset($post->imagem);

        $post = new PostResource($post);

        return array('post' => $post->toArray(request()));
    }

    public function destroy(string $id): array
    {
        $post = Post::findOrFail($id);

        $imagePath = public_path($post->imagem);

        if (!str_contains($post->imagem, 'assets/img') && File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $post->delete();

        $posts = Post::latest()->get();

        foreach ($posts as $singlePost) {
            $singlePost->imagem = asset($singlePost->imagem);
        }

        $posts = SimplePostResource::collection($posts);

        return array('posts' => $posts->toArray(request()));
    }
}
