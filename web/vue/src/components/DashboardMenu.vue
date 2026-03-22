<template>
  <div class="dashboard-menu">
    <RouterLink
      class="dashboard-menu__item -my-profile"
      to="/my-profile"
      :class="{ active: $route.path === '/my-profile' }"
    >
      My Profile
    </RouterLink>
    <RouterLink
      class="dashboard-menu__item -my-wallet"
      to="/my-wallet"
      :class="{ active: $route.path === '/my-wallet' }"
    >
      My Wallet
    </RouterLink>
    <RouterLink
      class="dashboard-menu__item -test-history"
      to="/my-test-history"
      :class="{ active: $route.path === '/my-test-history' }"
    >
      My Test History
    </RouterLink>
  </div>
  <a-select
    ref="select"
    v-model:value="currentMenuValue"
    style="width: 100%"
    :options="options1"
    @change="handleChange"
    class="dashboard-menu__select"
    :class="selectClass"
    :showArrow="false"
    :getPopupContainer="triggerNode => triggerNode.parentNode"
  ></a-select>
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router';
import { ref, watch, computed } from 'vue';

const currentMenuValue = ref('/my-profile');
const options1 = ref([
  { value: '/my-profile', label: 'My Profile', class:"mbmn-sub -my-profile" },
  { value: '/my-wallet', label: 'My Wallet', class:"mbmn-sub -my-wallet" },
  { value: '/my-test-history', label: 'My Test History', class:"mbmn-sub -test-history" }
]);

// Lấy thông tin route hiện tại để thiết lập active menu
const route = useRoute();
// Lấy instance của router để điều hướng
const router = useRouter();

// Tính toán class cho a-select dựa trên currentMenuValue
const selectClass = computed(() => {
  switch (currentMenuValue.value) {
    case '/my-profile':
      return '-my-profile';
    case '/my-wallet':
      return '-my-wallet';
    case '/my-test-history':
      return '-test-history';
    default:
      return '';
  }
});

const handleChange = (value) => {
  router.push(value); // Điều hướng khi chọn mục trong dropdown
};

// Đồng bộ currentMenuValue với route.path
watch(
  () => route.path,
  (newPath) => {
    // Chỉ cập nhật nếu newPath khớp với một trong các giá trị trong options1
    if (options1.value.some((option) => option.value === newPath)) {
      currentMenuValue.value = newPath;
    }
  },
  { immediate: true } // Chạy ngay khi component được mount
);
</script>

<style lang="scss">
  @import "@/assets/mixins.scss";
  .ant-select:not(.ant-select-disabled):not(.ant-select-customize-input):not(.ant-pagination-size-changer):hover .ant-select-selector {
    box-shadow: none;
  }
  .mbmn-sub {
    display: flex;
    align-items: center;
    gap: 1rem;
    &.-my-profile {
      &:before {
        content: "\e90a";
      }
    }
    &.-my-wallet {
      &:before {
        content: "\e909";
      }
    }
    &.-test-history {
      &:before {
        content: "\e911";
      }
    }
    &.ant-select-item-option-selected {
      display: none;
    }
    &:before {
      content: '\e912';
      font-size: 20px;
      font-family: 'iaticon' !important;
      speak: never;
      font-style: normal;
      font-weight: normal;
      font-variant: normal;
      text-transform: none;
      line-height: 1;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      color: #294563;
    }
  }

  .user-dashboard {
    .dashboard-menu {
      &__select {
        display: none;
        @include mobile {
          display: flex; 
        }
        &.ant-select-open {
          .ant-select-selection-item {
            &:after {
              transform: rotate(180deg);
            }
          }
        }
        &.-my-profile {
          .ant-select-selection-item {
            &:before {
              content: "\e90a";
            }
          }
        }
        &.-my-wallet {
          .ant-select-selection-item {
            &:before {
              content: "\e909";
            }
          }
        }
        &.-test-history {
          .ant-select-selection-item {
            &:before {
              content: "\e911";
            }
          }
        }
        .ant-select-selection-item {
          display: inline-flex;
          align-items: center;
          gap: 1rem;
          justify-content: center;
          color: #294563;
          font-weight: bold;
          &::after {
            font-size: 12px;
            content: "\f078";
            font-family: "Font Awesome 6 Pro";
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            display: var(--fa-display, inline-block);
            font-style: normal;
            font-variant: normal;
            line-height: 1;
            text-rendering: auto;
            width: initial;
            visibility: visible;
            color: #294563;
            @include transition();
          }
          &:before {
            content: '\e912';
            font-size: 20px;
            font-family: 'iaticon' !important;
            speak: never;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            color: var(--iat_blue-800_primary, #02317E);
          }
        }
        .ant-select-selector {
          background: var(--iat_light_blue-50, #DFF8FC);
          border: none;
          font-size: 14px;
          font-style: normal;
          font-weight: 700;
          border-radius: 0;
        }
        .ant-select-dropdown {
          border-radius: 0;
        }
      }
    }
    .ant-select-single:not(.ant-select-customize-input) {
      @include mobile {
        display: flex; 
      }      
    }
  }
</style>

<style lang="scss" scoped>
  @import "@/assets/mixins.scss";
  .dashboard-menu {
    display: flex;
    padding: 16px 0px;
    flex-direction: column;
    align-items: flex-start;
    border-radius: 20px;
    background: #FFF;
    box-shadow: 0px 4px 30px 0px rgba(2, 49, 126, 0.05);
    @include mobile {
      display: none; 
    }
    &__item {
      display: flex;
      color: var(--icon-illustration-primary, #294563);
      padding: 16px 20px;
      align-items: center;
      gap: 10px;
      align-self: stretch;
      cursor: pointer;
      font-family: $font-family-heading;
      @include transition();
      position: relative;
      &.-my-profile {
        &:before {
          content: '\e90a';
        }
        &.active {
          &::before {
            content: '';
            background: url('@/assets/images/icons/user-active.svg') no-repeat center center;
            background-size: 24px 24px;
          }
        }
      }
      &.-my-wallet {
        &:before {
          content: '\e909';
        }
        &.active {
          &::before {
            content: '';
            background: url('@/assets/images/icons/wallet-active.svg') no-repeat center center;
            background-size: 24px 24px;
          }
        }
      }
      &.-test-history {
        &:before {
          content: '\e911';
        }
        &.active {
          &::before {
            content: '';
            background: url('@/assets/images/icons/my-test-history-active.svg') no-repeat center center;
            background-size: 24px 24px;
          }
        }
      }
      &:before {
        content: '\e912';
        width: 24px;
        height: 24px;
        font-size: 24px;
        font-family: 'iaticon' !important;
        speak: never;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: #294563;
      }
      &:hover {
        background: var(--iat_orange-600, #DFF8FC);
        color: #294563;
      }
      &.active {
        background: var(--iat_orange-600, #DFF8FC);
        color: #294563;
        font-weight: bold;
      }
    }
  }
</style>