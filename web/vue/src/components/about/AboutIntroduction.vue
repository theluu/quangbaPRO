<template>
  <div class="about-introduction">
    <div class="intro-image-wrapper">
        <img :src="getImgUrl('../../../src/assets/images/about', data.image)" alt="About Illustration" class="img-fluid" />
    </div>
    <div class="container">
      <div class="row align-items-center justify-content-lg-end">
        <div class="col-lg-6">
          <div class="admin-intro-content ps-lg-4">
            <h2 class="title fw-bold">{{ data.title }}</h2>
            <h3 class="sub-title fw-semibold mb-4">{{ data.subTitle }}</h3>
            <p class="description mb-4">{{ data.desc }}</p>
            
            <div class="stats-section">
              <h4 class="stats-title fw-semibold mb-4 text-uppercase">{{ data.statsTitle }}</h4>
              <div class="d-flex justify-content-center justify-content-lg-between flex-wrap gap-4">
                <StatsCircle 
                  v-for="stat in data.stats" 
                  :key="stat.id"
                  :value="stat.value"
                  :suffix="stat.suffix"
                  :label="stat.label"
                  :percent="stat.percent"
                />
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
import StatsCircle from './StatsCircle.vue';

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

.about-introduction {
  position: relative;
  overflow: hidden;
  background-color: #f8fbff;
  margin-bottom: 40px;
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

.intro-image-wrapper {
  text-align: center;
  margin-bottom: 24px;
  position: relative;
  @include breakpoint(lg) {
    position: absolute;
    top: 0;
    left: 0;
    width: 50%;
    z-index: 2;
    height: 100%;
  }
  &::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    background-color: #BBCBFF;
    z-index: 0;
    width: 100%;
    height: 100%;
    @include breakpoint(lg) {
      width: 45%;
      height: 100%;
      clip-path: polygon(0 0, 85% 0, 100% 50%, 85% 100%, 0 100%);
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

.title {
  font-weight: 700;
  font-size: 28px;
  margin-bottom: 16px;
  @include breakpoint(md) {
    font-size: 32px;
  }
}

.sub-title {
  font-size: 20px;
  @include breakpoint(md) {
    font-size: 24px;
  }
}

.description {
  line-height: 1.8;
  font-size: 15px;
}
.stats-section {
  margin-top: 24px;
  border-top: 1px solid $grey-6;
  padding-top: 24px;
}
.stats-title {
  letter-spacing: 0.5px;
  font-size: 18px;
  @include breakpoint(md) {
    font-size: 20px;
  }
}
</style>
