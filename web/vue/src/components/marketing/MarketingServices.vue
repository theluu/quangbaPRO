<template>
  <div class="marketing-services-container">
    <div class="row gy-md-5 gy-4">
      <div 
        v-for="item in items" 
        :key="item.id" 
        class="col-12 col-lg-6"
      >
        <div class="service-card d-sm-flex">
          <!-- Left Image Section -->
          <div class="card-image-wrapper">
             <div class="image-blob d-flex align-items-center justify-content-center">
                 <img :src="getImgUrl('../../../src/assets/images/marketing',item.src)" :alt="item.title" class="img-fluid service-img" />
             </div>
          </div>

          <!-- Right Content Section -->
          <div class="card-content d-flex justify-content-center flex-column flex-grow-1">
            <h3 class="service-title mb-3">{{ item.title }}</h3>
            
            <!-- Features List (if available) -->
            <ul class="list-unstyled feature-list mb-3" v-if="item.features && item.features.length">
              <li v-for="(feature, idx) in item.features" :key="idx" class="d-flex align-items-start mb-2">
                <i class="fa-regular fa-circle-check text-primary mt-1 me-2 feature-icon"></i>
                 <span class="feature-text">{{ feature }}</span>
              </li>
            </ul>
            <!-- Fallback description if no features -->
            <p v-else class="service-desc mb-3 text-muted">
                {{ item.desc }}
            </p>

            <div class="service-btn">
              <RouterLink to="#" class="btn rounded-pill px-4 py-2 btn-green-color">
                <span class="fw-medium">{{ Drupal.t('Xem thêm') }}</span>
                <i class="fa-solid fa-arrow-right-long small ms-2"></i>
              </RouterLink>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import getImgUrl from '@/utils/getUrlImg'
const { items } = defineProps({
  items: {
    type: Array,
    default: () => []
  }
})
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.row {
  @include breakpoint(xl) {
    margin-left: -20px;
    margin-right: -20px;
    &>* {
      padding-left: 20px;
      padding-right: 20px;
    }
  }
}
.service-card {
  border: 1px solid $danger-3;
  border-radius: 30px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  overflow: hidden;
  @include breakpoint(md) {
    border-radius: 60px;
  }
  &:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
  }
}

.card-image-wrapper {
  flex-shrink: 0;
  @include breakpoint(sm) {
    flex-basis: 35%;
  }
}

.image-blob {
  width: 100%;
  height: 100%;
  border-radius: 30px;
  overflow: hidden;
  @include breakpoint(md) {
    border-radius: 60px;
  } 
  
  .service-img {
      object-fit: cover;
      width: 100%;
      height: 100%;
      border-radius: 30px;
      @include breakpoint(md) {
        border-radius: 60px;
      } 
  }
}
.card-content {
  padding: 24px;
}
.service-title {
  font-size: 24px;
  font-weight: 700;
}

.feature-list { 
  .feature-icon {
      color: $primary-1; 
  }
}

.service-desc {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
