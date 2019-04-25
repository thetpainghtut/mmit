<template>

  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <h1 class="h3 mb-2 text-gray-800"> Duration List </h1>

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            
            <button @click="initAddDuration()" class="btn btn-success btn-lg float-right ">
              Add New Duration
            </button>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" v-if="durations.length > 0">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Time </th>
                    <th> Day </th>
                    <th> During </th>
                    <th> Course </th>
                    <th>User Name</th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(duration, index) in durations">
                    <td> {{ index + 1 }} </td>
                    <td> {{ duration.time }} </td>
                    <td> {{ duration.days }} </td>
                    <td> {{ duration.during }} </td>
                    <td> {{ duration.course.name }} </td>
                    <td> {{duration.username}} </td>

                    <td> 
                      <button @click="initUpdate(index)" class="btn btn-success btn-xs" style="padding:8px">Edit</button>
                      
                      <button @click="deleteDuration(index)" class="btn btn-danger btn-xs" style="padding:8px">Delete</button>
                    </td>
                  </tr>
                </tbody>
                
              </table>
            </div>
          </div>

        </div>

      </div>
    </div>
    
    <div class="modal fade" tabindex="-1" role="dialog" id="add_duration_model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add New Duration</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
            
          <div class="modal-body">
            <div class="alert alert-danger" v-if="errors.length > 0">
              <ul>
                  <li v-for="error in errors">{{ error }}</li>
              </ul>
            </div>
            
            <div class="form-group">
              <label for="names">Time:</label>
                <input type="text" name="time" id="time" placeholder="Time" class="form-control" v-model="duration.time">
            </div>
            <div class="form-group">
              <label for="names">Day:</label>
                <input type="text" name="day" id="day" placeholder="Day" class="form-control" v-model="duration.days">
            </div>
            <div class="form-group">
              <label for="names">During:</label>
                <input type="text" name="during" id="during" placeholder="During" class="form-control" v-model="duration.during">
            </div>
            <div class="form-group">
              <label for="names">Course:</label>
                
                <select class="form-control" name="course_id" v-model="course_id" id="courseid">
                  <option disabled value="">Please select one</option>
                  <option v-for="(course, index) in courses" :value="course.id" > {{ course.name }}  </option>
                </select>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
            <button type="button" @click="createDuration" class="btn btn-primary">Submit</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="update_duration_model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Update Duration</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          
          <div class="modal-body">
            <div class="alert alert-danger" v-if="errors.length > 0">
              <ul>
                <li v-for="error in errors">{{ error }}</li>
              </ul>
            </div>
            
            

            <div class="form-group">
              <label for="names">Time:</label>
                <input type="text" name="time" id="time" placeholder="Time" class="form-control" v-model="update_duration.time">
            </div>
            <div class="form-group">
              <label for="names">Day:</label>
                <input type="text" name="day" id="day" placeholder="Day" class="form-control" v-model="update_duration.days">
            </div>
            <div class="form-group">
              <label for="names">During:</label>
                <input type="text" name="during" id="during" placeholder="During" class="form-control" v-model="update_duration.during">
            </div>
            <div class="form-group">
              <label for="names">Course:</label>
                
                <select class="form-control"  name="course_id" v-model="update_duration.courseid" id="courseid">
                  
                  <option v-for="(course, index) in courses" :value="course.id" :selected="course.id == update_duration.courseid"> {{ course.name }}  </option>
                </select>
            </div>
            
          </div>
              
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            <button type="button" @click="updateDuration" class="btn btn-primary">Submit</button>
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
               duration: {
                   name: ''
               },
               courses:[],
               course_id: '',
               errors: [],
               durations: [],
               update_duration: {}
           }
       },

       mounted()
       {
           this.readDurations();
          this.readCourses();

       },
       methods: {
           deleteDuration(index)
           {
               let conf = confirm("Do you ready want to delete this Duration?");
               if (conf === true) {
                   axios.delete('api/setup/duration/' + this.durations[index].id)
                       .then(response => {
                           this.durations.splice(index, 1);
                       })
                       .catch(error => {
                       });
               }
           },
           initAddDuration()
           {
               $("#add_duration_model").modal("show");
           },
           createDuration()
           {
               axios.post('api/setup/duration', {
                   time: this.duration.time,
                   days: this.duration.days,
                   during: this.duration.during,

                   course_id: this.course_id,

               })
                   .then(response => {
                       this.reset();
                       this.durations.push(response.data.duration);
                       $("#add_duration_model").modal("hide");
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
               this.duration.time = '';
               this.duration.days = '';
               this.duration.during = '';

           },
           readDurations()
           {
               axios.get('api/setup/duration')
                   .then(response => {
                       this.durations = response.data.durations;
                   });
           },
           readCourses()
           {
               axios.get('api/setup/course')
                   .then(response => {
                       this.courses = response.data.courses;
                   });
           },
           initUpdate(index)
           {
               this.errors = [];
               $("#update_duration_model").modal("show");
               this.update_duration = this.durations[index];
           },
           updateDuration()
           {
               axios.patch('api/setup/duration/' + this.update_duration.id, {
                   time: this.update_duration.time,
                   days: this.update_duration.days,
                   during: this.update_duration.during,

                   course_id: this.update_duration.courseid,

               })
                   .then(response => {
                       $("#update_duration_model").modal("hide");
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