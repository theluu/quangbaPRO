<template>
  <a-modal
    class="alert-modal"
    centered
    v-model:open="open"
    :footer="null"
    :width="width"
  >
    <img
      class="alert-modal__img-icon"
      src="@/assets/images/icons/alert-icon.svg"
      alt=""
    >
    <h3 class="alert-modal__title">{{ title }}</h3>
    <div class="alert-modal__caption">{{ caption }}</div>
    <a-button
      type="primary"
      @click="$emit('submit')"
      class="alert-modal__btn"
    >{{ buttonName }}</a-button>
  </a-modal>
</template>

<script setup>
import { ref } from 'vue';

defineProps({
  title: {
    type: String,
    required: true,
  },
  caption: {
    type: String,
    required: true,
  },
  buttonName: {
    type: String,
    required: true,
  },
  width: {
    type: String,
    default: '538px',
  },
});

defineEmits(['submit']);

const open = ref(true); // Điều khiển trạng thái hiển thị của modal
</script>

<style lang="scss">
@import "@/assets/mixins.scss";
.alert-modal {
  display: flex;
  flex-direction: column;
  align-items: stretch;
  text-align: center;
  .ant-modal-body {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
  }
  .ant-modal-content {
    padding: 4rem;
    @include mobile {
      padding: 2rem;
    }
  }
  &__img-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto;
  }
  &__title {
    font-size: var(--font-size-lg);
    font-weight: 700;
    color: var(--Text-Headline, #294563);
    margin-top: 16px;
  }
  &__caption {
    font-size: var(--font-size-sm);
    font-weight: 400;
    color: var(--Text-Body-2, #62626b);
    margin-top: 8px;
    margin-bottom: 24px;
  }
  &__btn {
    min-width: 160px;
    height: 44px;
  }
}
</style>