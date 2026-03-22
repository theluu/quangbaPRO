<template>
  <section class="section-seo-commitment section-pad">
    <div class="container">
      <SectionTitle
        :headingTitle="headingSection.headingTitle"
        :subTitle="headingSection.subTitle"
        lineBottom
      />

      <div
        v-if="item.commitments && item.commitments.length"
        class="row seo-commitment-list"
      >
        <div
          v-for="(commitment, index) in item.commitments"
          :key="index"
          class="col-12 col-md-6 col-lg-4"
        >
          <div class="commitment-item text-center">
            <div class="commitment-icon-circle">
              <i :class="commitment.icon" class="commitment-icon"></i>
            </div>
            <h3 class="commitment-title">{{ commitment.title }}</h3>
            <p class="commitment-description">{{ commitment.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import { defineProps } from "vue";
import SectionTitle from "@/components/SectionTitle.vue";

const { item } = defineProps({
  item: {
    type: Object,
    default: () => ({}),
  },
});
const headingSection = {
  headingTitle: {
    textPrimary: "Quangbapro ",
    textDangler: "cam kết",
  },
  subTitle: "",
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.section-seo-commitment {
  background-color: #f7f7f7;
}

.seo-commitment-list {
  margin-left: -24px;
  margin-bottom: -24px;
  & > * {
    padding-left: 24px;
    padding-right: 24px;
    margin-bottom: 24px;
    @include breakpoint(lg) {
      margin-bottom: 0;
    }
  }
}

.commitment-item {
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 0 12px;

  @include breakpoint(md) {
    padding: 0 16px;
  }
}

.commitment-icon-circle {
  margin-bottom: 30px;
  width: 230px;
  height: 230px;
  border-radius: 50%;
  border: 2px dashed #fbbc05;
  padding: 13px;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;

  // Dotted border circle
  &::before {
    content: "";
    position: absolute;
    top: 13px;
    left: 13px;
    width: 200px;
    height: 200px;
    background-color: #fbbc05;
    border-radius: 50%;
  }
}

.commitment-icon {
  height: 120px;
  width: 120px;
  display: inline-block;
  position: relative;
}

.commitment-title {
  font-size: 22px;
  font-weight: 700;
  line-height: 1.22727;
  margin-bottom: 30px;
  position: relative;
  display: inline-block;
  padding-bottom: 16px;
  @include breakpoint(md) {
    font-size: 24px;
    line-height: 1.20833;
  }

  // Decorative underline
  &::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 2px;
    border-top: 2px dashed #fbbc05;
  }
}

.commitment-description {
  font-size: 16px;
  line-height: 1.4;
  text-align: center;
}

.seo-commitment-icon-1 {
  width: 120px;
  height: 120px;
  display: inline-block;
  background: url(../../assets/images/icons/seo-commitment-icon-1.svg);
}

.seo-commitment-icon-2 {
  width: 120px;
  height: 120px;
  display: inline-block;
  background: url(../../assets/images/icons/seo-commitment-icon-2.svg);
}

.seo-commitment-icon-3 {
  width: 120px;
  height: 120px;
  display: inline-block;
  background: url(../../assets/images/icons/seo-commitment-icon-3.svg);
}
</style>
