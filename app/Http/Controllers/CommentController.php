<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Post $post)
    {
        // 특정 게시글에 속하는 댓글을 가져오는 로직
        $comments = $post->comments;

        return view('comment.index', compact('comments', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'content' => 'required',
        ], [
            'content.required' => '내용은 입력해 주세요.',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'content' => $request->content,
            'parent_id' => $request->parent_id, // 부모 댓글의 ID
        ]);

        return redirect()->back()->with('success', '댓글이 작성되었습니다.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);
    
        // 다음의 코드를 추가하여 해당 댓글을 삭제합니다.
        $comment->delete();

        return redirect()->back()->with('success', '댓글이 삭제되었습니다.');
    }
}
