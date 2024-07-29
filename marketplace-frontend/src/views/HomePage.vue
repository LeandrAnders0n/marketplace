<template>
  <v-container class="mt-80">
    <!-- Search Bar -->
    <v-row>
      <v-col cols="12">
        <v-text-field
          v-model="searchQuery"
          label="Search Products"
          prepend-icon="mdi-magnify"
          @input="filterProducts"
        ></v-text-field>
      </v-col>
    </v-row>

    <!-- Product List -->
    <v-row>
      <v-col
        v-for="product in filteredProducts"
        :key="product.id"
        cols="12"
        sm="6"
        md="4"
      >
        <v-card>
          <v-card-title>{{ product.name }}</v-card-title>
          <v-card-subtitle>{{ formatCurrency(product.price) }}</v-card-subtitle>
          <v-card-actions>
            <v-btn @click="handleAddToCart(product)" color="primary">Add to Cart</v-btn>
            <v-btn @click="handleAddToWishlist(product)" color="secondary">Add to Wishlist</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped>
.mt-80 {
  margin-top: 80px;
}
</style>

<script>
import axios from '../axios';
import { mapActions, mapState } from 'vuex';

export default {
  data() {
    return {
      products: [],
      searchQuery: '',
      filteredProducts: [],
    };
  },
  computed: {
    ...mapState(['wishlistItems']),
  },
  created() {
    this.fetchProducts();
    this.fetchWishlistItems(); // Fetch wishlist items when the component is created
  },
  methods: {
    ...mapActions(['addToCart', 'addToWishlist', 'removeFromWishlist', 'fetchWishlistItems']),
    async fetchProducts() {
      try {
        const response = await axios.get('/products');
        this.products = response.data;
        this.filteredProducts = this.products; // Initialize filtered products
      } catch (error) {
        console.error(error.response ? error.response.data : error.message);
      }
    },
    filterProducts() {
      const query = this.searchQuery.toLowerCase();
      this.filteredProducts = this.products.filter(product =>
        product.name.toLowerCase().includes(query)
      );
    },
    formatCurrency(value) {
      return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
      }).format(value);
    },
    async handleAddToCart(product) {
      try {
        await this.addToCart(product);
      } catch (error) {
        console.error(error);
      }
    },
    async handleAddToWishlist(product) {
      try {
        await this.addToWishlist(product);
      } catch (error) {
        console.error(error);
      }
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
    }
  },
};
</script>
