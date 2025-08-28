<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Roles</h3>
                    <a href="{{ route('roles.create') }}"
                       class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition">
                        Create
                    </a>
                </div>

                <!-- Roles Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-200">#</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-200">Name</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-200">Permissions</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-200">Created</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-200">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                                <tr class="border-t border-gray-200 dark:border-gray-700">
                                    <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $role->id }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $role->name }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $role->permissions->pluck('name')->implode(', ') }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $role->created_at->format('d M, Y') }}
                                    </td>
                                    <td class="px-4 py-2 flex space-x-2">
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                           class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                                           Edit
                                        </a>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No roles found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
