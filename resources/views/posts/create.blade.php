<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Create Posts') }}
                </h2>
                <p class="mt-2 text-gray-600">
                    Share your thoughts and experiences.
                </p>
            </div>
        </div>
    </x-slot>
    <div class="py-6 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mt-4">
                    <form action="{{ route('posts.store') }}" method="POST">

                        @csrf

                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Title
                            </label>

                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">

                            @error('title')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                                Excerpt
                            </label>

                            <textarea name="excerpt" id="excerpt" rows="5"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="body" class="block text-sm font-medium text-gray-700 mb-2">
                                Body
                            </label>

                            <textarea name="body" id="body" rows="5"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-4">

                            <a href="{{ route('posts.index') }}"
                                class="px-5 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition">
                                Cancel
                            </a>

                            <button type="submit"
                                class="px-5 py-3 bg-black text-white rounded-xl hover:opacity-90 transition">
                                Create Post
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
