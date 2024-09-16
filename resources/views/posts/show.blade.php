<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h3 class="text-2xl font-bold text-gray-800">{{ $post->title }}</h3>
                        <p class="text-gray-600 mt-2">Category:
                            {{ $post->category ? $post->category->name : 'Uncategorized' }}</p>
                    </div>

                    <div class="mb-4">
                        <h4 class="font-bold">Content:</h4>
                        <p class="text-gray-700">{{ $post->content }}</p>
                    </div>

                    <div class="mb-4">
                        <h4 class="font-bold">Tags:</h4>
                        @if ($post->tags->isNotEmpty())
                            <ul class="list-disc list-inside text-gray-600">
                                @foreach ($post->tags as $tag)
                                    <li>{{ $tag->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-600">No tags associated with this post.</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <h3 class="text-2xl font-bold text-gray-800">{{ $post->title }}</h3>
                        <p class="text-gray-600 mt-2">Category:
                            {{ $post->category ? $post->category->name : 'Uncategorized' }}</p>
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                                class="mt-4 w-full h-auto object-cover">
                        @endif
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                            <div class="text-gray-700 text-sm font-semibold">
                                <p>Created at: <span
                                        class="text-gray-900">{{ $post->created_at->format('F d, Y h:i A') }}</span></p>
                                <p>Updated at: <span
                                        class="text-gray-900">{{ $post->updated_at->format('F d, Y h:i A') }}</span></p>
                            </div>
                        </div>

                    </div>

                    <div class="mt-6">
                        <a href="{{ route('posts.edit', $post->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Edit Post
                        </a>

                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this post?')"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Delete Post
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
