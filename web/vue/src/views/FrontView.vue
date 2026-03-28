<template>
  <div class="page-wrap">
    <Banner v-if="banners.length" :items="banners" />
    <Introduction v-if="hasIntroduction" :item="introduction" />
    <Packages v-if="packages.length" :items="packages" />
    <Services v-if="services.length" :items="services" />
    <Themes v-if="themes.length" :items="themes" />
    <Featured v-if="featured.length" :items="featured" />
    <Marketing v-if="marketing.length" :items="marketing" />
    <Testimonials v-if="testimonials.length" :items="testimonials" />
    <News v-if="news.length" :items="news" />
    <Partners v-if="partners.length" :items="partners" />
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import axios from "axios";

import Banner from "@/components/home/Banner.vue";
import Introduction from "@/components/home/Introduction.vue";
import Featured from "@/components/home/Featured.vue";
import Services from "@/components/home/Services.vue";
import Packages from "@/components/home/Packages.vue";
import Themes from "@/components/home/Themes.vue";
import Partners from '@/components/home/Partners.vue';
import News from '@/components/home/News.vue';
import Marketing from '@/components/home/Marketing.vue';
import Testimonials from '@/components/home/Testimonials.vue';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

import { useAuthStore } from "@/store.js";

const authStore = useAuthStore();
const banners = ref([]);
const partners = ref([]);
const news = ref([]);
const introduction = ref({});
const packages = ref([]);
const services = ref([]);
const themes = ref([]);
const featured = ref([]);
const testimonials = ref([]);
const marketing = ref([]);
const hasIntroduction = computed(() => Object.keys(introduction.value || {}).length > 0);

const fetchEndpoint = async (url, fallback = []) => {
  if (!url) {
    return fallback;
  }

  try {
    const response = await axios.get(url);
    return response?.data?.data ?? fallback;
  } catch (error) {
    console.error(`Error fetching ${url}:`, error);
    return fallback;
  }
};

const fetchData = async () => {
  const endpoint = authStore.config?.endpoint || {};

  const [
    partnersData,
    bannersData,
    newsData,
    introductionData,
    packagesData,
    servicesData,
    themesData,
    featuredData,
    testimonialData,
    marketingData,
  ] = await Promise.all([
    fetchEndpoint(endpoint.partners),
    fetchEndpoint(endpoint.banners),
    fetchEndpoint(endpoint.newsHome),
    fetchEndpoint(endpoint.introductionHome, {}),
    fetchEndpoint(endpoint.packages),
    fetchEndpoint(endpoint.services),
    fetchEndpoint(endpoint.themes),
    fetchEndpoint(endpoint.featured),
    fetchEndpoint(endpoint.testimonials),
    fetchEndpoint(endpoint.marketingHome),
  ]);

  partners.value = Array.isArray(partnersData) ? partnersData : [];
  banners.value = Array.isArray(bannersData) ? bannersData : [];
  news.value = Array.isArray(newsData) ? newsData.slice(0, 6) : [];
  introduction.value = introductionData && typeof introductionData === 'object' ? introductionData : {};
  packages.value = Array.isArray(packagesData) ? packagesData : [];
  services.value = Array.isArray(servicesData) ? servicesData : [];
  themes.value = Array.isArray(themesData) ? themesData : [];
  featured.value = Array.isArray(featuredData) ? featuredData : [];
  testimonials.value = Array.isArray(testimonialData) ? testimonialData : [];
  marketing.value = Array.isArray(marketingData) ? marketingData : [];
};

onMounted(() => {
  fetchData();
});
</script>

