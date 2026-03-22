<template>
  <!-- section -->
  <section class="section-service">
    <div class="section-inner section-pad">
      <div class="container">
        <SectionTitle :subTitle="headingSection.subTitle" :headingTitle="headingSection.headingTitle" />
        <div class="service-list">
          <swiper :breakpoints="breakpointSlide" class="serviceSwiper">
            <swiper-slide v-for="item in props.items" :key="item.id">
              <ServiceItem :item="item" />
            </swiper-slide>
          </swiper>
        </div>
      </div>
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import SectionTitle from "@/components/SectionTitle.vue";
import ServiceItem from "./components/ServiceItem.vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import { defineProps } from "vue";

const props = defineProps({
  items: {
    type: Object,
    default: () => { },
  },
});

const breakpointSlide = {
  0: {
    slidesPerView: 2,
    spaceBetween: 0,
  },
  640: {
    slidesPerView: 3,
    spaceBetween: 0,
  },
  768: {
    slidesPerView: 4,
    spaceBetween: 0,
  },
  992: {
    slidesPerView: 5,
    spaceBetween: 0,
  },
  1200: {
    slidesPerView: 6,
    spaceBetween: 0,
  },
};

const headingSection = {
  headingTitle: {
    textPrimary: "mẫu website",
    textDangler: "theo ngành nghề",
  },
  subTitle:
    "Khám phá những mẫu website đẹp, phù hợp với ngành nghề, lĩnh vực bạn quan tâm",
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.section-service {
  background: url("@/assets/images/services/bg-service.png") no-repeat center center;
  background-size: cover;
}

.section-inner {
  background-color: rgba($white, 0.4);
}

:deep(.swiper-slide) {
  border-left: 1px solid rgba($white, 0.8);
  height: unset;
}

.serviceSwiper {
  border: 1px solid rgba($white, 0.8);

}

:deep(.swiper-wrapper) {
  margin-left: -1px;
  height: unset;
}
</style>
