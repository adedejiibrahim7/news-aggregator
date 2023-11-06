<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Models\Article;
use Illuminate\Http\Request;

class SearchNewsController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $searchFields = [ 'body', 'author', 'source'];

        $news = Article::when($request->has('q') && !empty($request->q), function ($query) use ($searchFields, $request){
            foreach ($searchFields as $field){
                $query->orWhere($field, 'like', "%{$request->q}%");
            }
        })->paginate($this->pageSize);

        return successResponse(NewsResource::collection($news));
    }
}
