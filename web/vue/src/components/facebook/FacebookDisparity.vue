<template>
  <section class="faceook-disparity section-pad">
    <div class="container">
      <SectionTitle :headingTitle="headingSection.headingTitle" :subTitle="headingSection.subTitle" />
      <div v-if="item.steps && item.steps.length" class="disparity-wrapper position-relative">
        <div class="row disparity-list">
          <div v-for="(step, index) in item.steps" :key="index" class="col-12 col-lg-6">
            <div class="disparity-card" :data-step="step.id">
              <div class="disparity-card-inner">
                <div class="disparity-icon">
                  <img v-if="step.icon" :src="getImgUrl('../../src/assets/images/icons', step.icon)" :alt="step.title"
                    class="disparity-icon-img" />
                </div>
                <div class="disparity-content">
                  <h3 class="disparity-title">{{ step.title }}</h3>
                  <p class="disparity-description">{{ step.description }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="disparity-cta text-center">
          <a href="#" class="btn btn-green-color btn-custom rounded-pill">
            <i class="fa-regular fa-pen-to-square"></i>
            Đăng ký tư vấn
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import { defineProps } from "vue";
import getImgUrl from "@/utils/getUrlImg";
import SectionTitle from "@/components/SectionTitle.vue";

const { item } = defineProps({
  item: {
    type: Object,
    default: () => ({}),
  },
});
const headingSection = {
  headingTitle: {
    textPrimary: "facebook ad tại Quangbapro ",
    textDangler: "có gì khác biệt",
  },
  subTitle: "",
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.disparity-list {
  margin-left: -15px;
  margin-bottom: -15px;

  &>* {
    padding-left: 15px;
    padding-right: 15px;
    margin-bottom: 16px;

    @include breakpoint(md) {
      margin-bottom: 30px;
    }
  }
}

.disparity-card {
  max-width: 1200px;
  margin-left: auto;
  margin-right: auto;
  background: radial-gradient(circle,
      rgba(255, 255, 255, 1) 0%,
      rgba(238, 238, 238, 1) 100%);
  border-radius: 24px;
  padding: 24px;
  height: 100%;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;

  &::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #2196f3 0%, #42a5f5 100%);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s ease;
  }

  &:hover {
    background: #fff;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    transform: translateY(-4px);

    &::before {
      transform: scaleX(1);
    }

    // .process-icon {
    //   transform: scale(1.1);
    // }
  }
}

.disparity-card-inner {
  display: flex;
  gap: 16px;

  @include breakpoint(md) {
    gap: 24px;
  }
}

.disparity-icon {
  flex: 0 0 120px;
  width: 120px;
  height: 120px;
  border-radius: 24px 24px 0 24px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.disparity-content {
  width: calc(100% - 120px);
}

.disparity-title {
  font-size: 18px;
  line-height: 1.6;
  font-weight: 600;
  color: #015fc9;
  margin-bottom: 8px;
}

.disparity-description {
  font-size: 16px;
  line-height: 1.4;
  margin-bottom: 0;
}

.disparity-cta {
  padding-top: 8px;

  @include breakpoint(md) {
    padding-top: 18px;
  }
}
</style>
