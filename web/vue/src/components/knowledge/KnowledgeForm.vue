<template>
  <section class="knowledge-form section-pad">
    <div class="container">
      <div class="form-wrapper">
        <SectionTitle
          :headingTitle="headingSection.headingTitle"
          :subTitle="headingSection.subTitle"
        />

        <form class="consultation-form" @submit.prevent>
          <div class="row g-3">
            <div class="col-md-6">
              <input
                type="text"
                class="form-control"
                placeholder="Họ tên của bạn *"
                required
              />
            </div>
            <div class="col-md-6">
              <input
                type="tel"
                class="form-control"
                placeholder="Số điện thoại *"
                required
              />
            </div>
            <div class="col-md-6">
              <input
                type="text"
                class="form-control"
                placeholder="Địa chỉ của bạn"
              />
            </div>
            <div class="col-md-6">
              <input type="email" class="form-control" placeholder="Email" />
            </div>
            <div class="col-12">
              <textarea
                class="form-control"
                rows="4"
                placeholder="Lĩnh vực, ghi chú"
              ></textarea>
            </div>
            <div class="col-12">
              <div class="recaptcha-placeholder">
                <img
                  src="@/assets/images/design-web/textbox.png"
                  class="w-100"
                  alt=""
                />
              </div>
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-submit">ĐĂNG KÝ</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<script setup>
import SectionTitle from "@/components/SectionTitle.vue";

const headingSection = {
  headingTitle: {
    textPrimary: "ĐĂNG KÝ",
    textDangler: "TƯ VẤN MIỄN PHÍ",
  },
  subTitle: "",
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

.recaptcha-placeholder {
  background-color: rgba(255, 255, 255, 0.9);
  border-radius: 8px;
  overflow: hidden;
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
}
</style>
