
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import i18n from './i18n.js';
import App from './App.vue'
import router from './router'
import AppLink from './components/AppLink.js'
import Toast from "vue-toastification";
// import { Tooltip } from 'ant-design-vue';
// import Antd from 'ant-design-vue';

/* Import FontAwesome CSS */
// import './assets/fonts/fontawesome-pro-6.5.2/scss/fontawesome.scss';
// import './assets/fonts/fontawesome-pro-6.5.2/scss/light.scss';
// import './assets/fonts/fontawesome-pro-6.5.2/scss/thin.scss';
import "./assets/fonts/fontawesome-pro-6.5.2/css/all.min.css";

/* Import the CSS or use your own! */
// import 'ant-design-vue/dist/reset.css';
import "vue-toastification/dist/index.css";
import './assets/fonts/nunito/nunito-fonts.css';
import './assets/fonts/iat/style.css';
import './assets/fonts/noto-sans-sc/noto-sans-fonts.css';

/* import font awesome icon component */
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

// bootstrap
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'
// import 'bootstrap/dist/js/bootstrap.min.js'

// swiper slide
import 'swiper/swiper-bundle.css'; 


// custom css
import './assets/main.scss'

/* International Telephone Input with Vue. */
// import VueTelInput from 'vue-tel-input';
// import 'vue-tel-input/vue-tel-input.css';
import {useAuthStore} from "@/store.js";

const options = {
  transition: "Vue-Toastification__bounce",
  maxToasts: 20,
  newestOnTop: true
};

const app = createApp(App)
app.use(i18n)
app.use(createPinia())
app.use(router)
app.use(Toast, options)
app.component('RouterLink', AppLink)
// app.use(VueTelInput)
// app.component('font-awesome-icon', FontAwesomeIcon)
// app.use(Tooltip)
// app.use(Antd)


// Đợi router sẵn sàng trước khi mount ứng dụng
router.isReady().then(async () => {
  // Get settings.
  const authStore = useAuthStore();
  authStore.config = window.drupalSettings || {};
  // Public marketing pages should look identical whether a Drupal user is
  // authenticated or anonymous.
  authStore.loggedin = authStore.config?.isPublicFrontend
    ? false
    : (authStore.config?.user?.uid > 0 ?? false);

  // console.log('Router ready, mounting app to DOM');
  app.mount('#app');
}).catch((error) => {
  console.error('Failed to initialize router:', error);
  // Vẫn mount ứng dụng để tránh ứng dụng bị treo
  app.mount('#app');
});

// Add global properties to app.
// Add Drupal object to global properties.
app.config.globalProperties.Drupal = window.Drupal || {}
