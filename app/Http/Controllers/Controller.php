<?php

namespace App\Http\Controllers;

use App\Services\SpaceService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Client\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    protected mixed $pageSize;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->pageSize = $request->has('page-size') ?? config('app.default_page_size');

            return $next($request);
        });
    }
}
