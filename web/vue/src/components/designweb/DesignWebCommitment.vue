<template>
  <!-- section commitment -->
  <section class="section-design-web-commitment section-pad">
    <div class="container">
      <SectionTitle 
        :headingTitle="headingSection.headingTitle"
        :isWhiteText="true"
      />
      <swiper 
        :breakpoints="breakpointSlide" 
        class="commitmentSwiper"
      >
        <swiper-slide v-for="item in props.items" :key="item.id">
          <CommitmentItem :item="item" />
        </swiper-slide>
      </swiper>
      <div class="text-center mt-5">
        <RouterLink class="btn btn-green-color px-4 py-2 rounded-pill" to="#">
          <i class="fa-light fa-phone-volume me-2"></i>
          {{ Drupal.t('Gọi ngay 19001006') }}
        </RouterLink>
      </div>
    </div>
  </section>
  <!-- e: section commitment -->
</template>

<script setup>
import { defineProps } from "vue";
import SectionTitle from '@/components/SectionTitle.vue';
import CommitmentItem from './components/CommitmentItem.vue'
import { Swiper, SwiperSlide } from 'swiper/vue';

const props = defineProps({
  items: {
    type: Array,
    default: () => []
  }
});

const headingSection = {
  headingTitle: {
    textPrimary: "CAM KẾT",
    textDangler: "CỦA CHÚNG TÔI"
  }
};

const breakpointSlide = {
  '0': {
    slidesPerView: 2,
    spaceBetween: 0,
  },
  '640': {
    slidesPerView: 2,
    spaceBetween: 0,
  },
  '768': {
    slidesPerView: 3,
    spaceBetween: 0,
  },
  '992': {
    slidesPerView: 3,
    spaceBetween: 0,
  },
  '1200': {
    slidesPerView: 4,
    spaceBetween: 0,
  }
}

</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
  .section-design-web-commitment {
    background: url("@/assets/images/design-web/bg-commitment.png") no-repeat center center;
    background-size: cover;
  }
  :deep(.section-title .text-danger-color) {
    color: $danger-1 !important;
  }
  :deep(.swiper-slide) {
    border-left: 1px solid rgba($white,0.8);
    height: unset;
  }
  .commitmentSwiper {
    border: 1px solid rgba($white,0.8);
  }
  :deep(.swiper-wrapper) {
    margin-left: -1px;
    height: unset;
  }
</style>
