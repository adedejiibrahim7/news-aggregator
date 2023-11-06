<?php

namespace App\Services;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class NYTimesService
{
    public static function fetch(){
        $base_url = config('news.ny_times.base_url');
        $api_key = config('news.ny_times.api_key');

        $yesterday = Carbon::now()->subDay()->toDateString();


        $req = Http::withToken($api_key)->get($base_url."/search/v2/articlesearch.json?q= &fq=pub_date:{$yesterday}&api-key={$api_key}");

        if($req->successful()){

            $data = $req->json();

//            return $data;

            $news = collect($data['response']['docs'])->map(function ($article){
               return [
                   'title'          => $article['headline']['main'],
                   'url'            => $article['web_url'],
                   'description'    => $article['abstract'],
                   'image_url'      => $article['multimedia'][0]['url'],
                   'source'         => $article['source'],
                   'author'         => self::extractAuthor($article['byline']['original']),
                   'body'           => $article['lead_paragraph'],
                   'category'       => $article['news_desk'],
                   'published_at'   =>  Carbon::parse($article['pub_date'])->toDateTimeString(),
               ];
            })->toArray();

            Article::insert($news);

            return $news;
        }
    }

    public static function extractAuthor(string $byLine)
    {
        $arr = explode(' ', $byLine);
        array_shift($arr);
        return implode(" ", $arr);
    }
}
