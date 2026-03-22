<template>
  <div class="subbanner bg-light-green section-pad">
    <div class="container">
      <div class="row align-items-lg-center">
        <div class="col-lg-6">
          <h2 class="subbanner-title fw-bold">Dịch vụ Quảng cáo Facebook Ads chuyên nghiệp</h2>
          <p class="subbanner-text-lead">Dịch vụ SEO Tổng Thể – Giải pháp đưa website lên TOP Google bền vững</p>
          <ul class="list-group-anpha list-unstyled">
            <li><b>Tiếp cận đúng đối tượng khách hàng</b> theo độ tuổi, giới tính, khu vực, sở thích…</li>
            <li><b>Tăng tương tác và độ nhận diện thương hiệu</b> nhanh chóng. </li>
            <li><b>Tối ưu ngân sách quảng cáo</b> – đạt hiệu quả cao với chi phí hợp lý.</li>
            <li><b>Tăng tương tác và độ nhận diện thương hiệu</b> nhanh chóng. </li>
            <li><b>Tăng doanh số bán hàng,</b> thu hút khách hàng tiềm năng liên tục.</li>
            <li><b>Theo dõi, báo cáo minh bạch,</b> điều chỉnh chiến dịch linh hoạt theo thời gian thực.</li>
          </ul>
          <div class="subbanner-button">
            <a href="#" class="btn btn-green-color btn-custom rounded-pill">
              <i class="fa-regular fa-pen-to-square"></i>
              Đăng ký tư vấn
            </a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="subbanner-img mt-4 mt-lg-0">
            <img src="../../assets/images/facebook/facebook-banner.png" alt="" />
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

.subbanner {
  .row {
    margin-left: -20px;
    margin-right: -20px;

    &>* {
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

.bg-light-green {
  background-color: #F2F7FF;
}

.list-group-anpha {
  li {
    margin-bottom: 16px;
    position: relative;
    min-height: 20px;
    padding-left: 32px;

    &::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 20px;
      height: 20px;
      background-image: url(../../assets/images/icons/ico-check-circle-color.svg);
      background-position: 0 0;
      background-repeat: no-repeat;
    }

    @include breakpoint(md) {
      margin-bottom: 24px;
    }

    &:last-child {
      margin-bottom: 0;
    }
  }
}

.subbanner-button {
  margin-top: 24px;

  @include breakpoint(md) {
    margin-top: 36px;
  }
}
</style>
