<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchNewsController extends Controller
{
    public function __invoke(Request $request)
    {
        $searchFields = [ 'body', 'author', 'source'];

        $news = Article::when($request->has('q') && !empty($request->q), function ($query) use ($searchFields, $request){
//            $query->where('title', 'like', "%{$request->q}%");
            foreach ($searchFields as $field){
                $query->orWhere($field, 'like', "%{$request->q}%");
            }
        })->paginate(25);
    }
}
