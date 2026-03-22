<script setup>
import { RouterLink, RouterView } from "vue-router";

import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
</script>
<template>
  
  <Header />
  <RouterView />
  <Footer />
</template>

<style lang="scss">
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
#app {
  overflow: hidden;
  // display: flex;
  // flex-direction: column;

  // > .container {
  //   flex: 1;
  // }
}

.showing-notification {
  overflow: hidden;
  .page-wrap {
    width: calc(100% - 360px);
    margin-left: 0px;    
  }
}

.cards-wrapper {
  margin: 24px 0 0;
}
.ant-select .ant-select-arrow {
  display: inline;
}
.test-card {
  display: flex;
  padding: var(--Size-7, 16px);
  flex-direction: column;
  align-items: center;
  gap: var(--Size-9, 24px);
  flex: 1 0 0;
  border-radius: var(--Size-7, 16px);
  border: 1px solid var(--Color-Dark-Blue-1, #eaecef);
  background: var(--Color-Base-White, #fff);
  &__title {
    font-size: var(--font-size-md);
    font-weight: 700;
    color: var(--Text-Heading, #294563);
  }
  &__test-types {
    display: flex;
    gap: 16px;
  }
  &__test-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--Space-2, 8px);
  }
  &__test-name {
    font-size: 16px;
    font-weight: 400;
    color: #53535b;
  }
  &__test-icon {
    display: flex;
    width: 40px;
    height: 40px;
    padding: 4px 2px;
    justify-content: center;
    align-items: center;
    flex-shrink: 0;
    border-radius: var(--Space-2, 8px);
    border: 1px solid var(--Color-Dark-Blue-1, #eaecef);
    i {
      font-size: 22px;
      color: var(--Color-Green-6, #4abea7);
    }
  }
  &__btn {
    font-size: 16px;
  }
}
.page-title {
  text-align: center;
  font-size: var(--font-size-lg);
  font-weight: 700;
  margin: 24px 0;
}
.course-filter {
  .ant-select-arrow {
    .anticon-down {
      &::after {
        content: "\e60d";
        font-family: "Font Awesome 6 Pro";
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        display: var(--fa-display, inline-block);
        font-style: normal;
        font-variant: normal;
        line-height: 1;
        text-rendering: auto;
        font-size: 14px;
        color: var(--Color-Verdigris-6);
      }
      svg {
        display: none;
      }
    }
  }
  .ant-btn {
    &.course-filter__refresh-icon {
      font-size: 22px;
      background: initial;
      border: 1px solid var(--Color-Verdigris-6);
      width: 40px;
      height: 40px;
      flex-shrink: 0;
      @include mobile {
        align-self: center;
      }
      &:hover {
        background-color: var(--Color-Verdigris-1);
        border: 1px solid var(--Color-Verdigris-6);
      }
    }
    .fa-rotate-reverse::before {
      color: var(--Color-Verdigris-6);
    }
  }
  .ant-select-single:not(.ant-select-customize-input) .ant-select-selector {
    height: 40px;
  }
  &__contents {
    display: flex;
    align-items: stretch;
    gap: 8px;
    height: 40px;
    @include mobile {
      flex-direction: column;
      height: auto;
    }
  }
  &__input {
    height: 40px;
    border-radius: 100px;
  }
}
</style>
