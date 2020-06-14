<?php

namespace App\Http\Controllers;

use App\Course;
use App\Template;
use App\Department;
use App\Module;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TemplateController extends Controller
{
    public function index()
    {
        return view('templates.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getTemplates()
    {
        $coursesId = auth()->user()->courses->pluck('id');

        $query = Template::select(['templates.*', 'c.name AS course_name', 'modules.name AS module_name', 'departments.name AS department_name'])
            ->join('courses AS c', 'c.id', '=', 'templates.course_id')
            ->join('departments', 'departments.id', '=', 'c.department_id')
            ->join('modules', 'modules.id', '=', 'c.module_id');

        if (!auth()->user()->is_admin) {
            $query->whereIn('c.id', $coursesId);
        }

        return Datatables::of($query->get())->make(true);
    }

    public function create(Request $request)
    {
        $course = Course::find($request->get('course'));

        if (auth()->user()->is_admin) {
            $courses = Course::with('module', 'department')->get();
        } else {
            $courses = auth()->user()->courses()->with('module', 'department')->get();
        }

        if ($course) {
            $course->load('domains', 'department');
        }

        return view('templates.create', compact('courses', 'course'));
    }

    public function store(Request $request)
    {
        $course = $request->get('course');

        if ($request->filled('template_id')) {
            $template = Template::find($request->get('template_id'));

            $template->update([
                "name" => $request->get('title')
            ]);
        } else {
            $template = Template::create([
                "course_id" => $course["id"],
                "name"      => $request->get('title')
            ]);
        }

        $template->elements()->delete();

        foreach ($request->get('template') as $element) {
            $template->elements()->create([
                "domain_id"   => $element["domain"],
                "domain_type" => $element["domain_type"],
                "type"        => $element["type"],
                "text"        => $element["text"]
            ]);
        }

        return response('OK');
    }

    public function edit(Request $request, Template $template)
    {
        $course = $template->course->load('domains', 'department');
        $template->load('elements');
        return view('templates.edit', compact('course', 'template'));
    }

    public function destroy(Template $template)
    {
        $template->delete();
        return response("OK");
    }

    public function getElement(Template $template)
    {
        return response(["data" => $template->load('elements.domain.tasks')]);
    }
}
