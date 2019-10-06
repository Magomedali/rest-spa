<template>
	<div class="catalog">
		
	  	<div class="catalog-header">
		    <h1>Catalog</h1>
		    <button class="btn btn-sm btn-success" v-on:click="generate">Generate</button> &nbsp
		    <button class="btn btn-sm btn-success" v-if="!btnHidden" >Create order</button>
		</div>

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
		            		<input type="checkbox"  :value="product.id"  @change="updateMessage" v-model="selectedProducts">
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
				products: [],
				selectedProducts: [],
				btnHidden: true
			}
		},
		mounted() {
			this.loadProducts();
		},
		methods: {
		  	updateMessage() {
			    this.btnHidden = !this.selectedProducts.length
			},
			generate() {

				axios.put('/product')
					.then(response => {
						if(response.status === 200 && response.data.hasOwnProperty("success") && response.data.success)
						{
							this.loadProducts();
						}
					})

			},
			loadProducts() {
				axios.get('/product')
				.then(response => {
					this.products = response.data;
				})
			}
		}
	}
</script>