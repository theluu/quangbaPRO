<template>
  <div class="banner-process">
    <div class="container">
      <div class="row align-items-lg-center">
        <div class="col-lg-6">
          <h2 class="banner-process-title fw-bold">Dịch vụ thiết kế website</h2>
          <p class="banner-process-text-lead">
            <span class="text-primary-color fw-bold">QuangbaPro</span> cung cấp
            <span class="text-primary-color fw-bold"
              >Dịch vụ thiết kế website</span
            >
            tốt nhất giúp mang đến trải nghiệm tốt cho khách hàng của doanh
            nghiệp bạn
          </p>
          <div class="inprogress">
            <div class="progress-item">
              <div
                class="d-flex justify-content-between align-items-center progress-item-label mb-3 mb-md-4"
              >
                <label>Mức độ hài lòng</label>
                <span class="percent-text">96%</span>
              </div>
              <div class="progress progress-custom rounded-pill">
                <div
                  style="width: 96%"
                  class="progress-bar rounded-pill"
                  role="progressbar"
                  aria-valuenow="0"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
            </div>
            <!-- /.progress-item -->
            <div class="progress-item">
              <div
                class="d-flex justify-content-between align-items-center progress-item-label mb-3 mb-md-4"
              >
                <label>Lượng traffic tăng</label>
                <span class="percent-text">80%</span>
              </div>
              <div class="progress progress-custom rounded-pill">
                <div
                  style="width: 80%"
                  class="progress-bar rounded-pill"
                  role="progressbar"
                  aria-valuenow="0"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
            </div>
            <!-- /.progress-item -->
            <div class="progress-item">
              <div
                class="d-flex justify-content-between align-items-center progress-item-label mb-3 mb-md-4"
              >
                <label>Tỷ lệ khách hàng quay lại</label>
                <span class="percent-text">90%</span>
              </div>
              <div class="progress progress-custom rounded-pill">
                <div
                  style="width: 90%"
                  class="progress-bar rounded-pill"
                  role="progressbar"
                  aria-valuenow="0"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
            </div>
            <!-- /.progress-item -->
            <div class="progress-item">
              <div
                class="d-flex justify-content-between align-items-center progress-item-label mb-3 mb-md-4"
              >
                <label>Tốc độ và hiệu suất</label>
                <span class="percent-text">95%</span>
              </div>
              <div class="progress progress-custom rounded-pill">
                <div
                  style="width: 95%"
                  class="progress-bar rounded-pill"
                  role="progressbar"
                  aria-valuenow="0"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
            </div>
            <!-- /.progress-item -->
          </div>
          <div class="banner-process-cta">
            <a href="#" class="btn btn-green-color btn-custom rounded-pill">
              <i class="fa-light fa-phone-volume"></i>
              Gọi ngay 19001006
            </a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="banner-process-img mt-4 mt-lg-0">
            <img src="../../assets/images/themes/theme-design-img.png" alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { defineProps } from "vue";
import getImgUrl from "@/utils/getUrlImg";
</script>
<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.banner-process {
  background-color: #fdf8f4;
  padding: 60px 0;
  @include breakpoint(md) {
    padding: 125px 0;
  }
  .row {
    margin-left: -20px;
    margin-right: -20px;
    & > * {
      padding-left: 20px;
      padding-right: 20px;
    }
  }
  &-title {
    font-size: 22px;
    line-height: 1.4;
    margin-bottom: 24px;
    font-weight: 700;

    @include breakpoint(md) {
      margin-bottom: 36px;
      font-size: 40px;
    }
  }
  &-text-lead {
    font-size: 16px;
    line-height: 1.4;
    margin-bottom: 24px;
    @include breakpoint(md) {
      font-size: 18px;
      margin-bottom: 36px;
    }
  }
  .progress-item {
    margin-bottom: 24px;
    @include breakpoint(md) {
      margin-bottom: 36px;
    }
    &-label {
      font-size: 18px;
      line-height: 1.4;
      label {
        font-weight: bold;
        margin-bottom: 0;
      }
    }
  }
}
.progress.progress-custom {
  height: 5px;
  background-color: $white;
  .progress-bar {
    background-color: #fbbc05;
  }
}
</style>
