<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\GuardianService;
use App\Services\NewsApiService;
use App\Services\NYTimesService;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index(Request $request)
    {
        $searchFields = [ 'body', 'author', 'source'];

        $news = Article::when($request->has('q') && !empty($request->q), function ($query) use ($searchFields, $request){
//            $query->where('title', 'like', "%{$request->q}%");
           foreach ($searchFields as $field){
               $query->orWhere($field, 'like', "%{$request->q}%");
           }
        });
    }


    public function show()
    {
        $req = GuardianService::fetch();

        return response()->json($req);
    }
}
