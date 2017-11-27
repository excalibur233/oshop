import axios from 'axios';
import store from '../store';

window.axios = axios;

axios.interceptors.request.use((request) => {
  if (store.getters.authToken) {
    request.headers.common.Authorization = `Bearer ${store.getters.authToken}`;
  }

  // request.headers['X-Socket-Id'] = Echo.socketId()

  return request;
});

axios.interceptors.response.use(response => response, (error) => {
  const { status } = error.response;

  if (status >= 500) {
    console.log('500 error!');
  }

  if (status === 401 && store.getters.authCheck) {
    console.log('401 error!');
  }

  return Promise.reject(error);
});
