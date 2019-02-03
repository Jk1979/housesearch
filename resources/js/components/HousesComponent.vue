<template>

<div class="container">

    <div class="row justify-content-center">
      <div class="card-header">Houses search</div>
      <div class="col-md-12">
          <div class="form-group">
          <div class="form-row mb-3">
          <div class="col-12">
            <label for="search">Search</label>
            <input  id="search" class="form-control" type="text" placeholder="house name ..." v-model="query">
          </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-2">
              <label for="bedrooms">Bedrooms</label><input  @change="search" id="bedrooms" class="form-control" type="number"  v-model="senddata.bedrooms">
            </div>
            <div class="col-2">
              <label for="bathrooms">Bathrooms</label><input  @change="search" id="bathrooms" class="form-control" type="number"  v-model="senddata.bathrooms">
            </div>
            <div class="col-2">
              <label for="storeys">Storeys</label><input  @change="search" id="storeys" class="form-control" type="number"  v-model="senddata.storeys">
            </div>
            <div class="col-2">
              <label for="garages">Garages</label><input  @change="search" id="garages" class="form-control" type="number"  v-model="senddata.garages">
            </div>
            <div class="col-2">
              <label for="pricefrom">Price from</label><input  @change="search" id="pricefrom" class="form-control" type="number"  v-model="senddata.pricefrom">
            </div>
            <div class="col-2">
              <label for="priceto">Price to</label><input  @change="search" id="priceto" class="form-control" type="number"  v-model="senddata.priceto">
            </div>
          </div>

          </div>
          <hr>
          <div v-if="loading" v-cloak>
            <i class="fas fa-circle-notch fa-spin fa-2x fa-fw"></i>
            <span>Loading...</span>
          </div>
          <div v-if="houses.length">
              <div  v-for="(house,index) in houses" :key="index" class="mt-3">
                <ul class="list-group">
                  <li class="list-group-item">
                    <span class="font-weight-bold">Name:</span> {{ house.name }}
                    <span class="font-weight-bold">Price: </span>{{ house.price }}
                  </li>
                  <li class="list-group-item">
                    <span class="font-weight-bold">Bedrooms:</span> {{ house.bathrooms }}
                    <span class="font-weight-bold">Bathrooms:</span> {{ house.bathrooms }}
                    <span class="font-weight-bold">Storeys:</span> {{ house.storeys }}
                    <span class="font-weight-bold">Garages:</span> {{ house.garages }}
                  </li>
                </ul>
              </div>
          </div>
          <div v-else><h2>No results found</h2></div>
      </div>
    </div>
</div>

</template>

<script>

export default {
    data(){
      return {
        houses:[],
        query:'',
        senddata:{
          bedrooms:'',
          bathrooms:'',
          storeys:'',
          garages:'',
          name:'',
          pricefrom:'',
          priceto:''
        },
        loading: false
      }
    },
    watch: {
     query: function () {
       this.senddata.name = this.query;
       this.debouncedSearch()
     }
   },
    methods: {
      search(){
        this.loading = true;
        setTimeout(function(){
            axios.post('/search',
                this.senddata
            ).then(response => {
              this.loading = false;
              if(response.data.length) {
                this.houses = response.data
              }
              else this.houses = [];
            })
  			}.bind(this),300);

      },
      getall(){
        this.loading = true;
        axios
        .get('/all')
        .then(response => {
          this.loading = false;
          if(response.data.length){
            this.houses = response.data;
          }
        });
      }
    },
    created: function () {

      this.debouncedSearch = _.debounce(this.search, 1000)
 },
    mounted(){
      this.getall();
    }
}

</script>
<style scoped>
  [v-cloak]{
  display:block;
  }

</style>
