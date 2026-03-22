<template>
  <section class="section-seo-process section-pad">
    <div class="container">
      <SectionTitle
        :headingTitle="headingSection.headingTitle"
        :subTitle="headingSection.subTitle"
        lineBottom
      />
      <div
        v-if="item.steps && item.steps.length"
        class="process-wrapper position-relative"
      >
        <div class="row seo-process-list">
          <div
            v-for="(step, index) in item.steps"
            :key="index"
            class="col-12 col-lg-6"
          >
            <div class="process-card" :data-step="step.id">
              <div class="process-card-inner">
                <div class="process-icon">
                  <img
                    v-if="step.icon"
                    :src="getImgUrl('../../src/assets/images/icons', step.icon)"
                    :alt="step.title"
                    class="process-icon-img"
                  />
                </div>
                <div class="process-content">
                  <h3 class="process-title">{{ step.title }}</h3>
                  <p class="process-description">{{ step.description }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="process-cta text-center">
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
    textPrimary: "QUY TRÌNH TRIỂN KHAI DỊCH VỤ",
    textDangler: "TẠI QUANGBAPRO",
  },
  subTitle: "",
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.seo-process-list {
  margin-left: -15px;
  margin-bottom: -15px;
  & > * {
    padding-left: 15px;
    padding-right: 15px;
    margin-bottom: 16px;
    @include breakpoint(md) {
      margin-bottom: 30px;
    }
  }
}

.process-card {
  max-width: 1200px;
  margin-left: auto;
  margin-right: auto;
  background: radial-gradient(
    circle,
    rgba(255, 255, 255, 1) 0%,
    rgba(238, 238, 238, 1) 100%
  );
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

.process-card-inner {
  

  @include breakpoint(md) {
    gap: 30px;
    display: flex;
  }
}

.process-icon {  
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  @include breakpoint(md) {
    flex: 0 0 120px;
    width: 120px;
    height: 120px;
    border-radius: 24px 24px 0 24px;
  }
}

.process-content {
  @include breakpoint(md) {
    width: calc(100% - 120px);
  }
}

.process-title {
  font-size: 18px;
  line-height: 1.6;
  font-weight: 600;
  color: #015fc9;
  margin-bottom: 8px;
}

.process-description {
  font-size: 16px;
  line-height: 1.4;
  margin-bottom: 0;
}

.process-cta {
  padding-top: 8px;

  @include breakpoint(md) {
    padding-top: 18px;
  }
}
</style>
