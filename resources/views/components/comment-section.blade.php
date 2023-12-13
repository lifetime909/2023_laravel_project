
<script>
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
    }
</script>


<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
    <h2 class="text-2xl font-semibold mb-4">댓글</h2>

    @forelse ($post->comments as $comment)
        <div class="mb-4 border-b pb-2">
            <div class="justify-between flex block">
                <p class="text-lg font-semibold">{{ $comment->user->name }}:</p>
                @if ($comment->user_id == auth()->user()->id)
                <div>
                    <form action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-red-500">댓글 삭제</button>
                    </form>
                </div>
                @endif
            </div>
            <p class="text-gray-700">{!! nl2br(e($comment->content)) !!}</p>
            <!-- Comment Blade 파일 내부 -->
            @auth
            @endauth
        </div>
    @empty
        <p class="text-gray-500">댓글이 없습니다.</p>
    @endforelse

    <!-- 댓글 입력 폼 -->
    @auth
        <form action="{{ route('posts.comments.store', $post->id) }}" method="post" class="mt-4">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="justify-between flex block ">
                <textarea name="content" class=" resize-none w-full p-2 border rounded-md" oninput="autoResize(this)" placeholder="댓글을 작성하세요..." required></textarea>
                <button type="submit" class="ml-2 bg-blue-500 text-white px-2 rounded hover:bg-blue-700 w-32"> 작성</button>
            </div>
        <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </form>
    @endauth
</div>