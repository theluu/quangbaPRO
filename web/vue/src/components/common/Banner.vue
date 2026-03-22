<template>
    <div class="banners">
        <swiper
            :autoplay="{
            delay: 2500,
            disableOnInteraction: false,
            }"
            :modules="[Autoplay]"
            class="mySwiper navigation-circle pagination-solid"
        >
            <swiper-slide v-for="item in items" :key="item.id">
                <img :src="getImgUrl('../../src/assets/images/banner',item.image)" alt="" class="img-fluid img-banner">
            </swiper-slide>
        </swiper>
    </div>
</template>
<script setup>
import { defineProps } from 'vue';
import getImgUrl from '@/utils/getUrlImg'
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay } from "swiper/modules";
const { items } = defineProps({
  items: {
    type: Array,
    default: () => []
  }
})
</script>
<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
img {
    min-height: 360px;
    object-fit: cover;
}
</style>