<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{
    public function mockImages(Request $request, $filename)
    {
        $resp = Http::get('https://picsum.photos/500/600');
        if ($resp->status() === 200){
            return response()->make($resp->body(), 200, ['content-type' => 'image/jpg']);
        }
        return response()->json(['status' => 'not found'], 404);
    }
}
