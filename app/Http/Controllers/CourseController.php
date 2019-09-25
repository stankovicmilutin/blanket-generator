<?php

namespace App\Http\Controllers;

use App\Course;
use App\Department;
use App\Module;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getCourses()
    {
        $query = Course::select(['courses.*', 'departments.name AS department_name'])
            ->join('departments', 'departments.id', '=', 'courses.department_id')->get();

        return Datatables::of($query)->make(true);
    }

    public function create()
    {
        $departments = Department::all();
        $modules = Module::all();
        return view('courses.create', compact('departments', 'modules'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "name"          => "required",
            "department_id" => "required",
            "module_id"     => "required",
            "domains"       => "required|array"
        ]);


        $course = Course::create($request->all());

        foreach ($request->get('domains') as $domain) {
            $course->domains()->create(["name" => $domain]);
        }

        flash("Successfully created");
        return redirect()->route('courses.index');
    }

    public function edit(Course $course)
    {
        $departments = Department::all();
        $modules = Module::all();
        return view('courses.edit', compact("course", "departments", "modules"));
    }

    public function update(Course $course, Request $request)
    {
        $this->validate($request, [
            "name"          => "required",
            "department_id" => "required",
            "module_id"     => "required",
            "domains"       => "required|array"
        ]);

        $course->update($request->all());

        foreach ($request->get('domains') as $domain) {
            $course->domains()->create(["name" => $domain]);
        }

        flash("Successfully updated");
        return redirect()->route('courses.index');
    }

    public function delete()
    {

    }
}
