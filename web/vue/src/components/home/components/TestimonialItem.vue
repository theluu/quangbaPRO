<template>
  <div class="testimonial-item">
    <div class="testimonial-content">
      <div class="testimonial-header">
        <div class="testimonial-avatar">
          <img :src="getImgUrl('../../../src/assets/images/avatars',item.avatar)" :alt="item.name" />
        </div>
        <div class="testimonial-info">
          <div class="testimonial-rating">
            <i v-for="star in 5" :key="star" class="fa-solid fa-star"></i>
          </div>
          <h4 class="testimonial-name">{{ item.name }}</h4>
          <div class="testimonial-location">{{ item.location }}</div>
        </div>
      </div>
      <div class="testimonial-text fw-medium mb-4 text-center">{{ item.testimonial }}</div>
      <div class="testimonial-quote text-center">
        <svg width="31" height="40" viewBox="0 0 31 40" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M30.9763 15.4522C30.9763 6.91322 24.047 -3.20684e-06 15.4881 -2.45861e-06C6.92929 -1.71037e-06 2.82951e-06 6.91322 3.57601e-06 15.4522C4.32251e-06 23.9912 6.92929 30.9044 15.4881 30.9044C15.9432 30.9044 16.3837 30.8751 16.8241 30.8312C16.8828 34.61 12.8897 40 12.8897 40C32.415 29.2201 30.9763 15.4522 30.9763 15.4522Z" fill="#BFBFBF"/>
        </svg>
        <svg width="31" height="40" viewBox="0 0 31 40" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M30.9763 15.4522C30.9763 6.91322 24.047 -3.20684e-06 15.4881 -2.45861e-06C6.92929 -1.71037e-06 2.82951e-06 6.91322 3.57601e-06 15.4522C4.32251e-06 23.9912 6.92929 30.9044 15.4881 30.9044C15.9432 30.9044 16.3837 30.8751 16.8241 30.8312C16.8828 34.61 12.8897 40 12.8897 40C32.415 29.2201 30.9763 15.4522 30.9763 15.4522Z" fill="#BFBFBF"/>
        </svg>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import getImgUrl from '@/utils/getUrlImg'
const { item } = defineProps({
  item: {
    type: Object,
    default: () => {}
  }
})
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.testimonial-item {
  background: white;
  border-radius: 24px;
  padding: 0 24px 24px;
  border: 1px solid #DDDDDD;
  box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.12);
  height: 100%;
  // display: flex;
  // flex-direction: column;
  position: relative;
}

.testimonial-header {
  display: flex;
  align-items: center;
  gap: 16px;
  background-color: #F2F5F9;
  border-radius: 60px 24px 24px 60px;
  max-width: 85%;
  margin: 0 auto 24px;
}

.testimonial-avatar {
  width: 120px;
  height: 130px;
  border-radius: 120px 120px 0;
  overflow: hidden;
  flex-shrink: 0;
  background-color: $primary-1;  
  img {
    @include square(120px);
    border-radius: 50%;
    object-fit: cover;
  }
}

.testimonial-info {
  flex: 1;
}

.testimonial-rating {
  margin-bottom: 8px;
  
  i {
    color: #FFA500;
    font-size: 14px;
    margin-right: 2px;
  }
}

.testimonial-name {
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 4px;
  color: #333;
}

.testimonial-location {
  font-size: 14px;
  color: #666;
}

.testimonial-text {
  font-size: 17px;
  line-height: 1.4;
}

.testimonial-quote {
  svg {
    &:not(:last-child) {
      margin-right: 4px;
    }
  }
}
</style>
