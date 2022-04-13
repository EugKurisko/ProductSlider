<template>
    <div>
        {{this.product.name}}
    </div>
    <div>
        {{this.product.description}}
    </div>
    <div>
        <img :src='this.mainImage' alt="Image is not downloaded" @mouseover="this.changeImage">
    </div>
</template>

<script>
export default {
    name: "Slide",
    props: {
        product: {
            type: Object,
        },
        mainImage: {
            type: String,
        }
    },
    emits: [
        "changeImage"
    ],
    methods: {
        changeImage() {
            this.$emit('changeImage', this.mainImage)
        }
    }
}
</script>

<style scoped>

</style>
