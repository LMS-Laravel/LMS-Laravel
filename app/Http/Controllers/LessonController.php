<?php

namespace App\Http\Controllers;

use App\Entities\Course;
use App\Http\Requests\Lesson\CreateRequest;
use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Traits\Authorizable;
use App\Usescases\Lessons\Contracts\CreateLessonUsecaseInterface;
use App\Usescases\Lessons\Contracts\DeleteLessonUsescaseInterface;
use App\Usescases\Lessons\Contracts\UpdateLessonUsescaseInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request, CreateLessonUsecaseInterface $createLessonUsecase)
    {
        try {
            $result = $createLessonUsecase->handle($request->all(), auth()->user()->id);
            if($result['data']){
                flash('Clase creada correctamente');
            } else {
                flash(implode('-', $result['errors']), 'error');
            }

        } catch (\Exception $e){
            flash($e->getMessage(), 'error');
        }

        return redirect()->route('courses.edit', $request->get('course_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param LessonRepositoryInterface $lessonRepository
     * @return \Illuminate\Http\Response
     */
    public function show($id, LessonRepositoryInterface $lessonRepository)
    {
        $lesson = $lessonRepository->findById($id);
        return view('lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param LessonRepositoryInterface $lessonRepository
     * @return \Illuminate\Http\Response
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
            dd($e);
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
            dd($e);
            flash('No se ha podido eliminar la lección', 'error');
        }
        return redirect()->back();
    }
}
