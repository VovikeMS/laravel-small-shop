<template>
    <div class="card">
        <div class="card-header">
            <b>{{ product.name }}</b>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Articul: {{ product.articul }}</li>
            <li v-if="product.hasOwnProperty('attributes')" v-for="attr of product.attributes" class="list-group-item">
                {{ attr.name }}: {{ attr.value }}
            </li>
        </ul>
        <div class="card-footer d-flex justify-content-between">
            <span class="product-card-price"><b>${{ product.price }}</b></span>
            <router-link :to="{name: 'product', params: {id: product.id}}" class="btn btn-primary">Details</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ProductCardComponent',
        props: ['product'],
    }
</script>

<style scoped>
    .product-card-price {
        padding: 7px 0;
    }
</style>