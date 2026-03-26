<template>
  <!-- section hero -->
  <section class="section-design-web-hero">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="hero-content">
            <h1 class="hero-title fw-bold text-uppercase">
              THIẾT KẾ WEB THEO YÊU CẦU - <br/>
              GIAO DIỆN ĐỘC QUYỀN
            </h1>
            <div class="hero-features">
              <div class="hero-gift d-flex align-items-center mb-4">
                <span class="img"><img src="@/assets/images/design-web/gift.png" alt=""/></span>
                <span class="txt fw-semibold flex-fill">Quà tặng</span>
              </div>
              <div class="feature-item" v-for="(feature, index) in features" :key="index">
                <i class="fa-regular fa-circle-check"></i>
                <span>{{ feature }}</span>
              </div>
            </div>
            <RouterLink class="btn btn-green-color px-4 py-2 rounded-pill" to="#">
              <i class="fa-light fa-phone-volume me-2"></i>
              {{ Drupal.t('Gọi ngay 19001006') }}
            </RouterLink>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="hero-form">
            <h3 class="form-title fw-semibold text-center text-white">Đăng ký tư vấn miễn phí</h3>
            <form @submit.prevent="handleSubmit">
              <div class="form-group">
                <input 
                  type="text" 
                  class="form-control" 
                  placeholder="Họ và tên *"
                  v-model="formData.name"
                  required
                />
              </div>
              <div class="form-group">
                <input 
                  type="tel" 
                  class="form-control" 
                  placeholder="Số điện thoại *"
                  v-model="formData.phone"
                  required
                />
              </div>
              <div class="form-group">
                <input 
                  type="email" 
                  class="form-control" 
                  placeholder="Email"
                  v-model="formData.email"
                  required
                />
              </div>
              <div class="form-group">
                <textarea class="form-control" v-model="formData.note" placeholder="Lĩnh vực, ghi chú"></textarea>
              </div>
              <!-- <div class="form-group captcha">
                <img src="@/assets/images/design-web/textbox.png" alt=""/>
              </div> -->
              <button type="submit" class="btn btn-submit w-100 text-uppercase fw-semibold text-primary-color">
                Đăng ký
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- e: section hero -->
</template>

<script setup>
import { ref, reactive } from 'vue';

const RECAPTCHA_ACTION = 'contact_lead_submit';
const features = [
  'Sáng tạo phong cách riêng - Không trùng lặp',
  'Đáp ứng đầy đủ yêu cầu về tính năng, nội dung, thiết kế của dự án',
  'Website được thiết kế thân thiện với người dùng',
  'Bàn giao mã nguồn mở, không giới hạn thời gian sử dụng',
  'Miễn phí đăng ký tên miền'
];

const formData = reactive({
  name: '',
  phone: '',
  email: '',
  note: ''
});

const isSubmitting = ref(false);

const getRecaptchaToken = async () => {
  const siteKey = window.drupalSettings?.recaptchaV3SiteKey;

  if (!siteKey) {
    return '';
  }

  if (!window.grecaptcha || typeof window.grecaptcha.execute !== 'function') {
    throw new Error('reCAPTCHA chưa sẵn sàng. Vui lòng thử lại sau ít giây.');
  }

  return new Promise((resolve, reject) => {
    window.grecaptcha.ready(async () => {
      try {
        const token = await window.grecaptcha.execute(siteKey, {
          action: RECAPTCHA_ACTION
        });
        resolve(token);
      }
      catch (error) {
        reject(error);
      }
    });
  });
};

const handleSubmit = async () => {
  if (isSubmitting.value) {
    return;
  }

  isSubmitting.value = true;

  try {
    const recaptchaToken = await getRecaptchaToken();

    const response = await fetch('/api/contact/lead', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        name: formData.name,
        phone: formData.phone,
        email: formData.email,
        note: formData.note,
        recaptchaToken,
        recaptchaAction: RECAPTCHA_ACTION
      })
    });

    const result = await response.json();

    if (!response.ok) {
      throw new Error(result.message || 'Gửi thông tin thất bại.');
    }

    alert('Cảm ơn bạn đã đăng ký! Chúng tôi sẽ liên hệ trong thời gian sớm nhất.');

    Object.assign(formData, {
      name: '',
      phone: '',
      email: '',
      note: ''
    });
  }
  catch (error) {
    alert(error.message || 'Có lỗi xảy ra, vui lòng thử lại sau.');
  }
  finally {
    isSubmitting.value = false;
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.section-design-web-hero {
  background: url('@/assets/images/design-web/bg-design-web.png') no-repeat center center;
  background-size: cover;
  padding: 48px 0;
  position: relative;
  overflow: hidden;
  @include breakpoint(md) {
    padding: 98px 0;
  }
}

.hero-content {
  color: white;
  position: relative;
  z-index: 1;
}

.hero-title {
  font-size: 22px;
  margin-bottom: 24px;
  @include breakpoint(md) {
    font-size: 40px;
    margin-bottom: 30px;
  }
}
.hero-gift {
  .txt {
    padding-left: 20px;
    font-size: 20px;
    @include breakpoint(md) {
      font-size: 32px;
    }
  }
  .img {
    @include flexWidth(80px);
    text-align: center;
  }
}
.hero-features {
  margin-bottom: 30px;
}

.feature-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  margin-bottom: 36px;
  font-size: 18x;
  li {
    &:not(:last-child) {
      margin-bottom: 24px;
    }
  }
  i {
    color: $danger-3;
    font-size: 20px;
    flex-shrink: 0;
    margin-top: 2px;
  }
}

.hero-form {
  // background: rgba($white,0.6);
  background: radial-gradient(circle, rgba(255, 255, 255, 0.5) 0%, rgba(255, 255, 255, 0) 100%);
  border-radius: 80px;
  padding: 50px 45px;
  @include breakpoint(lg) {
    max-width: 570px;
    margin-left: auto;
  }
}

.form-title {
  font-size: 22px;
  margin-bottom: 24px;
  @include breakpoint(md) {
    font-size: 32px;
    margin-bottom: 38px;
  }
  &::after {
    content: "";
    display: block;
    margin: 16px auto 0;
    width: 120px;
    height: 1px;
    background-color: $danger-3;
  }
}

.form-group {
  margin-bottom: 16px;
}

.form-control {
  width: 100%;
  padding: 12px 16px;
  border: 1px solid #ddd;
  border-radius: 8px;
  transition: border-color 0.3s ease;
  @include placeholder($grey-5);
  &:focus {
    outline: none;
    border-color: $primary-1;
    box-shadow: 0 0 0 3px rgba(11, 125, 191, 0.1);
  }
}
textarea.form-control {
  height: 120px;
  overflow-x: hidden;
  overflow-y: auto;
}
.captcha {
  background-color: $white;
  border-radius: 8px;
  overflow: hidden;
}
.btn-submit {
  background-color: $white;
  border-color: $white;
  border-radius: 8px;
  font-size: 18px;
  min-height: 45px;
  &:hover, &:focus {
    background-color: $primary-1 ;
    border-color:   $primary-1;
    color: $white;
  }
}
</style>
