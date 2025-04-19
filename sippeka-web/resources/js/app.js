import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router';

const app = createApp(App).mount('#app');
app.use(router);
app.mount('#app');
