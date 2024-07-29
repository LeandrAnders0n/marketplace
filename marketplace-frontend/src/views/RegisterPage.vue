<template>
  <v-container class="fill-height">
    <v-row justify="center" align="center">
      <v-col cols="12" md="8" lg="4">
        <v-card>
          <v-card-title>
            <span class="text-h5">Register</span>
          </v-card-title>
          <v-card-text>
            <v-form @submit.prevent="handleRegister">
              <v-text-field v-model="name" label="Name" outlined required></v-text-field>
              <v-text-field v-model="email" label="Email" type="email" outlined required></v-text-field>
              <v-text-field v-model="password" label="Password" type="password" outlined required></v-text-field>
              <v-btn type="submit" color="primary" class="mt-4" block>
                Register
              </v-btn>
            </v-form>
            <small class="d-block mt-4 text-center">
              Already have an account? <router-link to="/login">Login</router-link>
            </small>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
    };
  },
  methods: {
    ...mapActions(['register']),
    async handleRegister() {
      try {
        await this.register({ name: this.name, email: this.email, password: this.password});
        this.$router.push({ name: 'Home' });
      } catch (error) {
        console.error('Handle registration error:', error);
      }
    }
  }
};
</script>

<style scoped>
.fill-height {
  min-height: 100vh;
}
</style>
