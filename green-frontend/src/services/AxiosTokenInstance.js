
import axios from 'axios';
import store from '../store';
const axiosInstance = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/v1'
  });

axiosInstance.interceptors.request.use((config) => {
    const token = store.getters["auth/GET_AUTH_TOKEN"];
    const auth = token ? `Bearer ${token}` : '';
    config.headers.common['Authorization'] = auth;
    return config;
},
(error) => Promise.reject(error),
);

export default axiosInstance;