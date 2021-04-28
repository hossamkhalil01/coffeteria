<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Http\Requests\ImageUploadRequest;
use App\Models\User;

class imagecontroller extends Controller
{
    //
    public function upload(ImageUploadRequest $request)
    {


        $file = $request->file('avatar');
        $name = Str::random(10);
        $url = \Storage::putFileAs('storage/images/avatars', $file, $name . '.' . $file->extension());
        return ['url' => env('APP_URL') . '/' . $url];
    }
}
