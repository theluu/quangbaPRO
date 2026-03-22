<template>
  <section class="knowledge-topics section-pad bg-grey-1">
    <div class="container">
      <SectionTitle 
        :headingTitle="headingTitle"
      />
      
      <div class="row g-4">
        <div 
          class="col-md-6 col-lg-6 col-xl-3"
          v-for="item in items"
          :key="item.id"
        >
          <TopicItem :item="item" />
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { defineProps } from 'vue';
import SectionTitle from '@/components/SectionTitle.vue';
import TopicItem from '@/components/knowledge/components/TopicItem.vue';

const headingTitle = {
  textPrimary: "KHÁM PHÁ CÁC CHỦ ĐỀ",
  textDangler: ""
};

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
</style>
