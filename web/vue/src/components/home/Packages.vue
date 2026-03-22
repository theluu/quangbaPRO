<template>
  <!-- section -->
  <section class="section-package bg-grey-1 section-pad">
    <div class="container">
      <SectionTitle
        :subTitle="headingSection.subTitle"
        :headingCate="headingSection.headingCate"
        :headingTitle="headingSection.headingTitle"
      />
      <swiper :slidesPerView="'auto'" :spaceBetween="24" class="partnersSwiper">
        <swiper-slide v-for="item in items" :key="item.id">
          <PackageItem :item="item" />
        </swiper-slide>
      </swiper>
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import SectionTitle from "@/components/SectionTitle.vue";
import PackageItem from "./components/PackageItem.vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import { defineProps } from "vue";

const { items } = defineProps({
  items: {
    type: Array,
    default: () => [],
  },
});

const headingSection = {
  headingCate: {
    iconClass: "ico-slider-horizontal",
    text: "Dịch vụ thiết kế web",
  },
  headingTitle: {
    textPrimary: "Bảng giá",
    textDangler: "thiết kế website trọn gói",
  },
  subTitle:
    "Công nghệ web hàng đầu - Tiết kiệm chi phí - Bàn giao web nhanh chóng",
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.partnersSwiper {
  :deep(.swiper-slide) {
    width: 306px !important;
    height: unset;
  }
  :deep(.swiper-wrapper) {
    height: unset;
  }
}
</style>
