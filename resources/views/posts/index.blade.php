<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('posts.create') }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Add New Post
                        </a>
                    </div>

                    @if ($posts->isEmpty())
                        <p class="text-gray-700">No posts available.</p>
                    @else
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight">Title</th>
                                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight">Category
                                    </th>
                                    <th class="py-2 px-4 border-b-2 border-gray-300 text-right leading-tight">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $post->title }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">
                                            {{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-right">
                                            <div class="flex justify-end space-x-1">
                                                <a href="{{ route('posts.show', $post->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                    View
                                                </a>
                                                @if (auth()->user()->id === $post->user_id || auth()->user()->role === 'admin' || auth()->user()->role === 'editor')
                                                    <a href="{{ route('posts.edit', $post->id) }}"
                                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('posts.destroy', $post->id) }}"
                                                        method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this post?')"
                                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
