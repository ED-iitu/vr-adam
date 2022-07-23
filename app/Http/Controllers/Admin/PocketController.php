<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pocket;
use Illuminate\Http\Request;

class PocketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pockets = Pocket::all();

        return view('admin.pocket.index', [
            'pockets' => $pockets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pocket.form', [
            'action' => route('pocket.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        Pocket::create($request->all());

        return view('admin.pocket.index', [
            'pockets' => Pocket::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pocket  $pocket
     * @return \Illuminate\Http\Response
     */
    public function show(Pocket $pocket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pocket  $pocket
     */
    public function edit(Pocket $pocket)
    {
        return view('admin.pocket.form', [
            'action' => route('pocket.update', $pocket),
            'pocket' => $pocket
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pocket  $pocket
     */
    public function update(Request $request, Pocket $pocket)
    {
        $pocket->update($request->all());

        return view('admin.pocket.index', [
            'pockets' => Pocket::all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pocket  $pocket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pocket $pocket)
    {
        $pocket->delete();

        return back();
    }
}
