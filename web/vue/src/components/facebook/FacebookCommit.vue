<template>
  <section class="facebook-intro section-pad">
    <div class="container">
      <div class="row align-items-lg-center">
        <div class="col-lg-6">
          <figure class="facebook-intro-img mb-4 mb-lg-0 text-center text-lg-start">
            <img class="img-fluid" src="../../assets/images/facebook/facebook-commit-img.png" alt="" />
          </figure>
        </div>

        <div class="col-lg-6">
          <div class="facebook-intro-body">
            <h2 class="facebook-intro-title">Cam kết của Quangbapro</h2>
            <div class="facebook-intro-description">
              <span class="facebook-intro-description-icon">
                <img src="../../assets/images/facebook/facebook-icon-setting.svg" alt="">
              </span>
              <div class="facebook-intro-description-content">
                Quangbapro là đơn vị cung cấp dịch vụ quảng cáo Facebook Ads chuyên nghiệp hàng đầu với những giải pháp
                tôi ưu ngân sách mang lại hiệu quả tối đa.
              </div>
            </div>
            <div class="facebook-tabs">
              <ul class="group-list-decimal list-unstyled">
                <li>
                  <div class="decimal-badge">
                    <span class="decimal-number">1</span>
                  </div>
                  <div class="decimal-content">
                    Tiếp cận với hàng triệu khách hàng tiềm năng
                  </div>
                </li>
                <li>
                  <div class="decimal-badge">
                    <span class="decimal-number">2</span>
                  </div>
                  <div class="decimal-content">
                    Chiến lược quảng cáo dễ dàng tùy chỉnh theo mục tiêu
                  </div>
                </li>
                <li>
                  <div class="decimal-badge">
                    <span class="decimal-number">3</span>
                  </div>
                  <div class="decimal-content">
                    Tối ưu nội dung và gia tăng chuyển đổi khách hàng
                  </div>
                </li>
                <li>
                  <div class="decimal-badge">
                    <span class="decimal-number">4</span>
                  </div>
                  <div class="decimal-content">
                    Báo cáo kết quả chi tiết định kỳ theo tháng
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import { defineProps } from "vue";

const { item } = defineProps({
  item: {
    type: Object,
    default: () => ({}),
  },
});
</script>
