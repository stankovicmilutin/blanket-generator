<?php

namespace App\Http\Controllers;

use App\Course;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getTasks()
    {
        $query = Task::select(['tasks.*', 'domains.name AS domain_name', 'courses.name AS course_name', 'modules.name AS module_name' ])
            ->join('domains', 'domains.id', '=', 'tasks.domain_id')
            ->join('courses', 'courses.id', '=', 'domains.course_id')
            ->join('modules', 'modules.id', '=', 'courses.module_id')
            ->get();

        return Datatables::of($query)->make(true);
    }

    public function create(Request $request)
    {
        $courses = Course::with('module')->get();
        $course = Course::find($request->get('course'));

        if ($course) {
            $course->load('domains', 'department');
        }

        return view('tasks.create', compact('courses', 'course'));
    }

    public function store(Request $request)
    {
        Task::create($request->all());
        flash("Successfully created");
        return redirect()->route('tasks.index');
    }

    public function edit(Request $request, Task $task)
    {
        $course = $task->domain->course->load('domains');
        return view('tasks.edit', compact('course', 'task'));
    }

    public function update(Request $request, Task $task)
    {
            $task->update($request->all());
        flash("Successfully created");
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response("OK");
    }

    public function uploader(Request $request)
    {
        $filePath = $this->uploadImage($request->file('upload'), storage_path('app/public/'));

        return response([
            "uploaded" => 1,
            "fileName" => $filePath,
            "url" => '/storage/' . $filePath
        ]);
    }

    public function createDirIfNotExist(string $path)
    {
        if ($this->directoryNotExist($path)) {
            mkdir($path,0777, true);
        }
    }

    /**
     * @param string $path
     * @return bool
     */
    public function directoryNotExist(string $path): bool
    {
        return !File::isDirectory($path);
    }


    public function uploadImage(UploadedFile $file, string $path): string
    {
        $file_name = Str::random(10) . $file->getClientOriginalName();

        $this->createDirIfNotExist($path);

        Image::make($file->getRealPath())->save($path . $file_name);

        return $file_name;
    }
}
