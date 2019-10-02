<?php

namespace App\Http\Controllers;

use App\Blanket;
use App\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlanketController extends Controller
{

    public function index()
    {
        return view('blankets.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getBlankets()
    {
        $query = Blanket::select(['blankets.*', 't.name as template_name', 'c.name AS course_name', 'modules.name AS module_name', 'departments.name AS department_name'])
            ->join('templates AS t', 't.id', '=', 'blankets.template_id')
            ->join('courses AS c', 'c.id', '=', 't.course_id')
            ->join('departments', 'departments.id', '=', 'c.department_id')
            ->join('modules', 'modules.id', '=', 'c.module_id')
            ->get();

        return Datatables::of($query)->make(true);
    }

    public function create(Request $request)
    {
        $courses = Course::with('module', 'department')->get();
        $course = Course::find($request->get('course'));

        if ($course) {
            $course->load('domains', 'department', 'templates');
        }

        return view('blankets.create', compact('courses', 'course'));

    }

    public function store(Request $request)
    {

        return response('OK');
    }

    public function edit(Blanket $blanket)
    {
        return view('blankets.edit', compact('blanket'));

    }

    public function update(Request $request, Blanket $blanket)
    {

    }

    public function destroy(Request $request, Blanket $blanket)
    {
        $blanket->delete();
        return response("OK");
    }
}
