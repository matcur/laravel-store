<template>
    <form @submit.prevent="submitRequest">
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
                                <img :src="itemsSet.product.thumbanil_path" alt="">
                            </div>
                            <div class="info">
                                <div class="short_description">{{ itemsSet.product.short_description }}</div>
                                <div class="price">{{ itemsSet.product.price }}</div>
                                <input class="count" type="number" :value="itemsSet.count">
                                <div class="total-price">{{ itemsSet.count * itemsSet.product.price }}</div>
                            </div>
                        </div>
                    </template>
                    <br>
                </div>
            </div>
        </div>
        <button>Перейти к оплате</button>
    </form>
</template>

<script>
    /*
     * var cartItemsSets = [
     *      {
     *          thumbnail_path: String,
     *          short_description: String,
     *          count: Integer,
     *          one_item_price: Integer,
     *          total_price: Integer,
     *      }, ...
     *  ]
     */
    export default {
        props: {
            cartItemsSets: {
                require: true,
                type: Array
            },
            storeOrderUrl: {
                require: true,
                type: String
            }
        },
        data() {
            return {
                cartRequest: {
                    products: [
                        {
                            id: '',
                            count: '',
                        }
                    ]
                }
            };
        },
        methods: {
            updateCartRequest() {
                let products = [];
                this.cartItemsSets.forEach((itemsSet) => {
                    products.push({
                        id: itemsSet.productId,
                        count: itemsSet.count,
                    })
                })

                this.cartRequest.products = products;
            },
            submitRequest() {
                axios({
                    url: this.storeOrderUrl,
                    method: 'post',
                    data: {
                        products: this.cartRequest.products
                    },
                })
                .then(res => console.log(res))
                .catch(err => console.log(err))
            },
        },
        watch: {
            cartItemsSets() {
                this.updateCartRequest();
            }
        },
        created() {
            console.log(this.cartItemsSets);
            this.updateCartRequest();
        },
        mounted() {
        },
    }
</script>

<style lang="sass">

</style>