<style lang="scss">
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.ant-tooltip {
  .ant-tooltip-inner {
    background: var(--icon-illustration-stroke, #294563);
    text-align: center;
    font-family: Nunito;
  }
  .ant-tooltip-arrow:before {
    background: var(--icon-illustration-stroke, #294563);
  }
}
.modal-have-excode {
  .ant-modal-content {
    border-radius: 20px;
    padding: 4rem;
    @include mobile {
      padding: 2rem;
    }
  }
  .modal-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
  }
  &__title {
    font-size: 22px;
    font-weight: bold;
    color: $primary-500;
    text-align: center;
    margin-bottom: 16px;
    margin: 0;
  }
  &__desc {
    color: var(--Text-Body-2, #505050);
    text-align: center;
    font-size: 14px;
    font-weight: 400;
    margin: 0;
  }
  &__btn {
    min-width: 90px;
  }
  &__help {
    font-size: 12px;
    color: var(--Text-Body-2, #9a9a9a);
    text-align: center;
    font-style: italic;
    a {
      color: #32b3c7;
      text-decoration: underline;
      &:hover {
        color: darken($primary-500, 10%);
      }
    }
  }
}
.modal-start-test {
  .ant-modal-content {
    background: linear-gradient(to bottom, #97d6e2 0%, #fff 80%);
    border-radius: 20px;
    padding: 4rem;
    @include mobile {
      padding: 2rem;
    }
  }
  .ant-modal-footer {
    display: flex;
    justify-content: center;
    gap: 16px;
    margin-top: 2.4rem;
    @include mobile {
      margin-top: 1.2rem;
    }
    .ant-btn {
      padding: 0 24px;
    }
    .ant-btn-default {
      background: #fff;
      color: $primary-500;
      border: 1px solid $primary-500;
    }
  }
  &__text-block {
    display: flex;
    padding: 16px 26px;
    justify-content: center;
    align-items: center;
    gap: 10px;
    border-radius: 20px;
    background: linear-gradient(
      92deg,
      #02317e 1.4%,
      var(--icon-illustration-listening, #32b3c7) 233.97%
    );
    width: fit-content;
    font-size: 24px;
    font-style: normal;
    font-weight: 700;
    color: #fff;
    position: relative;
    margin-left: 4rem;
    @include mobile {
      margin-left: 2rem;
      font-size: 20px;
    }
    &.-top {
      &:after {
        content: "";
        width: 64.483px;
        height: 77.787px;
        background: url(@/assets/images/icons/trophy-winner.svg) center
          no-repeat;
        background-size: contain;
        position: absolute;
        right: -4.4rem;
        top: 1.9rem;
        z-index: 9;
      }
      &:before {
        content: "";
        width: 10.088px;
        height: 11.171px;
        background: url(@/assets/images/icons/triangle-blule.svg) center
          no-repeat;
        background-size: contain;
        position: absolute;
        left: 4rem;
        top: calc(100% - 1px);
        z-index: 9;
      }
    }
    &.-bottom {
      background: #fff;
      &:after {
        content: "";
        width: 64.483px;
        height: 77.787px;
        background: url(@/assets/images/icons/local-star.svg) center no-repeat;
        background-size: contain;
        position: absolute;
        left: -4.4rem;
        top: 1.9rem;
        z-index: 9;
        @include mobile {
          width: 54.483px;
          height: 57.787px;
          left: -3.4rem;
        }
      }
      &:before {
        content: "";
        width: 15.521px;
        height: 11.971px;
        background: url(@/assets/images/icons/triangle-white.svg) center
          no-repeat;
        background-size: contain;
        position: absolute;
        right: 5.8rem;
        top: calc(100% - 1px);
        z-index: 9;
      }
      span {
        background: linear-gradient(
          270deg,
          var(--icon-illustration-listening, #32b3c7) 0%,
          #02317e 100%
        );
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
      }
    }
  }
  &__desc {
    text-align: center;
    color: var(--Text-Body-2, #505050);
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    margin-top: 3.7rem;
  }
}

.all-collection {
  .ant-tabs-top > .ant-tabs-nav::before {
    border: none;
  }
  .ant-tabs-nav {
    margin: 1.2rem 0 4rem;
  }
  &__tabs {
    .ant-badge .ant-badge-count {
      background: #e6e9f3;
      color: #02317e;
      font-weight: 700;
    }
    .ant-tabs-tab {
      padding: 10px 20px;
      color: $primary-500;
    }
    .ant-tabs-tab + .ant-tabs-tab {
      margin: 0;
    }
  }
  &__search {
    .all-collection__search-input {
      display: flex;
      gap: 4px;
      align-items: center;
      &:before {
        content: "\e902";
        font-family: "iaticon" !important;
        speak: never;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        line-height: 1;

        /* Better Font Rendering =========== */
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        visibility: visible;
        width: initial;
        font-size: 16px;
        color: #294563;
      }
    }
  }
  .ant-input {
    border: none;
    box-shadow: none;
    height: 44px;
  }
  .ant-input-group-addon {
    background: none;
  }
  .ant-btn {
    background: none;
    box-shadow: none;
    border: none;
    outline: none;
    -webkit-tap-highlight-color: transparent;
    font-size: 22px;
    color: $primary-500;
  }
}

.modal-get-consultation {
  .ant-modal-content {
    border-radius: 20px;
    padding: 4rem;
    @include mobile {
      padding: 2rem;
    }
  }
  .ant-modal-footer {
    display: flex;
    justify-content: center;
    gap: 16px;
    margin-top: 2.4rem;
    @include mobile {
      margin-top: 1.2rem;
    }
    .ant-btn {
      padding: 0 24px;
    }
    .ant-btn-default {
      background: #fff;
      color: $primary-500;
      border: 1px solid $primary-500;
    }
  }
  .ant-modal-close-x {
    color: $primary-500;
    font-size: 24px;
  }
  &__or {
    position: relative;
    display: flex;
    align-items: center;
    font-size: 14px;
    font-weight: bold;
    color: #294563;
    @include mobile {
      justify-content: center;
    }
    &::after,
    &::before {
      content: "";
      flex: 1;
      width: 1px;
      height: calc(50% - 10%);
      background-color: #bdc5cf;
      position: absolute;
      left: 50%;
      bottom: 0%;
      transform: translate(0, 0);
      @include mobile {
        width: 42%;
        height: 1px;
        right: 0;
        left: initial;
        top: 50%;
        transform: none;
      }
    }
    &::before {
      top: 0;
      @include mobile {
        left: 0;
        top: 50%;
        height: 1px;
      }
    }
  }
  &__item {
    & + .modal-get-consultation__item {
      margin-top: 2rem;
    }
  }
  &__title {
    font-size: 22px;
    font-weight: bold;
    color: $primary-500;
    text-align: center;
    margin: 0 0 16px;
  }
  &__contents {
    display: flex;
    gap: 2rem;
    @include mobile {
      flex-direction: column;
    }
  }
  &__col-right {
    width: 40%;
    @include mobile {
      width: 100%;
    }
  }
  &__col-left {
    width: 60%;
    @include mobile {
      width: 100%;
    }
  }
  &__item {
    text-align: left;
  }
  &__label {
    font-size: 14px;
    color: #294563;
    margin-bottom: 2px;
    display: flex;
    .red {
      color: #dd1804;
    }
  }
  &__input {
    border-radius: 9999px;
    border: 1px solid var(--Primary-primary-200, #bdc5cf);
    background-color: #fff;
    height: 40px;
  }
  &__submit-btn {
    margin: 2.4rem auto 0;
    width: 100%;
    height: 40px;
  }
  .qr-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    border-radius: 16px;
    color: var(--Text-Body-2, #505050);
    height: 100%;
    justify-content: center;
    &__image-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 8px;
      overflow: hidden;
      height: auto;
      padding: 8px;
      background: var(--iat_blue-800_primary, #02317e);
      box-shadow: 0px 4px 30px 0px rgba(2, 49, 126, 0.05);
    }
    &__image {
      border-radius: 6px;
      width: 100%;
      height: auto;
      max-width: 154px;
    }
    &__desc {
      color: var(--Text-Body-2, #505050);
      text-align: center;
      font-size: 14px;
      font-style: italic;
      font-weight: 400;
    }
    &__qr-options {
      display: flex;
      gap: 8px;
      margin-top: 8px;
    }
    &__qr-option {
      width: 40px;
      height: 40px;
      padding: 4px;
      border-radius: 16px;
      background: transparent;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      aspect-ratio: 1/1;
      @include transition();
      &:hover {
        background: #e6e9f3;
      }
      &.-active {
        background: #e6e9f3;
      }
    }
    &__qr-icon {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
  }
}
</style>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";

.enter-code {
  background-color: #f4f7ff;
  &__container {
    display: flex;
    padding: 1.6rem;
    gap: 3rem;
    @include mobile {
      flex-direction: column;
    }
  }

  &__col-left {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    @include mobile {
      width: 100%;
    }
  }
  &__title {
    font-size: 16px;
    font-weight: bold;
    margin: 0;
    color: $primary-500;
  }
  &__desc {
    font-style: italic;
    font-weight: 400;
    color: $primary-500;
  }
  &__input {
    height: 44px;
  }
  &__next-btn {
    height: 44px;
  }
  &__next-btn {
    min-width: 116px;
  }
  &__colright {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    max-width: 495px;
    margin: 0 0 0 auto;
    gap: 16px;
    @include mobile {
      width: 100%;
    }
  }
}

.all-collection {
  .fa-arrow-down {
    width: 32px;
    height: 32px;
    background: #d6f0f4;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #32b3c7;
    border-radius: 50%;
  }
  &__exp-more {
    display: flex;
    gap: 8px;
    margin-bottom: 2rem;
    justify-content: flex-end;
    align-items: center;
    font-size: 14px;
    font-weight: 400;
    color: $primary-500;
    cursor: pointer;
    width: fit-content;
    justify-self: flex-end;
    &.active {
      .fa-arrow-down {
        transform: rotate(180deg);
      }
    }
  }
  &__items-wrapper {
    position: relative;
  }
  &__search {
    position: absolute;
    right: 0;
    bottom: calc(100% - 4rem);
    z-index: 9;
    width: 27%;
    @include mobile {
      position: relative;
      width: 100%;
    }
  }
  &__search-input {
    border-radius: 100px;
    border: 1px solid var(--Primary-primary-200, #9da9b7);
    background: #fff;
    overflow: hidden;
    height: 40px;
    .ant-input {
      border: none;
    }
  }
  &__items-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 2rem;
    @include tablet {
      grid-template-columns: repeat(2, 1fr);
    }
    @include mobile {
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
    }
  }
}
</style>

