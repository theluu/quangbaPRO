<template>
  <!-- section -->
  <section class="section-introduction section-pad">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mb-3 mb-md-4 mb-lg-0 text-center text-lg-start">
          <img :src="getImgUrl('../../src/assets/images/introduction',item.src)" :alt="item.title" />
        </div>
        <div class="col-lg-6">
          <div class="introduction-header">
            <SectionTitle :headingCate="headingSection.headingCate" />
            <div class="introduction-logo">
              <img :src="getImgUrl('../../src/assets/images/introduction',item.srcLogo)" :alt="item.title" />
            </div>
            <h2 class="introduction-title fw-bold">{{ item.title }}</h2>
          </div>
          <div class="introduction-text">{{ item.text }} <RouterLink to="#" class="text-primary-color fw-semibold">Xem thêm <i class="fa-regular fa-angle-right"></i></RouterLink></div>
          <ul class="introduction-list list-unstyled">
            <li
              v-for="(point, index) in item.points"
              :key="index"
              class="introduction-list-item"
            >
              <span class="icon"><i :class="point.iconClass"></i></span>
              <span class="txt flex-fill">{{ point.point }}</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import { defineProps } from "vue";
import getImgUrl from '@/utils/getUrlImg'
import SectionTitle from '@/components/SectionTitle.vue';

const { item } = defineProps({
  item: {
    type: Object,
    default: () => {},
  },
});

const headingSection = {
  headingCate: {
    iconClass: "fa-light fa-paper-plane",
    text: "Giới thiệu chung"
  }
}

</script>

<style lang="scss" scoped>
  @import "@/assets/mixins.scss";
  @import "@/assets/variables.scss";
  .introduction-header {
    .section-heading {
      text-align: left !important;
      margin-bottom: 16px;
      @include breakpoint(md) {
        margin-bottom: 24px;
      }
    }
    :deep(.section-heading-cate) {
      margin-bottom: 0;
    }
  }
  .introduction-logo {
    margin-bottom: 16px;
    @include breakpoint(md) {
      margin-bottom: 24px;
    }
  }
  .introduction-title {
    font-size: 24px;
    margin-bottom: 16px;
    @include breakpoint(md) {
      margin-bottom: 24px;
      font-size: 28px;
    }
  }
  .introduction-text {
    font-size: 15px;
    padding-bottom: 16px;
    border-bottom: 1px solid $grey-4;
    margin-bottom: 16px;
    @include breakpoint(md) {
      margin-bottom: 24px;
      padding-bottom: 24px;
      font-size: 17px;
    }
  }
  .introduction-list {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -12px;
    gap: 16px 0;
    font-weight: 600;
    font-size: 15px;
    @include breakpoint(md) {
      gap: 24px 0;
      font-size: 17px
    }
    li {
      @include flexWidth(50%);
      padding-left: 12px;
      padding-right: 12px;
      position: relative;
      display: flex;
      align-items: center;
      min-height: 22px;      
      .icon {
        @include flexWidth(22px);
        display: flex;
        align-items: center;
      }
      .txt {
        padding-left: 10px;
      }
    }
  }
</style>
