<template>
  <section class="section-ads-strategies section-pad pt-0">
    <div class="ads-strategies-illustration text-center mb-4 mb-lg-0">
      <img 
        :src="getImgUrl('../../../src/assets/images/googleads', data.image)" 
        :alt="data.title" 
        class="img-fluid main-img"
      />
    </div>
    <div class="container">
      <div class="row align-items-center justify-content-lg-end">
        <div class="col-lg-6 order-1 order-lg-2 ps-lg-5">
          <div class="ads-strategies-content">
            <h2 class="ads-strategies-title mb-3">
              {{ data.title }}
            </h2>
            <p class="ads-strategies-desc" v-html="data.description"></p>

            <div class="row row-xl">
              <div 
                v-for="(strategy, index) in data.strategies" 
                :key="strategy.id" 
                class="col-md-6 mb-4"
              >
                <div class="strategy-card" :class="{'has-divider': index === 0}">
                  <div class="strategy-header d-flex align-items-center mb-3">
                    <div class="strategy-badge me-3">
                      <img 
                        :src="getImgUrl('../../../src/assets/images/googleads', strategy.icon)" 
                        :alt="strategy.title" 
                        class="img-fluid main-img"
                      />
                    </div>
                    <div class="flex-fill">
                      <div class="strategy-name fw-semibold mb-1">{{ strategy.title }}</div>
                      <div class="strategy-subtitle">{{ strategy.subtitle }}</div>
                    </div>
                  </div>
                  <div class="strategy-body ps-1">
                    
                    <ul class="strategy-metrics list-unstyled mb-0">
                      <li v-for="(metric, mIndex) in strategy.metrics" :key="mIndex" class="d-flex align-items-baseline mb-2">
                        <span class="bullet me-2">•</span>
                        <span class="metric-text">{{ metric }}</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- Social Proof -->
            <div class="ads-strategies-social d-flex align-items-center">
              <div class="avatar-group d-flex">
                <div 
                  v-for="(avatar, index) in data.socialProof?.avatars" 
                  :key="index" 
                  class="avatar-item"
                >
                  <img :src="getImgUrl('../../../src/assets/images/avatars', avatar)" alt="User" class="rounded-circle border border-2 border-white" />
                </div>
                <div class="avatar-item avatar-plus d-flex align-items-center justify-content-center rounded-circle border border-2 border-white bg-primary text-white">
                    <i class="fa-solid fa-plus small"></i>
                </div>
              </div>
              <div class="social-text flex-fill ps-4">
                <span class="fw-bold social-count d-block">{{ data.socialProof?.count }}</span>
                <span class="social-desc">{{ data.socialProof?.text }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { defineProps } from 'vue';
import getImgUrl from '@/utils/getUrlImg';

const props = defineProps({
  data: {
    type: Object,
    required: true,
    default: () => ({
      title: '',
      description: '',
      image: '',
      strategies: [],
      socialProof: {
        count: '',
        text: '',
        avatars: []
      }
    })
  }
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.row-xl {
  @include breakpoint(md) {
    margin-left: -24px;
    margin-right: -24px;
    &>* {
      padding-left: 24px;
      padding-right: 24px;
    }
  }
}

.section-ads-strategies { 
  position: relative;
  .ads-strategies-title {
    font-size: 22px;
    font-weight: 700;
    color: $dark-1;
    @include breakpoint(md) {
      font-size: 32px;
    }
  }

  .strategy-card {
    position: relative;
    &.has-divider {
      border-bottom: 1px solid $grey-6;
      padding-bottom: 24px;
      @include breakpoint(md) {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
        &::after {
          content: "";
          position: absolute;
          right: -15px;
          top: 20px;
          bottom: 20px;
          width: 1px;
          background-color: $grey-6;
        }
      }
    }

    .strategy-badge {
      @include square(72px);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      color: $white;
      flex-shrink: 0;
      position: relative;
    }

    .strategy-name {
      font-size: 18px;
    }

  }

  .ads-strategies-social {
    border-top: 1px solid $grey-6;    
    padding-top: 24px;
    @include breakpoint(md) {
      padding-top: 36px;
      margin-top: 12px;
    }
    .avatar-group {
      .avatar-item {
        width: 40px;
        height: 40px;
        margin-right: -12px;
        @include breakpoint(md) {
          @include square(64px);
          margin-left: -18px;
        }
        img {
          width: 100%;
          height: 100%;
          object-fit: cover;
        }
        &:first-child {
          margin-left: 0;
        }
        &.avatar-plus {
            @include square(40px);
            font-size: 18px;
            @include breakpoint(md) {
              @include square(64px);
            }
        }
      }
    }
    
    .social-text {
        line-height: 1.2;
    }
  }

  .backdrop-circle {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 80%;
      height: 80%;
      background-color: #EBF5FF;
      border-radius: 50%;
      z-index: 0;
  }

  .ads-strategies-illustration {
    z-index: 1;    
    height: 100%;
    width: 100%;
    background-color: #E1F1FE;
    text-align: center;
    @include breakpoint(lg) {
      width: 50%;
      position: absolute;
      left: 0;
      top: 0;
    }
    .main-img {
      max-width: 100%;
      max-height: 100%;
    }
  }
  .ads-strategies-desc {
    margin-bottom: 24px;
    @include breakpoint(md) {
      margin-bottom: 36px;
    }
  }
}
.social-count {
  font-size: 24px;
}
.social-desc {
  font-size: 18px;
}
</style>
