<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p v-if="isLoading" class="alert alert-info">Loading...</p>
                <div v-else class="card">
                    <div class="card-header">{{ productName }}</div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Articul: {{ productArticul }}</li>

                        <li v-for="attr of productAttributes" class="list-group-item">
                            {{ attr.name }}: {{ attr.value }}
                        </li>

                        <li class="list-group-item"><b>Price: {{ productPrice }}</b></li>
                    </ul>

                    <div class="card-footer d-flex justify-content-between">
                        <router-link :to="{name: 'catalog'}" class="btn btn-secondary">Back</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'ProductView',
        data: function () {
            return {
                isLoading: false,
                productId: 0,
                productArticul: '',
                productName: '',
                productPrice: 0,
                productAttributes: [],
            };
        },
        mounted() {
            this.load();
        },
        methods: {
            load() {
                this.isLoading = true;

                axios
                    .get(`/api/products/${this.$route.params.id}`)
                    .then(res => {
                        console.log(res.data);

                        if (res.status === 200) {
                            this.productId = res.data.data.id;
                            this.productArticul = res.data.data.articul;
                            this.productName = res.data.data.name;
                            this.productPrice = res.data.data.price;
                            if (res.data.data.hasOwnProperty('attributes')) {
                                this.productAttributes = res.data.data.attributes;
                            }
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

</style>