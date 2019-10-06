<template>
	<div class="payment">
		<h1>Your order #{{ order.id }}</h1>

		<button class="btn btn-sm btn-success" v-on:click="payment">Execute Pay, Sum: {{ sum }}</button>

		<b-alert variant="danger" v-if="error" show>{{error}}</b-alert>
		<b-alert variant="success" v-if="success" show>{{success}}</b-alert>

		<div class="products" v-if="order.products.length">
			<table class="table table-sm table-bordered table-collapsed">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Price</th>
					</tr>
				</thead>
				<tbody>
		            <tr class="product-item" v-for="product in order.products">
		            	<td>{{ product.id }}</td>
		            	<td>{{ product.name }}</td>
		            	<td>{{ product.price }}</td>
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
				error: null,
				success: this.$store.state.notification,
				sum: null,
				order: this.$store.state.order
			}
		},
		mounted() {

			if(!this.$store.state.order.products.length)
			{
				this.$router.push({name: 'catalog'});
			}

			var sum = null;
			this.$store.state.order.products.forEach(function(product){
				sum += parseInt(product.price);
			})

			this.sum = sum;
		},
		methods: {
			payment() {
				this.error = null;
				this.success = null;

				axios.post('/pay',{id:this.order.id,sum:this.sum})
					.then(response => {

						if(response.data.hasOwnProperty("success") && response.data.success)
						{
							this.$store.state.notification = "Thanks for order";
							this.$router.push({name: 'success'});
						}

					})
					.catch(error => {
						console.log(error);
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