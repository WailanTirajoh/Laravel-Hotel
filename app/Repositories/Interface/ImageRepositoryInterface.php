<?php

namespace App\Repositories\Interface;

interface ImageRepositoryInterface
{
    public function uploadImage($path, $file);

    public function destroy($dir);
}
