import { createI18n } from 'vue-i18n';

// Import các tệp dịch
import en from './locales/en/common.js';
import vi from './locales/vi/common.js';
import zh from './locales/zh/common.js';

const messages = {
  en,
  vi,
  zh,
};

const i18n = createI18n({
  legacy: false,
  locale: 'en',
  fallbackLocale: 'en',
  messages,
});

export default i18n;
