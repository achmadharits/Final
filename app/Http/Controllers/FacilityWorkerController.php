<?php

namespace App\Http\Controllers;

use App\Models\FacilityWorker;
use Illuminate\Http\Request;

class FacilityWorkerController extends Controller
{

    public function getColorByFacilityWorker(Request $request)
    {
        $workerId = $request->input('worker_id'); // data JS
        $facilityId = $request->input('facility_id'); // data JS
        $cityId = $request->input('city_id'); // data GeoJSON
        $cityFacilityId = ($facilityId - 1) * 38 + $cityId;

        $facilityWorker = FacilityWorker::where('city_facility_id', $cityFacilityId)
            ->where('worker_id', $workerId)
            ->first();

        if (!$facilityWorker) {
            return response()->json(['error' => 'Facility worker not found']);
        }

        $color = $facilityWorker->color;
        $status = $facilityWorker->status;
        $total = $facilityWorker->total;
        $population = $facilityWorker->population;
        $ratio = $facilityWorker->ratio;        
        
        return response()->json([
            'color' => $color,
            'status' => $status,
            'total' => $total,
            'population' => $population,
            'ratio' => $ratio,
        ]);
    }
    // 
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
     * @param  \App\Models\FacilityWorker  $facilityWorker
     * @return \Illuminate\Http\Response
     */
    public function show(FacilityWorker $facilityWorker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacilityWorker  $facilityWorker
     * @return \Illuminate\Http\Response
     */
    public function edit(FacilityWorker $facilityWorker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacilityWorker  $facilityWorker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacilityWorker $facilityWorker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacilityWorker  $facilityWorker
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacilityWorker $facilityWorker)
    {
        //
    }
}