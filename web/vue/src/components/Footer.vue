<template>
  <footer class="footer pt-[68px]">
    <div class="container pb-[48px]">
      <div class="text-center logo-footer">
        <img
            alt="IEG logo"
            class="mx-auto"
            src="@/assets/images/logos/logo-footer.png"
          />
      </div>
      <div class="nav-footer text-center">
        <ul>
          <li><RouterLink to="#">Thiết Kế Web</RouterLink></li>
          <li><RouterLink to="#">Web Theme WP</RouterLink></li>
          <li><RouterLink to="#">Marketing</RouterLink></li>
          <li><RouterLink to="#">Tổ chức sự kiện</RouterLink></li>
          <li><RouterLink to="#">Giới thiệu</RouterLink></li>
          <li><RouterLink to="#">Dịch vụ</RouterLink></li>
        </ul>
      </div>

      <div class="row pb-4">
        <div class="col-md-6 col-lg-3 mb-4">
          <h3 class="title-footer fw-semibold" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">            
            {{ Drupal.t('Thông tin liên hệ') }}
            <i class="fa-regular fa-angle-up d-md-none"></i>
          </h3>
          <div class="collapse show collapse-footer" id="collapseExample"> 
            <ul class="list-unstyled group-links is-icon mb-0">
              <li>
                <span class="icon">
                  <i class="fa-regular fa-location-dot"></i>
                </span>
                Trụ sở chính: Số 9 - Phố Quỳnh Mai - Hai Bà Trưng - Hà Nội.</li>
              <li>
                <span class="icon">
                  <i class="fa-regular fa-location-dot"></i>
                </span>
                Cơ sở Đông Anh: Xóm Nhồi, Cổ Loa, Đông Anh, Hà Nội
              </li>
              <li>
                <span class="icon">
                  <i class="fa-regular fa-phone-volume"></i>
                </span>
                Hotline: 0886.633.889
              </li>
              <li>
                <span class="icon">
                  <i class="fa-regular fa-envelope"></i>
                </span>
                lienhe@quangbapro.com
              </li>
            </ul>
          </div>
        </div><!--/.col -->

        <div class="col-md-6 col-lg-3 mb-4">
          <h3 class="title-footer fw-semibold" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="true" aria-controls="collapseExample2">            
            {{ Drupal.t('Dịch vụ') }}
            <i class="fa-regular fa-angle-up d-md-none"></i>
          </h3>
          <div class="collapse show collapse-footer" id="collapseExample2">
            <ul class="list-unstyled group-links fw-medium mb-0">
              <li><RouterLink to="#">Thiết Kế Web</RouterLink></li>
              <li><RouterLink to="#">Web Theme WP</RouterLink></li>
              <li><RouterLink to="#">Quảng cáo Google</RouterLink></li>
              <li><RouterLink to="#">Quảng cáo Facebook</RouterLink></li>
              <li><RouterLink to="#">Dịch vụ SEO</RouterLink></li>
              <li><RouterLink to="#">SEO tổng thể</RouterLink></li>
            </ul>
          </div>
        </div><!--/.col -->

        <div class="col-md-6 col-lg-3 mb-4">
          <h3 class="title-footer fw-semibold" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="true" aria-controls="collapseExample3">            
            {{ Drupal.t('Thông tin hữu ích') }}
            <i class="fa-regular fa-angle-up d-md-none"></i>
          </h3>
          <div class="collapse show collapse-footer" id="collapseExample3">
            <ul class="list-unstyled group-links fw-medium mb-0">
              <li><RouterLink to="#">Chính sách bảo mật</RouterLink></li>
              <li><RouterLink to="#">Hình thức thanh toán</RouterLink></li>
              <li><RouterLink to="#">Chính sách bảo hành</RouterLink></li>
              <li><RouterLink to="#">Chính sách đổi trả dịch vụ</RouterLink></li>
              <li><RouterLink to="#">Quy định sử dụng tên miền</RouterLink></li>
              <li><RouterLink to="#">Liên hệ</RouterLink></li>
            </ul>
          </div>
        </div><!--/.col -->

        <div class="col-md-6 col-lg-3 mb-4">
          <div class="mb-4">
            <h3 class="title-footer fw-semibold" data-bs-toggle="collapse" data-bs-target="#collapseExample4" aria-expanded="true" aria-controls="collapseExample4">              
              {{ Drupal.t('Chúng tôi trên mạng xã hội') }}
              <i class="fa-regular fa-angle-up d-md-none"></i>
            </h3>
            <div class="collapse show collapse-footer" id="collapseExample4">
              <ul class="list-unstyled list-inline mb-0">
                <li class="list-inline-item">
                  <RouterLink to="#" target="_blank">
                    <img src="@/assets/images/icons/facebook.svg" alt=""/>
                  </RouterLink>
                </li>
                <li class="list-inline-item">
                  <RouterLink to="#" target="_blank">
                    <img src="@/assets/images/icons/youtube.svg" alt=""/>
                  </RouterLink>
                </li>
                <li class="list-inline-item">
                  <RouterLink to="#" target="_blank">
                    <img src="@/assets/images/icons/instagram.svg" alt=""/>
                  </RouterLink>
                </li>
                <li class="list-inline-item">
                  <RouterLink to="#" target="_blank">
                    <img src="@/assets/images/icons/linkedin.svg" alt=""/>
                  </RouterLink>
                </li>
              </ul>
            </div>
          </div>

          <h3 class="title-footer fw-semibold" data-bs-toggle="collapse" data-bs-target="#collapseExample5" aria-expanded="true" aria-controls="collapseExample5">            
            {{ Drupal.t('Đăng ký nhận tin') }}
            <i class="fa-regular fa-angle-up d-md-none"></i>
          </h3>
          <div class="collapse show collapse-footer" id="collapseExample5">
            <div class="news-letter">
              <input type="text" class="form-control flex-fill" placeholder="Email của bạn...">
              <button class="btn btn-primary-color text-nowrap"><i class="fa-regular fa-paper-plane me-1"></i> Gửi</button>
            </div><!--/.news-letter-->
          </div>
        </div><!--/.col -->
      </div>      
    </div>
    <div class="copyright text-center d-none d-md-block">
      <div class="container">
        © 2025 Quangbapro.com - Đơn vị tư vấn thiết kế website chuyên nghiệp hàng đầu Việt Nam
        <button class="btn-clear btn-back-top d-none d-lg-inline-block" @click="scrollToTop"><i class="fa-regular fa-arrow-up-long"></i></button>
      </div>
    </div>
  </footer>
