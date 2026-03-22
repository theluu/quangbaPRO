<template>
  <div class="about-services">
    <div class="services-image-wrapper">
      <img :src="getImgUrl('../../../src/assets/images/about', data.image)" alt="Services Illustration" class="img-fluid" />
    </div>
    <div class="container">
      <div class="row align-items-center">
        <!-- Services Grid -->
        <div class="col-lg-6 order-2 order-lg-1">
          <div class="services-content pe-lg-5">
            <h2 class="section-title fw-bold">{{ data.title }}</h2>
            <div class="row g-4">
              <div v-for="service in data.items" :key="service.id" class="col-sm-6">
                <RouterLink to="#" class="service-item d-flex align-items-center gap-3">
                  <div class="icon-box">
                    <img :src="getImgUrl('../../../src/assets/images/about', service.icon)" :alt="service.label" />
                  </div>
                  <span class="service-label text-uppercase">{{ service.label }}</span>
                </RouterLink>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import getImgUrl from '@/utils/getUrlImg';

const props = defineProps({
  data: {
    type: Object,
    required: true
  }
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.about-services {
  position: relative;
  overflow: hidden;
  background-color: #fff;
  @include breakpoint(lg) {
    min-height: 720px;
    display: flex;
    align-items: center;
  }  
  .container {
    position: relative;
    z-index: 3;
  }
}

.services-image-wrapper {
  text-align: center;
  position: relative;
  margin-bottom: 24px;
  @include breakpoint(lg) {
    position: absolute;
    top: 0;
    right: 0;
    width: 50%;
    z-index: 2;
  }
  &::after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background-color: #62B2F1;
    z-index: 0;
    @include breakpoint(lg) {
      width: 45%;
      height: 100%;
      clip-path: polygon(15% 0, 100% 0, 100% 100%, 15% 100%, 0 50%);
    }
  }
  img {
    height: 100%;
    width: auto;
    position: relative;
    z-index: 1;
    @include breakpoint(lg) {
      min-height: 720px;
    }
  }
}

.section-title {
  font-size: 28px;
  margin-bottom: 24px;
  @include breakpoint(md) {
    font-size: 32px;
    margin-bottom: 36px;
  }
}

.service-item {
  .icon-box {
    @include square(72px);
    background-color: $primary-1;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  
  .service-label {

  }
}
</style>
