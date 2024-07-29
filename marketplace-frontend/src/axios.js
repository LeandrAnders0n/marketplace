// src/axios.js

import axios from 'axios';

axios.defaults.withCredentials = true; // Ensure cookies are sent with requests

// Configure base URL if needed
axios.defaults.baseURL = 'http://localhost:8000/api';

export default axios;
