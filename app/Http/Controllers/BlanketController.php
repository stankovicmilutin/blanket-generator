<?php

namespace App\Http\Controllers;

use App\Blanket;
use App\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $coursesId = auth()->user()->courses->pluck('id');

        $query = Blanket::select(['blankets.*', 't.name as template_name', 'c.name AS course_name', 'modules.name AS module_name', 'departments.name AS department_name'])
            ->join('templates AS t', 't.id', '=', 'blankets.template_id')
            ->join('courses AS c', 'c.id', '=', 't.course_id')
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
            $course->load('domains', 'department', 'templates');
        }

        return view('blankets.create', compact('courses', 'course'));

    }

    public function store(Request $request)
    {
        $blanket = Blanket::create([
            'user_id'            => auth()->id(),
            'template_id'        => $request->get('template_id'),
            'date'               => Carbon::parse($request->get('date')),
            'examination_period' => $request->get('examination_period')
        ]);

        foreach ($request->get("elements") as $element) {
            if ($element["type"] == "task") {
                $blanket->tasks()->attach($element["task"]["id"]);
            }
        }

        return response('OK');
    }

    public function show(Blanket $blanket)
    {
        return view('blankets.show', compact('blanket'));
    }

    public function edit(Blanket $blanket)
    {
        $course = $blanket->template->course;
        $blanket->load('template.elements.domain.tasks', 'tasks');
        $course->load('domains', 'department', 'templates');
        return view('blankets.edit', compact('blanket', 'course'));
    }

    public function update(Request $request, Blanket $blanket)
    {
        $blanket->update([
            'template_id'        => $request->get('template_id'),
            'date'               => Carbon::parse($request->get('date')),
            'examination_period' => $request->get('examination_period')
        ]);

        $blanket->tasks()->detach();
        foreach ($request->get("elements") as $element) {
            if ($element["type"] == "task" && isset($element["task"])) {
                $blanket->tasks()->attach($element["task"]["id"]);
            }
        }

        return response('OK');
    }

    public function destroy(Request $request, Blanket $blanket)
    {
        $blanket->delete();
        return response("OK");
    }

    public function pdf(Blanket $blanket)
    {
        if ($blanket->file_path) {
            $file = public_path($blanket->file_path);
            return response()->download($file);
        }

        $blanket->load('template.elements.domain.tasks', 'tasks', 'template.course.department');

        $filePath = implode('/', [
            'pdf',
            $blanket->template->course->module_id,
            $blanket->template->course_id,
            $blanket->date->format('Y'),
            $blanket->examination_period
        ]);

        if (!\File::exists(public_path($filePath))) {
            \File::makeDirectory(public_path($filePath), 0755, true);
        }

        $fileName = implode("-", [
            $blanket->template->course->name,
            $blanket->template->name,
            $blanket->examination_period,
            $blanket->date->format('Y')
        ]);

        $fileName = Str::slug($fileName) . ".pdf";

        $pdf = \PDF::loadView('blankets.pdf', compact('blanket'))

            ->save($filePath . '/' . $fileName);

//        return view('blankets.pdf', compact('blanket'));
//        $blanket->update(["file_path" => $filePath . '/' . $fileName]);

        return $pdf->download($fileName);
    }
}
