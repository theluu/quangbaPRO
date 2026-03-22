<template>
  <div class="stats-circle-container">
    <div class="circle-box">
      <svg class="circle-svg" viewBox="0 0 100 100">
        <circle
          class="circle-bg"
          cx="50"
          cy="50"
          r="45"
        />
        <circle
          class="circle-progress"
          cx="50"
          cy="50"
          r="45"
          :style="progressStyle"
        />
      </svg>
      <div class="circle-content">
        <span class="value">{{ value }}</span>
        <span class="suffix">{{ suffix }}</span>
      </div>
    </div>
    <div class="circle-label" v-html="Drupal.t(label)"></div>
  </div>
</template>

<script setup>
import { computed, defineProps } from 'vue';

const props = defineProps({
  value: {
    type: [String, Number],
    required: true
  },
  suffix: {
    type: String,
    default: ''
  },
  label: {
    type: String,
    required: true
  },
  percent: {
    type: Number,
    default: 100
  },
  color: {
    type: String,
    default: '#4285F4'
  }
});

const progressStyle = computed(() => {
  const radius = 45;
  const circumference = 2 * Math.PI * radius;
  const offset = circumference - (props.percent / 100) * circumference;
  
  return {
    strokeDasharray: `${circumference} ${circumference}`,
    strokeDashoffset: offset,
    stroke: props.color
  };
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.stats-circle-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  max-width: 140px;
}

.circle-box {
  position: relative;
  width: 110px;
  height: 110px;
  margin-bottom: 12px;
  
  @include breakpoint(md) {
    width: 130px;
    height: 130px;
  }
}

.circle-svg {
  width: 100%;
  height: 100%;
  transform: rotate(-90deg);
}

.circle-bg {
  fill: none;
  stroke: #eee;
  stroke-width: 2;
}

.circle-progress {
  fill: none;
  stroke-width: 2;
  stroke-linecap: round;
  transition: stroke-dashoffset 1s ease-out;
}

.circle-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: flex;
  align-items: baseline;
  color: $primary-1;
  font-weight: 700;
  
  .value {
    font-size: 28px;
    @include breakpoint(md) {
        font-size: 36px;
    }
  }
  
  .suffix {
    font-size: 18px;
    margin-left: 2px;
    @include breakpoint(md) {
        font-size: 24px;
    }
  }
}

.circle-label {
  text-transform: uppercase;
  color: #2F1812;
}
</style>
