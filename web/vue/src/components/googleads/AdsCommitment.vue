<template>
  <section class="ads-commitment section-pad">
    <div class="container">
      <!-- Section Heading -->
      <SectionTitle 
        :headingTitle="{ textPrimary: data.title, textDangler: '' }" 
        :subTitle="data.subTitle"
      />

      <div class="row align-items-center">
        <!-- Left Commitments -->
        <div class="col-lg-4">
          <div class="commitment-list">
            <template v-for="(item, index) in data.commitmentList" :key="item.id">
              <div 
                v-if="index < data.commitmentList.length / 2"
                class="commitment-item p-3 mb-4 d-flex align-items-center"
              >
                <div class="commitment-num me-3 d-flex align-items-center justify-content-center fw-bold">
                  {{ item.id }}
                </div>
                <div class="commitment-text fw-semibold">{{ item.text }}</div>
              </div>
            </template>
          </div>
        </div>

        <!-- Center Illustration -->
        <div class="col-lg-4 my-4 my-lg-0 text-center">
          <div class="commitment-illustration position-relative">
            <img 
              :src="getImgUrl('../../../src/assets/images/googleads', data.image)" 
              :alt="data.title" 
              class="img-fluid main-img position-relative"
            />
          </div>
        </div>

        <!-- Right Commitments -->
        <div class="col-lg-4">
          <div class="commitment-list">
            <template v-for="(item, index) in data.commitmentList" :key="item.id">
              <div 
                v-if="index >= data.commitmentList.length / 2"
                class="commitment-item p-3 mb-4 d-flex align-items-center"
              >
                <div class="commitment-num me-3 d-flex align-items-center justify-content-center fw-bold">
                  {{ item.id }}
                </div>
                <div class="commitment-text fw-semibold">{{ item.text }}</div>
              </div>
            </template>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { defineProps } from 'vue';
import SectionTitle from '@/components/SectionTitle.vue';
import getImgUrl from '@/utils/getUrlImg';

const props = defineProps({
  data: {
    type: Object,
    required: true,
    default: () => ({
      title: '',
      subTitle: '',
      image: '',
      commitmentList: []
    })
  }
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.ads-commitment {
  background-color: $white;

  .commitment-item {
    background-color: $white;
    border: 1px dashed #FFD028; // Dashed yellow border
    border-radius: 16px;
    min-height: 80px;
    transition: all 0.3s ease;
    &:hover {
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
      transform: translateY(-2px);
    }

    .commitment-num {
      @include square(64px);
      background-color: #FFB800;
      border-radius: 50%;
      font-size: 24px;
      flex-shrink: 0;
      position: relative;
      
      &::after {
          content: "";
          position: absolute;
          @include square(52px);
          border-radius: 50%;
          border: 1px dashed $white;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
      }
    }

    .commitment-text {
      font-size: 18px;
    }
  }

  .commitment-illustration {
    text-align: center;
    .main-img {
      max-width: 100%;
      border-radius: 80px;
    }
  }
}


// Adjust for mobile stacking logic if needed
// @include breakpoint-down(lg) {
//     .commitment-list {
//         display: flex;
//         flex-direction: column;
//     }
// }
</style>
