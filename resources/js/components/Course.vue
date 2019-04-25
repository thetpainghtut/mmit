<template>

  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <h1 class="h3 mb-2 text-gray-800"> Course List </h1>

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            
            <button @click="initAddCourse()" class="btn btn-success btn-lg float-right ">
              Add New Course
            </button>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" v-if="courses.length>0">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Name </th>
                    <th> Fees </th>
                    <th> Location </th>
                    <th> User Name </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(course, index) in courses">
                    <td> {{ index + 1 }} </td>
                    <td> {{ course.name }} </td>
                    <td> {{ course.fees }} </td>
                    <td> {{ course.location.name }} </td>
                    <td> {{ course.username }} </td>

                    <td> 
                      <button @click="initUpdate(index)" class="btn btn-success btn-xs" style="padding:8px">Edit</button>
                      
                      <button @click="deleteCourse(index)" class="btn btn-danger btn-xs" style="padding:8px">Delete</button>
                    </td>
                  </tr>
                </tbody>
                
              </table>
            </div>
          </div>

        </div>

      </div>
    </div>
    
    <div class="modal fade" tabindex="-1" role="dialog" id="add_course_model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add New Course</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
            
          <div class="modal-body">
            <div class="alert alert-danger" v-if="errors.length > 0">
              <ul>
                  <li v-for="error in errors">{{ error }}</li>
              </ul>
            </div>
            
            <div class="form-group">
              <label for="names">Name:</label>
                <input type="text" name="name" id="name" placeholder="Course Name" class="form-control" v-model="course.name">
            </div>
            <div class="form-group">
              <label for="names">Fees:</label>
                <input type="text" name="fees" id="fees" placeholder="Course Fees" class="form-control" v-model="course.fees">

            </div>
            <div class="form-group">
              <label for="names">Location:</label>
                
                <select class="form-control" name="location_id" v-model="location_id" id="locationid">
                  <option disabled value="">Please select one</option>
                  <option v-for="(location, index) in locations" :value="location.id" > {{ location.name }}  </option>
                </select>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
            <button type="button" @click="createCourse" class="btn btn-primary">Submit</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="update_course_model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Update Course</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          
          <div class="modal-body">
            <div class="alert alert-danger" v-if="errors.length > 0">
              <ul>
                <li v-for="error in errors">{{ error }}</li>
              </ul>
            </div>
            
            <div class="form-group">
              <label>Name:</label>
                <input type="text" placeholder="Course Name" class="form-control" v-model="update_course.name">
            </div>
            <div class="form-group">
              <label for="names">Fees:</label>
                <input type="text" placeholder="Course Fees" class="form-control" v-model="update_course.fees">

            </div>
            <div class="form-group">
              <label for="names">Location:</label>
                <select class="form-control"  name="location_id" v-model="update_course.locationid" id="locationid">
                  
                  <option v-for="(location, index) in locations" :value="location.id" :selected="location.id == update_course.locationid"> {{ location.name }}  </option>
                </select>
            </div>
            
          </div>
              
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            <button type="button" @click="updateCourse" class="btn btn-primary">Submit</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </div>
</template>

<script>
   export default {
       data(){
           return {
               course: {
                   name: ''
               },
               locations:[],
               location_id: '',
               errors: [],
               courses: [],
               update_course: {}
           }
       },
       mounted()
       {
           this.readCourses();
           this.readLocations();

       },
       methods: {
           deleteCourse(index)
           {
               let conf = confirm("Do you ready want to delete this Course?");
               if (conf === true) {
                   axios.delete('api/setup/course/' + this.courses[index].id)
                       .then(response => {
                           this.courses.splice(index, 1);
                       })
                       .catch(error => {
                       });
               }
           },
           initAddCourse()
           {
               $("#add_course_model").modal("show");
           },
           createCourse()
           {
               axios.post('api/setup/course', {
                   name: this.course.name,
                   fees: this.course.fees,
                   location: this.location_id,

               })
                   .then(response => {
                       this.reset();
                       this.courses.push(response.data.course);
                       $("#add_course_model").modal("hide");
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
               this.course.name = '';
           },
           readCourses()
           {
               axios.get('api/setup/course')
                   .then(response => {
                       this.courses = response.data.courses;
                   });
           },
           readLocations()
           {
               axios.get('api/setup/location')
                   .then(response => {
                       this.locations = response.data.locations;
                   });
           },
           initUpdate(index)
           {
               this.errors = [];
               $("#update_course_model").modal("show");
               this.update_course = this.courses[index];
           },
           updateCourse()
           {
               axios.patch('api/setup/course/' + this.update_course.id, {
                   name: this.update_course.name,
                   fees: this.update_course.fees,
                   location: this.update_course.locationid,

               })
                   .then(response => {
                       $("#update_course_model").modal("hide");
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