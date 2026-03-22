<template>
  <section class="section-seo-services section-pad">
    <div class="container">
      <div class="seo-services">
        <SectionTitle
          :headingTitle="headingSection.headingTitle"
          :subTitle="headingSection.subTitle"
        />
        <div
          v-if="item.services && item.services.length"
          class="row seo-services-list"
        >
          <div
            v-for="(service, index) in item.services"
            :key="index"
            class="col-12 col-lg-6"
          >
            <div class="service-card">
              <div class="service-icon">
                <i :class="service.icon"></i>
              </div>
              <div class="service-header text-center">
                <h3 class="service-title">{{ service.title }}</h3>
                <p class="service-description">{{ service.description }}</p>
              </div>
              <ul
                v-if="service.features && service.features.length"
                class="service-features list-unstyled mb-0"
              >
                <li
                  v-for="(feature, fIndex) in service.features"
                  :key="fIndex"
                  class="service-feature-item"
                >
                  <i class="fa-light fa-circle-check feature-icon"></i>
                  <span class="feature-text">{{ feature.text }}</span>
                </li>
              </ul>
              <div class="service-cta mt-4 text-center">
                <a href="#" class="btn btn-green-color btn-custom rounded-pill">
                  <i class="fa-regular fa-pen-to-square"></i>
                  Đăng ký tư vấn
                </a>
              </div>
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
import SectionTitle from "@/components/SectionTitle.vue";

const { item } = defineProps({
  item: {
    type: Object,
    default: () => ({}),
  },
});

const headingSection = {
  headingTitle: {
    textPrimary: "Dịch vụ",
    textDangler: " seo tại QUangbapro",
  },
  subTitle:
    "Dịch vụ SEO tại Quangbaprro là giải pháp giúp doanh nghiệp tăng thứ hạng website trên Google, thu hút khách hàng tiềm năng và gia tăng doanh thu một cách tự nhiên, bền vững.",
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.seo-services {
  max-width: 1280px;
  margin-left: auto;
  margin-right: auto;
}
.seo-services-list {
  margin-left: -15px;
  margin-right: -15px;
  & > * {
    padding-left: 15px;
    padding-right: 15px;
    margin-bottom: 30px;
  }
}
.service-card {
  background: #ffffff;
  background: radial-gradient(
    circle,
    rgba(255, 255, 255, 1) 0%,
    rgba(238, 238, 238, 1) 100%
  );
  border-top-left-radius: 80px;
  border-top-right-radius: 80px;
  border-bottom-right-radius: 80px;
  padding: 24px;
  height: 100%;
  transition: all 0.3s ease;
  &:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
  }
}
.service-icon {
  height: 72px;
  margin-bottom: 24px;
  text-align: center;
  i {
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
}
.service-header {
  margin-bottom: 24px;
  padding-bottom: 24px;
  border-bottom: 1px solid #dddddd;
}
.service-title {
  font-size: 24px;
  line-height: 1.5;
  font-weight: 700;
  margin-bottom: 24px;
  text-transform: uppercase;
}
.service-description {
  font-size: 16px;
  line-height: 1.6;
  margin-bottom: 0;
}

.service-feature-item {
  display: flex;
  align-items: flex-start;
  gap: 16px;
  margin-bottom: 24px;
  &:last-child {
    margin-bottom: 0;
  }
  .feature-icon {
    flex: 0 0 18px;
    font-size: 18px;
    color: #015fc9;
    position: relative;
    top: 5px;
    @include breakpoint(md) {
      flex: 0 0 20px;
      font-size: 20px;
    }
  }
  .feature-text {
    font-size: 16px;
    line-height: 1.6;
  }
}
.service-icon-1 {
  background-image: url(../../assets/images/icons/service-icon-1.svg);
  width: 72px;
  height: 72px;
}
.service-icon-2 {
  background-image: url(../../assets/images/icons/service-icon-2.svg);
  width: 72px;
  height: 72px;
}
.service-icon-3 {
  background-image: url(../../assets/images/icons/service-icon-3.svg);
  width: 72px;
  height: 72px;
}
.service-icon-4 {
  background-image: url(../../assets/images/icons/service-icon-4.svg);
  width: 72px;
  height: 72px;
}
// .service-cta {

//   .btn-service {
//     display: inline-flex;
//     align-items: center;
//     justify-content: center;
//     gap: 8px;
//     padding: 10px 20px;
//     font-size: 14px;
//     font-weight: 600;
//     border-radius: 50px;
//     background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
//     border: none;
//     color: white;
//     text-decoration: none;
//     transition: all 0.3s ease;
//     box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
//     width: 100%;

//     @include breakpoint(md) {
//       padding: 12px 24px;
//       font-size: 15px;
//     }

//     &:hover {
//       transform: translateY(-2px);
//       box-shadow: 0 6px 16px rgba(16, 185, 129, 0.35);
//       background: linear-gradient(135deg, #10b981 0%, #059669 100%);
//     }

//     &:active {
//       transform: translateY(0);
//     }

//     i {
//       font-size: 16px;
//     }
//   }
// }
</style>
