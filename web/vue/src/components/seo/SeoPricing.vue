<template>
  <section class="section-seo-pricing section-pad">
    <div class="container">
      <div class="seo-pricing-box">
        <SectionTitle
          :headingTitle="headingSection.headingTitle"
          :subTitle="headingSection.subTitle"
        />
        <swiper
          :breakpoints="breakpointSlide"
          :modules="modules"
          class="seo-pricing-swiper"
        >
          <swiper-slide v-for="(pkg, index) in item.packages" :key="item.id">
            <div class="pricing-card" :class="{ featured: pkg.featured }">
              <div class="pricing-card-layout">
                <div
                  class="pricing-price"
                  :class="`pricing-price-${pkg.color}`"
                >
                  {{ pkg.price }}
                </div>
                <div class="pricing-name" :class="`pricing-name-${pkg.color}`">
                  {{ pkg.name }}
                </div>
                <ul class="pricing-features list-unstyled">
                  <li
                    v-for="(feature, fIndex) in pkg.features"
                    :key="fIndex"
                    class="pricing-feature-item"
                  >
                    <i class="feature-icon"></i>
                    <span class="feature-text">{{ feature }}</span>
                  </li>
                </ul>
              </div>
              <div class="pricing-cta text-center">
                <a href="#" class="btn btn-green-color btn-custom rounded-pill">
                  <i class="fa-regular fa-pen-to-square"></i>
                  Tư vấn ngay
                </a>
              </div>
            </div>
          </swiper-slide>
        </swiper>
      </div>
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import { defineProps } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import SectionTitle from "@/components/SectionTitle.vue";

const { item } = defineProps({
  item: {
    type: Object,
    default: () => ({}),
  },
});
const headingSection = {
  headingTitle: {
    textPrimary: "BẢNG GIÁ DỊCH VỤ SEO",
    textDangler: "",
  },
  subTitle:
    "Quangbapro đưa ra các gói dịch vụ SEO với chi phí tối ưu - hiệu quả tối đa nhất",
};

const breakpointSlide = {
  0: {
    slidesPerView: 1.2,
    spaceBetween: 10,
  },
  640: {
    slidesPerView: 1.8,
    spaceBetween: 10,
  },
  768: {
    slidesPerView: 2.25,
    spaceBetween: 10,
  },
  992: {
    slidesPerView: 3,
    spaceBetween: 10,
  },
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.section-seo-pricing {
  // background: linear-gradient(135deg, #fdd835 0%, #fbc02d 100%);
  position: relative;
  overflow: hidden;
  background: url("@/assets/images/seo/seo-pricing-bg.png") no-repeat center
    center/cover;
  // &::before {
  //   content: "";
  //   position: absolute;
  //   top: 0;
  //   left: 0;
  //   width: 100%;
  //   height: 100%;
  //   background: url("@/assets/images/seo/seo-pricing-bg.png") no-repeat center
  //     center/cover;
  // }
  & > .container {
    position: relative;
    z-index: 1;
  }
}
// .seo-pricing-list {
//   margin-left: -15px;
//   margin-right: -15px;
//   & > * {
//     padding-left: 15px;
//     padding-right: 15px;
//   }
// }
.seo-pricing-swiper {
  :deep(.swiper-slide) {
    height: unset;
    padding: 16px 10px;
  }
  :deep(.swiper-wrapper) {
    height: unset;
  }
}
.pricing-card {
  background: #fff;
  border-radius: 48px;
  overflow: hidden;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  // box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
  box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.12);
  transition: all 0.3s ease;
  padding-bottom: 24px;
  &:hover {
    transform: scale(1.04);
    // box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2);
  }
  &.featured {
    // transform: scale(1.05);
    // @include breakpoint(lg) {
    //   transform: scale(1.08);
    // }
    // &:hover {
    //   transform: scale(1.05) translateY(-8px);
    //   @include breakpoint(lg) {
    //     transform: scale(1.08) translateY(-8px);
    //   }
    // }
  }
}
.pricing-price {
  padding: 12px;
  text-align: center;
  font-size: 32px;
  font-weight: 700;
  color: #015fc9;
  background: #fff;
  @include breakpoint(md) {
    padding: 24px;
  }
  &-blue {
    color: #015fc9;
  }
  &-orange {
    color: #fbbc05;
  }
  &-red {
    color: #ff4e42;
  }
}
.pricing-name {
  padding: 10px;
  text-align: center;
  font-size: 24px;
  font-weight: 600;
  color: #fff;
  @include breakpoint(md) {
    padding: 16px;
  }
  &-blue {
    background: #4285f4;
  }
  &-orange {
    background: #fbbc05;
  }
  &-red {
    background: #ff4e42;
  }
}

.pricing-features {
  margin-bottom: 0;
  padding: 8px 24px 90px 24px;
  @include breakpoint(md) {
    padding-top: 14px;
    padding-bottom: 30px;
  }
}
.pricing-feature-item {
  display: flex;
  align-items: center;
  padding-top: 16px;
  padding-bottom: 16px;
  font-size: 16px;
  line-height: 1.4;
  border-bottom: 1px solid #eeeeee;
  .feature-icon {
    width: 20px;
    height: 20px;
    min-width: 20px;
    background-image: url(../../assets/images/icons/ico-check-circle-color.svg);
  }
  .feature-text {
    width: calc(100% - 20px);
    padding-left: 14px;
  }
}
</style>
