<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    private $post;

    public function __construct(Post $post){
        $this->post = $post;

    }

    public function index(){
        $posts = $this->post->all();

        if(Gate::denies('view_post')){
            return redirect()->back();
        }

        return view('painel.posts.index', compact('posts'));
    }
}
