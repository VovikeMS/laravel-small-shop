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

                    <div class="card-body" v-if="relatedProducts.length">
                        Choose modification:
                        <ul class="list-group">
                            <router-link :to="{name: 'product', params: {id: related.id}}"
                                         class="list-group-item list-group-item-action d-flex justify-content-between"
                                         :class="{'disabled': related.id === productId}"
                                         v-for="related of relatedProducts"
                                         :key="related.id">
                                <span>
                                    <span v-for="attr of related.attributes" class="badge badge-secondary related-property">
                                        {{ attr.name }} {{ attr.value }}
                                    </span>
                                </span>
                                <b>${{ related.price }}</b>
                            </router-link>
                        </ul>
                    </div>

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
                relatedProducts: [],
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

                            if (res.data.data.hasOwnProperty('related') && res.data.data.related.length) {
                                this.relatedProducts = res.data.data.related;
                                this.relatedProducts.unshift(res.data.data);
                            } else if (res.data.data.hasOwnProperty('relatedTo') && res.data.data.relatedTo !== null) {
                                this.relatedProducts = res.data.data.relatedTo.related;
                                this.relatedProducts.unshift(res.data.data.relatedTo);
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
    .related-property {
        margin-right: 5px;
    }
</style>