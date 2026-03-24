import { createRouter, createWebHistory } from 'vue-router'
import FrontView from '../views/FrontView.vue'
import DesignWeb from '../views/DesignWeb.vue'
import Marketing from '../views/Marketing.vue'
import ThemeWP from '../views/ThemeWP.vue'
import Knowledge from '../views/Knowledge.vue'
import ServiceSeo from '../views/ServiceSeo.vue'
import Facebook from '../views/Facebook.vue'
import GoogleAds from '../views/GoogleAds.vue'

const router = createRouter({
  // Keep the SPA mounted at the site root/dashboard routes in Drupal.
  // Vite's build base is only for static assets under /vue/dist/.
  history: createWebHistory('/'),
  routes: [
    {
      path: '/',
      name: 'home',
      component: FrontView,
      alias: ['/dashboard-vue', '/en/dashboard-vue', '/zh-hans/dashboard-vue'],
    },
    {
      path: '/design-web',
      name: 'design-web',
      component: () => import('../views/DesignWeb.vue'),
    },
    {
      path: '/marketing',
      name: 'marketing',
      component: () => import('../views/Marketing.vue'),
    },
    {
      path: '/theme-wp',
      name: 'theme-wp',
      component: () => import('../views/ThemeWP.vue'),
    },
    {
      path: '/knowledge',
      name: 'knowledge',
      component: () => import('../views/Knowledge.vue'),
    },
    {
      path: '/service-seo',
      name: 'service-seo',
      component: () => import('../views/ServiceSeo.vue'),
    },
    {
      path: '/knowledge/:id',
      name: 'knowledge-detail',
      component: () => import('../views/KnowledgeDetail.vue'),
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue'),
    },
    {
      path: '/facebook-ads',
      name: 'facebook-ads',
      component: () => import('../views/Facebook.vue'),
    },
    {
      path: '/google-ads',
      name: 'google-ads',
      component: () => import('../views/GoogleAds.vue'),
    },
  ],
  scrollBehavior() {
    return { top: 0 }
  },
})

export default router
