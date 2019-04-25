<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Location;
use App\Model\City;
use App\User;
use App\Http\Resources\LocationResource;
use Auth;
use Illuminate\Support\Facades\DB;



class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        $cities = City::all();
        $locations =  DB::table('locations')
            ->join('cities', 'cities.id', '=', 'locations.city_id')
            ->join('users', 'users.id', '=', 'locations.user_id')
            ->select('locations.*', 'cities.name as cityname', 'users.name as username')
            ->get();

        $locations =  LocationResource::collection($locations);

        return response()->json([
            'locations' => $locations,
        ],200);
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
        $this->validate($request, [
            'name'  => 'required',
        ]);

        $location = Location::create([
            'name'  =>  request('name'),
            'city_id'  =>  request('city_id'),
            'user_id'    =>  Auth::user()->id,
        ]);

        $location = new LocationResource($location);

        return response()->json([
            'location'  =>  $location,
            'message'   =>  'Successfully Added!'
        ],200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name'  =>  'required|max:255',
        ]);
        $location = Location::find($id);

        $location->name = request('name');
        $location->city_id = request('city_id');

        $location->user_id=  Auth::user()->id;
        $location->save();

        return response()->json([
            'message'   =>  'City updated successfully!'
        ],200);
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
