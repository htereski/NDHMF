<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Helper\UserHelper;
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
        $user = UserHelper::authenticated();

        return array('user' => $user, 'posts' => Post::latest()->get());
    }

    public function show(Post $post)
    {
        $user = UserHelper::authenticated();

        $post->load('user');
        $post->load('editors');
        $post->imagem = asset($post->imagem);

        return array('user' => $user, 'post' => $post);
    }

    public function create(): User
    {
        return UserHelper::authenticated();
    }

    public function store(Request $request): Post
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

        return $post;
    }

    private function createURLImage(Request $request): void
    {
        $this->path = $this->imageService->storeImage($request);
    }

    public function edit(Post $post): array
    {
        $user = UserHelper::authenticated();

        $post->load('user');

        $post->imagem = asset($post->imagem);

        return array('user' => $user, 'post' => $post);
    }

    public function update(Request $request, string $id): Post
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

        $post->load('editors');
        $post->load('user');
        $post->imagem = asset($post->imagem);

        return $post;
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

        $user = UserHelper::authenticated();

        return array('user' => $user, 'posts' => $posts);
    }
}
