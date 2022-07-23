<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Region::all();

        return view('admin.region.index', [
            'regions' => $regions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.region.form', [
            'action' => route('region.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        Region::create($request->all());

        return view('admin.region.index', [
            'regions' => Region::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     */
    public function edit(Region $region)
    {
        return view('admin.region.form', [
            'region' => $region,
            'action' => route('region.update', $region)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     */
    public function update(Request $request, Region $region)
    {
        $region->update($request->all());

        return view('admin.region.index', [
            'regions' => Region::all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     */
    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->back();
    }
}
