<template>
  


  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <h1 class="h3 mb-2 text-gray-800"> City List </h1>

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            
            <button @click="initAddCity()" class="btn btn-success btn-lg float-right ">
              Add New City
            </button>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" v-if="cities.length > 0">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Name </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(city, index) in cities">
                    <td> {{ index + 1 }} </td>
                    <td> {{ city.name }} </td>
                    <td> 
                      <button @click="initUpdate(index)" class="btn btn-success btn-xs" style="padding:8px">Edit</button>
                      
                      <button @click="deleteCity(index)" class="btn btn-danger btn-xs" style="padding:8px">Delete</button>
                    </td>
                  </tr>
                </tbody>
                
              </table>
            </div>
          </div>

        </div>

      </div>
    </div>
    
    <div class="modal fade" tabindex="-1" role="dialog" id="add_city_model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add New City</h4>
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
                <input type="text" name="name" id="name" placeholder="City Name" class="form-control" v-model="city.name">
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
            <button type="button" @click="createCity" class="btn btn-primary">Submit</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="update_city_model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Update City</h4>
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
                <input type="text" placeholder="City Name" class="form-control" v-model="update_city.name">
            </div>
            
          </div>
              
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            <button type="button" @click="updateCity" class="btn btn-primary">Submit</button>
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
               city: {
                   name: ''
               },
               errors: [],
               cities: [],
               update_city: {}
           }
       },
       mounted()
       {
           this.readCities();
       },
       methods: {
           deleteCity(index)
           {
               let conf = confirm("Do you ready want to delete this city?");
               if (conf === true) {
                   axios.delete('/api/setup/city/' + this.cities[index].id)
                       .then(response => {
                           this.cities.splice(index, 1);
                       })
                       .catch(error => {
                       });
               }
           },
           initAddCity()
           {
               $("#add_city_model").modal("show");
           },
           createCity()
           {
               axios.post('/api/setup/city', {
                   name: this.city.name,
               })
                   .then(response => {
                       this.reset();
                       this.cities.push(response.data.city);
                       $("#add_city_model").modal("hide");
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
               this.city.name = '';
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
               $("#update_city_model").modal("show");
               this.update_city = this.cities[index];
           },
           updateCity()
           {
               axios.patch('/api/setup/city/' + this.update_city.id, {
                   name: this.update_city.name,
               })
                   .then(response => {
                       $("#update_city_model").modal("hide");
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