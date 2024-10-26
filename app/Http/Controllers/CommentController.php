<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Anime;
use App\Models\Comment;


class CommentController extends Controller
{
    public function index(Request $request, Anime $anime)
    {
        $comments = $anime->comments()
            ->whereNull('comment_id')
            ->with(['user', 'replies.user'])
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json($comments);
    }

    public function store(Request $request, Anime $anime)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:5000',
            'comment_id' => 'nullable|exists:comments,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $comment = $anime->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'comment_id' => $request->comment_id
        ]);

        return response()->json($comment->load('user'), 201);
    }

    public function update(Request $request, Comment $comment)
    {
        // Проверка прав пользователя
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:5000'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $comment->update($request->only('content'));
        return response()->json($comment->load('user'));
    }

    public function destroy(Comment $comment)
    {
        // Проверка прав пользователя
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $comment->delete();
        return response()->json(null, 204);
    }
}
