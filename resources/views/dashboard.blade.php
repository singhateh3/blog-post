<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @can('isAdmin')
                        <div class="bg-blue-100 p-6 rounded-lg shadow-lg">
                            <h3 class="text-2xl font-bold text-blue-600">Admin Section</h3>
                            <p class="mt-4">Welcome, Admin! Here you can manage all aspects of the application.</p>
                        </div>
                        <div class="statistics grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="stat-item bg-blue-100 p-6 rounded-lg text-center">
                                <h2 class="text-2xl font-semibold text-blue-600">Total Users</h2>
                                <p class="text-4xl font-bold mt-2">{{ $userCount }}</p>
                            </div>
                            <div class="stat-item bg-green-100 p-6 rounded-lg text-center">
                                <h2 class="text-2xl font-semibold text-green-600">Total Posts</h2>
                                <p class="text-4xl font-bold mt-2">{{ $postCount }}</p>
                            </div>
                        </div>
                    @elseif (auth()->user()->role === 'editor')
                        <div class="bg-green-100 p-6 rounded-lg shadow-lg">
                            <h3 class="text-2xl font-bold text-green-600">Editor Section</h3>
                            <p class="mt-4">Welcome, Editor! You have access to manage posts and content.</p>
                        </div>
                    @elseif (auth()->user()->role === 'user')
                        <div class="bg-yellow-100 p-6 rounded-lg shadow-lg">
                            <h3 class="text-2xl font-bold text-yellow-600">User Section</h3>
                            <p class="mt-4">Welcome, User! Explore the latest content and engage with the community.</p>

                            @if ($authUserPosts->isEmpty())
                                <p class="mt-4 text-gray-700">You have not created any posts yet. Start sharing your
                                    thoughts!</p>
                            @else
                                <div class="mt-6 space-y-4">
                                    @foreach ($authUserPosts as $post)
                                        <div class="post bg-white p-4 rounded-lg shadow-md">
                                            <h4 class="text-lg font-semibold text-gray-800">{{ $post->title }}</h4>
                                            <p class="mt-2 text-gray-600">{{ Str::limit($post->content, 100) }}</p>
                                            <a href="{{ route('posts.show', $post->id) }}"
                                                class="text-blue-500 mt-2 inline-block">Read More</a>
                                        </div>
                                    @endforeach

                                </div>
                            @endif
                        </div>
                    @else
                        <div class="bg-red-100 p-6 rounded-lg shadow-lg">
                            <h3 class="text-2xl font-bold text-red-600">Access Denied</h3>
                            <p class="mt-4">You do not have access to this content.</p>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
