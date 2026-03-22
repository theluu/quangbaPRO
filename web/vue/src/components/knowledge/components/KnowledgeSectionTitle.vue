<template>
  <div class="d-flex align-items-center mb-4 title-block">
     <i :class="[icon, 'me-2']"></i>
     <h2 class="mb-0 fw-bold flex-fill ps-1">{{ Drupal.t(title) }}</h2>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  title: {
    type: String,
    required: true
  },
  icon: {
    type: String,
    required: true
  }
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.title-block {
    font-size: 28px;
    @include breakpoint("md") {
        font-size: 32px;
    }
    h2 {
      font-size: 28px;
      @include breakpoint("md") {
          font-size: 32px;
      }
    }
}
</style>
