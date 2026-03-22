<template>
  <div class="about-mission section-pad" :style="bgStyle">
    <div class="container">
      <SectionTitle 
        v-if="data.title"
        :headingTitle="data.title" 
        :isWhiteText="true"
        class="mb-5"
      />
      
      <div class="row g-4">
        <div v-for="item in data.items" :key="item.id" class="col-lg-6">
          <div class="mission-card">
            <div class="card-header d-flex align-items-center mb-4">
              <div class="number-circle-wrapper">
                <div class="number-circle" :style="{ borderColor: item.color }">
                  <span>{{ item.number }}</span>
                </div>
              </div>
              <h3 class="card-title fw-bold mb-0 ms-3">{{ Drupal.t(item.title) }}</h3>
            </div>
            <ul class="card-content list-unstyled mb-0">
              <li v-for="(text, index) in item.content" :key="index" class="position-relative ps-4">
                {{ Drupal.t(text) }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, defineProps } from 'vue';
import SectionTitle from '@/components/SectionTitle.vue';
import getImgUrl from '@/utils/getUrlImg';

const props = defineProps({
  data: {
    type: Object,
    required: true
  }
});

const bgStyle = computed(() => {
  if (!props.data.background) return {};
  const url = getImgUrl('../../../src/assets/images/about', props.data.background);
  return {
    backgroundImage: `linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(${url})`,
    backgroundSize: 'cover',
    backgroundPosition: 'center',
    backgroundAttachment: 'fixed'
  };
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.about-mission {
  overflow: hidden;
}

.mission-card {
  background: rgba(255, 255, 255, 0.9);
  border-radius: 16px;
  padding: 24px 16px;
  height: 100%;
  @include transition();
  
  &:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  }
}
.number-circle-wrapper {
  @include square(80px);
  border: 8px solid $white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.number-circle {
  @include square(64px);
  border: 6px solid;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  
  span {
    font-size: 24px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    @include square(48px);
    border-radius: 50%;
    background-color: $white;
    border: 2px solid $grey-6;
  }
}

.card-title {
  font-size: 20px;
  letter-spacing: 0.5px;
  @include breakpoint(md) {
    font-size: 24px;
  }
}

.card-content {
  li {
    &:not(:last-child) {
      margin-bottom: 24px;
    }
    &::before {
      content: "";
      position: absolute;
      left: 0;
      top: 10px;
      width: 6px;
      height: 6px;
      background-color: #333;
      border-radius: 50%;
    }
  }
}
</style>
