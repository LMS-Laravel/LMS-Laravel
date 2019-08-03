<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\CreateRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Usescases\Courses\Contracts\ListCourseUsecaseInterface;
use App\Usescases\Courses\CreateCourseUsecase;
use Illuminate\Http\Request;

class CourseController extends Controller
{


    public function __construct()
    {
        return $this->middleware('auth');
    }


    public function index(ListCourseUsecaseInterface $listCourseUsecase)
    {
        $courses = $listCourseUsecase->handle();
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {

    }

    public function create(UserRepositoryInterface $userRepository)
    {
        $users = $userRepository->all()->pluck('name', 'id');
        return view('courses.create', compact('users'));
    }

    public function store(CreateRequest $request, CreateCourseUsecase $courseUsecase)
    {
        $courseUsecase->handle($request->all());

        return redirect()->route('course.index');
    }

    public function edit($id)
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
