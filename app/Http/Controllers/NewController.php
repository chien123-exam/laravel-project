<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveNewRequest;
use App\Models\News;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class NewController extends Controller
{
    public function index()
    {
        return view('news.index', [
            'news' => News::get()
        ]);
    }

    public function create()
    {
        return view('news.form');
    }

    public function store(SaveNewRequest $request)
    {
        dd($request->all());
    }
}
