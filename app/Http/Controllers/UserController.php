<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getUsers()
    {
        $query = User::with('courses');

        return Datatables::of($query)->make(true);
    }

    public function create(Request $request)
    {
        $courses = Course::with('module')->get();
        return view('users.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "name"  => "required",
            "email" => "email|required",
            "password" => "min:6|required",
        ]);

        $requestData = $request->all();
        $requestData["password"] = bcrypt($requestData["password"]);

        $user = User::create($requestData);
        $user->courses()->sync($requestData['courses']);

        flash("Successfully created");
        return redirect()->route('users.index');
    }

    public function edit(Request $request, User $user)
    {
        $user->load('courses');
        $courses = Course::with('module')->get();
        return view('users.edit', compact( 'user', 'courses'));
    }

    public function update(Request $request, User $user)
    {
        $requestData = $request->all();

        if ($requestData['password'] == '') {
            unset($requestData['password']);
        } else {
            $requestData["password"] = bcrypt($requestData["password"]);
        }

        $user->update($requestData);
        $user->courses()->sync($requestData['courses'] ?? []);

        flash("Successfully created");
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response("OK");
    }

}
