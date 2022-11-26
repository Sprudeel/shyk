<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    public function store(Request $request) {
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $folder = uniqid(). "-" . now()->timestamp;
            $file->storeAs('tmp/'. $folder, $filename);

            return $folder;
        }

        return '';
    }
}
