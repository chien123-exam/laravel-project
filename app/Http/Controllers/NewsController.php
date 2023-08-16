<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveNewRequest;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsModel;

    public function __construct(News $newsModel)
    {
        $this->newsModel = $newsModel;
    }

    public function index(Request $request)
    {
        $query = $this->newsModel->query();

        if ($name = $request->input('name')) {
            $query->where('name', 'like', "%$name%");
        }

        return view('news.index', [
            'news' => $query->paginate(5),
        ]);
    }

    public function create()
    {
        return view('news.form');
    }

    public function store(SaveNewRequest $request)
    {
        $this->newsModel->create($request->validated());

        return redirect()->route('news.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        return view('news.form', [
            'news' => $this->newsModel->find($id),
        ]);
    }

    public function update(SaveNewRequest $request, $id)
    {
        $news = $this->newsModel->findOrFail($id);

        $news->update([
            'name' => $request->name,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'is_suspended' => $request->is_suspended,
        ]);

        return redirect()->route('news.index');
    }

    public function destroy(string $id)
    {
        $this->newsModel->findOrFail($id)->delete();

        return redirect()->route('news.index');
    }
}
