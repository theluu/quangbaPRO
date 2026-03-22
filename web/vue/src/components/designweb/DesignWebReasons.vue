<template>
  <!-- section reasons -->
  <section class="section-design-web-reasons bg-primary section-pad">
    <div class="section-inner">
      <div class="container">
        <SectionTitle 
          :headingTitle="headingSection.headingTitle"
          :subTitle="headingSection.subTitle"
          :isWhiteText="true"
        />
        <div class="row row-gap-y">
          <div class="col-md-6 col-lg-4" v-for="item in items" :key="item.id">
            <FeaturedItem :item="item" :srcRoot="srcRoot" />
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- e: section reasons -->
</template>

<script setup>
import SectionTitle from '@/components/SectionTitle.vue';
import FeaturedItem from '@/components/home/components/FeaturedItem.vue';
import { defineProps } from "vue";

const { items } = defineProps({
  items: {
    type: Array,
    default: () => [],
  },
});

const srcRoot = '../../../src/assets/images/design-web';

const headingSection = {
  headingTitle: {
    textPrimary: "LỰA CHỌN",
    textDangler: "QUANGBAPRO"
  },
  subTitle: 'Bước đi đúng đắn của Doanh nghiệp'
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.row-gap-y {
  gap: 24px 0;
}
.section-design-web-reasons {
  background: radial-gradient(50% 50% at 50% 50%, #0076CA 0%, #0064AC 100%);
}
.section-inner {
  background: url('@/assets/images/marketing/bg-marketing.png') no-repeat bottom right;
}
:deep(.section-title .text-danger-color) {
    color: $danger-1 !important;
  }
</style>
