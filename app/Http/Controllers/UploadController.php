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
            $metadata = json_decode($_POST['file'], true);
            $filename = $file->getClientOriginalName();
            $folder = Auth::user()->username.'_'.$metadata['folder'];
            $file->storeAs('tmp/'. $folder, $filename);

            $return = [
                'filename' => $filename,
                'folder' => $folder,
            ];

            return $return;
        }

        return '';
    }

    public function destroy(Request $request) {
        $metadata = json_decode(request()->getContent(), true);
        $filename = $metadata['filename'];
        $folder = $metadata['folder'];
        Storage::delete('tmp/'.$folder.'/'.$filename);

        return '';
    }
}
