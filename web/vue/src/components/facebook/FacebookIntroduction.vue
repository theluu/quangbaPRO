<template>
  <section class="facebook-intro section-pad">
    <div class="container">
      <div class="row align-items-lg-center">
        <div class="col-lg-6">
          <figure class="facebook-intro-img mb-4 mb-lg-0 text-center text-lg-start">
            <img class="img-fluid" src="../../assets/images/facebook/facebook-introduction-img.png" alt="" />
          </figure>
        </div>

        <div class="col-lg-6">
          <div class="facebook-intro-body">
            <h2 class="facebook-intro-title">Facebook - Mảnh đất đầy tiềm năng và bí ẩn</h2>
            <div class="facebook-intro-description">
              <span class="facebook-intro-description-icon">
                <img src="../../assets/images/facebook/facebook-icon-fb-circle.svg" alt="">
              </span>
              <div class="facebook-intro-description-content">
                Nhưng bạn có đang gặp phải những vấn đề sau khiến các doanh nghiệp không khai thác hết được sức mạnh của
                facebook?
              </div>
            </div>
            <div class="facebook-tabs">
              <nav>
                <div class="nav nav-tabs nav-tabs-horizontal" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                    <span class="nav-tab-icon"><i class="fa-thin fa-arrow-down-long"></i></span>Vấn đề nền tảng
                  </button>
                  <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                    <span class="nav-tab-icon"><i class="fa-thin fa-arrow-down-long"></i></span>Vấn đề tối ưu
                  </button>
                </div>
              </nav>
              <hr />
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                  <ul class="group-list-decimal list-unstyled">
                    <li>
                      <div class="decimal-badge">
                        <span class="decimal-number">1</span>
                      </div>
                      <div class="decimal-content">
                        Tài khoản bị “vô hiệu hóa” do không hiểu rõ chính sách Facebook: Lỗi né hệ thống, content
                        VPCS...
                      </div>
                    </li>
                    <li>
                      <div class="decimal-badge">
                        <span class="decimal-number">2</span>
                      </div>
                      <div class="decimal-content">
                        Tốn nhiều ngân sách mua tài nguyên Ivia, BM) nhưng vẫn không ổn định.
                      </div>
                    </li>
                    <li>
                      <div class="decimal-badge">
                        <span class="decimal-number">3</span>
                      </div>
                      <div class="decimal-content">
                        Updates từ Facebook: Camp lên không được duyệt, cứ add thẻ là bị hold tiền...
                      </div>
                    </li>
                    <li>
                      <div class="decimal-badge">
                        <span class="decimal-number">4</span>
                      </div>
                      <div class="decimal-content">
                        Page lên camp là bị hạn chế quảng cáo.
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import { defineProps } from "vue";

const { item } = defineProps({
  item: {
    type: Object,
    default: () => ({}),
  },
});
</script>

<style lang="scss">
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.facebook-intro-title {
  font-size: 22px;
  line-height: 1.4;
  margin-bottom: 24px;
  font-weight: 700;

  @include breakpoint(md) {
    font-size: 32px;
  }
}

.facebook-intro-description {
  background-color: #F2F5F9;
  border-radius: 36px;
  padding: 36px;
  font-size: 16px;
  line-height: 1.4;
  margin-bottom: 0;
  display: flex;
  align-items: center;

  @include breakpoint(md) {
    font-size: 18px;
  }

  &-icon {
    display: inline-block;
    min-width: 90px;
    width: 90px;
    height: 90px;
  }

  &-content {
    width: calc(100% - 90px);
    padding-left: 16px;
  }
}

.group-list-decimal {
  margin-bottom: 0;

  li {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;

    @include breakpoint(md) {
      margin-bottom: 24px;
    }

    &:last-child {
      margin-bottom: 0;
    }
  }
}

.decimal-badge {
  flex: 0 0 48px;
  width: 48px;
  height: 48px;
  background-image: url(../../assets/images/icons/ico-flower.svg);
  display: flex;
  align-items: center;
  justify-content: center;

  .decimal-number {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 700;
    color: white;
    background-color: #4285f4;
    border-radius: 50%;
  }
}

.decimal-content {
  padding-left: 12px;
  width: calc(100% - 48px);
}

.decimal-content {
  font-size: 16px;
  line-height: 1.5;
}

.facebook-tabs {
  padding: 24px 16px;
  border-radius: 24px;
  background-color: #fff;
  border-bottom: 1px solid #eee;

  @include breakpoint(md) {
    padding: 36px 24px;
    border-radius: 36px;
    margin-left: 30px;
    margin-right: 30px;
    margin-top: -30px;
  }

  hr {
    border-bottom: 1px solid #eee;
    margin: 24px 0;
    padding: 0;
    height: 1px;
    overflow: hidden;
  }
}

.nav-tabs-horizontal {
  border-bottom-width: 0;
  flex-wrap: nowrap;

  .nav-link {
    flex: 1;
    margin-bottom: 0;
    border: 0;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    padding: 0;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 16px;
    line-height: 1.4;
    font-weight: 600;
    color: #0D0D0D;

    @include breakpoint(md) {
      font-size: 20px;
      gap: 16px;
    }

    &.active {
      color: #015FC9;

      .nav-tab-icon {
        background-color: #015FC9;
        color: $white;
      }
    }

    &:nth-child(2n + 2) {
      justify-content: flex-end;
      border-left: 1px solid #eee;
      padding-left: 8px;

      @include breakpoint(md) {
        padding-left: 16px;
      }
    }
  }
}

.nav-tab-icon {
  width: 40px;
  height: 40px;
  min-width: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #F2F5F9;
  border-radius: 50%;
  color: #4285F4;

  @include breakpoint(md) {
    width: 72px;
    height: 72px;
  }

  i {
    font-size: 20px;

    @include breakpoint(md) {
      font-size: 40px;
    }
  }
}
</style>
