<template>
    <div class="solution-item">
        <div class="solution-icon">
            <img :src="getImgUrl('../../../src/assets/images/design-web',item.icon)" :alt="item.title">
        </div>
        <h4 class="solution-title fw-semibold">{{ item.title }}</h4>
        <p class="solution-desc">{{ item.desc }}</p>
    </div>
</template>
<script setup>
import { defineProps } from "vue";
import getImgUrl from '@/utils/getUrlImg'
const props = defineProps({
  item: {
    type: Object,
    default: {}
  }
});
</script>
<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.solution-item {
  text-align: center;
  // padding: 40px 20px;
  background: white;
  border-radius: 20px;
  height: 100%;
  transition: all 0.3s ease;
  padding: 64px 24px 110px;
  background: radial-gradient(50% 50% at 50% 50%, #FFFFFF 0%, #EEEEEE 100%);  
  &:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  }
}

.solution-icon {
  @include square(72px);
  margin: 0 auto 16px;
  border-radius: 50%;
  background-color: $white;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
}

.solution-title {
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 16px;
  line-height: 1.4;
}
</style>