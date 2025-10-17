<?php

namespace App\Actions;

use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;

class OptimizeWebpImageAction
{
    public function handle(string $input): array
    {
        $image = Image::read($input);

        if ($image->width() > 1000) {
            $image->scale(width: 1000);
        }

        $encoded = $image->toWebp(quality: 95)->toString();
        $fileName = Str::random() . '.webp';

        return  [
            'fileName' => $fileName,
            'webpString' => $encoded,
        ];
    }
}
