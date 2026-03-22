<template>
  <section class="section-seo-definition section-pad">
    <div class="container">
      <div class="row align-items-lg-center">
        <div class="col-lg-6">
          <figure class="seo-definition-img mb-4 mb-lg-0 text-center text-lg-start">
            <img v-if="item.src" :src="getImgUrl('../../src/assets/images/seo', item.src)" :alt="item.title"
              class="img-fluid" />
          </figure>
        </div>

        <div class="col-lg-6">
          <div class="seo-definition-body">
            <h2 class="seo-definition-title">{{ item.title }}</h2>
            <p v-if="item.description" class="seo-definition-description">
              {{ item.description }}
            </p>
            <hr />
            <ul v-if="item.steps && item.steps.length" class="seo-definition-steps list-unstyled">
              <li v-for="(step, index) in item.steps" :key="index" class="seo-definition-step-item">
                <div class="step-badge">
                  <span class="step-number">{{ step.number }}</span>
                </div>
                <div class="step-content">
                  <span class="step-title fw-bold">{{ step.title }}</span>
                  {{ step.description }}
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import { defineProps } from "vue";
import getImgUrl from "@/utils/getUrlImg";

const { item } = defineProps({
  item: {
    type: Object,
    default: () => ({}),
  },
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.section-seo-definition {
  background-color: #f8f8f8;
}

.seo-definition-img {
  display: flex;
  justify-content: flex-end;

  img {
    width: auto;
  }
}

.seo-definition-title {
  font-size: 22px;
  line-height: 1.4;
  margin-bottom: 24px;
  font-weight: 700;

  @include breakpoint(md) {
    font-size: 32px;
  }
}

.seo-definition-description {
  font-size: 16px;
  line-height: 1.5;
  margin-bottom: 0;
}

.seo-definition-body {
  hr {
    height: 1px;
    overflow: hidden;
    border-top: 1px solid #d9d9d9;
    margin: 24px 0;
  }
}

.seo-definition-steps {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.seo-definition-step-item {
  display: flex;
  align-items: center;
  gap: 12px;

  .step-badge {
    flex: 0 0 48px;
    width: 48px;
    height: 48px;
    background-image: url(../../assets/images/icons/ico-flower.svg);
    display: flex;
    align-items: center;
    justify-content: center;

    .step-number {
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      font-weight: 700;
      color: white;
      background-color: #4285f4;
      border-radius: 50%;
    }
  }

  .step-content {
    padding-left: 12px;
    width: calc(100% - 48px);
  }

  .step-content {
    font-size: 16px;
    line-height: 1.5;
  }

  // .step-title {
  //   font-size: 15px;
  //   font-weight: 700;
  //   color: #000;
  //   margin-bottom: 4px;

  //   @include breakpoint(md) {
  //     font-size: 16px;
  //     margin-bottom: 6px;
  //   }

  //   @include breakpoint(lg) {
  //     font-size: 17px;
  //     margin-bottom: 8px;
  //   }
  // }

  // .step-description {
  //   font-size: 14px;
  //   line-height: 1.6;
  //   color: #555;
  //   margin-bottom: 0;

  //   @include breakpoint(md) {
  //     font-size: 15px;
  //   }

  //   @include breakpoint(lg) {
  //     font-size: 15px;
  //   }
  // }
}
</style>
