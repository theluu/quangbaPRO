<template>
  <div class="commitment-item position-relative text-center text-white">
    <img :src="getImgUrl('../../../src/assets/images/design-web',props.item.icon)" :alt="props.item.title" />
    <h3 class="commitment-title fw-semibold mb-0">{{ props.item.title }}</h3>
    <div v-if="props.item.desc" class="commitment-desc mt-3">{{ props.item.desc }}</div>
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
.commitment-item {
    padding: 16px 40px;
    display: block;
    min-height: 100%;
}
.commitment-title {
  margin-top: 20px;
  font-size: 16px;
}

</style>
