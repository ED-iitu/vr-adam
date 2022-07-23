<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CourseCategory::all();

        return view('admin.course.category', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.categoryForm', [
            'action' => route('courseCategory.store')
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
        CourseCategory::create($request->all());

        return redirect()->route("courseCategory.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseCategory  $courseCategory
     * @return \Illuminate\Http\Response
     */
    public function show(CourseCategory $courseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseCategory  $courseCategory
     */
    public function edit(CourseCategory $courseCategory)
    {
        return view('admin.course.categoryForm', [
            'action' => route('courseCategory.update', $courseCategory),
            'category' => $courseCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseCategory  $courseCategory
     */
    public function update(Request $request, CourseCategory $courseCategory)
    {
        $courseCategory->update($request->all());

        return redirect()->route("courseCategory.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseCategory  $courseCategory
     */
    public function destroy(CourseCategory $courseCategory)
    {
        $courseCategory->delete();

        return back();
    }
}
