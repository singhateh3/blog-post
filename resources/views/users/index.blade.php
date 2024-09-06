<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('users.create') }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Add New User
                        </a>
                    </div>

                    @if ($users->isEmpty())
                        <p class="text-gray-700">No users available.</p>
                    @else
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight">Name</th>
                                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight">Email</th>
                                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight">Role</th>
                                    <th class="py-2 px-4 border-b-2 border-gray-300 text-right leading-tight">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $user->name }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $user->email }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $user->role }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-right">
                                            <a href="{{ route('users.show', $user->id) }}"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                View
                                            </a>
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                Edit
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this user?')"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                    Delete
                                                </button>
                                            </form>
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
