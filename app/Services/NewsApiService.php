<?php

namespace App\Services;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class NewsApiService
{
    public static function fetch(){
        $yesterday = Carbon::now()->subDay()->toDateString();
        $req = Http::withToken(config('news.news_api.api_key'))
            ->get(config('news.news_api.base_url')."/everything?q= from={$yesterday}&language=en");

        if($req->successful()){
            $articles =  json_decode($req->body(), true)['articles'];

            $new_data = collect($articles)->map(function($article){
               return [
                  'author'          => $article['author'] ?? "nill",
                  'title'           => $article['title'],
                  'description'     => $article['description'],
                   'published_at'   => Carbon::parse($article['publishedAt'])->toDateTimeString(),
                   'url'            => $article['url'],
                   'image_url'      => $article['urlToImage'],
                   'body'           => $article['content'],
                   'source'         => $article['source']['name']
               ] ;
            })->toArray();

            Article::insert($new_data);

            return true;
        }
    }
}
