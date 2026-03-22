<template>
  <!-- section solutions -->
  <section class="section-design-web-solutions section-pad">
    <div class="container">
      <SectionTitle 
        :headingTitle="headingSection.headingTitle"
        :subTitle="headingSection.subTitle"
      />
      <div class="row">
        <div class="col-md-6 col-lg-3 col-item mb-4 mb-lg-0" v-for="solution in props.items" :key="solution.id">
          <SolutionItem :item="solution" />
        </div>
      </div>
    </div>
  </section>
  <!-- e: section solutions -->
</template>

<script setup>
import { defineProps } from "vue";
import SectionTitle from '@/components/SectionTitle.vue';
import SolutionItem from './components/SolutionItem.vue';

const props = defineProps({
  items: {
    type: Array,
    default: () => []
  }
});

const headingSection = {
  headingTitle: {
    textPrimary: "GIẢI PHÁP",
    textDangler: "THIẾT KẾ WEBSITE ĐỘC QUYỀN"
  },
  subTitle: 'Quangbapro mang đến cho bạn những giải pháp tối ưu để xây dựng một website chuyên nghiệp, thu hút khách hàng và thúc đẩy doanh số'
};

</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.section-design-web-solutions {
  .row {
    margin-top: 40px;
  }
}
.col-item {
  &:first-child {
    :deep(.solution-item) {
      border-radius: 160px 160px 160px 0px;
    }
  }
  &:nth-child(2) {
    :deep(.solution-item) {
      border-radius: 160px 0 160px 160px;
    }
  }
  &:nth-child(3) {
    :deep(.solution-item) {
      border-radius: 160px 160px 0 160px;
    }
  }
  &:nth-child(4) {
    :deep(.solution-item) {
      border-radius: 0 160px 160px 160px;
    }
  }
}
</style>
