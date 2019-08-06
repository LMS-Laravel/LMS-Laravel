<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\CreateRequest;
use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Traits\Authorizable;
use App\Usescases\Courses\Contracts\CreateCourseUsescaseInterface;
use App\Usescases\Courses\Contracts\DeleteCourseUsecaseInterface;
use App\Usescases\Courses\Contracts\ListCourseUsecaseInterface;
use App\Usescases\Courses\Contracts\UpdateCourseUsecaseInterface;
use App\Usescases\Courses\CreateCourseUsecase;
use App\Usescases\Courses\UpdateCourseUsecase;
use App\Usescases\Courses\DeleteCourseUsecase;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    use Authorizable;

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

    public function store(CreateRequest $request, CreateCourseUsescaseInterface $courseUsecase)
    {
        $courseUsecase->handle($request->all());
        return redirect()->route('courses.index');
    }

    public function edit($id, UserRepositoryInterface $userRepository, CourseRepositoryInterface $courseRepository)
    {
        $course = $courseRepository->findById($id);
        $users = $userRepository->all()->pluck('name', 'id');
        $lessons = $course->lessons->where('status', 'enabled');

        return view('courses.edit', compact('course', 'users', 'lessons'));
    }

    public function update($id, CreateRequest $request, UpdateCourseUsecaseInterface $courseUsecase)
    {
        $courseUsecase->handle($id, $request->all());
        return redirect()->route('courses.index');
    }

    public function destroy($id, DeleteCourseUsecaseInterface $courseUsecase)
    {
        $courseUsecase->handle($id);
        return redirect()->route('courses.index');
    }
}
