<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::all();

        return view('admin.city.index', [
            'cities' => $cities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        $countries = Country::all();

        return view('admin.city.form', [
            'countries' => $countries,
            'regions' => $regions,
            'action' => route('city.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        City::create($request->all());

        return view('admin.city.index', [
            'cities' => City::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     */
    public function edit(City $city)
    {
        $regions = Region::all();
        $countries = Country::all();

        return view('admin.city.form', [
            'city' => $city,
            'regions' => $regions,
            'countries' => $countries,
            'action' => route('city.update', $city)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     */
    public function update(Request $request, City $city)
    {
        $city->update($request->all());

        return view('admin.city.index', [
            'cities' => City::all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     */
    public function destroy(City $city)
    {
        $city->delete();

        return redirect()->back();
    }
}
