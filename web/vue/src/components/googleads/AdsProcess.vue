<template>
  <section class="section-ads-process section-pad" style="background-image: url('../../../src/assets/images/googleads/bg-ads.png')">
    <div class="container">
      <!-- Section Heading -->
      <SectionTitle 
        :headingTitle="{ textPrimary: data.title, textDangler: '' }" 
        :subTitle="data.subTitle"
        :isWhiteText="true"
      />

      <!-- Swiper Carousel -->
      <div class="ads-process-swiper-wrap">
        <swiper
          :modules="modules"
          :slidesPerView="auto"
          :spaceBetween="24"
          :slidesToScroll="1"
          class="ads-process-swiper"
        >
          <swiper-slide v-for="item in data.steps" :key="item.id">
            <div class="process-card text-center h-100">
              <div class="icon-box mb-3">
                <img :src="getImgUrl('../../../src/assets/images/googleads',item.icon)" :alt="item.title" class="img-fluid" />
              </div>
              <div class="step-label mb-3 text-primary">{{ item.step }}</div>
              <h4 class="step-title fw-semibold mb-3">{{ item.title }}</h4>
              <p class="step-desc">{{ item.description }}</p>
            </div>
          </swiper-slide>
        </swiper>
      </div>

      <!-- Action Button -->
      <div class="text-center mt-5">
        <button class="btn btn-green-color rounded-pill px-4 py-2 fw-bold shadow-sm" @click="$emit('register')">
            <i class="fa-light fa-pen-to-square me-2"></i> {{ Drupal.t('Đăng ký tư vấn') }}
          </button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay } from 'swiper/modules';
import SectionTitle from '@/components/SectionTitle.vue';
import getImgUrl from '@/utils/getUrlImg'
import 'swiper/css';
import 'swiper/css/pagination';

const props = defineProps({
  data: {
    type: Object,
    required: true,
    default: () => ({
      title: '',
      subTitle: '',
      buttonText: '',
      steps: []
    })
  }
});

defineEmits(['register']);

const modules = [Autoplay];

</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.section-ads-process {
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  position: relative;
  overflow: hidden;

  .process-card {
    background: #EEEEEE;
    background: radial-gradient(circle, rgba(255, 255, 255, 1) 0%, rgba(#EEEEEE, 1) 100%);
    border-radius: 80px 80px 80px 0;
    padding: 24px 24px 57px;
    .icon-box {
      @include square(72px);
      background-color: $white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
    }

    .step-label {
      color: $primary-1;
    }

    .step-title {
      font-size: 18px;
    }
  }
}
.ads-process-swiper-wrap {
  :deep(.swiper-wrapper) {
    height: unset;
    .swiper-slide {
      height: unset;
      width: 237px !important;
      .process-card {
        min-height: 100%;        
      }
    }
  }
}
</style>
