<?php

namespace App\Http\Controllers;

use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10); // 또는 필요한 로직에 따라 게시글을 가져옴
        return view('dashboard', ['posts' => $posts]);
    }
}
