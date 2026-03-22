<template>
  <div class="topic-item">
    <div class="topic-header">
      <div class="topic-icon">
          <img :src="getImgUrl('../../../src/assets/images/knowledge', item.icon)" :alt="item.title" />
      </div>
      <h3 class="topic-title">{{ item.title }}</h3>
    </div>
    <div class="topic-body">
      <ul class="topic-list">
        <li v-for="(subItem, index) in item.items" :key="index">
          <i class="fa-regular fa-circle-check"></i>
          <span>{{ subItem }}</span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import getImgUrl from '@/utils/getUrlImg';

const props = defineProps({
  item: {
    type: Object,
    default: () => ({})
  }
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.topic-item {
  background: white;
  border-radius: 20px;
  padding: 24px 24px 12px;
//   box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
  height: 100%;
  transition: all 0.3s ease;
  
  &:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  }
}

.topic-header {
  display: flex;
  align-items: center;
  gap: 16px;
  padding-bottom: 12px;
}

.topic-icon {
  @include square(80px);
  border-radius: 50%;
  background: #f0f8ff; // Light blue background for icon
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  
  img {
    @include square(48px);
    object-fit: contain;
  }
}

.topic-title {
  font-size: 20px;
  font-weight: 700;
  color: $primary-1;
  margin: 0;
  text-transform: uppercase;
}

.topic-list {
  list-style: none;
  padding: 0;
  margin: 0;
  
  li {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 0;
    border-bottom: 1px solid $grey-4;
    font-weight: 500;
    &:last-child {
      border-bottom: none;
    }
    
    i {
      color: $primary-1;
    }
  }
}
</style>
