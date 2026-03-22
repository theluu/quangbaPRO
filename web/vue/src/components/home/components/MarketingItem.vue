<template>
  <div class="marketing-item">
    <div class="marketing-item-header d-flex align-items-center">
      <div class="marketing-item-icon">
        <img :src="getImgUrl('../../../src/assets/images/marketing',item.src)" :alt="item.title"/>
      </div>
      <h3 class="marketing-item-title mb-0 fs-5 fw-semibold ps-3 flex-fill">{{ item.title }}</h3>
    </div>
    <div class="marketing-item-desc">{{ item.desc }}</div>
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

.marketing-item-header {
  margin-bottom: 18px
}
.marketing-item-icon {
  @include flexWidth(60px);
}
</style>
