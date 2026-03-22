<template>
  <div class="knowledge-related-posts mt-4 mt-lg-5">
     <KnowledgeSectionTitle :icon="icon" :title="title" />
     <div class="row g-4">
        <div class="col-md-6 col-lg-4" v-for="item in items" :key="item.id">
           <NewsItem :item="item" />
        </div>
     </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import NewsItem from '@/components/home/components/NewsItem.vue';
import KnowledgeSectionTitle from '@/components/knowledge/components/KnowledgeSectionTitle.vue';

const props = defineProps({
  items: {
    type: Array,
    default: () => []
  },
  title: {
    type: String,
    default: 'Tin liên quan'
  },
  icon: {
    type: String,
    default: 'fa-regular fa-newspaper'
  }
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

</style>
