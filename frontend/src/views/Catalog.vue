<template>
	<div class="catalog">
		
	  	<div class="catalog-header">
		    <h1>Catalog</h1>
		    <button class="btn btn-sm btn-success" v-on:click="generate">Generate</button> &nbsp
		    <button class="btn btn-sm btn-success" v-if="!btnHidden" v-on:click="createOrder">Create order</button>
		</div>

		<b-alert variant="danger" v-if="error" show>{{error}}</b-alert>
		<b-alert variant="success" v-if="success" show>{{success}}</b-alert>

		<div class="products" v-if="products.length">
			<table class="table table-sm table-bordered table-collapsed">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Price</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
		            <tr class="product-item" v-for="product in products">
		            	<td>{{ product.id }}</td>
		            	<td>{{ product.name }}</td>
		            	<td>{{ product.price }}</td>
		            	<td>
		            		<input type="checkbox"  :value="product"  @change="updateMessage" v-model="order.products">
		            	</td>
		            </tr>
				</tbody>
			</table>
		</div>

	</div>
</template>

<script>
	import axios from "axios";

	export default {
		data() {
			return {
				success:null,
				error: null,
				products: [],
				btnHidden: true,
				order: {
					id: 0,
					products: []
				}
			}
		},
		mounted() {
			this.loadProducts();
		},
		methods: {
		  	updateMessage() {
			    this.btnHidden = !this.order.products.length
			},
			generate() {

				axios.put('/product')
					.then(response => {
						if(response.data.hasOwnProperty("success") && response.data.success)
						{
							this.success = response.data.success;
							this.loadProducts();
						}
					}).catch(error => {
			            if (error.response) {
				            if (error.response.data.error) {
				                this.error = error.response.data.error;
				            }
			            } else {
			              	console.log(error.message);
			            }
			        })

			},
			loadProducts() {
				axios.get('/product')
				.then(response => {
					this.products = response.data;
				})
			},
			createOrder() {
				var ids = [];
				if(!this.order.products.length)
				{
					return;
				}

				this.order.products.forEach(function(product){
					ids.push(product.id)
				})

				axios.put('/order',ids)
					.then(response => {

						if(response.data.hasOwnProperty('id'))
						{
							this.success = 'Order #'+response.data.id+' created successfully';
							this.order.id = response.data.id;
							
							this.$store.state.order = this.order;
							this.$store.state.notification = this.success;

							this.$router.push({name: 'payment'});
						}else{
							this.error = 'Error while creating order';
						}
						
					})
					.catch(error => {
			            if (error.response) {
				            if (error.response.data.error) {
				                this.error = error.response.data.error;
				            }
			            } else {
			              	console.log(error.message);
			            }
			        })
			}
		}
	}
</script>