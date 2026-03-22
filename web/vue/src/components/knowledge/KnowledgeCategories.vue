<template>
  <div class="section-knowledge-categories">
    <div class="container">
      <div class="categories-card">
        <div class="row g-0">
          <div 
            class="col-12 col-sm-6 col-lg-3 category-item-wrapper" 
            v-for="(item, index) in items" 
            :key="item.id"
          >
            <div class="category-item">
              <div class="category-icon">
                 <img :src="getImgUrl('../../../src/assets/images/knowledge', item.icon)" :alt="item.title" />
              </div>
              <div class="category-info">
                <h3 class="category-title">{{ item.title }}</h3>
                <p class="category-count">{{ item.count }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import getImgUrl from '@/utils/getUrlImg';

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

.section-knowledge-categories {
  margin-top: -115px;
  position: relative;
  z-index: 2;
}

.categories-card {
  background-color: $white;
  border-radius: 24px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
  overflow: hidden;
  border: 1px solid $grey-6;
}

.category-item-wrapper {
  border-right: 1px solid $grey-6;
  border-bottom: 1px solid $grey-6;

  // Logic for 4 columns on Large screens
  @include breakpoint(lg) {
    // Remove right border for every 4th item (4, 8, 12...)
    &:nth-child(4n) {
      border-right: none;
    }
    // Remove bottom border for the last row (assuming 8 items -> 5,6,7,8)
    // Or more generic: last 4 items
    &:nth-last-child(-n+4) {
      border-bottom: none;
    }
  }

  // Logic for 2 columns on Small/Medium screens
  @media (min-width: 576px) and (max-width: 991px) {
    &:nth-child(2n) {
      border-right: none;
    }
    &:nth-last-child(-n+2) {
      border-bottom: none;
    }
  }

  // Logic for 1 column on Extra Small screens
  @media (max-width: 575px) {
    border-right: none;
    &:last-child {
      border-bottom: none;
    }
  }
}

.category-item {
  padding: 32px 24px;
  display: flex;
  align-items: center;
  gap: 16px;
  height: 100%;
  transition: all 0.3s ease;
  cursor: pointer;

  &:hover {
    background-color: #f8f9fa;
    
    .category-title {
      color: $primary-1; // Assuming primary color variable exists
    }
  }
}

.category-icon {
  width: 48px;
  height: 48px;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;

  img {
    width: 100%;
    height: 100%;
    object-fit: contain;
  }
}

.category-info {
  flex-grow: 1;
}

.category-title {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 4px;
  text-transform: uppercase;
}

.category-count {
  margin: 0;
}
</style>
