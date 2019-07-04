<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Catalog</div>

                    <div class="card-body">
                        <div v-if="isLoading" class="alert alert-info">
                            Loading
                        </div>

                        <div v-else class="row">
                            <div v-for="product of products" :key="product.id" class="col-md-6 product-card">
                                <product-card-component :product="product"></product-card-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import ProductCardComponent from './Product/ProductCardComponent.vue';

    export default {
        name: 'CatalogView',
        components: {ProductCardComponent},
        data: function () {
            return {
                products: [],
                isLoading: false,
            };
        },
        mounted() {
            this.load();
        },
        methods: {
            load() {
                this.isLoading = true;

                axios
                    .get('/api/products')
                    .then(res => {
                        console.log(res.data);

                        if (res.status === 200) {
                            this.products = res.data.data;
                        }
                    })
                    .catch(err => console.log(err))
                    .finally(() => {
                        this.isLoading = false;
                    });
            },
        },
    }
</script>

<style scoped>
    .product-card {
        margin-bottom: 20px;
    }
</style>