<template>
    <form :action="cartAddRoute" method="post">
        <input type="hidden" :value="csrfToken" name="_token">
        <input type="hidden" name="product_id" :value="productId">
        <input type="hidden" name="count" :value="finishedProductCount">
        <input type="text" :value="finishedProductCount + parseInt(primordialProductCount)" disabled>
        <span class="grow-count"
              @click="growFinishedProductCount">+</span>
        <span class="down-count"
              @click="downFinishedProductCount">-</span>
        <button class="btn btn-secondary">
            Add in cart
        </button>
    </form>

</template>

<script>
    export default {
        props: {
            csrfToken: {
                Required: true,
                Type: String,
            },
            product: {
                Required: true,
                Type: Object,
            },
            cartAddRoute: {
                Required: true,
                Type: String,
            },
            primordialProductCount: {
                Required: true,
                Type: Number,
            }
        },
        data() {
            return {
                productId: this.product.id,
                finishedProductCount: 0,
            };
        },
        methods: {
            growFinishedProductCount() {
                this.finishedProductCount++;
            },
            downFinishedProductCount() {
                if (this.primordialProductCount > 0)
                    this.finishedProductCount--;
            },
        },
        created() {
            console.log(this.finishedProductCount, this.primordialProductCount)
        },
        mounted() {
        },
    }
</script>

<style lang="sass">

</style>
