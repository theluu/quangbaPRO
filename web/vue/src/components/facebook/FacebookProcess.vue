<template>
    <section class="facebook-process section-pad">
        <div class="container">
            <SectionTitle :subTitle="headingSection.subTitle" :headingTitle="headingSection.headingTitle" />
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0" v-for="item in items" :key="item.id">
                    <div class="facebook-process-item h-100">
                        <div class="facebook-process-icon mb-3">
                            <img :src="getImgUrl('../../../src/assets/images/icons', item.icon)" :alt="item.title" />
                        </div>
                        <h4 class="facebook-process-title fw-bold mb-3">{{ item.title }}</h4>
                        <div class="facebook-process-desc">
                            <p class="mb-0">{{ item.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { defineProps } from "vue";
import SectionTitle from "@/components/SectionTitle.vue";
import getImgUrl from "@/utils/getUrlImg";

const props = defineProps({
    items: {
        type: Array,
        default: () => [],
    },
});

const headingSection = {
    headingTitle: {
        textPrimary: "Quy trình triển khai ",
        textDangler: "cho mỗi dự án",
    },
    subTitle:
        "Lorem ipsum dolor sit amet consectetur. Velit diam id quis pretium mauris convallis a amet. Ultrices cursus vestibulum nunc egestas. Pellentesque odio elit curabitur sit dictumst natoque ut habitant dolor. Enim scelerisque volutpat id arcu in pellentesque enim.",
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.facebook-process {
    background-color: #00469c;
    background-image: url(../../assets/images/facebook/facebook-process-bg.png);
    background-position: right bottom;
    background-repeat: no-repeat;
    color: $white;
}

.facebook-process-item {
    background: radial-gradient(50% 50% at 50% 50%, #FFFFFF 0%, #EEEEEE 100%);
    padding: 24px 16px;
    text-align: center;
    transition: all 0.3s ease;
    border-radius: 40px;
    color: $text-base-color;

    @include breakpoint(md) {
        border-radius: 80px;
        padding: 36px 24px;
    }

    &:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
}

.facebook-process-icon {
    height: 72px;
    display: flex;
    align-items: center;
    justify-content: center;

    img {
        max-height: 100%;
        width: auto;
    }
}

.facebook-process-title {
    font-size: 18px;
    line-height: 1.4;
}

.facebook-process-desc {
    font-size: 16px;
    line-height: 1.6;
}
</style>
