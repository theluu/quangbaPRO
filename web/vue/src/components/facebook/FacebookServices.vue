<template>
  <section class="section-facebook-services section-pad">
    <div class="container">
      <div class="facebook-services">
        <SectionTitle :headingTitle="headingSection.headingTitle" :subTitle="headingSection.subTitle" />
        <div v-if="item.services && item.services.length" class="row facebook-services-list">
          <div v-for="(service, index) in item.services" :key="index" class="col-12 col-lg-6">
            <div class="facebook-service-card">
              <div class="facebook-service-icon">
                <i :class="service.icon"></i>
              </div>
              <div class="facebook-service-header text-center">
                <h3 class="facebook-service-title">{{ service.title }}</h3>
                <p class="facebook-service-description">{{ service.description }}</p>
              </div>
              <ul v-if="service.features && service.features.length"
                class="facebook-service-features list-unstyled mb-0">
                <li v-for="(feature, fIndex) in service.features" :key="fIndex" class="facebook-service-feature-item">
                  <i class="fa-light fa-circle-check feature-icon"></i>
                  <span class="feature-text" v-html="feature.text"></span>
                </li>
              </ul>
              <div class="facebook-service-cta mt-4 text-center">
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
    textPrimary: "Lựa chọn ",
    textDangler: "gói dịch vụ facebook ad",
  },
  subTitle:
    "Lorem ipsum dolor sit amet consectetur. Consectetur adipiscing diam non ut purus rhoncus congue. Et morbi a risus cursus eget. Mus massa purus nam velit elit scelerisque. Leo quis congue faucibus fringilla risus odio consequat.",
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.section-facebook-services {
  background-color: #F8F8F8;
}

.facebook-services {
  max-width: 1280px;
  margin-left: auto;
  margin-right: auto;
}

.facebook-services-list {
  margin-left: -15px;
  margin-right: -15px;

  &>* {
    padding-left: 15px;
    padding-right: 15px;
    margin-bottom: 30px;
  }
}

.facebook-service-card {
  background: #ffffff;
  background: radial-gradient(circle,
      rgba(255, 255, 255, 1) 0%,
      rgba(238, 238, 238, 1) 100%);
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

.facebook-service-icon {
  height: 72px;
  margin-bottom: 24px;
  text-align: center;

  i {
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
}

.facebook-service-header {
  margin-bottom: 24px;
  padding-bottom: 24px;
  border-bottom: 1px solid #dddddd;
}

.facebook-service-title {
  font-size: 24px;
  line-height: 1.5;
  font-weight: 700;
  margin-bottom: 24px;
  text-transform: uppercase;
}

.facebook-service-description {
  font-size: 16px;
  line-height: 1.6;
  margin-bottom: 0;
}

.facebook-service-feature-item {
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

.facebook-service-icon-1 {
  background-image: url(../../assets/images/icons/facebook-service-icon-1.svg);
  width: 72px;
  height: 72px;
}

.facebook-service-icon-2 {
  background-image: url(../../assets/images/icons/facebook-service-icon-2.svg);
  width: 72px;
  height: 72px;
}

.facebook-service-icon-3 {
  background-image: url(../../assets/images/icons/facebook-service-icon-3.svg);
  width: 72px;
  height: 72px;
}

.facebook-service-icon-4 {
  background-image: url(../../assets/images/icons/facebook-service-icon-4.svg);
  width: 72px;
  height: 72px;
}

// .facebook-service-cta {

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
// }</style>
