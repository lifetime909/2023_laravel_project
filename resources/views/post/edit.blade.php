<!-- resources/views/posts/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto mt-8">
                        <form action="{{ route('posts.update', $post) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="title" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Title</label>
                                <input type="text" name="title" id="title" class="mt-1 p-2 border rounded-md w-full" value="{{ old('title', $post->title) }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="content" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Content</label>
                                <textarea name="content" id="content" rows="12" class="resize-none mt-1 p-2 border rounded-md w-full h-auto" required>{{ old('content', $post->content) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Update Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
    

