<template>
  <a-modal class="verify-modal" v-model:open="openVerify" :footer="null" width="422px" @cancel="onModalClose">
    <Form ref="otpForm" @submit="onOtpSubmit" :validation-schema="otpSchema">
      <img class="verify-modal__img-icon" src="@/assets/images/icons/letter-icon.svg" alt="">
      <h5 class="verify-modal__title">{{ title }}</h5>
      <div class="verify-modal__caption">{{ Drupal.t('Enter the verification code sent to') }}</div>
      <div class="verify-modal__target"><strong>{{ identifier }}</strong></div>
      <Field name="userOtp" v-slot="{ field, errors }">
        <a-input
          class="verify-modal__input"
          v-bind="field"
          :placeholder="Drupal.t('Enter OTP code')"
          :status="errors.length ? 'error' : ''"
        />
        <div class="error-message">{{ errors[0] }}</div>
      </Field>
      <template v-if="!endRemainingTime">
        <div class="verify-modal__remaining-time" v-if="deadline">{{ Drupal.t('Remaining time:') }} 
          <a-statistic-countdown
            :value="deadline"
            format="s"
            suffix="s"
            @finish="onOtpCountdownFinish"
          />
        </div>
      </template>
      <template v-if="endRemainingTime">
        <div class="verify-modal__resend-code" @click="onResendOtpCode"><i class="fa-light fa-arrow-rotate-right"></i><b>{{ Drupal.t('Resend code') }}</b></div>
      </template>
      <a-button 
        type="primary" 
        html-type="submit"
        class="verify-modal__btn" 
      >{{ Drupal.t('Verify') }}</a-button>
    </Form>
  </a-modal>
</template>

<script setup>
import { ref } from 'vue';
import { Form, Field } from 'vee-validate';
import * as yup from 'yup';
import { verifyOtp } from '@/api';
import { message } from 'ant-design-vue';

// Nhận props
const props = defineProps({
  title: {
    type: String,
    required: true,
    default: Drupal.t('Verify your email'),
  },
  identifier: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    default: 'email',
  },
});

// Emit events
const emit = defineEmits(['otp-verified', 'resend-otp']);

// State
const openVerify = ref(false);
const endRemainingTime = ref(false);
const deadline = ref(null);
const otpChecked = ref(false);
const otpForm = ref(null);

// Schema xác thực OTP
const otpSchema = yup.object({
  userOtp: yup
    .string()
    .required('OTP code is required')
    .min(1, 'OTP code is required'),
});

// Hàm mở modal
const showModal = () => {
  openVerify.value = true;
  deadline.value = Date.now() + 1000 * 10; // 10 giây countdown
  endRemainingTime.value = false;
  if (otpForm.value) {
    otpForm.value.resetForm(); // Reset form khi mở modal (tùy chọn)
  }
};

// Hàm xử lý khi countdown hoàn tất
const onOtpCountdownFinish = () => {
  endRemainingTime.value = true;
};

// Hàm xử lý resend OTP
const onResendOtpCode = () => {
  deadline.value = Date.now() + 1000 * 10;
  endRemainingTime.value = false;
  emit('resend-otp');
  if (otpForm.value) {
    otpForm.value.resetForm(); // Reset form khi resend OTP (tùy chọn)
  }
};

// Hàm xử lý khi modal đóng
const onModalClose = () => {
  // Reset các giá trị khi modal đóng
  if (otpForm.value) {
    otpForm.value.resetForm(); // Reset form khi đóng modal
  }
  openVerify.value = false;
  otpChecked.value = false; // Reset trạng thái OTP đã kiểm tra
  deadline.value = null; // Reset deadline
  endRemainingTime.value = false; // Reset trạng thái hết thời gian
};

// Hàm xử lý submit OTP
const onOtpSubmit = async (values, { setErrors }) => {
  console.log('OTP submitted:', values.userOtp);
  try {
    const response = await verifyOtp({
      identifier: props.identifier,
      otp: values.userOtp,
      type: props.type,
    });
    if (response.data.success) {
      otpChecked.value = true;
      openVerify.value = false;
      emit('otp-verified', values.userOtp); // Phát ra OTP cùng sự kiện
      message.success('OTP verified successfully!');
    } else {
      setErrors({ userOtp: 'Invalid OTP code' });
    }
  } catch (error) {
    console.error('Error verifying OTP:', error);
    setErrors({ userOtp: 'An error occurred while verifying OTP' });
  }
};

// Expose phương thức showModal để parent component gọi
defineExpose({
  showModal,
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";

.verify-modal {
  display: flex;
  flex-direction: column;
  align-items: stretch;
  text-align: center;
  &__img-icon {
    margin: 0 auto 2rem;
  }
  .error-message {
    margin-top: 4px;
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
    margin-bottom: 4px;
  }
  &__target {
    font-size: 14px;
    font-weight: 700;
    color: #294563;
    margin-bottom: 8px;
  }
  &__input {
    width: 100%;
    height: 44px;
    border-radius: 99999px;
    border: 1px solid #EAECEF;
  }
  &__btn {
    margin: 1.6rem auto 0;
    height: 44px;
    font-size: 16px;
    text-transform: uppercase;
    min-width: 160px;
  }
  &__remaining-time {
    font-weight: 400;
    color: var(--Text-Body-2, #62626b);
    text-align: center;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin: 2rem 0 0;
    font-family: $font-family;
    .ant-statistic-content {
      font-size: 14px;
      font-weight: 700;
      color: #FAA859;
      span {
        font-weight: 700;
      }
      .ant-statistic-content-suffix {
        margin: 0;
      }
    }
  }
  &__resend-code {
    color: #FAA859;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    margin-top: 2rem;
  }
}
</style>