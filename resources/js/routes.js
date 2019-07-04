import Vue from 'vue';
import VueRouter from 'vue-router';

import CatalogView from './components/CatalogView.vue';
import ProductView from './components/Product/ProductView.vue';

Vue.use(VueRouter);

Vue.component('CatalogView', CatalogView);
Vue.component('ProductView', ProductView);

const routes = [
    {
        path: '/',
        name: 'catalog',
        component: CatalogView,
        meta: {
            title: 'Catalog'
        }
    },
    {
        path: '/product/:id',
        name: 'product',
        component: ProductView,
        meta: {
            title: 'Product'
        }
    },
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

export default router;
