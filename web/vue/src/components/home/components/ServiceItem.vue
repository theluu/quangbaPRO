<template>
  <div class="service-item position-relative text-center">
    <RouterLink to="#">
      <img :src="getImgUrl('../../../src/assets/images/services',props.item.src)" :alt="props.item.title" />
      <h3 class="service-title fw-semibold mb-0">{{ props.item.title }}</h3>
      <div v-if="props.item.desc" class="service-desc">{{ props.item.desc }}</div>
    </RouterLink>
  </div>
</template>
<script setup>
import { defineProps } from "vue";
import getImgUrl from '@/utils/getUrlImg'
  const props = defineProps({
    item: {
      type: Object,
      default: () => {}
    }
  })
</script>
<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.service-item {
  min-height: 100%;
  a {
    padding: 16px;
    display: block;
    height: 100%;
  }
}
.service-title {
  margin-top: 20px;
  font-size: 16px;
}

</style>
