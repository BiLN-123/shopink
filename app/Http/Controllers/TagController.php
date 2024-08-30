<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q');
        $tags = Tag::where('name', 'LIKE', "%{$search}%")->get();

        return response()->json($tags);

//        if ($tags->isEmpty() && $tags == '') {
//            $tags = Tag::all();
//        }
    }


//    public function indexAll()
//    {
//        $tagsAll = Tag::all();
//        return response()->json($tagsAll);
//    }
}
