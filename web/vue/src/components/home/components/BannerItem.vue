<template>
  <div class="hero-item position-relative">
    <img class="d-md-none img-hero" :src="getImgUrl('../../../src/assets/images/banner', item.imgSrcMb)" :alt="item.title" />
    <img
      class="d-none d-md-block img-hero"
      :src="getImgUrl('../../../src/assets/images/banner',item.imgSrcPc)"
      :alt="item.title"
    />
    <div class="hero-item-content">
      <div class="container">
        <div class="hero-item-layout">
          <div class="hero-item-header">
            <h2 class="hero-item-title after2">{{ item.title }}</h2>
            <h2 class="hero-item-title after1">{{ item.title }}</h2>
            <h2 class="hero-item-title front">{{ item.title }}</h2>
          </div>
          <h3 class="hero-item-subtitle">{{ item.subTitle }}</h3>
          <div class="hero-item-desc">
            {{ item.desc }}
          </div>
          <RouterLink
            class="btn btn-warning-color rounded-pill px-4 py-2"
            to="#"
          >
            <span class="btn-icon">
              <img src="@/assets/images/icons/angle-right-circle.svg" alt="" />
            </span>
            {{ Drupal.t("Tìm hiểu thêm") }}
          </RouterLink>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { defineProps } from "vue";
import getImgUrl from '@/utils/getUrlImg'
const { item } = defineProps({
  item: {
    type: Object,
    default: () => {},
  },
});
</script>
<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.hero {
  &-item {
    img {
      max-width: 100%;
      height: auto;
    }
    .img-hero {
      min-height: 360px;
    }
  }
  &-item-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }
  &-item-layout {
    @include breakpoint(md) {
      width: 50%;
    }
  }
  &-item-header {
    position: relative;
  }
  &-item-title {
    text-transform: uppercase;
    font-weight: bold;
    font-size: 24px;
    color: #4285f4;
    margin-bottom: 16px;
    position: relative;
    @include breakpoint(md) {
      color: #015fc9;
      margin-bottom: 26px;
      font-size: 30px;
    }
    @include breakpoint(lg) {
      font-size: 64px;
    }
    &.after1 {
      display: none;
      @include breakpoint(lg) {
        display: block;
        color: #fff;
        position: absolute;
        top: -2px;
        left: -2px;
      }
    }
    &.after2 {
      display: none;
      @include breakpoint(lg) {
        display: block;
        color: #015fc9;
        position: absolute;
        top: -3px;
        left: -3px;
        opacity: 0.6;
      }
    }
  }
  &-item-subtitle {
    font-size: 22px;
    text-transform: uppercase;
    font-weight: bold;
    margin-bottom: 16px;
    @include breakpoint(lg) {
      font-size: 22px;
    }
  }
  &-item-desc {
    font-size: 14px;
    text-shadow: 1px 0 #fff, -1px 0 #fff, 0 1px #fff, 0 -1px #fff, 1px 1px #fff,
      -1px -1px #fff, 1px -1px #fff, -1px 1px #fff;
    margin-bottom: 16px;
    @include breakpoint(md) {
      font-size: 18px;
      margin-bottom: 24px;
    }
  }
}
</style>
