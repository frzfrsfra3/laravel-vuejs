<?php
namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
trait ImageTrait
{
    public function storeImg($photo)
    {
        $name=time().'.'.explode('/',explode(':',substr($photo,0,strpos($photo,';')))[1])[1];
        // $request->merge(['photo'=>$name]);
        Image::make($photo)->save(public_path('img/profile/').$name);

        // $userPhoto =public_path('img/profile/').$currentPhoto;
        return $name;
    }
    public function UserImageUpload($query  ) // Taking input image as parameter
    {
        $image_name = str_random(20);
        $ext = strtolower($query->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $image_full_name = $image_name.'.'.$ext;
        $upload_path = 'img/';    //Creating Sub directory in Public folder to put image
        $image_url = $upload_path.$image_full_name;
        $success = $query->move($upload_path,$image_full_name);

        return $image_url; // Just return image
    }
}
