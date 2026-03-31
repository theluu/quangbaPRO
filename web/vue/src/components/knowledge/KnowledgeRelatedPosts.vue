<template>
  <div class="knowledge-related-posts mt-4 mt-lg-5">
     <KnowledgeSectionTitle :icon="icon" :title="title" />
     <swiper
        :modules="[]"
        :spaceBetween="24"
        :breakpoints="breakpoints"
        class="related-posts-swiper"
     >
        <swiper-slide v-for="item in items" :key="item.id">
           <NewsItem :item="item" />
        </swiper-slide>
     </swiper>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
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

const breakpoints = {
  0: {
    slidesPerView: 1,
  },
  768: {
    slidesPerView: 2,
  },
  1200: {
    slidesPerView: 3,
  },
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

:deep(.swiper-slide) {
  height: auto;
}

</style>
