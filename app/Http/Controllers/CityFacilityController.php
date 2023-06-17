<?php

namespace App\Http\Controllers;

use App\Models\CityFacility;
use Illuminate\Http\Request;

class CityFacilityController extends Controller
{
    public function getColorByCityFacility(Request $request)
    {
        $cityId = $request->input('city_id');
        $facilityId = $request->input('facility_id');

        $cityFacility = CityFacility::where('city_id', $cityId)
            ->where('facility_id', $facilityId)
            ->first();

        if (!$cityFacility) {
            return response()->json(['error' => 'City facility not found']);
        }

        $color = $cityFacility->color;
        $status = $cityFacility->status;
        $total = $cityFacility->total;
        $population = $cityFacility->population;
        $ratio = $cityFacility->ratio;

        return response()->json([
            'color' => $color,
            'status' => $status,
            'total' => $total,
            'population' => $population,
            'ratio' => $ratio,
        ]);
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CityFacility  $cityFacility
     * @return \Illuminate\Http\Response
     */
    public function show(CityFacility $cityFacility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CityFacility  $cityFacility
     * @return \Illuminate\Http\Response
     */
    public function edit(CityFacility $cityFacility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CityFacility  $cityFacility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CityFacility $cityFacility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CityFacility  $cityFacility
     * @return \Illuminate\Http\Response
     */
    public function destroy(CityFacility $cityFacility)
    {
        //
    }
}