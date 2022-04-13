import {createRouter, createWebHistory} from "vue-router";

import Carousel from "../views/Carousel.vue";

const routes = [
    {
        path: '/',
        name: 'carousel',
        component: Carousel
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
