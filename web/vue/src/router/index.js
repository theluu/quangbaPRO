import { createRouter, createWebHistory } from 'vue-router'
import FrontView from '../views/FrontView.vue'
import DesignWeb from '../views/DesignWeb.vue'
import Marketing from '../views/Marketing.vue'
import ThemeWP from '../views/ThemeWP.vue'
import Knowledge from '../views/Knowledge.vue'
import ServiceSeo from '../views/ServiceSeo.vue'
import Facebook from '../views/Facebook.vue'
import GoogleAds from '../views/GoogleAds.vue'

const siteName = 'QuangBaPRO';

function applySeo(meta = {}, to) {
  const title = meta.title || siteName;
  const description = meta.description || 'Dich vu thiet ke web va marketing tai QuangBaPRO.';
  const canonical = `${window.location.origin}${to.fullPath}`;

  document.title = title;

  const ensureMeta = (selector, attributes) => {
    let element = document.head.querySelector(selector);

    if (!element) {
      element = document.createElement('meta');
      document.head.appendChild(element);
    }

    Object.entries(attributes).forEach(([key, value]) => {
      element.setAttribute(key, value);
    });
  };

  const ensureLink = (selector, attributes) => {
    let element = document.head.querySelector(selector);

    if (!element) {
      element = document.createElement('link');
      document.head.appendChild(element);
    }

    Object.entries(attributes).forEach(([key, value]) => {
      element.setAttribute(key, value);
    });
  };

  ensureMeta('meta[name="description"]', {
    name: 'description',
    content: description,
  });

  ensureMeta('meta[property="og:title"]', {
    property: 'og:title',
    content: title,
  });

  ensureMeta('meta[property="og:description"]', {
    property: 'og:description',
    content: description,
  });

  ensureMeta('meta[property="og:url"]', {
    property: 'og:url',
    content: canonical,
  });

  ensureLink('link[rel="canonical"]', {
    rel: 'canonical',
    href: canonical,
  });
}

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
      meta: {
        title: 'QuangBaPRO | Thiet ke web va marketing',
        description: 'QuangBaPRO cung cap dich vu thiet ke website, SEO, Facebook Ads va Google Ads.',
      },
    },
    {
      path: '/design-web',
      name: 'design-web',
      component: () => import('../views/DesignWeb.vue'),
      meta: {
        title: 'Thiet ke web theo yeu cau | QuangBaPRO',
        description: 'Dich vu thiet ke web theo yeu cau voi giao dien doc quyen, toi uu chuyen doi va than thien SEO.',
      },
    },
    {
      path: '/marketing',
      name: 'marketing',
      component: () => import('../views/Marketing.vue'),
      meta: {
        title: 'Dich vu marketing tong the | QuangBaPRO',
        description: 'Giai phap marketing tong the giup doanh nghiep tang nhan dien thuong hieu va chuyen doi.',
      },
    },
    {
      path: '/theme-wp',
      name: 'theme-wp',
      component: () => import('../views/ThemeWP.vue'),
      meta: {
        title: 'Theme WordPress | QuangBaPRO',
        description: 'Kho giao dien WordPress va giai phap website ban hang, gioi thieu doanh nghiep.',
      },
    },
    {
      path: '/knowledge',
      name: 'knowledge',
      component: () => import('../views/Knowledge.vue'),
      meta: {
        title: 'Kien thuc marketing va website | QuangBaPRO',
        description: 'Tong hop bai viet ve website, SEO, Facebook Ads, Google Ads va marketing online.',
      },
    },
    {
      path: '/service-seo',
      name: 'service-seo',
      component: () => import('../views/ServiceSeo.vue'),
      meta: {
        title: 'Dich vu SEO tong the | QuangBaPRO',
        description: 'Dich vu SEO tong the giup website tang thu hang ben vung va mo rong luong truy cap tu nhien.',
      },
    },
    {
      path: '/knowledge/:id',
      name: 'knowledge-detail',
      component: () => import('../views/KnowledgeDetail.vue'),
      meta: {
        title: 'Chi tiet bai viet kien thuc | QuangBaPRO',
        description: 'Noi dung kien thuc chuyen sau ve website, SEO va marketing online.',
      },
    },
    {
      path: '/tim-kiem',
      name: 'search',
      component: () => import('../views/SearchView.vue'),
      meta: {
        title: 'Tim kiem | QuangBaPRO',
        description: 'Ket qua tim kiem bai viet kien thuc tren QuangBaPRO.',
      },
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue'),
      meta: {
        title: 'Gioi thieu QuangBaPRO',
        description: 'Thong tin gioi thieu ve QuangBaPRO, tam nhin, su menh va cac dich vu dang cung cap.',
      },
    },
    {
      path: '/facebook-ads',
      name: 'facebook-ads',
      component: () => import('../views/Facebook.vue'),
      meta: {
        title: 'Dich vu Facebook Ads | QuangBaPRO',
        description: 'Giai phap Facebook Ads giup tiep can dung khach hang muc tieu va toi uu chi phi quang cao.',
      },
    },
    {
      path: '/google-ads',
      name: 'google-ads',
      component: () => import('../views/GoogleAds.vue'),
      meta: {
        title: 'Dich vu Google Ads | QuangBaPRO',
        description: 'Dich vu Google Ads giup tang lead, don hang va do luong hieu qua theo tung chien dich.',
      },
    },
  ],
  scrollBehavior() {
    return { top: 0 }
  },
})

router.afterEach((to) => {
  applySeo(to.meta, to);
});

export default router
