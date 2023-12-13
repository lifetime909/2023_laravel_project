<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto mt-8">
                        <div class="pb-4">
                            <h2 class="text-3xl font-semibold mb-4">{{ $post->title }}</h2>
                            <p class="text-sm text-gray-500">
                                작성자: {{ $post->user->name }}
                            </p>
                            <p class="text-gray-600 mb-6">{{ $post->created_at->format('F d, Y') }}</p>
                            <p class="text-gray-800">{{ $post->content }}</p>
                        </div>
                        <x-comment-section :post="$post"/>

                        <div class="flex items-center justify-end mt-2">
                            @if ($post->user_id == auth()->user()->id)
                                <a href="{{ route('posts.edit', $post->id) }}" class="border-2 border-blue-300 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-6 rounded mr-2">수정</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-2 border-red-500 bg-red-300 hover:bg-red-600 text-red-500 hover:text-white font-bold py-1 px-3 rounded" onclick="return confirm('게시글을 삭제하시겠습니까?')">삭제</button>
                                </form>
                                @if (session('error'))
                                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mt-2">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
