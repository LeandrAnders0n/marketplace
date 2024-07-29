<template>
  <v-container class="cart-container">
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-card-title>
            <h2>Your Cart</h2>
          </v-card-title>
          <v-card-subtitle>
            <v-row>
              <v-col cols="6">
                <strong>Product</strong>
              </v-col>
              <v-col cols="3">
                <strong>Quantity</strong>
              </v-col>
              <v-col cols="3">
                <strong>Price</strong>
              </v-col>
            </v-row>
          </v-card-subtitle>
          <v-card-text>
            <v-list>
              <v-list-item-group v-if="cartItems.length">
                <v-list-item v-for="item in cartItems" :key="item.id">
                  <v-list-item-content v-if="item.product">
                    <v-list-item-title>{{ item.product.name || 'Unknown Product' }}</v-list-item-title>
                    <v-list-item-subtitle>
                      <v-row>
                        <v-col cols="4">{{ formatCurrency(item.product.price || 0) }}</v-col>
                        <v-col cols="4">
                          <v-text-field v-model.number="item.quantity" type="number" min="0" @change="updateQuantity(item)" hide-details></v-text-field>
                        </v-col>
                        <v-col cols="2">{{ formatCurrency((item.product.price || 0) * item.quantity) }}</v-col>
                        <v-col cols="2">
                          <v-btn icon @click="removeFromCart(item)">
                            <v-icon color="red">mdi-delete</v-icon>
                          </v-btn>
                        </v-col>
                      </v-row>
                    </v-list-item-subtitle>
                  </v-list-item-content>
                  <v-list-item-content v-else>
                    <v-list-item-title>Product information is missing</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
              <v-list-item v-else>
                <v-list-item-content>
                  <v-list-item-title>Your cart is empty</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-card-text>
          <v-card-actions>
            <v-row>
              <v-col cols="12" sm="6" class="text-right">
                <h3>Total: {{ totalAmount }}</h3>
                <v-btn @click="checkout" color="primary">Checkout</v-btn>
              </v-col>
            </v-row>
          </v-card-actions>
        </v-card>
      </v-col>
      <v-col cols="12" class="mt-4">
        <v-card>
          <v-card-title>
            <h2>Recommended Products</h2>
          </v-card-title>
          <v-card-text>
            <v-list>
              <v-list-item-group v-if="recommendedProducts.length">
                <v-list-item v-for="product in recommendedProducts" :key="product.id">
                  <v-list-item-content>
                    <v-list-item-title>{{ product.name }}</v-list-item-title>
                    <v-list-item-subtitle>
                      <v-row>
                        <v-col cols="6">{{ formatCurrency(product.price) }}</v-col>
                        <v-col cols="6">
                          <v-btn @click="addToCartAndRefresh(product)" color="primary">Add to Cart</v-btn>
                        </v-col>
                      </v-row>
                    </v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
              <v-list-item v-else>
                <v-list-item-content>
                  <v-list-item-title>No recommendations available</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  computed: {
    ...mapState(['cartItems', 'recommendedProducts']),
    totalAmount() {
      return this.cartItems.reduce((total, item) => {
        const price = item.product?.price || 0;
        const quantity = item.quantity || 0;
        return total + (price * quantity);
      }, 0);
    }
  },
  methods: {
    ...mapActions(['fetchCartItems', 'updateCartItem', 'removeFromCart', 'addToCart']),
    formatCurrency(value) {
      const numValue = parseFloat(value);
      if (isNaN(numValue)) {
        console.warn('Value is not a valid number:', value);
        return '$0.00';
      }
      return `$${numValue.toFixed(2)}`;
    },
    updateQuantity(item) {
      this.updateCartItem(item);
    },
    checkout() {
      console.log('Proceeding to checkout with total amount:', this.totalAmount);
    },
    async addToCartAndRefresh(product) {
      await this.addToCart(product);
      await this.fetchCartItems();
    }
  },
  created() {
    this.fetchCartItems();
  }
};
</script>

<style scoped>
.cart-container {
  margin-top: 120px;
}
</style>
