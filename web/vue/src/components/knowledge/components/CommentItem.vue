<template>
  <div class="comment-item">
    <div class="comment-avatar">
      <img v-if="comment.avatar" :src="getImgUrl('../../../src/assets/images/avatars', comment.avatar)" :alt="comment.name" />
      <span v-else>{{ initials }}</span>
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
import { computed, defineProps } from 'vue';
import getImgUrl from '@/utils/getUrlImg';

const props = defineProps({
  comment: {
    type: Object,
    required: true
  }
});

const initials = computed(() => {
  return (props.comment?.name || '')
    .split(' ')
    .filter(Boolean)
    .slice(0, 2)
    .map(part => part.charAt(0).toUpperCase())
    .join('') || 'U';
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

  span {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background-color: $primary-1;
    color: $white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
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
