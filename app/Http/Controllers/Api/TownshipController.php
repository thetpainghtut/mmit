<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Township;
use App\Model\City;
use App\User;

use App\Http\Resources\TownshipResource;
use Auth;

use Illuminate\Support\Facades\DB;

class TownshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $townships =  Township::all();

        $townships =  TownshipResource::collection($townships);

        return response()->json([
            'townships' => $townships,
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
        $this->validate($request, [
            'name'  => 'required',
        ]);


        $name = request('name');
        $cityid = request('city_id');
        $userid = Auth::user()->id;

        $township = Township::create([
            'name'       =>  $name,
            'city_id'    =>  $cityid,
            'user_id'    =>  $userid,
        ]);

        $township = new TownshipResource($township);

        return response()->json([
            'township'  =>  $township,
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
        $this->validate($request, [
            'name'  =>  'required|max:255',
        ]);
        $township = Township::find($id);

        $township->name = request('name');
        $township->city_id = request('city_id');
        $township->user_id = Auth::user()->id;
        $township->save();        

        return response()->json([
            'township'  =>  $township,
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
        $township = Township::find($id);
        $township->delete();

        return response()->json([
            'message'   =>  'Township deleted successfully!'
        ],200);
    }
}
