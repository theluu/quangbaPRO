<template>
  <a-modal
    class="success-verify-modal"
    v-model:open="open"
    :footer="null"
    width="422px"
  >
    <Form @submit="onSubmit">
      <img
        class="success-verify-modal__img-icon"
        src="@/assets/images/icons/verified-successfull-icon.svg"
        alt=""
      >
      <h5 class="success-verify-modal__title">{{ title }}</h5>
      <div class="success-verify-modal__caption" v-html="caption"></div>
      <a-button
        type="primary"
        html-type="submit"
        class="success-verify-modal__btn"
      >{{ buttonName }}</a-button>
    </Form>
  </a-modal>
</template>

<script setup>
import { ref } from 'vue';
import { Form } from 'vee-validate';

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
});

const open = ref(true);
const emit = defineEmits(['submit']);

const onSubmit = () => {
  open.value = false;
  emit('submit');
};
</script>

<style lang="scss">
@import "@/assets/mixins.scss";

.success-verify-modal {
  display: flex;
  flex-direction: column;
  align-items: stretch;
  text-align: center;

  &__img-icon {
    margin: 0 auto 2rem;
  }

  .ant-modal-content {
    border-radius: 20px;
    padding: 40px;
    background: var(--iat_gradient-modal_linear, linear-gradient(179deg, #AEEDF8 -27.13%, #FFF 23.42%));
  }

  &__title {
    font-size: 20px;
    font-weight: 700;
    color: #294563;
    margin: 0 0 2rem;
  }

  &__caption {
    font-size: 14px;
    font-weight: 400;
    color: #505050;
  }

  &__btn {
    margin: 2rem auto 0;
    height: 44px;
    font-size: 16px;
    text-transform: uppercase;
    min-width: 160px;
  }
}
</style>