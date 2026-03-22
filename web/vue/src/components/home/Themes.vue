<template>
  <!-- section -->
  <section class="section-themes section-pad">
    <div class="container">
      <SectionTitle :subTitle="headingSection.subTitle" :headingTitle="headingSection.headingTitle"/>
      <swiper 
        :breakpoints="breakpointSlide" 
        :modules="modules"
        class="themsSwiper"
      >
        <swiper-slide v-for="item in items" :key="item.id">
          <ThemeItem :item="item" />
        </swiper-slide>
      </swiper>

      <ViewDetail :textLink="'Xem thêm'" />
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import SectionTitle from '@/components/SectionTitle.vue';
import ThemeItem from './components/ThemeItem.vue';
import ViewDetail from '@/components/ViewDetail.vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Grid } from 'swiper/modules';
import { defineProps } from 'vue';

const modules = [Grid];

const { items } = defineProps({
  items: {
    type: Array,
    default: () => []
  }
})

const breakpointSlide = {
  '0': {
    slidesPerView: 1.2,
    grid: {
      rows: 1,
    },
    spaceBetween: 16,
  },
  '768': {
    slidesPerView: 2,
    grid: {
      rows: 2,
    },
    spaceBetween: 32,
  },
  '992': {
    slidesPerView: 3,
    grid: {
      rows: 2,
    },
    spaceBetween: 32,
  },
  '1200': {
    slidesPerView: 4,
    grid: {
      rows: 2,
    },
    spaceBetween: 32,
  }
}

const headingSection = {
  headingTitle: {
    textPrimary: "Giao diện",
    textDangler: "website mới nhất"
  },
  subTitle: "Danh sách các giao diện website được khách hàng tin tưởng và chọn mua nhiều nhất"
}
</script>

<style lang="scss" scoped>
  @import "@/assets/mixins.scss";
  @import "@/assets/variables.scss";
  :deep(.swiper-grid-column > .swiper-wrapper) {
    flex-wrap: wrap;
    flex-direction: row;
    display: flex;
    @include breakpoint(md) {
      gap: 32px 0;
    }
    .swiper-slide {
      margin-top: 0 !important;
    }
  }
</style>