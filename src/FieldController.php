<?php

namespace Halimtuhu\ArrayFiles;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class FieldController extends Controller
{
    public function index(Request $request)
    {
        return "array files by halimtuhu";
    }

    public function upload(Request $request)
    {
        $disk = $request->disk ? $request->disk : 'public';
        $path = $request->path ? $request->path : '/';

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $savedFileName = Storage::disk($disk)->putFileAs($path, $file, $fileName);

        $data = [
            'originalName' => $request->file('file')->getClientOriginalName(),
            'editableName' => $request->file('file')->getClientOriginalName(),
            'name' => $savedFileName,
            'url' => Storage::url($file),
        ];

        return $data;
    }

    public function delete($file)
    {
        Storage::delete($file);

        return "success";
    }
}
