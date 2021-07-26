<?php

namespace App\Traits;

trait uploadTrait
{

    public function uploadPhoto($id, $image, $folder)
    {
        $fileName = $id . '_' . time() . '.' . $image->extension();
        $image->move(public_path('images/' . $folder), $fileName);
        return $fileName;
    }

    public function deletePhoto($path)
    {
        if (file_exists($path)) {
            unlink($path);
            return 1;
        }
    }
}
