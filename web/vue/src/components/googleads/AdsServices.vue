<template>
  <section class="ads-services section-pad">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="ads-services-content">
            <h2 class="ads-services-title mb-4">
              {{ data.title }}
            </h2>
            <div class="ads-services-content" v-html="data.features"></div>
            <button class="btn btn-green-color rounded-pill px-4 py-2 fw-bold shadow-sm" @click="$emit('register')">
              <i class="fa-light fa-pen-to-square me-2"></i> {{ Drupal.t('Đăng ký tư vấn') }}
            </button>
          </div>
        </div>
        <div class="col-lg-6 mt-5 mt-lg-0">
          <div class="ads-services-image text-center">
            <img :src="getImgUrl('../../../src/assets/images/googleads',data.image)" :alt="data.title" class="img-fluid main-img" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';
import getImgUrl from '@/utils/getUrlImg'

const props = defineProps({
  data: {
    type: Object,
    required: true,
    default: () => ({
      title: '',
      description: '',
      buttonText: '',
      image: '',
      features: ''
    })
  }
});

defineEmits(['register']);
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.ads-services {
  background-color: #FDF8F4;
  overflow: hidden;
  
  .ads-services-title {
    font-size: 22px;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 24px;
    @include breakpoint(md) {
      font-size: 40px;
      margin-bottom: 36px;
    }
  }

  .ads-services-content {
    margin-bottom: 24px;
    @include breakpoint(md) {
      margin-bottom: 36px;
    }
    :deep(p) {
      margin-bottom: 16px;
      &:last-child {
        margin-bottom: 0;
      }
    }
  }

  .ads-services-image {
    padding: 0 20px;
    position: relative;
    
    &::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 120%;
        height: 120%;
        background: radial-gradient(circle, rgba($primary-1, 0.05) 0%, rgba($white, 0) 70%);
        z-index: 0;
    }

    .main-img {
      max-width: 100%;
      height: auto;
      position: relative;
      z-index: 1;
      filter: drop-shadow(0 20px 50px rgba(0,0,0,0.1));
      animation: float 6s ease-in-out infinite;
    }
  }
}

@keyframes float {
  0% {
    transform: translateY(0px) rotate(0deg);
  }
  50% {
    transform: translateY(-15px) rotate(1deg);
  }
  100% {
    transform: translateY(0px) rotate(0deg);
  }
}
</style>
