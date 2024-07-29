import { createStore } from 'vuex';
import axios from '../axios';
import Cookies from 'js-cookie';

axios.defaults.withCredentials = true;

export default createStore({
  state: {
    token: Cookies.get('token') || null,
    cartItems: [],
    wishlistItems: [],
    recommendedProducts: []
  },
  mutations: {
    SET_TOKEN(state, token) {
      state.token = token;
    },
    LOGOUT(state) {
      state.token = null;
      state.cartItems = [];
      state.wishlistItems = [];
      Cookies.remove('token');
    },
    ADD_TO_CART(state, product) {
      const existingProduct = state.cartItems.find(item => item.id === product.id);
      if (existingProduct) {
        existingProduct.quantity += 1;
      } else {
        state.cartItems.push({ ...product, quantity: 1 });
      }
    },
    UPDATE_CART_ITEM(state, updatedProduct) {
      const product = state.cartItems.find(item => item.id === updatedProduct.id);
      if (product) {
        if (updatedProduct.quantity <= 0) {
          state.cartItems = state.cartItems.filter(item => item.id !== updatedProduct.id);
        } else {
          product.quantity = updatedProduct.quantity;
        }
      }
    },
    SET_CART_ITEMS(state, items) {
      state.cartItems = items;
    },
    SET_WISHLIST_ITEMS(state, items) {
      state.wishlistItems = items;
    },
    ADD_TO_WISHLIST(state, product) {
      const existingProduct = state.wishlistItems.find(item => item.id === product.id);
      if (!existingProduct) {
        state.wishlistItems.push(product);
      }
    },
    REMOVE_FROM_WISHLIST(state, product) {
      state.wishlistItems = state.wishlistItems.filter(item => item.id !== product.id);
    },
    SET_RECOMMENDED_PRODUCTS(state, products) {
      state.recommendedProducts = products;
    }
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        const response = await axios.post('/login', credentials);
        commit('SET_TOKEN', response.data.token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
      } catch (error) {
        console.error('Login error:', error.response ? error.response.data : error.message);
      }
    },
    async register({ commit }, userData) {
      try {
        const response = await axios.post('/register', userData);
        commit('SET_TOKEN', response.data.token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
      } catch (error) {
        console.error('Register error:', error.response ? error.response.data : error.message);
      }
    },
    async logout({ commit }) {
      try {
        await axios.post('/logout');
        commit('LOGOUT');
      } catch (error) {
        console.error('Logout error:', error.response ? error.response.data : error.message);
      }
    },
    async fetchCartItems({ commit }) {
      try {
        const response = await axios.get('/carts');
        commit('SET_CART_ITEMS', response.data);
        await this.dispatch('fetchRecommendations');
      } catch (error) {
        console.error('Fetch cart items error:', error.response ? error.response.data : error.message);
      }
    },
    async addToCart({ commit }, product) {
      commit('ADD_TO_CART', product);
      try {
        await axios.post('/carts', { product_id: product.id, quantity: 1 });
        await this.dispatch('fetchRecommendations');
      } catch (error) {
        console.error('Failed to add product to cart:', error.response ? error.response.data : error.message);
      }
    },
    async updateCartItem({ commit }, product) {
      commit('UPDATE_CART_ITEM', product);
      try {
        await axios.put(`/carts/${product.id}`, { quantity: product.quantity });
        await this.dispatch('fetchRecommendations');
      } catch (error) {
        console.error('Failed to update cart item:', error.response ? error.response.data : error.message);
      }
    },
    async removeFromCart({ commit }, product) {
      commit('UPDATE_CART_ITEM', { ...product, quantity: 0 });
      try {
        await axios.delete(`/carts/${product.id}`);
        await this.dispatch('fetchRecommendations');
      } catch (error) {
        console.error('Failed to remove product from cart:', error.response ? error.response.data : error.message);
      }
    },
    async fetchWishlistItems({ commit }) {
      try {
        const response = await axios.get('/wishlist');
        commit('SET_WISHLIST_ITEMS', response.data);
      } catch (error) {
        console.error('Fetch wishlist items error:', error.response ? error.response.data : error.message);
      }
    },
    async addToWishlist({ commit }, product) {
      commit('ADD_TO_WISHLIST', product);
      try {
        await axios.post('/wishlist', { product_id: product.id });
      } catch (error) {
        console.error('Failed to add product to wishlist:', error.response ? error.response.data : error.message);
      }
    },
    async removeFromWishlist({ commit }, product) {
      commit('REMOVE_FROM_WISHLIST', product);
      try {
        await axios.delete(`/wishlist/${product.id}`);
      } catch (error) {
        console.error('Failed to remove product from wishlist:', error.response ? error.response.data : error.message);
      }
    },
    async fetchRecommendations({ commit, state }) {
      try {
        const productNames = state.cartItems.map(item => item.product.name);

        if (productNames.length === 0) return;

        const recommendationRequests = productNames.map(name =>
          axios.get(`recommendations/${name}`)
        );

        const recommendationResponses = await Promise.all(recommendationRequests);

        const recommendedProductNames = recommendationResponses.flatMap(response => response.data);

        const productDetailsResponse = await axios.post('products/by-names', {
          names: recommendedProductNames
        });

        commit('SET_RECOMMENDED_PRODUCTS', productDetailsResponse.data);
      } catch (error) {
        console.error('Fetch recommendations error:', error.response ? error.response.data : error.message);
      }
    }
  }
});
