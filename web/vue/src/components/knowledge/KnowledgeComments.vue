<template>
  <div class="knowledge-comments mt-4 mt-lg-5">
    <KnowledgeSectionTitle icon="fa-regular fa-message-dots" title="Cảm nhận về bài viết" />
    
    <div class="comment-list">
      <div v-if="!items.length" class="comment-empty">
        Chưa có bình luận nào cho bài viết này.
      </div>
      <div v-for="comment in items" :key="comment.id" class="comment-item-group">
        <CommentItem :comment="comment" />
        
        <!-- Replies -->
        <div v-if="comment.replies && comment.replies.length" class="comment-replies">
          <CommentItem 
            v-for="reply in comment.replies" 
            :key="reply.id" 
            :comment="reply" 
            class="reply-item" 
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import KnowledgeSectionTitle from '@/components/knowledge/components/KnowledgeSectionTitle.vue';
import CommentItem from '@/components/knowledge/components/CommentItem.vue';

const props = defineProps({
  items: {
    type: Array,
    default: () => []
  }
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.comment-list {
    border-top: 1px solid $grey-6;
    padding-top: 24px;
}

.comment-empty {
    color: $grey-5;
}
.comment-item-group {
    margin-bottom: 24px;
    &:last-child {
        margin-bottom: 0;
    }
}

.comment-replies {
    margin-top: 24px;
    

    .reply-item {
        margin-bottom: 24px;
        padding-left: 40px;    
        @include breakpoint("md") {
            padding-left: 80px;
        }
        &:last-child {
            margin-bottom: 0;
        }
    }
}
</style>
