<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $posts = auth()
        //     ->user()
        //     ->posts()
        //     ->latest()
        //     ->paginate(10);

        // To display posts created by all users on the platform and not just the post by the signed in user
        $posts = Post::with('user')
            ->whereNotNull('published_at')
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        //
        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'excerpt' => ['required'],
            'body' => ['required'],
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        auth()->user()->posts()->create($validated);

        return redirect()->route('posts.show', $post)->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        if (! $post->isPublished() && auth()->id() !== $post->user_id) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Using policy for authorization to edit post
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Using policy for authorization to update post
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'excerpt' => ['required'],
            'body' => ['required'],
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $post->update($validated);

        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Using policy for authorization to delete post
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.mine')->with('success', 'Post created successfully.');
    }

    public function publish(Post $post)
    {
        $this->authorize('publish', $post);

        $post->update([
            'published_at' => now(),
        ]);

        return redirect()
            ->route('posts.mine', $post)
            ->with('success', 'Post published successfully.');
    }

    public function myPosts()
    {
        $user = auth()->user();

        $allCount = $user->posts()->count();

        $publishedCount = $user->posts()
            ->whereNotNull('published_at')
            ->count();

        $draftCount = $user->posts()
            ->whereNull('published_at')
            ->count();

        $query = $user->posts()->latest();

        if (request('status') === 'published') {
            $query->whereNotNull('published_at');
        }

        if (request('status') === 'draft') {
            $query->whereNull('published_at');
        }

        $posts = $query
            ->paginate(10)
            ->withQueryString();

        return view('posts.my-posts', compact(
            'posts',
            'allCount',
            'publishedCount',
            'draftCount'
        ));
    }

    public function unpublish(Post $post)
    {
        $this->authorize('unpublish', $post);

        $post->update([
            'published_at' => null,
        ]);

        return redirect()
            ->route('posts.mine')
            ->with('success', 'Post moved back to drafts.');
    }
}
