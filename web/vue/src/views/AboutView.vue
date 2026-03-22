<template>
  <div class="about-page">
    <section class="section-about-banner position-relative">
      <Banner :items="bannerData" />
      <div class="banner-content-overlay">
        <div class="container">
          <SectionTitle 
            :headingTitle="bannerData[0]?.title" 
            :subTitle="bannerData[0]?.subTitle"
          />
        </div>
      </div>
    </section>

    <section class="section-about-content section-pad">
      <AboutIntroduction v-if="aboutData.intro" :data="aboutData.intro" />
      <AboutServices v-if="aboutData.services" :data="aboutData.services" />
    </section>

    <AboutMission v-if="missionData.items" :data="missionData" />
    <AboutWhy v-if="whyData.title" :data="whyData" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Banner from '@/components/common/Banner.vue';
import SectionTitle from '@/components/SectionTitle.vue';
import AboutIntroduction from '@/components/about/AboutIntroduction.vue';
import AboutServices from '@/components/about/AboutServices.vue';
import AboutMission from '@/components/about/AboutMission.vue';
import AboutWhy from '@/components/about/AboutWhy.vue';
import { useAuthStore } from "@/store.js";

const authStore = useAuthStore();
const bannerData = ref([]);
const aboutData = ref({});
const missionData = ref({});
const whyData = ref({});

const fetchData = async () => {
  try {
    const endpoint = authStore.config?.endpoint || {};
    const [bannerRes, aboutRes, missionRes, whyRes] = await Promise.all([
      axios.get(endpoint.bannerAbout).catch(err => {
        console.error("Error fetching about banner:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.aboutContent).catch(err => {
        console.error("Error fetching about content:", err);
        return { data: { data: {} } };
      }),
      axios.get(endpoint.aboutMission).catch(err => {
        console.error("Error fetching about mission:", err);
        return { data: { data: {} } };
      }),
      axios.get(endpoint.aboutWhy).catch(err => {
        console.error("Error fetching about why:", err);
        return { data: { data: {} } };
      })
    ]);
    bannerData.value = bannerRes.data.data || [];
    aboutData.value = aboutRes.data.data || {};
    missionData.value = missionRes.data.data || {};
    whyData.value = whyRes.data.data || {};
  } catch (error) {
    console.error("Error fetching about page data:", error);
  }
};

onMounted(() => {
  fetchData();
});
</script>

<style scoped lang="scss">
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.section-about-banner {
  .banner-content-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    z-index: 10;
    pointer-events: none;
    :deep(.section-title) {
      word-break: break-word;
    }
  }

  :deep(.banners) {
    img {
      width: 100%;
      height: 400px;
      object-fit: cover;
      filter: brightness(0.6); 
      @include breakpoint(md) {
        height: 500px;
      }
    }
  }

  :deep(.section-heading) {
    margin-bottom: 0;
    .section-title {
        font-size: 32px;
        @include breakpoint(md) {
            font-size: 48px;
        }
    }
    .section-sub-title {
        margin-top: 16px;
        font-size: 18px;
        color: $white;
        @include breakpoint(md) {
            font-size: 24px;
        }
    }
  }
}
</style>
