<template>
    <div class="process-item">
        <div class="process-icon">
            <img :src="getImgUrl('../../../src/assets/images/design-web',item.icon)" :alt="item.title" />
        </div>
        <div class="process-content">
            <h4 class="process-title">{{ item.title }}</h4>
            <p class="process-desc">{{ item.desc }}</p>
        </div>
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
.process-item {
  display: flex;
  position: relative;
  z-index: 1;
  border-radius: 24px;
  background-color: $white;
  border: 1px solid #DDDDDD;
  padding: 24px;
  margin-bottom: 12px;
  &:hover {
    .process-icon {
      transform: scale(1.1) rotate(5deg);
    }
  }
}

.process-icon {
  @include flexWidth(70px);
  transition: all 0.3s ease;
}

.process-content {
  flex: 1;
  padding-left: 16px;
}

.process-title {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 12px;
  line-height: 1.4;
}

.process-desc {
  line-height: 1.6;
  margin: 0;
}
</style>