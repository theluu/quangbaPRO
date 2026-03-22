<template>
  <!-- section benefits -->
  <section class="section-design-web-benefits">
    <div class="section-item section-pad"  v-for="(benefit, index) in props.items" :key="benefit.id">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-4 mb-lg-0" :class="{ 'order-lg-2': (index + 1) % 2 === 0 }">
            <div class="benefit-content">
              <h2 class="benefit-title fw-bold">{{ benefit.title }}</h2>
              <div class="benefit-items mb-4">
                <div class="benefit-item" v-for="(item, idx) in benefit.items" :key="idx">
                  <div class="benefit-icon">
                    <img :src="getImgUrl('../../../src/assets/images/design-web',item.icon)" :alt="benefit.title" />
                  </div>
                  <div class="benefit-text flex-fill ps-3">
                    <h4 class="fw-semibold">{{ item.title }}</h4>
                  </div>
                </div>
              </div>
              <template v-if="(index + 1) % 2 === 0">
                <RouterLink class="btn btn-green-color px-4 py-2 rounded-pill" to="#">
                  <i class="fa-light fa-phone-volume me-2"></i>
                  {{ Drupal.t('Gọi ngay 19001006') }}
                </RouterLink>
              </template>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="benefit-image">
              <img :src="getImgUrl('../../../src/assets/images/design-web',benefit.image)" :alt="benefit.title" />
            </div>
          </div>
        </div>
      </div>
    </div>    
  </section>
  <!-- e: section benefits -->
</template>

<script setup>
  import { defineProps } from "vue";
import getImgUrl from '@/utils/getUrlImg'

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

.section-design-web-benefits {
  
  .section-item {
    position: relative;
    background-repeat: no-repeat;
    background-position: center bottom;
    &::after {
      content: "";
      width: 100%;
      height: 100%;
      position: absolute;
      bottom: 0;
      right: 0;
      
    }
    &:nth-child(2n+1) {
      background-color: #FDF8F4;
      background-image: url('@/assets/images/design-web/bg-benefit-1.svg');      
      &::after {
        background: url("@/assets/images/design-web/wave.svg") no-repeat bottom right;
      }
    }
    &:nth-child(2n+2) {
      background-image: url('@/assets/images/design-web/bg-benefit-2.svg');
      &::after {
        background: url("@/assets/images/design-web/wave-2.svg") no-repeat bottom left;
      }
    }
    .container {
      position: relative;
      z-index: 2;
    }
  }
}
.benefit-title {
  font-size: 22px;
  margin-bottom: 24px;
  @include breakpoint(md) {
    font-size: 40px;
    margin-bottom: 36px;
  }
}
.benefit-items {
  display: flex;
  flex-wrap: wrap;
  gap: 1px;
  border-radius: 24px;
  overflow: hidden;
  background-color: #FFF3CF;
}
.benefit-item {
  @include flexWidth(100%);
  background-color: $white;
  padding: 32px 24px;
  display: flex;
  align-items: center;
  @include breakpoint(md) {
    @include flexWidth(calc(50% - 1px));
  }
}
.benefit-icon {
  @include flexWidth(48px);
}
.benefit-text {
  h4 {
    font-size: 18px;
  }
}
</style>
