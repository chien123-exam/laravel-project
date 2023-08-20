<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseModel;

    public function __construct(Course $courseModel)
    {
        $this->courseModel = $courseModel;
    }

    public function index(Request $request)
    {
        $query = $this->courseModel->query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%'.$request->input('name').'%');
        }

        return view('courses.index', [
            'courses' => $query->paginate(5),
        ]);
    }

    public function create()
    {
        return view('courses.form');
    }

    public function store(CourseRequest $request)
    {
        $this->courseModel->create($request->validated());

        return redirect()->route('course.index');
    }

    public function edit($id)
    {
        return view('courses.form', [
            'course' => $this->courseModel->find($id),
        ]);
    }

    public function update(CourseRequest $request, $id)
    {
        $course = $this->courseModel->findOrFail($id);

        $course->update($request->all());

        return redirect()->route('course.index');
    }

    public function destroy(string $id)
    {
        $this->courseModel->findOrFail($id)->delete();

        return redirect()->route('course.index');
    }
}
