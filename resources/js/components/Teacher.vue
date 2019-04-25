<template>

  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <h1 class="h3 mb-2 text-gray-800"> Teacher List </h1>

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            
            <button @click="initAddTeacher()" class="btn btn-success btn-lg float-right ">
              Add New Teacher
            </button>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" v-if="teachers.length>0">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Name </th>
                    <th> Course </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(teacher, index) in teachers">
                    <td> {{ index + 1 }} </td>
                    <td> {{ teacher.users.name }} </td>
                    <td> {{ teacher.courses.name }} </td>
                    <td> 
                      <button @click="initUpdate(index)" class="btn btn-success btn-xs" style="padding:8px">Edit</button>
                      
                      <button @click="deleteTeacher(index)" class="btn btn-danger btn-xs" style="padding:8px">Delete</button>
                    </td>
                  </tr>
                </tbody>
                
              </table>
            </div>
          </div>

        </div>

      </div>
    </div>
    
    <div class="modal fade" tabindex="-1" role="dialog" id="add_teacher_model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add New Teacher</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
            
          <div class="modal-body">
            <div class="alert alert-danger" v-if="errors.length > 0">
              <ul>
                  <li v-for="error in errors">{{ error }}</li>
              </ul>
            </div>
            
            <div class="form-group">
               <label for="loc">Staff:</label>
               <select v-model="staff_id" class="form-control" id="staffid" name="staff_id">
                 <option disabled value="">Please chooose one</option>
                 <option v-for="(staff, index) in staffs" :value="staff.id" > {{ staff.username }} </option>
               </select>
               
           </div>
            
            <div class="form-group">
              <label for="names">Course:</label>
                <select v-model="course_id" class="form-control" id="courseid" name="course_id">
                  <option disabled value="">Please chooose one</option>
                  <option v-for="(course, index) in courses" :value="course.id">{{course.name}}</option>
                </select>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
            <button type="button" @click="createTeacher" class="btn btn-primary">Submit</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="update_teacher_model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Update Teacher</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          
          <div class="modal-body">
            <div class="alert alert-danger" v-if="errors.length > 0">
              <ul>
                <li v-for="error in errors">{{ error }}</li>
              </ul>
            </div>
            
            <div class="form-group">
              <label for="names"> Staff :</label>
                <select class="form-control"  name="staff_id" v-model="update_teacher.teacher_staffid" id="staffid">
                <option v-for="(staff, index) in staffs" :value="staff.id" :selected="staff.id == update_teacher.teacher_staffid"> {{ staff.username }}  </option>
               </select>
          </div>
            <div class="form-group">
              <label for="names"> Course :</label>
                <select class="form-control"  name="course_id" v-model="update_teacher.teacher_courseid" id="courseid">
    
                <option v-for="(course, index) in courses" :value="course.id" :selected="course.id == update_teacher.teacher_courseid"> {{ course.name }}  </option>
               </select>
          </div>
            
            
          </div>
              
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            <button type="button" @click="updateTeacher" class="btn btn-primary">Submit</button>
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
               teacher: {
                   name: ''
               }, 
               errors: [],
               courses: [],
               course_id: '',
               users: [],
               user_id: '',
               staffs: [],
               staff_id: '',
               teachers: [],
               update_teacher: {}
           }
       },
       mounted()
       {
           this.readTeachers();
           this.readCourses();
           this.readStaffs();
       },
       methods: {
           deleteTeacher(index)
           {
               let conf = confirm("Do you ready want to delete this Teacher?");
               if (conf === true) {
                   axios.delete('api/setup/teacher/' + this.teachers[index].id)
                       .then(response => {
                           this.teachers.splice(index, 1);
                       })
                       .catch(error => {
                       });
               }
           },
           initAddTeacher()
           {
               $("#add_teacher_model").modal("show");
           },
           createTeacher()
           {
               axios.post('api/setup/teacher', {
                   staff_id: this.staff_id,
                   course_id: this.course_id,

               })
                   .then(response => {
                       this.reset();
                       this.teachers.push(response.data.teachers);
                       $("#add_teacher_model").modal("hide");
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
               this.teacher.staff_id = '';
               this.teacher.course_id = '';
           },
           readTeachers()
           {
               axios.get('/api/setup/teacher')
                   .then(response => {
                       this.teachers = response.data.teachers;
                   });
           },
           readCourses()
           {
               axios.get('api/setup/course')
                   .then(response => {
                       this.courses = response.data.courses;
                   });
           },
           readStaffs()
           {
               axios.get('/api/setup/staff')
                   .then(response => {
                       this.staffs = response.data.staffs;
                   });
           },
           initUpdate(index)
           {
               this.errors = [];
               $("#update_teacher_model").modal("show");
               this.update_teacher = this.teachers[index];
           },
           updateTeacher()
           {
               axios.patch('api/setup/teacher/' + this.update_teacher.id, {
                   staff_id : this.update_teacher.teacher_staffid,
                   course_id : this.update_teacher.teacher_courseid,

               })
                   .then(response => {
                       $("#update_teacher_model").modal("hide");
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