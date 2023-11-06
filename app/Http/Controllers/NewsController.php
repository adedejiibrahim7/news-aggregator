<?php

namespace App\Http\Controllers;

use App\Services\GuardianService;
use App\Services\NewsApiService;
use App\Services\NYTimesService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show()
    {
        $req = GuardianService::fetch();

        return response()->json($req);
    }
}
