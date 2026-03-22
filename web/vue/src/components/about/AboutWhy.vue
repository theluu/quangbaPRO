<template>
  <div class="about-why section-pad bg-grey-1">
    <div class="container">
      <div class="content-wrapper mx-auto">
        <h2 class="section-title fw-bold mb-5">{{ data.title }}</h2>
        
        <div v-if="data.content" class="why-content" v-html="data.content"></div>

        <div v-if="data.share" class="share-section d-flex align-items-center justify-content-end mt-5">
           <span class="share-label me-3 d-flex align-items-center">
             <i class="fa-light fa-share-nodes me-2"></i>
             {{ data.share.label }}
           </span>
           <div class="share-socials d-flex gap-2">
             <RouterLink v-for="social in data.share.socials" 
                :key="social.id" 
                :to="social.url" 
                class="share-btn d-flex align-items-center justify-content-center"
                target="_blank"
             >
               <i :class="social.icon"></i>
             </RouterLink>
           </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  data: {
    type: Object,
    required: true
  }
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.bg-light-grey {
  background-color: #f1f1f1;
}

.content-wrapper {
  max-width: 900px;
}

.section-title {
  font-size: 24px;
  @include breakpoint(md) {
    font-size: 28px;
  }
}

.why-content {
  :deep(h3) {
    font-size: 18px;
    font-weight: 700;
  }
  :deep(h3), :deep(p), :deep(ul) {
    margin-bottom: 24px;
  }
  :deep(ul) {
    &:not(:last-child) {
      margin-bottom: 24px;
    }
  }
}

.share-btn {
  @include square(30px);
  background-color: $black;
  color: $white;
  border-radius: 4px;
  @include transition();
  border-radius: 50%;
  &:hover {
    opacity: 0.8;
  }

  i {
    font-size: 14px;
  }
}
</style>
