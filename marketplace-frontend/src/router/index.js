import { createRouter, createWebHistory } from 'vue-router';
import store from '../store';
import Register from '../views/RegisterPage.vue';
import Login from '../views/LoginPage.vue';
import HomePage from '../views/HomePage.vue';
import CartPage from '../views/CartPage.vue';
import Wishlist from '../views/WishlistPage.vue';

const routes = [
  {
    path: '/register',
    name: 'Register',
    component: Register,
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
  {
    path: '/',
    name: 'Home',
    component: HomePage,
    meta: { requiresAuth: true },
  },
  {
    path: '/cart',
    name: 'Cart',
    component: CartPage,
    meta: { requiresAuth: true },
  },
  {
    path: '/wishlist',
    name: 'Wishlist',
    component: Wishlist,
  },
  // Add other routes as needed
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach(async (to, from, next) => {
  const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);
  const isAuthenticated = store.getters.isAuthenticated;

  if (requiresAuth && !isAuthenticated) {
    try {
      await store.dispatch('fetchUser');
      next();
    } catch {
      next('/login');
    }
  } else {
    next();
  }
});

export default router;
