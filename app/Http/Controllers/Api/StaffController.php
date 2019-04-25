<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Staff;
use App\Http\Resources\StaffResource;
use App\Model\Location;
use Auth;
use App\User;
use Illuminate\Support\Facades\DB;
class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $locations = Location::all();
        $staffs = DB::table('staff')
            ->join('locations', 'locations.id', '=', 'staff.location_id')
            ->join('users', 'users.id', '=', 'staff.user_id')
            ->select('staff.*', 'locations.name as locationname', 'users.name as username')
            ->get();
        $staffs =  StaffResource::collection($staffs);

        return response()->json([
            'staffs' => $staffs,
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
        //
        /*$this->validate($request, [

            'name'  => 'required',
        ]);*/
        


        if($request->get('image'))
       {
          $image = $request->get('image');
          $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('image'))->save(public_path('images/').$name);
        }

        $staff = Staff::create([
            'dob'  =>  request('dob'),
            'fathername'  =>  request('fname'),
            'nrc'  =>  request('nrc'),
            'photo'  =>  $name,
            'joineddate'  =>  request('jdate'),
            'leavedate'  =>  request('ldate'),
            'status'  =>  request('status'),
            'location_id'  =>  request('location_id'),
            'user_id'    =>  Auth::user()->id,
        ]);

        $staff = new StaffResource($staff);

        return response()->json([
            'staff'  =>  $staff,
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

        if($request->get('image'))
       {
          $image = $request->get('image');
          $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('image'))->save(public_path('images/').$name);
        }else{
            $name = request('oldimage');
        }

        $staff = Staff::find($id);

        $staff->dob = request('dob');        
        $staff->fathername = request('fname');
        $staff->nrc = request('nrc');        
        $staff->photo = $name;
        $staff->joineddate = request('jdate');        
        $staff->leavedate = request('ldate');
        $staff->status = request('status');        
        $staff->location_id = request('location_id');
        $staff->user_id=  Auth::user()->id;
        $staff->save();

        return response()->json([
            'message'   =>  'Staff updated successfully!'
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
         $staff = Staff::find($id);
        $staff->delete();

        return response()->json([
            'message'   =>  'Staff deleted successfully!'
        ],200);
    }
}