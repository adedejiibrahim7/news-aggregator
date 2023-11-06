<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class FilterNewsController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $articles = Article::when($request->filled('date') || $request->filled('category') || $request->filled('source'), function ($query) use($request){
            $searchableFields = ['date' => 'published_at', 'category', 'source'];

            foreach ($searchableFields as $param => $column) {
                if ($request->filled($param)) {
                    $value = $request->input($param);

                    if ($param === 'date') {
                        $query->whereDate($column, $value);
                    } else {
                        $query->where($column, 'like', "%{$value}%");
                    }
                }
            }
        })->paginate($this->pageSize);

        return successResponse($articles);

    }
}
