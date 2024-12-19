<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ImageService
{
    private const DEFAULT_IMAGE_PATH = 'assets/img/post.png';

    public function storeImage(Request $request): string
    {
        $path = self::DEFAULT_IMAGE_PATH;

        if ($request->hasFile('imagem')) {
            $ext = $request->file('imagem')->getClientOriginalExtension();
            $nome_arq = Str::uuid()  . "_" . time() . "." . $ext;
            $request->file('imagem')->storeAs("", $nome_arq);
            $path = "/storage/" . $nome_arq;
        }

        return $path;
    }
}
