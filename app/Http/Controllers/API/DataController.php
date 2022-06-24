<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function home()
    {
        $posts = Post::select(['id', 'title', 'user_id',])->with(['user'])->get();
        
        $new_posts = $posts->map(function ($item){
            return [
                'id'    =>  $item->id,
                'title' =>  $item->title,
                'username'  =>  $item->user->name
            ];
        });

        return response()->json($new_posts);
    }

    public function CheckPost(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'age'   =>  'required',
        ]);

        return response()->json($request->all());
    }
}
// return $posts->first();

        // $new_posts = $posts->map(function ($item){
        //     return [
        //         'id' => $item->id,
        //         'title' =>  strtoupper($item->title),
        //     ];
        // });
        
        // $new_posts = $posts->filter(function ($item){
        //     return $item->id>1;
        // });