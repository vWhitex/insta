<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Get a listing of posts.
     */
    public function index(Request $request)
    {
        $query = Post::query()
            ->with(['user:id,name,username,profile_photo_path'])
            ->latest();

        // Add related data if requested
        if ($request->has('with')) {
            $with = $request->input('with');

            if (in_array('comments.user', $with)) {
                $query->with(['comments' => function ($query) {
                    $query->with('user:id,name,username,profile_photo_path')
                          ->latest()
                          ->take(5);
                }]);
            }

            if (in_array('likes_count', $with)) {
                $query->withCount('likes');
            }
        }

        // Paginate results
        $perPage = $request->input('per_page', 10);
        $posts = $query->paginate($perPage);

        // Add the time_ago attribute to each post
        $posts->getCollection()->transform(function ($post) {
            $post->time_ago = $post->created_at->diffForHumans();
            return $post;
        });

        return response()->json($posts);
    }

    /**
     * Get posts from users the authenticated user follows.
     */
    public function following(Request $request)
    {
        $user = $request->user();

        $query = Post::whereIn('user_id', function ($query) use ($user) {
                $query->select('followed_user_id')
                      ->from('follows')
                      ->where('user_id', $user->id);
            })
            ->with(['user:id,name,username,profile_photo_path'])
            ->latest();

        // Add related data if requested
        if ($request->has('with')) {
            $with = $request->input('with');

            if (in_array('comments.user', $with)) {
                $query->with(['comments' => function ($query) {
                    $query->with('user:id,name,username,profile_photo_path')
                          ->latest()
                          ->take(5);
                }]);
            }

            if (in_array('likes_count', $with)) {
                $query->withCount('likes');
            }
        }

        // Paginate results
        $perPage = $request->input('per_page', 10);
        $posts = $query->paginate($perPage);

        // Add the time_ago attribute to each post
        $posts->getCollection()->transform(function ($post) {
            $post->time_ago = $post->created_at->diffForHumans();
            return $post;
        });

        return response()->json($posts);
    }

    /**
     * Store a new post.
     */
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'nullable|string|max:2200',
            'image' => 'required|image|max:10240', // Max 10MB
        ]);

        $user = $request->user();

        // Store the image
        $path = $request->file('image')->store('posts', 'public');

        // Create the post
        $post = Post::create([
            'user_id' => $user->id,
            'caption' => $request->input('caption'),
            'image_path' => $path,
        ]);

        return response()->json($post, 201);
    }

    /**
     * Show a specific post.
     */
    public function show(Post $post)
    {
        $post->load([
            'user:id,name,username,profile_photo_path',
            'comments' => function ($query) {
                $query->with('user:id,name,username,profile_photo_path')
                      ->latest();
            },
        ]);

        $post->loadCount('likes');
        $post->time_ago = $post->created_at->diffForHumans();

        return response()->json($post);
    }

    /**
     * Like a post.
     */
    public function like(Request $request, Post $post)
    {
        $user = $request->user();

        // Check if already liked
        if (!$post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->attach($user->id);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Unlike a post.
     */
    public function unlike(Request $request, Post $post)
    {
        $user = $request->user();
        $post->likes()->detach($user->id);

        return response()->json(['success' => true]);
    }

    /**
     * Check if user has liked a post.
     */
    public function checkLiked(Request $request, Post $post)
    {
        $user = $request->user();
        $liked = $post->likes()->where('user_id', $user->id)->exists();

        return response()->json(['liked' => $liked]);
    }

    /**
     * Add a comment to a post.
     */
    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:2200',
        ]);

        $user = $request->user();

        $comment = $post->comments()->create([
            'user_id' => $user->id,
            'content' => $request->input('content'),
        ]);

        $comment->load('user:id,name,username,profile_photo_path');

        return response()->json($comment, 201);
    }

    /**
     * Delete a comment.
     */
    public function deleteComment(Request $request, Comment $comment)
    {
        $user = $request->user();

        // Check if user owns the comment or the post
        if ($comment->user_id !== $user->id && $comment->post->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['success' => true]);
    }
}
