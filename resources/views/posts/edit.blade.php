<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit Posts') }}
                </h2>
                <p class="mt-2 text-gray-600">
                    Edit this post
                </p>
            </div>
        </div>
    </x-slot>
    <div class="py-6 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mt-4">
                    <form action="{{ route('posts.update', $post) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Title
                            </label>

                            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
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
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">{{ old('excerpt', $post->excerpt) }}</textarea>
                            @error('excerpt')
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
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">{{ old('body', $post->body) }}</textarea>
                            @error('body')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-4">

                            <a href="{{ route('posts.show', $post) }}"
                                class="px-5 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition">
                                Cancel
                            </a>

                            <button type="submit"
                                class="px-5 py-3 bg-black text-white rounded-xl hover:opacity-90 transition">
                                Save
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
