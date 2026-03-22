<template>
  <section class="section-knowledge-list section-pad">
    <div class="container">
      <SectionTitle 
        :headingTitle="headingTitle"
      />
      <Breadcrumb :crumbs="breadcrumbs" class="mb-4 mb-md-5" />
      
      <div class="row gy-4">
        <div 
          class="col-md-6 col-lg-4"
          v-for="item in items"
          :key="item.id"
        >
          <NewsItem :item="item" />
        </div>
      </div>

      <!-- Pagination -->
      <Pagination :current-page="1" :total-pages="10" />
    </div>
  </section>
</template>

<script setup>
import { defineProps } from 'vue';
import SectionTitle from '@/components/SectionTitle.vue';
import Breadcrumb from '@/components/Breadcrumb.vue';
import Pagination from '@/components/Pagination.vue';
import NewsItem from '@/components/home/components/NewsItem.vue';

const headingTitle = {
  textPrimary: "KIẾN THỨC MỚI NHẤT",
  textDangler: ""
};

const breadcrumbs = [
  { text: "Trang chủ", to: "/" },
  { text: "Kiến thức", to: "/knowledge" }
];

const props = defineProps({
  items: {
    type: Array,
    default: () => []
  }
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
:deep(.section-heading) {
  margin-bottom: 24px;
} 
:deep(.news-item) {
  @include breakpoint(md) {
    min-height: 100%;
  } 
}
:deep(.breadcrumb) {
  justify-content: center;
}
</style>
