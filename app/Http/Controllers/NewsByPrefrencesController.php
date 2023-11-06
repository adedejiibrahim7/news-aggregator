<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class NewsByPrefrencesController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {

        $news = Article::when($request->has('authors') || $request->has('categories') || $request->has('sources'), function ($query) use ($request){
                $searchableColumns = ['author', 'category', 'source'];

                foreach ($searchableColumns as $column) {
                    if ($request->has($column) && !empty($request->$column)) {
                        $values = explode(',', $request->$column);

                        foreach ($values as $value) {
                            $query->orWhere($column, 'like', "%{$value}%");
                        }
                    }
                }
            })
            ->paginate($this->pageSize);

        return successResponse($news);
    }
}
