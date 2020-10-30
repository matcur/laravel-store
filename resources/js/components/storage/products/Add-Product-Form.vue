<template>
    <form @submit.prevent="submit" method="post">
        <input type="hidden" :value="csrfToken" name="_token">
        <label>
            Продуктов в корзине
            <input type="text" :value="oldProductCount" disabled>
        </label>
        <label v-if="addProductCount > 0">
            Добавить {{ addProductCount }} продуктов в корзину
            <input type="text" :value="addProductCount"  disabled>
        </label>
        <label v-if="addProductCount < 0">
            Убрать {{ addProductCount * (-1) }} продуктов в корзину
            <input type="text" :value="addProductCount * (-1)"  disabled>
        </label>
        <span class="grow-count"
              @click="growFinishedProductCount">+</span>
        <span class="down-count"
              @click="downFinishedProductCount">-</span>
        <button class="btn btn-secondary" :disabled="addProductCount == 0">
            Отправить в корзину
        </button>
        <a class="btn btn-secondary"
           :disabled="oldProductCount != 0"
           @click="removeFromCart">
            Убрать из корзины
        </a>
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
            initialProductCount: {
                Required: true,
                Type: Number,
            }
        },
        data() {
            return {
                addProductCount: 0,
                oldProductCount: parseInt(this.initialProductCount),
            };
        },
        methods: {
            growFinishedProductCount() {
                this.addProductCount++;
            },
            downFinishedProductCount() {
                if (this.initialProductCount > 0)
                    this.addProductCount--;
            },
            removeFromCart() {
                this.addProductCount = -this.oldProductCount;
                this.submit()
                this.addProductCount = 0;
            },
            async submit() {
                let _addProductCount = this.addProductCount;

                this.oldProductCount += this.addProductCount;
                this.addProductCount = 0;

                await axios({
                    url: this.cartAddRoute,
                    method: 'POST',
                    data: {
                        product_id: this.product.id,
                        count: _addProductCount,
                    },
                })
                .catch(err => console.log(err))
            },
        },
        created() {
        },
        mounted() {
        },
    }
</script>

<style lang="sass">

</style>
