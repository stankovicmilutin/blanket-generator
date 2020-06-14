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
        $coursesId = auth()->user()->courses->pluck('id');

        $query = Course::select(['courses.*', 'departments.name AS department_name',  'modules.name AS module_name'])
            ->join('departments', 'departments.id', '=', 'courses.department_id')
            ->join('modules', 'modules.id', '=', 'courses.module_id');

        if (!auth()->user()->is_admin) {
            $query->whereIn('courses.id', $coursesId);
        }

        return Datatables::of($query->get())->make(true);
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
            "name"           => "required",
            "department_id"  => "required",
            "module_id"      => "required",
            "domains"        => "required|array",
            "domains.*.name" => "required"
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
            if ($domain && trim($domain != '')) {
                $course->domains()->create(["name" => trim($domain)]);
            }
        }

        flash("Successfully updated");
        return redirect()->route('courses.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response("OK");
    }
}
