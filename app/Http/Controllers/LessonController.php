<?php

namespace App\Http\Controllers;

use App\Entities\Course;
use App\Http\Requests\Lesson\CreateRequest;
use LMS\Modules\Lessons\Repositories\Contracts\LessonRepositoryInterface;
use App\Traits\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LMS\Modules\Lessons\Usecases\Contracts\{CreateLessonUsecaseInterface,
    DeleteLessonUsescaseInterface,
    ShowLessonUsecaseInterface,
    UpdateLessonUsescaseInterface};

class LessonController extends Controller
{
    use Authorizable;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $course
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('lessons.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @param CreateLessonUsecaseInterface $createLessonUsecase
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request, CreateLessonUsecaseInterface $createLessonUsecase)
    {
        try {
            $result = $createLessonUsecase->handle($request->all(), auth()->user()->id);
            if($result['data']){
                flash('Clase creada correctamente');
            } else {
                flash(implode('-', $result['errors']), 'error');
                throw new \Exception('error create course');
            }
            return redirect()->route('courses.edit', $request->get('course_id'));
        } catch (\Exception $e){

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param ShowLessonUsecaseInterface $lessonUsecase
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id, ShowLessonUsecaseInterface $lessonUsecase)
    {
        $response = $lessonUsecase->handle($id, Auth::user()->id);
        $lesson = $response['data']['lesson'];
        $subscribed = $response['data']['subscribed'];
        if(!$subscribed){
            return redirect()->route("courses.show", $lesson->course->id);
        }

        return view('lessons.show', compact('lesson', 'subscribed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param LessonRepositoryInterface $lessonRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, LessonRepositoryInterface $lessonRepository)
    {
        $lesson = $lessonRepository->findById($id);

        return view('lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @param UpdateLessonUsescaseInterface $updateLessonUsescase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UpdateLessonUsescaseInterface $updateLessonUsescase)
    {
        try {
            $updateLessonUsescase->handle($id, $request->all());
            flash('Lección guardada correctamente');
        } catch (\Exception $e){
            flash('No se ha podido guardar la lección', 'error');
        }
        return  redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param DeleteLessonUsescaseInterface $deleteLessonUsescase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeleteLessonUsescaseInterface $deleteLessonUsescase)
    {
        try {
            $deleteLessonUsescase->handle($id);
            flash('Lección eliminada correctamente');
        } catch (\Exception $e){
            flash('No se ha podido eliminar la lección', 'error');
        }
        return redirect()->back();
    }
}
