<?php


namespace App\Actions;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreImage
{
    public static function handle($imageBase64, $path, $name)
    {
        $image = base64_decode($imageBase64);
        $str = now();
        $public = "public/";
        $storage = "storage/";
        $filename =  $path . $name . '$' . str_replace(' ', '', $str) . '.jpg';
        Storage::put($public . $filename, $image);
        return $storage . $filename;
    }

    public static function delete($filename)
    {
        return Storage::delete("public/".substr($filename, 8,strlen($filename)));
    }
}
