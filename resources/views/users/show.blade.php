@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-2xl text-white leading-tight">
        {{ __('User Details: ' . $user->name) }}
    </h2>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl p-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">User Details</h2>

            <div class="space-y-4">
                <div>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Name:</p>
                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Email:</p>
                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Roles:</p>
                    <div class="mt-1 flex flex-wrap gap-2">
                        @forelse($user->roles as $role)
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-800 dark:bg-indigo-700 dark:text-indigo-200 rounded-full text-sm font-medium">
                                {{ $role->name }}
                            </span>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 italic">No roles assigned.</p>
                        @endforelse
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Direct Permissions:</p>
                    <div class="mt-1 flex flex-wrap gap-2">
                        @forelse($user->permissions as $permission)
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 dark:bg-purple-700 dark:text-purple-200 rounded-full text-sm font-medium">
                                {{ $permission->name }}
                            </span>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 italic">No direct permissions assigned.</p>
                        @endforelse
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Created At:</p>
                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $user->created_at->format('d M, Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Last Updated:</p>
                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $user->updated_at->format('d M, Y H:i') }}</p>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('users.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                    Edit User
                </a>
                <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Back to Users
                </a>
            </div>
        </div>
    </div>
@endsection
