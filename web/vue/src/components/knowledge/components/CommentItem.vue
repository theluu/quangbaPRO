<template>
  <div class="comment-item">
    <div class="comment-avatar">
      <img :src="getImgUrl('../../../src/assets/images/avatars', comment.avatar)" :alt="comment.name" />
    </div>
    <div class="comment-content">
      <div class="comment-meta d-flex align-items-center">
        <span class="comment-author fw-bold me-2">{{ comment.name }}</span>
        <span class="comment-separator fw-bold me-2">-</span>
        <span class="comment-date fw-bold">{{ comment.date }}</span>
      </div>
      <div class="comment-text">
        {{ comment.content }}
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import getImgUrl from '@/utils/getUrlImg';

const props = defineProps({
  comment: {
    type: Object,
    required: true
  }
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.comment-item {
  display: flex;
  gap: 20px;
  border-bottom: 1px dashed $grey-6;
  padding-bottom: 24px;
  @include breakpoint("md") {
    gap: 24px;
  }
}

.comment-avatar {
  flex-shrink: 0;
  width: 60px;
  height: 60px;
  
  img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
  }
  
  @include breakpoint("md") {
    width: 80px;
    height: 80px;
  }
}

.comment-content {
  flex: 1;
}

.comment-meta {
  margin-bottom: 12px;
}
</style>
