<template>

  <div>
      <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <div class="row mb-3">
              <div class="col-xl-5 col-lg-5">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
                  <a class="m-0 float-right btn btn-danger btn-sm" href="#">Customers <i
                      class="fas fa-chevron-right"></i></a>
                </div>
                <div class="table-responsive" style="font-size: 12px;">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>QTY</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="cart in cartContents" :key="cart.id">
                        <td>{{ cart.pro_name }}</td>
                        <td><input type="text" readonly="" style="width: 15px;" :value="cart.pro_quantity">
                            <button @click.prevent="increment(cart.pro_id)" class="btn btn-sm btn-success">+</button>
                            <button  @click.prevent="decrement(cart.pro_id)" class="btn btn-sm btn-danger" v-if="cart.pro_quantity >= 2">-</button>
                            <button class="btn btn-sm btn-danger" v-else="" disabled="">-</button>
                        </td>
                        <td>{{ cart.product_price  }}</td>
                        <td>{{ cart.sub_total }}</td>
                        <td><a @click="removeItem(cart.id)" class="btn btn-sm btn-primary"><font color="#ffffff">X</font></a></td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">


                    <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity:
                    <strong>{{ qty }}</strong>
                    </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">Total :
                    <strong>{{ subtotal }} $</strong>
                    </li> 
                    
                  </ul>   
                    <br> 

                    <form @submit.prevent="orderDone">
                      <label>Customer Name</label>
                      <select class="form-control" v-model="customer_id">
                        <option :value="customer.id" v-for="customer in customers">{{customer.name }} </option>   
                      </select>
                      <label>Pay</label>
                      <input type="text" class="form-control" required="" v-model="pay">

                      <label>Due</label>
                      <input type="text" class="form-control" required="" v-model="due">

                      <label>Pay By</label>
                      <select class="form-control" v-model="payby">
                            <option value="HandCash">Hand Cash </option>
                            <option value="Cheaque">Cheaque </option>
                            <option value="GiftCard">Gift Card </option>
                      </select>

                      <br>
                      <button type="submit" class="btn btn-success">Submit</button>

                    </form> 


                </div>
              </div>
            </div>
            <!-- Area Chart -->
            <div class="col-xl-7 col-lg-7 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Products</h6>
                    <!-- <a class="m-0 float-right btn btn-danger btn-sm" href="#">View More <i
                        class="fas fa-chevron-right"></i></a> -->
                    </div>


                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Product </a>
                        </li>

                        <li class="nav-item" v-for="category in categories" :key="category.id">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="categoryWiseProduct(category.id)" >{{ category.name }}</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card-body">
                                <input type="text" v-model="searchTerm" class="form-control" style="width: 560px;" placeholder="Search Product">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filterSearch" :key="product.id">
                                        <button class="btn btn-sm" @click.prevent="addToCart(product.id)">
                                            <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                            <img :src="product.image" id="em_photo" class="card-img-top">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ product.product_name }}</h6>
                                                <span class="badge badge-success" v-if="product.product_quantity  >= 1 ">Available {{ product.product_quantity }}  </span>
                                                <span class="badge badge-danger" v-else=" ">Stock Out </span>
                                            </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <input type="text" v-model="categoryWiseSearchTerm" class="form-control" style="width: 560px;" placeholder="Search Product">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="getproduct in getFilterSearch" :key="getproduct.id">
                                    <button class="btn btn-sm" @click.prevent="addToCart(getproduct.id)">
                                        <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                            <img :src="getproduct.image" id="em_photo" class="card-img-top">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ getproduct.product_name }}</h6>
                                                <span class="badge badge-success" v-if="getproduct.product_quantity  >= 1 ">Available {{ getproduct.product_quantity }}  </span>
                                                <span class="badge badge-danger" v-else=" ">Stock Out </span>
                                            </div>
                                        </div>
                                    </button>

                                </div>
                            </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- Pie Chart -->
          </div>
          <!--Row-->
        </div>
        <!---Container Fluid-->
  </div>


</template>

<script type="text/javascript">
 export default{
   created(){
         if(!User.loggedIn()){
             this.$router.push({name:'/'})
         }
     },
     created(){
			 this.allProducts();
             this.allCategories();
             this.allCustomers();
             this.cartContent();
             Reload.$on('afterAdd',()=>{
                 this.cartContent();
             })
		 },
	 data(){
		 return{
             customer_id:'',
             pay:'',
             due:'',
             payby:'',
			 products:[],
			 catProducts:[],
			 searchTerm:'',
			 categoryWiseSearchTerm:'',
             categories:'',
             customers:'',
             cartContents:[],
             
		 }
	 },

	 computed:{
		 filterSearch(){
			 return this.products.filter(product =>{
				 return product.product_name.match(this.searchTerm)
			 })
		 },
		 getFilterSearch(){
			 return this.catProducts.filter(catProducts =>{
				 return catProducts.product_name.match(this.categoryWiseSearchTerm)
			 })
		 },qty(){
            let sum = 0;
            for(let i = 0; i < this.cartContents.length; i++){
                sum += (parseFloat(this.cartContents[i].pro_quantity));      
                }
                return sum;
        },
        subtotal(){
            let sum = 0;
            for(let i = 0; i < this.cartContents.length; i++){
            sum += (parseFloat(this.cartContents[i].pro_quantity) * parseFloat(this.cartContents[i].product_price));      
            }
            return sum;
        },
	 },
     methods:{
         addToCart(id){
             axios.get('/api/cart/addToCart/'+id)
			 .then(()=>{
                 Reload.$emit('afterAdd');
                 Notification.success();
             })
			 .catch()
         },
         cartContent(){
             axios.get('/api/cart/cartContent/')
			 .then(({data})=>(this.cartContents = data))
			 .catch()
         },
         removeItem(id){
            axios.get('/api/cart/remove/'+id)
            .then(() => {
                Reload.$emit('afterAdd');
                Notification.success()
            })
            .catch()
        },
        increment(id){
            axios.get('/api/cart/increment/'+id)
            .then(() => {
                Reload.$emit('afterAdd');
                Notification.success()
            })
            .catch()
        },
        decrement(id){
            axios.get('/api/cart/decrement/'+id)
            .then(() => {
                Reload.$emit('afterAdd');
                Notification.success()
            })
            .catch()
        },
		allProducts(){
			axios.get('/api/product/')
			.then(({data})=>(this.products = data))
			.catch()
		},
        allCategories(){
            axios.get('/api/category/')
            .then(({data})=>(this.categories = data))
            .catch()
        },
        allCustomers(){
            axios.get('/api/customer/')
            .then(({data})=>(this.customers = data))
            .catch()
        },
        categoryWiseProduct(id){
            axios.get('/api/categoryWiseProduct/'+id)
            .then(({data})=>(this.catProducts = data))
            .catch()
        },
        orderDone(){
            var data = {qty:this.qty, subtotal:this.subtotal, customer_id:this.customer_id, payby:this.payby, pay:this.pay, due:this.due}
            axios.post('/api/order/done',data)
            .then(() => {
                Notification.success()
                this.$router.push({name: 'home'})
            })
        }

     },

 }
</script>

<style scoped>
	 #em_photo{
    height: 100px;
    width: 135px;
  }
</style>
