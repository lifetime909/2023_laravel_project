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
                    <h1 class="text-2xl font-semibold mb-6">{{ __("Posts") }}</h1>

                    @forelse ($posts as $post)
                        <div class="mb-4 border dark:border-gray-700 p-4 rounded-md">
                            <a href="{{ route('posts.show', $post) }}">
                                <div class="flex items-center">    
                                    <h2 class="text-xl font-semibold overflow-hidden whitespace-nowrap overflow-ellipsis">
                                        {{ $post->title }}
                                    </h2>
                                    <p class="text-sm text-gray-500 pl-3 w-40">
                                        작성자: {{ $post->user->name }}
                                    </p>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ \Illuminate\Support\Str::limit($post->content, 200) }}
                                </p>
                            </a>
                        </div>
                    @empty
                        <div class="flex items-center justify-center h-64">
                            <p class="text-lg text-gray-500">{{ __("No posts found") }}</p>
                        </div>
                    @endforelse

                    <!-- 페이징 링크 표시 -->
                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>

                    <!-- 게시글 추가 버튼 -->
                    <a href="{{ route('posts.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Create Post</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
