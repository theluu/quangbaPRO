<template>
    <!-- section -->
    <section class="section-news section-pad">
      <div class="container">
        <SectionTitle lineBottom :headingCate="headingSection.headingCate" :headingTitle="headingSection.headingTitle"/>
        <swiper :breakpoints="breakpointSlide" class="newsSwiper">
            <swiper-slide v-for="item in props.items" :key="item.id">
              <NewsItem :item="item" />
            </swiper-slide>
        </swiper>
        <ViewDetail :textLink="'Xem tất cả'" />
      </div>
    </section>
    <!-- e: section -->
</template>

<script setup>
    import SectionTitle from '@/components/SectionTitle.vue';
    import ViewDetail from '@/components/ViewDetail.vue';
    import NewsItem from './components/NewsItem.vue';
    import { Swiper, SwiperSlide } from 'swiper/vue';
    import { defineProps } from 'vue';

    const props = defineProps({
        items: {
            type: Object,
            default: () => {}
        }
    })

    const headingSection = {
        headingCate: {
            iconClass: "ico-news",
            text: "Kiến thức"
        },
        headingTitle: {
            textPrimary: "kiến thức",
            textDangler: "nổi bật"
        }
    }
    const breakpointSlide = {
        '0': {
            slidesPerView: 1,
            spaceBetween: 16,
        },
        '640': {
            slidesPerView: 2,
            spaceBetween: 16,
        },
        '1024': {
            slidesPerView: 3,
            spaceBetween: 16,
        }
    }
</script>
