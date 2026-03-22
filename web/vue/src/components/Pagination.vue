<template>
  <div class="pagination-wrapper text-center mt-5">
    <ul class="pagination d-inline-flex align-items-center mb-0">
      <!-- Previous Button -->
      <li class="page-item" :class="{ disabled: currentPage === 1 }">
        <RouterLink class="page-link" to="#" @click.prevent="changePage(currentPage - 1)">
          <i class="fa-solid fa-chevron-left"></i>
        </RouterLink>
      </li>

      <!-- Page 1 -->
      <li class="page-item" :class="{ active: currentPage === 1 }">
        <RouterLink class="page-link" to="#" @click.prevent="changePage(1)">1</RouterLink>
      </li>

      <!-- Page 2 -->
      <li class="page-item" :class="{ active: currentPage === 2 }" v-if="totalPages >= 2">
        <RouterLink class="page-link" to="#" @click.prevent="changePage(2)">2</RouterLink>
      </li>

      <!-- Page 3 -->
      <li class="page-item" :class="{ active: currentPage === 3 }" v-if="totalPages >= 3">
        <RouterLink class="page-link" to="#" @click.prevent="changePage(3)">3</RouterLink>
      </li>

      <!-- Ellipsis if more than some pages (simple logic for now matching the design) -->
      <li class="page-item" v-if="totalPages > 4">
        <span class="page-link">...</span>
      </li>

      <!-- Last Page -->
      <li class="page-item" :class="{ active: currentPage === totalPages }" v-if="totalPages > 3">
        <RouterLink class="page-link" to="#" @click.prevent="changePage(totalPages)">{{ totalPages }}</RouterLink>  
      </li>

      <!-- Next Button -->
      <li class="page-item" :class="{ disabled: currentPage === totalPages }">
        <RouterLink class="page-link" to="#" @click.prevent="changePage(currentPage + 1)">
          <i class="fa-solid fa-chevron-right"></i>
        </RouterLink>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  currentPage: {
    type: Number,
    default: 1
  },
  totalPages: {
    type: Number,
    default: 10
  }
});

const emit = defineEmits(['page-change']);

const changePage = (page) => {
  if (page >= 1 && page <= props.totalPages) {
    emit('page-change', page);
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.pagination-wrapper {
  .pagination {
    gap: 8px;
    
    .page-item {
      .page-link {
        border: none;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: $text-base-color;
        font-weight: 600;
        background: transparent;
        transition: all 0.3s ease;
        text-decoration: none;
        border: 1px solid $grey-6;
        &:hover {
          background-color: $primary-1;
          color: $white;
          border-color: $primary-1;
        }
      }
      
      &.active {
        .page-link {
          background-color: $primary-1;
          color: $white;
          border-color: $primary-1;
        }
      }
      
      &.disabled {
        .page-link {
          background-color: transparent;
          color: $grey-6;
          cursor: not-allowed;
          pointer-events: none;
        }
      }
    }
  }
}
</style>
