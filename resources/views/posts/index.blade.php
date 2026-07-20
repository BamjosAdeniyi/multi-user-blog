<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Your Timeline') }}
                </h2>
                <p class="mt-2 text-gray-600">
                    Capture your thoughts and experiences.
                </p>
            </div>
            <div>
                <a href="{{ route('posts.create') }}"
                    class="px-5 py-4 bg-black text-white rounded-xl hover:opacity-90 transition">
                    New Post
                </a>
            </div>
        </div>
    </x-slot>
    <div class="py-6 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="GET" class="mb-8 mt-6">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search entries..."
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white">
                </form>
                <div class="flex gap-2 mb-8">
                    <a href="{{ route('posts.index', ['sort' => 'newest', 'search' => request('search')]) }}"
                        class="px-4 py-2 bg-white border rounded-xl">
                        Newest
                    </a>

                    <a href="{{ route('posts.index', ['sort' => 'oldest', 'search' => request('search')]) }}"
                        class="px-4 py-2 bg-white border rounded-xl">
                        Oldest
                    </a>

                    <a href="{{ route('posts.index', ['sort' => 'title_asc', 'search' => request('search')]) }}"
                        class="px-4 py-2 bg-white border rounded-xl">
                        A-Z
                    </a>

                    <a href="{{ route('posts.index', ['sort' => 'title_desc', 'search' => request('search')]) }}"
                        class="px-4 py-2 bg-white border rounded-xl">
                        Z-A
                    </a>
                </div>

                @if ($posts->isEmpty())
                    @if (request('search'))
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-12 text-center">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">
                                No posts match Laravel relationship
                            </h2>
                        </div>
                    @else
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-12 text-center">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">
                                No posts yet
                            </h2>

                            <p class="text-gray-500 mb-6">
                                Create your first post to get started.
                            </p>

                            <a href="{{ route('posts.create') }}"
                                class="inline-block px-5 py-3 bg-black text-white rounded-xl">
                                Create First Post
                            </a>
                        </div>
                    @endif
                @else
                    <div class="space-y-4">
                        @foreach ($posts as $post)
                            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-300 hover:shadow-md transition">
                                {{-- <a href="{{ route('posts.show', $post) }}"> --}}
                                    <p class="text-gray-600 mt-2">
                                         {{'@' . $post->user->name }}
                                    </p>
                                    <h2 class="text-xl font-semibold text-gray-900">
                                        <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                    </h2>

                                    <p class="text-gray-600 mt-2">
                                        {{ $post->excerpt }}
                                    </p>

                                    <p class="text-black-600 p-6">
                                        {{ $post->body }}
                                    </p>

                                    <div class="flex justify-between items-center mt-4 text-sm text-gray-500">
                                        {{ $post->created_at->diffForHumans() }}
                                        @can('delete', $post)
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="text-sm text-red-600 hover:text-red-800"
                                                    onclick="return confirm('Delete this entry?')">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                {{-- </a> --}}
                            </div>
                        @endforeach
                    </div>
                @endif
                {{-- <div class="mt-8">
                    {{ $post->links() }}
                </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
