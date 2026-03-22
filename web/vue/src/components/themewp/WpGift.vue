<template>
  <div class="wp-gift section-pad">
    <div class="container">
      <SectionTitle
        :subTitle="headingSection.subTitle"
        :headingTitle="headingSection.headingTitle"
      />
      <div class="row">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <div class="wp-gift-box">
            <img
              class="wp-gift-img"
              src="@/assets/images/themes/theme-gift-img1.png"
              alt=""
            />
            <div class="wp-gift-content position-relative">
              <ul class="wp-gift-list list-unstyled">
                <li>
                  Tặng
                  <span class="text-primary-color fw-bold"
                    >Tên miền - Hoting - Banner</span
                  >
                </li>
                <li>
                  <span class="text-primary-color fw-bold">Giảm 10%</span> khi
                  giới thiệu hoặc thiết kế web thứ 2
                </li>
                <li>
                  <span class="text-primary-color fw-bold">Giảm 10%</span> khi
                  giới thiệu hoặc thiết kế web thứ 2
                </li>
                <li>
                  Miễn phí chiến lược seo, Quảng Cáo Giúp gia tăng doanh số
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="wp-countdown-box">
            <img
              class="wp-countdown-img"
              src="@/assets/images/themes/theme-gift-img2.png"
              alt=""
            />
            <div class="wp-countdown-content position-relative">
              <h3 class="wp-countdown-title">Liên hệ ngay</h3>
              <div class="wp-countdown">
                <div class="wp-countdown-item">
                  <h3>02</h3>
                  <label>Giờ</label>
                </div>
                <div class="wp-countdown-item">
                  <h3>02</h3>
                  <label>Phút</label>
                </div>
                <div class="wp-countdown-item">
                  <h3>02</h3>
                  <label>Giây</label>
                </div>
              </div>
              <div class="banner-process-cta">
                <a href="#" class="btn btn-green-color btn-custom rounded-pill">
                  <i class="fa-light fa-phone-volume"></i>
                  Gọi ngay 19001006
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { defineProps } from "vue";
import SectionTitle from "@/components/SectionTitle.vue";

const headingSection = {
  headingTitle: {
    textPrimary: "Quà tặng",
    textDangler: "Duy nhất trong tháng",
  },
  subTitle: "",
};
</script>
<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.wp-gift-box {
  border-radius: 48px;
  overflow: hidden;
  position: relative;
  @include breakpoint(lg) {
    height: 100%;
  }
  // &::before {
  //   content: "";
  //   display: block;
  //   width: 100%;
  //   height: 100%;
  //   background-color: rgba(255, 255, 255, 0.6);
  //   position: absolute;
  //   top: 0;
  //   left: 0;
  // }
}
.wp-gift-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.wp-gift-content {
  background-color: rgba(255, 255, 255, 0.6);
  padding: 24px;
  @include breakpoint(lg) {
    height: 100%;
  }
}
.wp-gift-list {
  li {
    margin-bottom: 16px;
    min-height: 48px;
    position: relative;
    display: flex;
    align-items: center;
    padding-left: 64px;
    &::before {
      content: "";
      display: block;
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background-color: $white;
      position: absolute;
      top: 0;
      left: 0;
    }
    &::after {
      content: "";
      display: block;
      width: 24px;
      height: 24px;
      position: absolute;
      top: 12px;
      left: 12px;
      background-image: url(../../assets/images/icons/ico-check-circle-dark.svg);
      width: 24px;
      height: 24px;
    }
    &:last-child {
      margin-bottom: 0;
    }
  }
}
.wp-countdown {
  display: flex;
  justify-content: center;
  gap: 16px;
  &-box {
    border-radius: 48px;
    overflow: hidden;
    position: relative;
    @include breakpoint(lg) {
      height: 100%;
    }
  }
  &-title {
    font-size: 20px;
    line-height: 1.4;
    color: #fbbc05;
    text-transform: uppercase;
    font-weight: bold;
    margin-bottom: 0;
    @include breakpoint(md) {
      font-size: 24px;
    }
  }
  &-item {
    width: 90px;
    height: 112px;
    border: 2px solid $white;
    border-radius: 24px;
    padding: 14px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    color: #ff9d3d;
    @include breakpoint(sm) {
      width: 100px;
      height: 125px;
    }
    h3 {
      font-size: 32px;
      line-height: 1.4;
      font-weight: bold;
      margin-bottom: 0;
      @include breakpoint(sm) {
        font-size: 40px;
      }
    }
    label {
      font-size: 16px;
      line-height: 1.4;
      font-weight: bold;
      margin-bottom: 0;
      @include breakpoint(sm) {
        font-size: 16px;
      }
    }
  }
  &-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  &-content {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 16px;
    padding: 24px;
    background-color: rgba(0, 0, 0, 0.6);
    @include breakpoint(lg) {
      height: 100%;
    }
  }
}
</style>
