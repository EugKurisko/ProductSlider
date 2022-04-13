<template>
    <h1>Carousel</h1>
    <div v-if="!this.product.name">
        Wait, please, a couple of seconds. Data is loading
    </div>
    <div v-else>
        <Slide v-bind:product="this.product" v-bind:main-image="this.mainImage" @changeImage="changeImage"></Slide>
    </div>
</template>

<script>
import axios from "axios";
import Slide from "./Slide.vue";
export default {
    components: {
        Slide,
    },
    name: "Carousel",
    created() {
        this.getProducts();
    },
    data() {
        return {
            products: [],
            countDown: 0,
            product: {},
            counterInterval: 0,
            mainImage: '',
        }
    },
    destroyed() {
        clearInterval(this.counterInterval);
    },
    methods: {
        getProducts() {
            axios.get('/api/product/all').
            then((response) => {
                this.products = response.data.data
                const amountOfProducts = this.products.length;
                this.counterInterval = setInterval(this.changeProduct, 5000, this.products, amountOfProducts);
            }).
            catch((error) => console.log(error))
        },
        changeProduct(products, amountOfProducts) {
            this.product = this.products[this.countDown];
            this.mainImage = this.product.main_image;
            this.countDown++;
            if (this.countDown >= amountOfProducts) {
                this.countDown = 0;
            }
        },
        changeImage() {
            this.mainImage = this.product.images[Math.floor(Math.random()*this.product.images.length)];
        }
    }
}
</script>

<style scoped>

</style>
