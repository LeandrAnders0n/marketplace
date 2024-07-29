<template>
    <v-container class="mt-80">
      <v-row>
        <v-col cols="12">
          <v-card>
            <v-card-title>
              <h2 class="headline">Wishlist</h2>
            </v-card-title>
            <v-card-text>
              <v-list>
                <v-list-item-group v-if="wishlistItems.length">
                  <v-list-item v-for="item in wishlistItems" :key="item.id">
                    <v-list-item-content class="d-flex align-center">
                      <v-list-item-title class="mr-2">{{ item.name }}</v-list-item-title>
                      <v-list-item-subtitle>{{ formatCurrency(item.price) }}</v-list-item-subtitle>
                    </v-list-item-content>
                    <v-list-item-action class="d-flex align-center">
                      <v-btn @click="handleAddToCartFromWishlist(item)" color="primary" class="mr-2">
                        <v-icon left>mdi-cart</v-icon>
                      </v-btn>
                      <v-icon @click="handleRemoveFromWishlist(item)" color="error">
                        mdi-delete
                      </v-icon>
                    </v-list-item-action>
                  </v-list-item>
                </v-list-item-group>
                <v-list-item v-else>
                  <v-list-item-content>
                    <v-list-item-title>Your wishlist is empty</v-list-item-title>
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
      ...mapState(['wishlistItems']),
    },
    methods: {
      ...mapActions(['addToCart', 'removeFromWishlist']),
      formatCurrency(value) {
        return new Intl.NumberFormat('en-US', {
          style: 'currency',
          currency: 'USD',
        }).format(value);
      },
      async handleAddToCartFromWishlist(product) {
        try {
          await this.addToCart(product);
          await this.removeFromWishlist(product);
        } catch (error) {
          console.error(error);
        }
      },
      async handleRemoveFromWishlist(product) {
        try {
          await this.removeFromWishlist(product);
        } catch (error) {
          console.error(error);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .mt-80 {
    margin-top: 80px;
  }
  .headline {
    font-size: 1.5rem;
  }
  </style>
  