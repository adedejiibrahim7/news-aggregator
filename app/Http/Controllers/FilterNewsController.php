<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class FilterNewsController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $articles = Article::when($request->has('date') && !empty($request->date), function ($query) use($request){
            return $query->whereDate('published_at', $request->date);
        })->when($request->has('category') && !empty($request->category), function ($query) use($request) {
            return $query->where('category', 'like', "%{$request->category}%");
        })->when($request->has('source') && !empty($request->source), function ($query) use($request){
            return $query->where('source', 'like', "%{$request->source}%");
        })->paginate($this->pageSize);

        return successResponse($articles);

    }
}
