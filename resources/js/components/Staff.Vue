<template>
   <div class="container">
       <div class="row">
           <div class="col-md-12">
            <h1 class="h3 mb-2 text-gray-800"> Staff List </h1>
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <button @click="initAddStaff()" class="btn btn-success btn-lg float-right" style="padding:5px">
                     Add New Staff
                  </button>
                  </div>
                   <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped" v-if="staffs.length > 0">
                           <tbody>
                           <tr>
                               <th>
                                   No.
                               </th>
                               <th>
                                   Username
                               </th>
                               <th>
                                   Father Name
                               </th>
                               <th>
                                   Date of Birth
                               </th>
                               <th>
                                   NRC No
                               </th>
                               <th>
                                   Photo
                               </th>
                               <!-- <th>
                                   Start Date
                               </th>
                               <th>
                                   End Date
                               </th>
                               <th>
                                   Status
                               </th>
                               <th>
                                   Location
                               </th> -->
                               <th>
                                   Action
                               </th>
                               

                           </tr>
                           <tr v-for="(staff, index) in staffs">
                               <td>{{ index + 1 }}</td>
                               <td>
                                  {{ staff.username}}
                              </td>
                               <td>
                                   {{ staff.fathername }}
                               </td>
                               <td>
                                   {{ staff.dob }}
                               </td>
                               
                               <td>
                                   {{ staff.nrc }}
                               </td>
                               <td>
                                <img :src="getImage(staff.photo)" class="img-responsive" height="90" width="90">
                                   
                               </td>
                              <!--  <td>
                                  {{ staff.joineddate }}
                              </td>
                              <td>
                                  {{ staff.leavedate }}
                              </td>
                              <td>
                                  {{ staff.status }}
                              </td>
                              <td>
                                  {{ staff.locations.name }}
                              </td> -->
                               
                               <td>
                    <button @click="initDetail(index)" class="btn btn-info btn-xs" style="padding:8px">Detail</button>

                   <button @click="initUpdate(index)" class="btn btn-success btn-xs" style="padding:8px">Edit</button>
                   
                   <button @click="deleteStaff(index)" class="btn btn-danger btn-xs" style="padding:8px">Delete</button>

                   
                               </td>
                           </tr>
                           </tbody>
                       </table>
                     </div>
                   </div>
           </div>
       </div>
       <div class="modal fade" tabindex="-1" role="dialog" id="add_staff_model">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                      <h4 class="modal-title">Add New Staff</h4>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   </div>
                   <div class="modal-body">
                       <div class="alert alert-danger" v-if="errors.length > 0">
                           <ul>
                               <li v-for="error in errors">{{ error }}</li>
                           </ul>
                       </div>
                       <div class="form-group">
                           <label for="names">Date of Birth:</label>
                           <input type="date" name="dob" id="dob" placeholder="Date of Birth" class="form-control"
                                  v-model="staff.dob">
                       </div>
                        <div class="form-group">
                           <label for="names">Father Name:</label>
                           <input type="text" name="fname" id="fname" placeholder="Father Name" class="form-control"
                                  v-model="staff.fname">
                       </div>
                        <div class="form-group">
                           <label for="names">NRC NO:</label>
                           <input type="text" name="nrc" id="nrc" placeholder="NRC No" class="form-control"
                                  v-model="staff.nrc">
                       </div>
       
                        <div class="form-group">
                           <label for="names">Photo:</label>
                           <div class="col-md-3" v-if="image">
                              <img :src="image" class="img-responsive" height="90" width="90">
                           </div>
                          <div class="col-md-6">
                              <input type="file" multiple v-on:change="onImageChange" class="form-control">
                          </div>
                       </div>
                        <div class="form-group">
                           <label for="names">Join Date:</label>
                           <input type="date" name="jdate" id="jdate" placeholder="Join Date" class="form-control"
                                  v-model="staff.jdate">
                       </div>
                        <div class="form-group">
                           <label for="names">Leave Date:</label>
                           <input type="date" name="ldate" id="ldate" placeholder="Leave Date" class="form-control"
                                  v-model="staff.ldate">
                       </div>
                        <div class="form-group">
                           <label for="names">Status:</label>
                           <textarea name="status" id="status" placeholder="Any Description" class="form-control"
                                  v-model="staff.status"></textarea>
                       </div>
                        <div class="form-group">
                           <label for="loc">Location:</label>
                           <select v-model="location_id" class="form-control" id="locationid" name="location_id">
                             <option disabled value="">Please select one</option>
                             <option v-for="(location, index) in locations" :value="location.id" > {{ location.name }} </option>
                           </select>
                           
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       <button type="button" @click="createStaff" class="btn btn-primary">Submit</button>
                   </div>
               </div>
           </div>
       </div>
       <div class="modal fade" tabindex="-1" role="dialog" id="update_staff_model">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                      <h4 class="modal-title">Update Staff</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   </div>
                   <div class="modal-body">
                       <div class="alert alert-danger" v-if="errors.length > 0">
                           <ul>
                               <li v-for="error in errors">{{ error }}</li>
                           </ul>
                       </div>
                       <!-- {{update_staff}} -->
                       <div class="form-group">
                           <label>Date of Birth</label>
                           <input type="text" placeholder="Date of Birth" class="form-control"
                                  v-model="update_staff.dob" name="dob" id="dob">
                       </div>
                       <div class="form-group">
                           <label>Father Name:</label>
                           <input type="text" placeholder="Father Name" class="form-control"
                                  v-model="update_staff.fathername" name="fname" id="fname">
                       </div>
                       <div class="form-group">
                           <label>NRC:</label>
                           <input type="text" placeholder="NRC No" class="form-control"
                                  v-model="update_staff.nrc" name="nrcno" id="nrcno">
                       </div>
                       <div class="form-group">
                           <label>Photo:</label>
                           <nav>
                            <div class=" nav nav-tabs nav-justified">
                              <a href="#old" class="nav-item nav-link active" data-toggle="tab">Old Photo</a>
                              <a href="#newimage" class="nav-item nav-link" data-toggle="tab" >Upload New Photo</a>
                              
                            </div>
                          </nav>
                          <div class="tab-content container my-3">
                            <div class="tab-pane fade show active rounded" id="old">
                              <img :src="getImage(update_staff.photo)" class="img-responsive" height="90" width="90">
                              <input type="hidden" name="oldimage" :value="update_staff.photo" id="oldimage">
                              {{staff.photo}}
                            </div>        
                            <div class="tab-pane fade" id="newimage">
                              <div class="col-md-3" v-if="image">
                                <!-- <img :src="image" class="img-responsive" height="90" width="90"> -->
                              </div>
                              <div class="col-md-6">
                                  <input type="file" v-on:change="onImageChange" class="form-control">
                              </div>
                            </div>
                            
                          </div>
                          <!--  <input type="text" placeholder="Photo" class="form-control"
                                 v-model="update_staff.photo"> -->
                       </div>
                       <div class="form-group">
                           <label>Join Date:</label>
                           <input type="text" placeholder="Join Date" class="form-control"
                                  v-model="update_staff.joineddate" name="jdate" id="jdate">
                       </div>
                       <div class="form-group">
                           <label>Leave Date:</label>
                           <input type="text" placeholder="Leave Date" class="form-control"
                                  v-model="update_staff.leavedate" name="j" id="fname">
                       </div>
                       <div class="form-group">
                           <label>Status:</label>
                           <input type="text" placeholder="Any Description" class="form-control"
                                  v-model="update_staff.status">
                       </div>
                       <div class="form-group">
                            <label for="names"> Location :</label>
                              <select class="form-control"  name="location_id" v-model="update_staff.staff_locationid" id="locationid">
                  
                              <option v-for="(location, index) in locations" :value="location.id" :selected="location.id == update_staff.staff_locationid"> {{ location.name }}  </option>
                             </select>
                        </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       <button type="button" @click="updateStaff" class="btn btn-primary">Submit</button>
                   </div>
               </div>
           </div>
       </div>
       <div class="modal fade" tabindex="-1" role="dialog" id="detail_staff_model">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                      <h4 class="modal-title">Detail Information</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   </div>
                   <div class="modal-body col-md-8s offset-2 text-left">
                       <div class="alert alert-danger" v-if="errors.length > 0">
                           <ul>
                               <li v-for="error in errors">{{ error }}</li>
                           </ul>
                       </div>
                       <!-- {{detail_staff}} -->
                       <div class="row">
                         <div class="col-md-6">
                           Name
                         </div>
                         <div class="col-md-6">
                           {{detail_staff.username}}
                         </div>
                       </div>
                       <div class="row">
                         <div class="col-md-6">
                           Father Name
                         </div>
                         <div class="col-md-6">
                           {{detail_staff.fathername}}
                         </div>
                       </div>
                       <div class="row">
                         <div class="col-md-6">
                           Date of Birth
                         </div>
                         <div class="col-md-6">
                           {{detail_staff.dob}}
                         </div>
                       </div>
                       <div class="row">
                         <div class="col-md-6">
                           Photo
                         </div>
                         <div class="col-md-6">
                           <img :src="getImage(detail_staff.photo)" class="img-responsive" height="90" width="90">
                         </div>
                       </div>
                       <div class="row">
                         <div class="col-md-6">
                           NRC No
                         </div>
                         <div class="col-md-6">
                           {{detail_staff.nrc}}
                         </div>
                       </div>
                       <div class="row">
                         <div class="col-md-6">
                           Joined Date
                         </div>
                         <div class="col-md-6">
                           {{detail_staff.joineddate}}
                         </div>
                       </div>
                       <div class="row">
                         <div class="col-md-6">
                           Leave Date
                         </div>
                         <div class="col-md-6">
                           {{detail_staff.leavedate}}
                         </div>
                       </div>
                       <div class="row">
                         <div class="col-md-6">
                           Status
                         </div>
                         <div class="col-md-6">
                           {{detail_staff.status}}
                         </div>
                       </div>
                       <div class="row">
                         <div class="col-md-6">
                           Location
                         </div>
                         <div class="col-md-6">
                           {{detail_staff.locationname}}
                         </div>
                       </div>
                       
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   </div>
               </div>
           </div>
       </div>
       <!-- /.modal-dialog -->
    </div>
