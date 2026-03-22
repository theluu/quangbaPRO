<template>
    <!-- section -->
    <section class="section-partners bg-grey-1 section-pad">
      <img src="@/assets/images/themes/partner-background.png" alt="" class="partner-background" />
      <div class="container">
        <SectionTitle lineBottom :headingCate="headingSection.headingCate" :headingTitle="headingSection.headingTitle"/>

        <swiper :navigation="true" :modules="[Navigation]" :breakpoints="breakpointSlide" class="mySwiper navigation-circle">
            <swiper-slide v-for="item in props.items" :key="item.id">
              <PartnerItem :item="item" />
            </swiper-slide>
        </swiper>

      </div>
    </section>
    <!-- e: section -->
</template>

<script setup>
import SectionTitle from '@/components/SectionTitle.vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation } from 'swiper/modules';
import PartnerItem from './components/PartnerItem.vue';
import { defineProps } from 'vue';

const props = defineProps({
    items: {
        type: Object,
        default: () => {}
    }
})

const headingSection = {
    headingCate: {
        iconClass: "ico-shake-hand",
        text: "Hợp tác - đối tác"
    },
    headingTitle: {
        textPrimary: "Đối tác",
        textDangler: "của chúng tôi"
    }
}
const breakpointSlide = {
  '0': {
    slidesPerView: 2,
    spaceBetween: 16,
  },
  '640': {
    slidesPerView: 2,
    spaceBetween: 16,
  },
  '768': {
    slidesPerView: 3,
    spaceBetween: 16,
  },
  '1024': {
    slidesPerView: 4,
    spaceBetween: 16,
  },
  '1200': {
    slidesPerView: 5,
    spaceBetween: 16,
  },
}
</script>
<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.partner-background {
  display: none;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  min-width: 100%;
  min-height: 100%;
}
.section-partner-background {
  position: relative;
  overflow: hidden;
  &::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.2);
    z-index: 1;
  }
  .container {
    position: relative;
    z-index: 1;
  }
  .partner-background {
    display: block;
  }
}
</style>
