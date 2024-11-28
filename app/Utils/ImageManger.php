<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageManger
{
    //upload images in post
    public static function uplaodImages($request, $post = null, $user = null)
    {
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
               $file=self::generateFileName($image);
                //upload images to local
                $path = self::storeImageInLocal($image, 'posts', $file);

                //upload images to database
                $post->images()->create([
                    'path' => $path,
                ]);
            }
        }

        //update single image user
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            //delete image from local
           self::deleteImageFromLocal($user->image);
            //store new image in local
            $file=self::generateFileName($image);

            $path = self::storeImageInLocal($image, 'users', $file);

            //stor new image in data base
            $user->update(['image' => $path]);
        }
    }

    //delete image in post
    public static function deleteImage($post)
    {

        if ($post->images->count() > 0) {
            foreach ($post->images as $image) {
                self::deleteImageFromLocal($image->path);

                $image->delete();

            }
        }


    }
    public static function generateFileName($image){
        $file = Str::uuid() . time() . $image->getClientOriginalExtension();


        return $file;

    }

    public static function storeImageInLocal($image,$path, $file_name)
    {
        $path = $image->storeAs('uploads/' . $path, $file_name, ['disk' => 'uploads']);
        return $path;
    }

    public static function deleteImageFromLocal($image_path){
        if (File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
    }
}
