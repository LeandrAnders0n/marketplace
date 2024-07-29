<!-- FRONTEND/src/components/NavigationComponent.vue -->

<template>
  <v-app-bar app>
    <!-- Toolbar Title -->
    <v-toolbar-title>
      <v-btn text to="/">
        <v-icon>mdi-home</v-icon>
        My E-commerce Site
      </v-btn>
    </v-toolbar-title>
    
    <v-spacer></v-spacer>
    
    <!-- Wishlist Button with Icon -->
    <v-btn text to="/wishlist">
      <v-icon>mdi-heart</v-icon> Wishlist
    </v-btn>
    
    <!-- Cart Button with Icon -->
    <v-btn text to="/cart">
      <v-icon>mdi-cart</v-icon> Cart
    </v-btn>
    
    <!-- Login Button with Icon -->
    <v-btn text to="/login">
      <v-icon>mdi-login</v-icon> Login
    </v-btn>
  </v-app-bar>
</template>

<script>
export default {
  name: 'NavigationComponent'
}
</script>

<style scoped>
/* Add any navigation specific styles here */
</style>
