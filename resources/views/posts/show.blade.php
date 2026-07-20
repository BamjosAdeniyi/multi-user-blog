<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __($post->title) }}
                </h2>
                <div class="mt-2 text-sm text-gray-500">
                    Author: {{ $post->user->name }}
                </div>
                <div class="mt-2 text-sm text-gray-500">
                    Created {{ $post->created_at->diffForHumans() }}
                </div>
            </div>
            <div class="flex gap-2 justify-end items-center">
                {{-- To hide edit button from guest users --}}
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}"
                        class="px-5 py-4 bg-black text-white rounded-xl hover:opacity-90 transition">
                        Edit
                    </a>
                @endcan
                {{-- To hide delete button from guest users --}}
                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this entry?');">
                        @csrf
                        @method('DELETE')
    
                        <button type="submit"
                            class="px-5 py-4 bg-red-600 text-white rounded-xl hover:opacity-90 transition">
                            Delete
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($post->excerpt)
                        <p class="text-black-600 font-semibold justify-center">
                            {{ $post->excerpt }}
                        </p>
                    @endif
                </div>
                <div class="px-6 pb-6 text-gray-900">
                    @if ($post->body)
                        <p class="text-gray-600 justify-center">
                            {{ $post->body }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
