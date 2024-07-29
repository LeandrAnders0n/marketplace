import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store'; // Make sure this path is correct
import vuetify from './plugins/vuetify'; // If you're using Vuetify
import axios from './plugins/axios'; // Import Axios plugin
import '@mdi/font/css/materialdesignicons.css'; // Import Material Design Icons

const app = createApp(App);

app.use(router);
app.use(store); // Ensure the store is used
app.use(vuetify);
app.use(axios); // If you're using Vuetify
app.mount('#app');

