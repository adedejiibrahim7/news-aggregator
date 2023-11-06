<?php

namespace App\Services;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class GuardianService
{
    public static function fetch()
    {
        $base_url = config('news.guardian.base_url');
        $api_key = config('news.guardian.api_key');

        $yesterday = Carbon::now()->subDay()->toDateString();

        $req = Http::get($base_url."?q= &from-date={$yesterday}&show-fields=body,headline,thumbnail,byline&page-size=50&api-key={$api_key}");

        if($req->successful()){
            $data = $req->json();

            $news = collect($data['response']['results'])->map(function ($article){
                return [
                    'title'          => $article['webTitle'],
                    'url'            => $article['webUrl'],
                    'image_url'      => $article['fields']['thumbnail'] ?? null,
                    'source'         => "Guardian",
                    'author'         => $article['fields']['byline'] ?? "nill",
                    'body'           => $article['fields']['body'],
                    'category'       => $article['sectionName'],
                    'published_at'   =>  Carbon::parse($article['webPublicationDate'])->toDateTimeString(),
                ];
            })->toArray();

            Article::insert($news);

            return $data;
        }

    }
}
