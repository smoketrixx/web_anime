<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('username', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('firstname', 'LIKE', "%{$search}%")
                  ->orWhere('lastname', 'LIKE', "%{$search}%");
            });
        }

        return response()->json($query->paginate($request->get('per_page', 15)));
    }

    public function show(User $user)
    {
        return response()->json($user->load([
            'completedAnimes',
            'watchingAnimes',
            'plannedAnimes',
            'droppedAnimes'
        ]));
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|required|string|max:50|unique:users,username,' . $user->id,
            'email' => 'sometimes|required|email|max:500|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|max:500',
            'avatar' => 'nullable|string|max:1000',
            'status' => 'nullable|string|max:1000',
            'firstname' => 'sometimes|required|string|max:500',
            'lastname' => 'sometimes|required|string|max:500',
            'banner' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return response()->json($user);
    }

    // Методы управления списками аниме пользователя
    public function addToList(Request $request, User $user, $listType)
    {
        $validator = Validator::make($request->all(), [
            'anime_id' => 'required|exists:animes,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        switch ($listType) {
            case 'completed':
                $user->completedAnimes()->syncWithoutDetaching([$request->anime_id]);
                break;
            case 'watching':
                $user->watchingAnimes()->syncWithoutDetaching([$request->anime_id]);
                break;
            case 'planned':
                $user->plannedAnimes()->syncWithoutDetaching([$request->anime_id]);
                break;
            case 'dropped':
                $user->droppedAnimes()->syncWithoutDetaching([$request->anime_id]);
                break;
            default:
                return response()->json(['error' => 'Invalid list type'], 400);
        }

        return response()->json(['message' => 'Anime added to list successfully']);
    }

    public function removeFromList(Request $request, User $user, $listType)
    {
        $validator = Validator::make($request->all(), [
            'anime_id' => 'required|exists:animes,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        switch ($listType) {
            case 'completed':
                $user->completedAnimes()->detach($request->anime_id);
                break;
            case 'watching':
                $user->watchingAnimes()->detach($request->anime_id);
                break;
            case 'planned':
                $user->plannedAnimes()->detach($request->anime_id);
                break;
            case 'dropped':
                $user->droppedAnimes()->detach($request->anime_id);
                break;
            default:
                return response()->json(['error' => 'Invalid list type'], 400);
        }

        return response()->json(['message' => 'Anime removed from list successfully']);
    }
}
