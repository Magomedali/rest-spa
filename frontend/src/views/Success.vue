<template>
	<div class="success">
		<h1>{{ msg }}</h1>
		<router-link :to="{name: 'catalog'}">Back to catalog</router-link>
	</div>
</template>

<script>

	export default {
		data() {
			return {
				msg: this.$store.state.notification
			}
		},
		mounted() {
			if(!this.$store.state.order.products.length)
			{
				this.$router.push({name: 'catalog'});
			}
		},
		methods: {
			
		}
	}
</script>