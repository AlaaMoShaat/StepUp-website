<?php

namespace App\Utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ImageManeger
{
    public static function uploadImages($images, $model, $disk)
    {
        foreach ($images as $image) {
            $file = self::generateImageName($image);
            $path = self::storeImageLocaly($image, '/', $file, $disk);
            $model->images()->create([
                'file_name' => $file,
            ]);
        }
    }

    public static function deleteImages($post)
    {
        if ($post->images->count() > 0) {
            foreach ($post->images as $image) {
                self::deleteImageFromLocal($image->path);
                $image->delete();
            }
        }
    }

    public function uploadSingleImage($path, $image, $disk) {
        $imageName = self::generateImageName($image);
        self::storeImageLocaly($image, $path, $imageName, $disk);
        return $imageName;
    }

    public static function generateImageName($image)
    {
        $file_name = Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
        return $file_name;
    }

    public static function storeImageLocaly($image, $path, $filename, $disk)
    {
        $path = $image->storeAs($path, $filename, ['disk' => $disk]);
        return $path;
    }

    public static function deleteImageFromLocal($path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}