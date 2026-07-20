<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Your Posts') }}
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
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

                    <div class="flex flex-wrap gap-3 mb-6">

                        <a href="{{ route('posts.mine') }}"
                            class="px-4 py-2 rounded-xl border
                                {{ !request('status') ? 'bg-black text-white border-black' : 'bg-white text-gray-700 border-gray-300' }}">

                            All ({{ $allCount }})

                        </a>

                        <a href="{{ route('posts.mine', ['status' => 'published']) }}"
                            class="px-4 py-2 pr-2 rounded-xl border
                                {{ request('status') === 'published'
                                    ? 'bg-black text-white border-black'
                                    : 'bg-white text-gray-700 border-gray-300' }}">

                            Published ({{ $publishedCount }})
                            <span class="inline-block w-3 h-3 bg-green-500 rounded-full mx-2"></span>
                        </a>

                        <a href="{{ route('posts.mine', ['status' => 'draft']) }}"
                            class="px-4 py-2 pr-2 rounded-xl border
                                {{ request('status') === 'draft'
                                    ? 'bg-black text-white border-black'
                                    : 'bg-white text-gray-700 border-gray-300' }}">

                            Drafts ({{ $draftCount }})
                            <span class="inline-block w-3 h-3 bg-gray-500 rounded-full mx-2"></span>
                        </a>

                    </div>

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
                            <div
                                class="bg-white rounded-2xl shadow-sm p-6 border border-gray-300 hover:shadow-md transition">
                                {{-- <a href="{{ route('posts.show', $post) }}"> --}}
                                <h2 class="text-xl font-semibold text-gray-900">
                                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                    @if ($post->isPublished())
                                        <span class="inline-block w-3 h-3 bg-green-500 rounded-full mx-2"></span>
                                    @else
                                        <span class="inline-block w-3 h-3 bg-gray-500 rounded-full mx-2"></span>
                                    @endif
                                </h2>

                                <p class="text-gray-600 mt-2">
                                    {{ $post->excerpt }}
                                </p>

                                <p class="text-black-600 p-6">
                                    {{ $post->body }}
                                </p>

                                <div class="flex justify-between items-center mt-4 text-sm text-gray-500">
                                    {{ $post->created_at->diffForHumans() }}
                                    {{-- @can('delete', $post)
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="text-sm text-red-600 hover:text-red-800"
                                                onclick="return confirm('Delete this entry?')">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan --}}
                                    <div class="flex flex-wrap gap-3 mt-4">

                                        <a href="{{ route('posts.show', $post) }}"
                                            class="text-sm text-gray-600 hover:text-gray-800">
                                            {{ $post->isPublished() ? 'View' : 'Preview' }}
                                        </a>

                                        <a href="{{ route('posts.edit', $post) }}"
                                            class="text-sm text-gray-600 hover:text-gray-800">
                                            Edit
                                        </a>

                                        @if (!$post->isPublished())
                                            <form action="{{ route('posts.publish', $post) }}" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit" class="text-sm text-gray-600 hover:text-gray-800"
                                                    onclick="return confirm('Publish this post?')>
                                                    Publish
                                                </button>
                                            </form>
@else
<form action="{{ route('posts.unpublish', $post) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit"
                                                        class="text-sm text-gray-600 hover:text-gray-800"
                                                        onclick="return confirm('Unpublish this post?')">
                                                        Unpublish
                                                    </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="text-sm text-red-600 hover:text-red-800"
                                                onclick="return confirm('Delete this entry?')">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
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
