<template>
  <!-- section SEO Contact Form -->
  <section class="section-seo-contact-form section-pad">
    <div class="container">
      <!-- Section Header -->
      <div class="contact-form-header text-center">
        <h2 class="contact-form-heading">
          {{ item.heading?.title }}
          <span class="text-highlight">{{ item.heading?.highlight }}</span>
        </h2>
      </div>

      <!-- Contact Form -->
      <div class="contact-form-wrapper">
        <form @submit.prevent="handleSubmit" class="contact-form">
          <div class="row g-3 g-md-4">
            <template v-if="item.form?.fields">
              <div
                v-for="(field, index) in item.form.fields"
                :key="index"
                :class="getFieldClass(field.width)"
              >
                <!-- Input Fields -->
                <input
                  v-if="field.type !== 'textarea'"
                  :type="field.type"
                  :name="field.name"
                  :placeholder="field.placeholder"
                  :required="field.required"
                  v-model="formData[field.name]"
                  class="form-control"
                />

                <!-- Textarea Field -->
                <textarea
                  v-else
                  :name="field.name"
                  :placeholder="field.placeholder"
                  :required="field.required"
                  v-model="formData[field.name]"
                  class="form-control form-textarea"
                  rows="5"
                ></textarea>
              </div>
            </template>

            <!-- reCAPTCHA -->
            <div class="col-12">
              <div class="recaptcha-wrapper">
                <label class="recaptcha-label">
                  <input type="checkbox" v-model="isVerified" class="recaptcha-checkbox" />
                  <i class="fa-light fa-check recaptcha-icon"></i>
                  <span class="recaptcha-text">Tôi không phải là người máy</span>
                </label>
                <div class="recaptcha-logo">
                  <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 256 78'%3E%3Ctext x='0' y='50' font-size='40' fill='%234285F4'%3EreCAPTCHA%3C/text%3E%3C/svg%3E" alt="reCAPTCHA" />
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12">
              <button type="submit" class="btn btn-submit" :disabled="!isVerified">
                {{ item.form?.submitText || 'ĐĂNG KÝ' }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import { ref, reactive, defineProps } from "vue";

const { item } = defineProps({
  item: {
    type: Object,
    default: () => ({}),
  },
});

// Form data
const formData = reactive({
  fullname: '',
  phone: '',
  address: '',
  email: '',
  message: ''
});

// reCAPTCHA verification
const isVerified = ref(false);

// Get field class based on width
const getFieldClass = (width) => {
  return width === 'half' ? 'col-12 col-lg-6' : 'col-12';
};

// Handle form submission
const handleSubmit = () => {
  if (!isVerified.value) {
    alert('Vui lòng xác nhận bạn không phải là người máy');
    return;
  }
  
  console.log('Form submitted:', formData);
  // Add your form submission logic here
  alert('Đăng ký thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.');
  
  // Reset form
  Object.keys(formData).forEach(key => formData[key] = '');
  isVerified.value = false;
};

</script>

<style lang="scss" scoped>
  @import "@/assets/mixins.scss";
  @import "@/assets/variables.scss";
  
  .section-seo-contact-form {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?w=1920') center/cover no-repeat;
    position: relative;
    
    &::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(2px);
    }
  }
  
  .contact-form-header {
    position: relative;
    z-index: 1;
    margin-bottom: 32px;
    
    @include breakpoint(md) {
      margin-bottom: 40px;
    }
    
    @include breakpoint(lg) {
      margin-bottom: 48px;
    }
  }
  
  .contact-form-heading {
    font-size: 24px;
    line-height: 1.3;
    margin-bottom: 0;
    color: #fff;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    
    @include breakpoint(md) {
      font-size: 28px;
    }
    
    @include breakpoint(lg) {
      font-size: 32px;
    }
    
    .text-highlight {
      color: #FFD54F;
      display: inline-block;
    }
  }
  
  .contact-form-wrapper {
    position: relative;
    z-index: 1;
    max-width: 900px;
    margin: 0 auto;
  }
  
  .contact-form {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 28px 20px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    
    @include breakpoint(md) {
      padding: 36px 32px;
      border-radius: 20px;
    }
    
    @include breakpoint(lg) {
      padding: 40px;
    }
  }
  
  .form-control {
    width: 100%;
    padding: 14px 18px;
    font-size: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #fff;
    color: #333;
    transition: all 0.3s ease;
    
    @include breakpoint(md) {
      padding: 16px 20px;
      font-size: 15px;
    }
    
    &::placeholder {
      color: #999;
    }
    
    &:focus {
      outline: none;
      border-color: #2196F3;
      box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
    }
    
    &:required:invalid {
      border-color: #ddd;
    }
  }
  
  .form-textarea {
    resize: vertical;
    min-height: 120px;
    font-family: inherit;
  }
  
  .recaptcha-wrapper {
    background: #F9F9F9;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 16px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    
    @include breakpoint(md) {
      padding: 18px 20px;
    }
  }
  
  .recaptcha-label {
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    margin-bottom: 0;
    user-select: none;
    
    &:hover {
      .recaptcha-checkbox {
        border-color: #2196F3;
      }
    }
  }
  
  .recaptcha-checkbox {
    appearance: none;
    width: 28px;
    height: 28px;
    border: 2px solid #ccc;
    border-radius: 4px;
    background: #fff;
    cursor: pointer;
    position: relative;
    transition: all 0.3s ease;
    flex-shrink: 0;
    
    &:checked {
      background: #10B981;
      border-color: #10B981;
      
      & + .recaptcha-icon {
        opacity: 1;
        transform: scale(1);
      }
    }
  }
  
  .recaptcha-icon {
    position: absolute;
    left: 48px;
    color: #fff;
    font-size: 18px;
    opacity: 0;
    transform: scale(0);
    transition: all 0.3s ease;
    pointer-events: none;
  }
  
  .recaptcha-text {
    font-size: 14px;
    color: #333;
    
    @include breakpoint(md) {
      font-size: 15px;
    }
  }
  
  .recaptcha-logo {
    width: 60px;
    height: 30px;
    
    img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
  }
  
  .btn-submit {
    width: 100%;
    padding: 16px 32px;
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius: 8px;
    background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
    border: none;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 16px rgba(33, 150, 243, 0.3);
    
    @include breakpoint(md) {
      padding: 18px 40px;
      font-size: 17px;
    }
    
    &:hover:not(:disabled) {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(33, 150, 243, 0.4);
      background: linear-gradient(135deg, #1976D2 0%, #1565C0 100%);
    }
    
    &:active:not(:disabled) {
      transform: translateY(0);
    }
    
    &:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }
  }
</style>
