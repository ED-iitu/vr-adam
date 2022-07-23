<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Lesson;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $courses = Course::with('author')->with('category')->get();

        return view('admin.course.index', [
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CourseCategory::all();

        return view('admin.course.form', [
            'categories' => $categories,
            'action' => route("course.store")
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->get('is_cashback_available') == null) {
            $data['is_cashback_available'] = true;
        } else {
            $data['is_cashback_available'] = false;
        }

        if ($request->get('is_active') == null) {
            $data['is_active'] = true;
        } else {
            $data['is_active'] = false;
        }

        Course::create($data);

        return redirect()->route("course.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     */
    public function edit(Course $course)
    {
        $categories = CourseCategory::all();

        return view('admin.course.form', [
            'course' => $course,
            'categories' => $categories,
            'action' => route("course.update", $course)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     */
    public function update(Request $request, Course $course)
    {
        $data = $request->all();
        $cashbackAvailable = $request->get('is_cashback_available');
        $isActive = $request->get('is_active');
        if (isset($cashbackAvailable) && $request->get('is_cashback_available') == null) {
            $data['is_cashback_available'] = true;
        } else {
            $data['is_cashback_available'] = false;
        }

        if (isset($isActive) && $request->get('is_active') == null) {
            $data['is_active'] = true;
        } else {
            $data['is_active'] = false;
        }

        $course->update($data);

        return redirect()->route('course.edit', $course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return back();
    }

    public function categories()
    {
        return view('admin.course.category');
    }

    public function lessons(Course $course)
    {
        return view('admin.course.lesson.index', [
           'lessons' => $course->lessons,
           'course' => $course
        ]);
    }

    public function lessonCreate(Course $course)
    {
        return view('admin.course.lesson.form', [
            'action' => route('course_lesson_store'),
            'course' => $course
        ]);
    }

    public function lessonEdit(Course $course, Lesson $lesson)
    {
        return view('admin.course.lesson.form', [
            'action' => route('course_lesson_update', [$course, $lesson]),
            'lesson' => $lesson,
            'course' => $course
        ]);
    }

    public function lessonStore(Request $request)
    {
        Lesson::create($request->all());

        $course = Course::where('id', $request->course_id)->first();

        return redirect()->route('course_lessons', $course);
    }

    public function lessonUpdate(Request $request, Course $course, Lesson $lesson)
    {
        $lesson->update($request->all());

        return redirect()->route('course_lesson_edit', [$course, $lesson]);
    }

    public function lessonDelete(Course $course, Lesson $lesson)
    {
        $lesson->delete();

        return back();
    }
}
