<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class GuardianService
{
    public static function fetch()
    {
        $base_url = config('news.guardian.base_url');
        $api_key = config('news.guardian.api_key');

        $yesterday = Carbon::now()->subDay()->toDateString();

        $req = Http::get($base_url."?q= &from-date={$yesterday}&show-fields=body&api-key={$api_key}");

        if($req->successful()){
            $data = $req->json();

            $news = collect($data['results'])->map(function ($article){
                return [
                    'title'          => $article['webTitle'],
                    'url'            => $article['webUrl'],
                    'description'    => $article['abstract'],
                    'image_url'      => $article['multimedia'][0]['url'],
                    'source'         => $article['source'],
                    'author'         => self::extractAuthor($article['byline']['original']),
                    'body'           => $article['lead_paragraph'],
                    'category'       => $article['sectionName'],
                    'published_at'   =>  Carbon::parse($article['webPublicationDate'])->toDateTimeString(),
                ];
            })->toArray();
        }

    }
}
