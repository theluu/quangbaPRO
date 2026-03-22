<template>
  <div class="theme position-relative">
    <div class="theme-img">
      <RouterLink :to="item.link">
        <img :src="getImgUrl('../../../src/assets/images/themes',item.src)" :alt="item.alt" />
      </RouterLink>
    </div>
    <h3 class="theme-title fw-bold"><RouterLink :to="item.link">{{ item.title }}</RouterLink></h3>
    <div class="theme-price fw-bold text-danger-color-2">{{ item.price }}</div>
    <RouterLink
      class="btn rounded-pill btn-primary-color px-4 py-2"
      v-if="item.link"
      :to="item.link"
    >
      <span class="btn-icon">
        <img src="@/assets/images/icons/angle-right-circle.svg" alt="" />
      </span>
      Xem chi tiết
    </RouterLink>
  </div>
</template>
<script setup>
import { defineProps } from "vue";
import getImgUrl from '@/utils/getUrlImg'
const { item } = defineProps({
  item: {
    type: Object,
    default: () => {},
  },
});
</script>
<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.theme-img {
  margin-bottom: 16px;
  img {
    width: 100%;
  }
}
.theme-title {
  font-size: 16px;
  margin-bottom: 12px;
}
.theme-price {
  margin-bottom: 12px;
}
</style>
