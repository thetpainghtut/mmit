<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use App\Model\Location;

class StaffResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        /*return parent::toArray($request);*/
        return[
            'id' => $this->id,
            'dob' => $this->dob,
            'fathername' => $this->fathername,
            'nrc' => $this->nrc,
            'photo' => $this->photo,
            'joineddate' => $this->joineddate,
            'leavedate' => $this->leavedate,
            'status' => $this->status,
            'staff_locationid' => $this->location_id,
            'locationname' => $this->locationname,
            'username' => $this->username,
            'locations' => new LocationResource(Location::find($this->location_id)),
            'username' => $this->username,
        ];
    }
}
