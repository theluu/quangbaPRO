<template>
  <div class="breadcrumb-container">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item" v-for="(crumb, index) in crumbs" :key="index" :class="{ active: index === crumbs.length - 1 }">
            <template v-if="index < crumbs.length - 1">
              <RouterLink :to="crumb.to">{{ crumb.text }}</RouterLink>
            </template>
            <span v-else>{{ crumb.text }}</span>
          </li>
        </ol>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

defineProps({
  crumbs: {
    type: Array,
    default: () => []
  }
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.breadcrumb {
  background: transparent;
  padding: 0;
  
  .breadcrumb-item {   
    a {
      color: $primary-1;
      text-decoration: none;
      
      &:hover {
        text-decoration: underline;
      }
    }
    
    &.active {
      color: $text-base-color;
    }
    
    + .breadcrumb-item {
      padding-left: 0.5rem;
      
      &::before {
        content: ">";
        color: $text-base-color;
      }
    }
  }
}
</style>