</template>
<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.footer {
  padding-top: 24px;
  @include breakpoint(md) {
    padding-top: 48px;
  }
}
.logo-footer {
  margin-bottom: 28px;
}
.copyright {
  background-color: $primary-1;
  color: $white;
  padding: 24px 0;
  .container {
    position: relative;
  }
}
.nav-footer {
  padding: 14px 0;
  background: #f7f7f7;
  background: linear-gradient(90deg, rgba(255, 255, 255, 1) 0%, rgba(#f7f7f7, 1) 50%, rgba(#fff, 1) 100%);
  display: flex;
  justify-content: center;
  overflow: hidden;
  margin-bottom: 25px;
  @include breakpoint(md) {
    margin-bottom: 48px;
  }
  ul {
    list-style: none;
    padding: 0;
    margin: 0;
    position: relative;
    display: flex;
    flex-wrap: wrap;
    gap: 12px 0;
    &::before, &::after {
      content: "";
      display: block;
      height: 2px;
      position: absolute;
      top: 50%;
      @include translate(0,-50%);
      background-color: $danger-3;
      width: 500px;
    }
    &::before {
      right: 100%;
      margin-right: 24px;
    }
    &::after {
      left: 100%;
      margin-left: 24px;
    }
    li {
      display: inline-block;
      &:not(:last-child) {
        &::after {
          content: "";
          display: inline-block;
          @include square(5px);
          background-color: $grey-2;
          border-radius: 50%;
          margin: 0 24px;
          vertical-align: middle;
        }
      }
    }
  }
  a {
    font-size: 18px;
    font-weight: 600;
    color: $dark-1;
    &:hover {
      color: $primary-1;
    }
  }
}

.title-footer {
  font-size: 20px;
  // margin-bottom: 24px;
  position: relative;
  cursor: pointer;
  @include breakpoint(md) {
    cursor: text;
  }
  i {
    position: absolute;
    top: 0;
    right: 0;
    @include transition-value();
  }
  &[aria-expanded="false"] {
    // margin-bottom: 0;
    i {
      @include transform(rotate(180deg));
    }
  }
}
.group-links {
  li {
    &:not(:last-child) {
      margin-bottom: 16px;
    }
  }
  &.is-icon {
    li {
      position: relative;
      padding-left: 32px;
      .icon {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translate(0,-50%);
        width: 24px;
        font-size: 20px;
        color: $danger-3;
      }
    }
  }
}
.news-letter {
  display: flex;
  .form-control {
    border-radius: 6px 0 0 6px;
    border: none;
    background-color: $grey-1;
    height: 40px;
    padding: 6px 16px;
    &:focus {
      outline: none;
      box-shadow: none;      
    }
  }
  .btn {
    border-radius: 0 6px 6px 0;
  }
}
.btn-back-top {
  @include square(56px);
  border-radius: 50%;
  background-color: rgba($black,0.2);
  color: $white;
  text-align: center;
  position: absolute;
  top: -15px;
  right: 0;
  font-size: 20px;
  &:hover, &:focus {
    background-color: rgba($black,0.5);
  }
  @include breakpoint(xl) {
    left: 100%;
    right: auto;
  }
}
footer .collapse-footer {
  margin-top: 24px;
  @include breakpoint(md) {
    display: block;
    height: unset !important;
  }
}
</style>
<script setup>
const scrollToTop = () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  })
}
</script>
