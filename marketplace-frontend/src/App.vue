<!-- FRONTEND/src/App.vue -->

<template>
  <v-app>
    <NavigationComponent />
    <router-view></router-view>
  </v-app>
</template>

<script>
import NavigationComponent from './components/NavigationComponent.vue'

export default {
  name: 'App',
  components: {
    NavigationComponent
  }
}
</script>

<style>
/* Add any global styles here */
</style>
