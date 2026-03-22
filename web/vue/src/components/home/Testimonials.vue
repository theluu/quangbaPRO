<template>
  <!-- section -->
  <section class="section-testimonial section-pad" :class="{'bg-grey-1' : !isBgWhite}">
    <div class="container">
      <SectionTitle 
        :headingCate="headingSection.headingCate" 
        :headingTitle="headingSection.headingTitle"
      />
      <swiper 
        :breakpoints="breakpointSlide" 
        :pagination="{ clickable: true }"
        :modules="modules"
        :navigation="true"
        :centeredSlides="true"
        :loop="true"
        class="testimonialSwiper navigation-circle"
      >
        <swiper-slide v-for="item in items" :key="item.id">
          <TestimonialItem :item="item" />
        </swiper-slide>
      </swiper>
      <div class="text-center mt-5" v-if="isButton">
        <button class="btn btn-green-color rounded-pill px-4 py-2" @click="$emit('click')"><i class="fa-light fa-pen-to-square me-2"></i> {{ Drupal.t('Đăng ký tư vấn') }}</button>
      </div>
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import SectionTitle from '@/components/SectionTitle.vue';
import TestimonialItem from './components/TestimonialItem.vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Pagination, Navigation } from 'swiper/modules';
import { defineProps, defineEmits } from 'vue';

defineEmits(['click']);

const { items, isButton, isBgWhite } = defineProps({
  items: {
    type: Array,
    default: () => []
  },
  isButton: {
    type: Boolean,
    default: false
  },
  isBgWhite: {
    type: Boolean,
    default: false
  }
})

const modules = [Pagination, Navigation];

const headingSection = {
  headingCate: {
    iconClass: "ico-message-favorite",
    text: "TESTIMONIAL"
  },
  headingTitle: {
    textPrimary: "KHÁCH HÀNG",
    textDangler: "NÓI VỀ CHÚNG TÔI"
  }
}

const breakpointSlide = {
  '0': {
    slidesPerView: 1,
    spaceBetween: 16,
  },
  '768': {
    slidesPerView: 2,
    spaceBetween: 16,
  },
  '1200': {
    slidesPerView: 3,
    spaceBetween: 24,
  }
}
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.testimonialSwiper {
  @include breakpoint(md) {
    padding-bottom: 50px;
  }
  
  :deep(.swiper-pagination) {
    bottom: 0;
  }
  
  :deep(.swiper-pagination-bullet) {
    width: 40px;
    height: 4px;
    border-radius: 2px;
    background-color: #D9D9D9;
    opacity: 1;
    
    &.swiper-pagination-bullet-active {
      background-color: #F7941D;
    }
  }
  :deep(.swiper-slide) {
    &:not(.swiper-slide-active) {
      margin-top: 48px;
      opacity: 0.4;
    }
    &.swiper-slide-active {
      .testimonial-quote {
        svg {
          path {
            fill: $primary-1;
          }
        }
      }
    }
  }
}
</style>