</template>
<script>
   export default {
       data(){
           return {
               staff: {
                   fathername: '',
                   image:''
               },
               errors: [],
               locations: [],
               location_id: '',
               staffs: [],
               update_staff: {},
               detail_staff: {
                name:'',
               }
           }
       },
       mounted()
       {
           this.readStaffs();
           this.readLocations();
       },
       methods: {
            getImage(image){
              return "images/" + image;
            },
            onImageChange(e) {
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                    this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
           deleteStaff(index)
           {
               let conf = confirm("Do you ready want to delete this staff?");
               if (conf === true) {
                   axios.delete('/api/setup/staff/' + this.staffs[index].id)
                       .then(response => {
                           this.staffs.splice(index, 1);
                       })
                       .catch(error => {
                       });
               }
           },
           initAddStaff()
           {
               $("#add_staff_model").modal("show");
           },
           createStaff()
           {
               axios.post('/api/setup/staff', {
                   dob: this.staff.dob,
                   fname: this.staff.fname,
                   nrc: this.staff.nrc,
                   image: this.image,
                   jdate: this.staff.jdate,
                   ldate: this.staff.ldate,
                   status: this.staff.status,
                   location_id: this.location_id,
               })
                   .then(response => {
                       this.reset();
                       this.staffs.push(response.data.staff);
                       $("#add_staff_model").modal("hide");
                       /*console.log(response);
                       if (response.data.success) {
                     alert(response.data.success);
                   }*/
                   })
                   .catch(error => {
                       this.errors = [];
                       if (error.response.data.errors && error.response.data.errors.name) {
                           this.errors.push(error.response.data.errors.name[0]);
                       }
                   });
           },
           reset()
           {
               this.staff.name = '';
           },
           readStaffs()
           {
               axios.get('/api/setup/staff')
                   .then(response => {
                       this.staffs = response.data.staffs;
                       /*console.log(response.data.staffs[0]);*/
                   });
           },
           readLocations()
           {
               axios.get('/api/setup/location')
                   .then(response => {
                       this.locations = response.data.locations;
                   });
           },
           initUpdate(index)
           {
               this.errors = [];
               $("#update_staff_model").modal("show");
               this.update_staff = this.staffs[index];
           },
           initDetail(index)
           {
               this.errors = [];
               $("#detail_staff_model").modal("show");
               this.detail_staff = this.staffs[index];
           },
           updateStaff()
           {
               axios.patch('/api/setup/staff/' + this.update_staff.id, {
                   dob: this.update_staff.dob,
                   fname: this.update_staff.fathername,
                   nrc: this.update_staff.nrc,
                   image: this.image,
                   oldimage: this.update_staff.photo,
                   jdate: this.update_staff.joineddate,
                   ldate: this.update_staff.leavedate,
                   status: this.update_staff.status,
                   location_id: this.update_staff.staff_locationid,
               })
                   .then(response => {
                       $("#update_staff_model").modal("hide");
                   })
                   .catch(error => {
                       this.errors = [];
                       if (error.response.data.errors.name) {
                           this.errors.push(error.response.data.errors.name[0]);
                       }
                   });
           }
       }
   }
</script>
