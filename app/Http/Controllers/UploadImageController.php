<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    public function __invoke(Request $request)
    {
        $name = "IMG_" . time() . '.' . $request->upload->getClientOriginalExtension();
        $request->upload->storeAs('images', $name);

        return response()->json(['fileName' => $name, 'uploaded' => true, 'url' => url("storage/images/$name")]);
    }
}
