// src/plugins/axios.js

import axios from 'axios';

axios.defaults.withCredentials = true; // Ensure cookies are sent with requests

export default {
  install: (app) => {
    app.config.globalProperties.$axios = axios;
  }
};
