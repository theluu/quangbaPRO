<template>
  <!-- section -->
  <swiper
    :navigation="true"
    :pagination="{ clickable: true }"
    :modules="[Navigation, Pagination]"
    class="mySwiper navigation-circle pagination-solid"
  >
    <swiper-slide v-for="item in items" :key="item.id">
      <BannerItem :item="item" />
    </swiper-slide>
  </swiper>
  <!-- e: section -->
</template>

<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Pagination } from "swiper/modules";
import BannerItem from "./components/BannerItem.vue";
import { defineProps } from "vue";

const { items } = defineProps({
  items: {
    type: Array,
    default: () => [],
  },
});
</script>

<style lang="scss">
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.navigation-circle {
  .swiper-button-next,
  .swiper-button-prev {
    display: none;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.64);
    box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.25);
    background-position: center center;
    background-repeat: no-repeat;
    background-image: url("@/assets/images/icons/arrow-right-length.svg");
    @include breakpoint(md) {
      display: block;
    }
    svg {
      display: none;
    }
  }
  .swiper-button-prev {
    transform: rotate(180deg);
  }
}
.pagination-solid {
  .swiper-horizontal > .swiper-pagination-bullets,
  .swiper-pagination-bullets.swiper-pagination-horizontal {
    height: 20px;
    bottom: 20px;
    top: unset;
    @include breakpoint(md) {
      bottom: 36px;
    }
  }
  .swiper-pagination-bullet {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #fff;
    opacity: 0.5;
    margin: 0 5px;
    border: 5px solid #fff;
    &.swiper-pagination-bullet-active {
      opacity: 1;
      background-color: #fbbc05;
    }
  }
}
</style>
