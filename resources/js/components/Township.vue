<template>
  


  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <h1 class="h3 mb-2 text-gray-800"> Township List </h1>

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            
            <button @click="initAddTownship()" class="btn btn-success btn-lg float-right ">
              Add New Township
            </button>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" v-if="townships.length > 0">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Township </th>
                    <th> City </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(township, index) in townships">
                    
                    <td> {{ index + 1 }} </td>
                    <td> {{ township.name }} </td>
                    <td> {{ township.cityname }} </td>

                    <td> 
                      <button @click="initUpdate(index)" class="btn btn-success btn-xs" style="padding:8px">Edit</button>
                      
                      <button @click="deletetownship(index)" class="btn btn-danger btn-xs" style="padding:8px">Delete</button>
                    </td>
                  </tr>
                </tbody>
                
              </table>
            </div>
          </div>

        </div>

      </div>
    </div>
    
    <div class="modal fade" tabindex="-1" role="dialog" id="add_township_model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add New township</h4>
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
                <input type="text" name="name" id="name" placeholder="township Name" class="form-control" v-model="township.name">
            </div>

            <div class="form-group">
              <label for="names"> City :</label>
                <select class="form-control"  name="city_id" v-model="city_id" id="cityid">
                  <option disabled value="">Please select one</option>
                  <option v-for="(city, index) in cities" :value="city.id" > {{ city.name }}  </option>
                </select>
            </div>

          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
            <button type="button" @click="createTownship" class="btn btn-primary">Submit</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="update_township_model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Update township</h4>
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
                <input type="text" placeholder="township Name" class="form-control" v-model="update_township.name">
            </div>

            <div class="form-group">
              <label for="names"> City :</label>
                <select class="form-control"  name="city_id" v-model="update_township.tsp_cityid" id="cityid">
                  
                  <option v-for="(city, index) in cities" :value="city.id" :selected="city.id == update_township.tsp_cityid"> {{ city.name }}  </option>
                </select>
            </div>
            
          </div>
              
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            <button type="button" @click="updateTownship" class="btn btn-primary">Submit</button>
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
               township: {
                   name: ''
               },
               cities:[],
               city_id: '',
               errors: [],
               townships: [],
               update_township: {}
           }
       },
       mounted()
       {
          this.readTownships();
          this.readCities();
       },
       methods: {
           deletetownship(index)
           {
               let conf = confirm("Do you ready want to delete this township?");
               if (conf === true) {
                   axios.delete('/api/setup/township/' + this.townships[index].id)
                       .then(response => {
                           this.townships.splice(index, 1);
                       })
                       .catch(error => {
                       });
               }
           },
           initAddTownship()
           {
               $("#add_township_model").modal("show");
           },
           createTownship()
           {
               axios.post('/api/setup/township', {
                   name: this.township.name,
                   city_id : this.city_id,
               })
                   .then(response => {
                       this.reset();
                       this.townships.push(response.data.township);
                       $("#add_township_model").modal("hide");
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
               this.township.name = '';
           },
           readTownships()
           {
               axios.get('/api/setup/township')
                   .then(response => {
                       this.townships = response.data.townships;
                   });
           },

           readCities()
           {
               axios.get('/api/setup/city')
                   .then(response => {
                       this.cities = response.data.cities;
                   });
           },

           initUpdate(index)
           {
               this.errors = [];
               $("#update_township_model").modal("show");
               this.update_township = this.townships[index];
           },

           updateTownship()
           {
               axios.patch('/api/setup/township/' + this.update_township.id, {
                   name: this.update_township.name,
                   city_id : this.update_township.tsp_cityid,
               })
                   .then(response => {
                       $("#update_township_model").modal("hide");
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