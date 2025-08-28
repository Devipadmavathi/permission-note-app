@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-2xl text-white leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Users Summary Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl p-6">
                <h3 class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mb-4 flex justify-between">
                    <span>Users</span>
                    <span class="text-sm bg-indigo-100 dark:bg-indigo-700 text-indigo-700 dark:text-indigo-200 px-2 py-1 rounded">
                        {{ $users->count() ?? 0 }}
                    </span>
                </h3>
                <p class="text-gray-700 dark:text-gray-300">Total registered users in the system.</p>
                <a href="{{ route('users.index') }}" class="mt-4 inline-block text-indigo-500 hover:text-indigo-700 font-semibold">View All Users &rarr;</a>
            </div>

            <!-- Roles Summary Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl p-6">
                <h3 class="text-xl font-bold text-green-600 dark:text-green-400 mb-4 flex justify-between">
                    <span>Roles</span>
                    <span class="text-sm bg-green-100 dark:bg-green-700 text-green-700 dark:text-green-200 px-2 py-1 rounded">
                        {{ $roles->count() ?? 0 }}
                    </span>
                </h3>
                <p class="text-gray-700 dark:text-gray-300">Defined roles for user access control.</p>
                <a href="{{ route('roles.index') }}" class="mt-4 inline-block text-green-500 hover:text-green-700 font-semibold">View All Roles &rarr;</a>
            </div>

            <!-- Permissions Summary Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl p-6">
                <h3 class="text-xl font-bold text-purple-600 dark:text-purple-400 mb-4 flex justify-between">
                    <span>Permissions</span>
                    <span class="text-sm bg-purple-100 dark:bg-purple-700 text-purple-700 dark:text-purple-200 px-2 py-1 rounded">
                        {{ $permissions->count() ?? 0 }}
                    </span>
                </h3>
                <p class="text-gray-700 dark:text-gray-300">Granular permissions available in the application.</p>
                <a href="{{ route('permissions.index') }}" class="mt-4 inline-block text-purple-500 hover:text-purple-700 font-semibold">View All Permissions &rarr;</a>
            </div>

            <!-- Notes Summary Card (Example, if you had one) -->
            {{--
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl p-6">
                <h3 class="text-xl font-bold text-blue-600 dark:text-blue-400 mb-4 flex justify-between">
                    <span>Notes</span>
                    <span class="text-sm bg-blue-100 dark:bg-blue-700 text-blue-700 dark:text-blue-200 px-2 py-1 rounded">
                        {{ $notes->count() ?? 0 }}
                    </span>
                </h3>
                <p class="text-gray-700 dark:text-gray-300">Number of notes created.</p>
                <a href="{{ route('notes.index') }}" class="mt-4 inline-block text-blue-500 hover:text-blue-700 font-semibold">View All Notes &rarr;</a>
            </div>
            --}}

        </div>
    </div>
@endsection
