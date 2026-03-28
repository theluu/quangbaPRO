<template>
  <section class="knowledge-form section-pad">
    <div class="container">
      <div class="form-wrapper">
        <SectionTitle
          :headingTitle="headingSection.headingTitle"
          :subTitle="headingSection.subTitle"
        />

        <form class="consultation-form" @submit.prevent="handleSubmit" novalidate>
          <div class="row g-3">
            <div class="col-md-6">
              <input
                type="text"
                class="form-control"
                :class="{ 'is-invalid': errors.name }"
                placeholder="Họ tên của bạn *"
                v-model.trim="formData.name"
                required
              />
              <div v-if="errors.name" class="field-error">{{ errors.name }}</div>
            </div>
            <div class="col-md-6">
              <input
                type="tel"
                class="form-control"
                :class="{ 'is-invalid': errors.phone }"
                placeholder="Số điện thoại *"
                v-model.trim="formData.phone"
                required
              />
              <div v-if="errors.phone" class="field-error">{{ errors.phone }}</div>
            </div>
            <div class="col-md-6">
              <input
                type="text"
                class="form-control"
                placeholder="Địa chỉ của bạn"
                v-model.trim="formData.address"
              />
            </div>
            <div class="col-md-6">
              <input
                type="email"
                class="form-control"
                :class="{ 'is-invalid': errors.email }"
                placeholder="Email *"
                v-model.trim="formData.email"
                required
              />
              <div v-if="errors.email" class="field-error">{{ errors.email }}</div>
            </div>
            <div class="col-12">
              <textarea
                class="form-control"
                rows="4"
                placeholder="Lĩnh vực, ghi chú"
                v-model.trim="formData.note"
              ></textarea>
            </div>
            <div class="col-12">
              <div class="recaptcha-placeholder">
                Trang này được bảo vệ bởi Google reCAPTCHA v3.
              </div>
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-submit" :disabled="isSubmitting">
                {{ isSubmitting ? 'ĐANG GỬI...' : 'ĐĂNG KÝ' }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<script setup>
import { reactive, ref } from "vue";
import SectionTitle from "@/components/SectionTitle.vue";

const RECAPTCHA_ACTION = "contact_lead_submit";
const PHONE_REGEX = /^[0-9+\s().-]{8,20}$/;

const headingSection = {
  headingTitle: {
    textPrimary: "ĐĂNG KÝ",
    textDangler: "TƯ VẤN MIỄN PHÍ",
  },
  subTitle: "",
};

const formData = reactive({
  name: "",
  phone: "",
  address: "",
  email: "",
  note: "",
});

const errors = reactive({
  name: "",
  phone: "",
  email: "",
});

const isSubmitting = ref(false);

const validateForm = () => {
  errors.name = "";
  errors.phone = "";
  errors.email = "";

  if (!formData.name || formData.name.length < 2) {
    errors.name = "Vui lòng nhập họ tên hợp lệ.";
  }

  if (!PHONE_REGEX.test(formData.phone)) {
    errors.phone = "Vui lòng nhập số điện thoại hợp lệ.";
  }

  if (!formData.email) {
    errors.email = "Vui lòng nhập email.";
  }
  else {
    const emailInput = document.createElement("input");
    emailInput.type = "email";
    emailInput.value = formData.email;

    if (!emailInput.checkValidity()) {
      errors.email = "Vui lòng nhập email hợp lệ.";
    }
  }

  return !errors.name && !errors.phone && !errors.email;
};

const getRecaptchaToken = async () => {
  const siteKey = window.drupalSettings?.recaptchaV3SiteKey;

  if (!siteKey) {
    return "";
  }

  if (!window.grecaptcha || typeof window.grecaptcha.execute !== "function") {
    throw new Error("reCAPTCHA chưa sẵn sàng. Vui lòng thử lại sau ít giây.");
  }

  return new Promise((resolve, reject) => {
    window.grecaptcha.ready(async () => {
      try {
        const token = await window.grecaptcha.execute(siteKey, {
          action: RECAPTCHA_ACTION,
        });
        resolve(token);
      }
      catch (error) {
        reject(error);
      }
    });
  });
};

const buildNote = () => {
  const parts = [];

  if (formData.address) {
    parts.push(`Dia chi: ${formData.address}`);
  }

  if (formData.note) {
    parts.push(`Ghi chu: ${formData.note}`);
  }

  return parts.join("\n");
};

const resetForm = () => {
  Object.assign(formData, {
    name: "",
    phone: "",
    address: "",
    email: "",
    note: "",
  });
};

const handleSubmit = async () => {
  if (isSubmitting.value || !validateForm()) {
    return;
  }

  isSubmitting.value = true;

  try {
    const recaptchaToken = await getRecaptchaToken();
    const response = await fetch("/api/contact/lead", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        name: formData.name,
        phone: formData.phone,
        email: formData.email,
        note: buildNote(),
        sourcePage: window.location.pathname,
        recaptchaToken,
        recaptchaAction: RECAPTCHA_ACTION,
      }),
    });

    const result = await response.json();

    if (!response.ok) {
      throw new Error(result.message || "Gửi thông tin thất bại.");
    }

    alert("Cảm ơn bạn đã đăng ký! Chúng tôi sẽ liên hệ trong thời gian sớm nhất.");
    resetForm();
  }
  catch (error) {
    alert(error.message || "Có lỗi xảy ra, vui lòng thử lại sau.");
  }
  finally {
    isSubmitting.value = false;
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.knowledge-form {
  background: url("@/assets/images/knowledge/bg-form.png") no-repeat center
    center / cover;
  position: relative;
}

.form-wrapper {
  position: relative;
  z-index: 1;
  max-width: 800px;
  margin: 0 auto;
}

:deep(.section-title) {
  color: $white;
  .text-primary-color {
    color: $white !important;
  }
  .text-danger-color {
    color: $danger-1 !important;
  }
}

.consultation-form {
  .form-control {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 8px;
    padding: 12px 16px;
    color: $text-base-color;
    border: 1px solid $white;

    &::placeholder {
      color: $text-base-color;
    }

    &:focus {
      border-color: $primary-1;
      box-shadow: none;
    }
  }
}

.field-error {
  color: $danger-1;
  font-size: 14px;
  margin-top: 6px;
}

.form-control.is-invalid {
  border-color: $danger-1;
}

.recaptcha-placeholder {
  background-color: rgba(255, 255, 255, 0.9);
  border-radius: 8px;
  overflow: hidden;
  color: $text-base-color;
  font-size: 14px;
  padding: 14px 16px;
}

.btn-submit {
  width: 100%;
  background: rgba(255, 255, 255, 0.9);
  color: $primary-1;
  border: none;
  border-radius: 8px;
  padding: 12px;
  font-weight: 700;
  text-transform: uppercase;
  transition: all 0.3s ease;

  &:hover {
    background: $primary-1;
    color: white;
  }

  &:disabled {
    opacity: 0.7;
    cursor: not-allowed;
  }
}
</style>
