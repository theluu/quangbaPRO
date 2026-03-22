<template>
  <!-- section -->
  <section class="section-featured bg-grey-1 section-pad">
    <div class="container">
      <SectionTitle :subTitle="headingSection.subTitle" :headingTitle="headingSection.headingTitle"/>
      <div class="row row-gap-y">
        <div class="col-md-6 col-lg-4" v-for="item in items" :key="item.id">
          <FeaturedItem :item="item" />
        </div>
      </div>
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import SectionTitle from "@/components/SectionTitle.vue";
import FeaturedItem from "./components/FeaturedItem.vue";
import { defineProps } from "vue";

const { items } = defineProps({
  items: {
    type: Array,
    default: () => [],
  },
});

const headingSection = {
  headingTitle: {
    textPrimary: "Ưu điểm",
    textDangler: "khi dùng dịch vụ của Quangbapro",
  },
  subTitle: "Công nghệ web hàng đầu - Tiết kiệm chi phí - Bàn giao web nhanh chóng"
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.row-gap-y {
  gap: 24px 0;
}
</style>
