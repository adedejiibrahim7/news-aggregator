<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class NewsByPrefrencesController extends Controller
{
    public function __invoke(Request $request)
    {

        $news = Article::when($request->has('authors') && !empty($request->authors), function ($query) use ($request){
                $authors = explode(',', $request->authors);

                foreach ($authors as $author){
                    $query->Orwhere('author', 'like', "%{$author}%");
                }
            })
            ->when($request->has('authors') && !empty($request->authors), function ($query) use ($request){
                $categories = explode(',', $request->categories);

                foreach ($categories as $category){
                    $query->Orwhere('author', 'like', "%{$category}%");
                }
            })
            ->when($request->has('sources') && !empty($request->sources), function ($query) use ($request){
                $sources = explode(',', $request->sources);

                foreach ($sources as $source){
                    $query->Orwhere('author', 'like', "%{$source}%");
                }
            })
            ->paginate($this->pageSize);

        return successResponse($news);
    }
}
