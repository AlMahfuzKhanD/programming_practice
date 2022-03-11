<?php

namespace App\Http\Controllers;
use app\Models\Tag;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function addTag(Request $request){
        return Tag::create([
            'tagName' => $request->tagName
        ]);
    }

    public function getTag(){
        return Tag::orderBy('id','desc')->get();
    }
}
