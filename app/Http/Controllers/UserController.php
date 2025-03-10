<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Register a new user.
     */

     public function index()
     {
         $users = User::all(); // Or you could paginate results if you have a lot of users
         return response()->json($users);
     }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:30|unique:users|alpha_dash',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * User login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string', // Can be email or username
            'password' => 'required|string',
        ]);

        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user = User::where($loginField, $request->login)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Revoke previous tokens
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Logout user (revoke token).
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    /**
     * Get authenticated user profile.
     */
    public function profile(Request $request)
    {
        $user = $request->user()->load([
            'posts' => function ($query) {
                $query->latest()->take(12);
            },
            'followers' => function ($query) {
                $query->select('users.id', 'name', 'username', 'profile_photo_path');
            },
            'following' => function ($query) {
                $query->select('users.id', 'name', 'username', 'profile_photo_path');
            },
        ]);

        $user->posts_count = $user->posts()->count();
        $user->followers_count = $user->followers()->count();
        $user->following_count = $user->following()->count();

        return response()->json($user);
    }

    /**
     * Get user by username with profile data.
     */
    public function show($username)
    {
        $user = User::where('username', $username)
            ->with([
                'posts' => function ($query) {
                    $query->latest()->take(12);
                },
            ])
            ->firstOrFail();

        $user->posts_count = $user->posts()->count();
        $user->followers_count = $user->followers()->count();
        $user->following_count = $user->following()->count();

        // Add isFollowing flag if user is authenticated
        if (auth()->check()) {
            $user->is_following = auth()->user()->following()->where('followed_user_id', $user->id)->exists();
        }

        return response()->json($user);
    }

    /**
     * Update user profile.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'string|max:255',
            'username' => [
                'string',
                'max:30',
                'alpha_dash',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'bio' => 'nullable|string|max:150',
            'website' => 'nullable|string|max:100|url',
            'profile_photo' => 'nullable|image|max:2048', // Max 2MB
        ]);

        $userData = $request->only('name', 'username', 'email', 'bio', 'website');

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $userData['profile_photo_path'] = $path;
        }

        $user->update($userData);

        return response()->json($user);
    }

    /**
     * Change user password.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = $request->user();

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect',
            ], 422);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Password updated successfully',
        ]);
    }

    /**
     * Follow a user.
     */
    public function follow(Request $request, User $user)
    {
        $currentUser = $request->user();

        // Can't follow yourself
        if ($currentUser->id === $user->id) {
            return response()->json([
                'message' => 'You cannot follow yourself',
            ], 422);
        }

        // Check if already following
        if (!$currentUser->following()->where('followed_user_id', $user->id)->exists()) {
            $currentUser->following()->attach($user->id);
        }

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Unfollow a user.
     */
    public function unfollow(Request $request, User $user)
    {
        $currentUser = $request->user();
        $currentUser->following()->detach($user->id);

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Search for users.
     */
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2|max:50',
        ]);

        $query = $request->input('query');

        $users = User::where('username', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->select('id', 'name', 'username', 'profile_photo_path')
            ->take(20)
            ->get();

        return response()->json($users);
    }

    /**
     * Get user suggestions.
     */
    public function suggestions(Request $request)
    {
        $user = $request->user();

        // Get users that current user is not following
        $users = User::whereNotIn('id', function ($query) use ($user) {
                $query->select('followed_user_id')
                      ->from('follows')
                      ->where('user_id', $user->id);
            })
            ->where('id', '!=', $user->id)
            ->inRandomOrder()
            ->take(5)
            ->select('id', 'name', 'username', 'profile_photo_path')
            ->get();

        return response()->json($users);
    }
}
