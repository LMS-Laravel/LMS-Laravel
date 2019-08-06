<?php

namespace App\Http\Controllers;

use App\Entities\Course;
use App\Http\Requests\Lesson\CreateRequest;
use App\Traits\Authorizable;
use App\Usescases\Courses\Contracts\CreateLessonUsecaseInterface;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    use Authorizable;

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
            $createLessonUsecase->handle($request->all());
            flash('Clase creada correctamente');
        } catch (\Exception $e){
            flash('No se ha podido crear la case', 'error');
        }

        return redirect()->route('courses.edit', $request->get('course_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
