<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimeController extends Controller
{
    public function index(Request $request)
    {
        $query = Anime::with(['status', 'originalSource', 'mpaaRating', 'studios']);

        // Фильтрация
        if ($request->has('status_id')) {
            $query->where('status_id', $request->status_id);
        }
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('russian_name', 'LIKE', "%{$search}%")
                  ->orWhere('english_name', 'LIKE', "%{$search}%")
                  ->orWhere('original_name', 'LIKE', "%{$search}%");
            });
        }

        // Сортировка
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        // Пагинация
        $perPage = $request->get('per_page', 15);
        
        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'russian_name' => 'required|string|max:1000',
            'original_name' => 'required|string|max:1000',
            'english_name' => 'nullable|string|max:1000',
            'avatar' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric|between:0,99.99',
            'current_episodes' => 'required|integer|min:0',
            'total_episodes' => 'nullable|integer|min:0',
            'status_id' => 'nullable|exists:statuses,id',
            'original_source_id' => 'nullable|exists:original_sources,id',
            'issue_date' => 'nullable|date',
            'mpaa_rating_id' => 'nullable|exists:mpaa_ratings,id',
            'studios' => 'array',
            'studios.*' => 'exists:studios,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $anime = Anime::create($request->except('studios'));
        
        if ($request->has('studios')) {
            $anime->studios()->sync($request->studios);
        }

        return response()->json($anime->load(['status', 'originalSource', 'mpaaRating', 'studios']), 201);
    }

    public function show(Anime $anime)
    {
        return response()->json($anime->load([
            'status',
            'originalSource',
            'mpaaRating',
            'studios',
            'comments' => function($query) {
                $query->whereNull('comment_id')
                      ->with(['user', 'replies.user']);
            }
        ]));
    }

    public function update(Request $request, Anime $anime)
    {
        $validator = Validator::make($request->all(), [
            'russian_name' => 'sometimes|required|string|max:1000',
            'original_name' => 'sometimes|required|string|max:1000',
            'english_name' => 'nullable|string|max:1000',
            'avatar' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric|between:0,99.99',
            'current_episodes' => 'sometimes|required|integer|min:0',
            'total_episodes' => 'nullable|integer|min:0',
            'status_id' => 'nullable|exists:statuses,id',
            'original_source_id' => 'nullable|exists:original_sources,id',
            'issue_date' => 'nullable|date',
            'mpaa_rating_id' => 'nullable|exists:mpaa_ratings,id',
            'studios' => 'array',
            'studios.*' => 'exists:studios,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $anime->update($request->except('studios'));
        
        if ($request->has('studios')) {
            $anime->studios()->sync($request->studios);
        }

        return response()->json($anime->load(['status', 'originalSource', 'mpaaRating', 'studios']));
    }

    public function destroy(Anime $anime)
    {
        $anime->delete();
        return response()->json(null, 204);
    }
}
