<template>
    <form name="create-order-form" :action="orderCreateUrl" method="POST">
        <input type="hidden" name="json_cart">
        <input type="hidden" name="_token" :value="csrfToken">
        <div class="card">
            <div class="card-body">
                <div class="cart">
                    <template v-if="cartItemsSets.length === 0">
                        <div class="cart-empty">
                            Корзина пуста
                        </div>
                    </template>
                    <template v-else>
                        <div v-for="(itemsSet, index) in cartItemsSets"
                             :key="index"
                             class="cart-item">
                            <div class="image-wrapper">
                                <img :src="siteDomain + itemsSet.product.thumbnail_path" alt="">
                            </div>
                            <div class="info">
                                <div class="short_description">{{ itemsSet.product.short_description }}</div>
                                <div class="price">{{ itemsSet.product.price }}</div>
                                <input class="count" type="number" :value="itemsSet.count">
                                <div class="total-price">{{ itemsSet.totalPrice }}</div>
                            </div>
                        </div>
                        <button @click.prevent="submitRequest">Перейти к оплате</button>
                    </template>
                    <br>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    /*
     * var cartItemsSets = [
     *      [
     *          product: {
     *              thumbnail_path: String,
     *              short_description: String,
     *              price: Integer
     *          },
     *          count: Integer,
     *          totalPrice: Integer,
     *      ], ...
     *  ]
     */
    import {csrfToken, siteDomain} from '../../../app';

    export default {
        props: {
            cartItemsSets: {
                require: true,
                type: Array
            },
            orderCreateUrl: {
                require: true,
                type: String
            },
        },
        data() {
            return {
                cart: {
                    products: [
                        {
                            id: '',
                            count: '',
                        }
                    ]
                },
                siteDomain: siteDomain,
                csrfToken: csrfToken,
            };
        },
        methods: {
            updateCartRequest() {
                let products = [];
                this.cartItemsSets.forEach((itemsSet) => {
                    products.push({
                        id: itemsSet.product.id,
                        count: itemsSet.count,
                    })
                })

                this.cart.products = products;
            },
            createJsonCartInput() {
                let jsonCartInput = document.querySelector('input[name="json_cart"]');
                jsonCartInput.value = JSON.stringify(this.cart.products);
            },
            submitRequest() {
                this.updateCartRequest();

                this.createJsonCartInput();

                let form = document.querySelector('form[name="create-order-form"]');
                form.submit();
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
