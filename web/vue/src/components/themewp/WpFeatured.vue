<template>
  <!-- section -->
  <section class="section-wpfeatured section-pad">
    <div class="container">
      <SectionTitle
        :subTitle="headingSection.subTitle"
        :headingTitle="headingSection.headingTitle"
      />
      <div class="row row-gap-y">
        <div class="col-md-6 col-lg-4" v-for="item in items" :key="item.id">
          <WpFeaturedItem :item="item" />
        </div>
      </div>
    </div>
  </section>

  <!-- e: section -->
</template>

<script setup>
import SectionTitle from "@/components/SectionTitle.vue";
import WpFeaturedItem from "./components/WpFeaturedItem.vue";
import { defineProps } from "vue";

const { items } = defineProps({
  items: {
    type: Array,
    default: () => [],
  },
});

const headingSection = {
  headingTitle: {
    textPrimary: "Ưu điểm web wordpress ",
    textDangler: "tại Quangbapro",
  },
  subTitle:
    "Công nghệ web hàng đầu - Tiết kiệm chi phí - Bàn giao web nhanh chóng",
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.section-wpfeatured {
  background: url(../../assets/images/themes/wp-featured-bg.png) no-repeat
    center center/cover;
}
.row-gap-y {
  gap: 24px 0;
}
</style>
