<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ], [
            'title.required' => '제목은 필수 입력 항목입니다.',
            'title.max' => '제목은 최대 255자까지 입력 가능합니다.',
            'content.required' => '내용은 필수 입력 항목입니다.',
        ]);

        $userId = auth()->user()->id;

        $post = Post::create([
            'user_id' => $userId,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('dashboard')->with('success', '게시글이 등록되었습니다.');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('post.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // 생성한 유저만 수정 가능하도록 체크
        if ($post->user_id != auth()->user()->id) {
            return redirect()->route('post.show')->with('error', '게시글을 수정할 권한이 없습니다.');
        }

        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // 생성한 유저만 업데이트 가능하도록 체크
        if ($post->user_id != auth()->user()->id) {
            return redirect()->route('dashboard')->with('error', '게시글을 수정할 권한이 없습니다.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ], [
            'title.required' => '제목은 필수 입력 항목입니다.',
            'title.max' => '제목은 최대 255자까지 입력 가능합니다.',
            'content.required' => '내용은 필수 입력 항목입니다.',
        ]);

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('dashboard')->with('success', '게시글이 업데이트되었습니다.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // 생성한 유저만 삭제 가능하도록 체크
        if ($post->user_id != auth()->user()->id) {
            return redirect()->route('post.show')->with('error', '게시글을 삭제할 권한이 없습니다.');
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', '게시글이 삭제되었습니다.');
    }
}
