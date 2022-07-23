<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();

        return view('admin.country.index', [
            'countries' => $countries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();

        return view('admin.country.form', [
            'regions' => $regions,
            'action' => route('country.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        Country::create($request->all());

        return view('admin.country.index', [
            'countries' => Country::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     */
    public function edit(Country $country)
    {
        $regions   = Region::all();

        return view('admin.country.form', [
            'country' => $country,
            'regions' => $regions,
            'action' => route('country.update', $country)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     */
    public function update(Request $request, Country $country)
    {
        $country->update($request->all());

        return view('admin.country.index', [
            'countries' => Country::all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     */
    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->back();
    }
}
