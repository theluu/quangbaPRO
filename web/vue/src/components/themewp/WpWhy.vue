<template>
  <!-- section why -->
  
  <section class="section-why section-pad">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="why-image">
            <img
              class="wp-countdown-img"
              src="@/assets/images/themes/why-img.png"
              alt=""
            />
          </div>
        </div>
        <div class="col-lg-6 mb-4 mb-lg-0">
          <div class="why-content">
            <h2 class="why-title fw-bold">Tại sao lại chọn chúng tôi</h2>
            <div class="why-items mb-4">
              <div class="why-item" v-for="item in props.items" :key="item.id">
                <div class="why-icon">
                  <img
                    :src="getIconSrc(item)"
                    :alt="item.title"
                  />
                </div>
                <div class="why-text flex-fill ps-3">
                  <h4 class="fw-semibold">{{ item.title }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- e: section why -->
</template>

<script setup>
import { defineProps } from "vue";
import getImgUrl from "@/utils/getUrlImg";

const themeImages = import.meta.glob(
  "../../assets/images/themes/*.png",
  { eager: true, query: "?url", import: "default" }
);

const props = defineProps({
  items: {
    type: Array,
    default: () => [],
  },
});

function getIconSrc(item) {
  if (item.src) return getImgUrl("", item.src);
  if (!item.icon) return "";
  return themeImages[`../../assets/images/themes/${item.icon}`] || "";
}
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.section-why {
  position: relative;
  background-repeat: no-repeat;
  background-position: top left;
  background-color: #FDF8F4;
  background-image: url("@/assets/images/themes/bg-why.svg");
  &::after {
    content: "";
    width: 100%;
    height: 100%;
    position: absolute;
    bottom: 0;
    right: 0;
    background: url("@/assets/images/themes/why-wave.svg") no-repeat bottom
        left;
  }
  .container {
    position: relative;
    z-index: 2;
  }
}
.why-title {
  font-size: 32px;
  margin-bottom: 24px;
  @include breakpoint(md) {
    font-size: 40px;
    margin-bottom: 36px;
  }
}
.why-items {
  display: flex;
  flex-wrap: wrap;
  gap: 1px;
  border-radius: 24px;
  overflow: hidden;
  background-color: #fff3cf;
}
.why-item {
  @include flexWidth(100%);
  background-color: $white;
  padding: 32px 24px;
  display: flex;
  align-items: center;
  @include breakpoint(md) {
    @include flexWidth(calc(50% - 1px));
  }
}
.why-icon {
  @include flexWidth(48px);
}
.why-text {
  h4 {
    font-size: 18px;
  }
}
</style>
