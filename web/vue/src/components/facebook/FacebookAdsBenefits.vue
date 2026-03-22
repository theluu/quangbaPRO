<template>
    <section class="facebook-benefits section-pad">
        <div class="container">
            <SectionTitle :subTitle="headingSection.subTitle" :headingTitle="headingSection.headingTitle" />
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0" v-for="item in items" :key="item.id">
                    <div class="facebook-benefit-item h-100">
                        <div class="facebook-benefit-icon mb-4">
                            <img :src="getImgUrl('../../../src/assets/images/icons', item.icon)" :alt="item.title" />
                        </div>
                        <h4 class="facebook-benefit-title fw-bold mb-3">{{ item.title }}</h4>
                        <div class="facebook-benefit-desc">
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
        textPrimary: "KHÔNG FACEBOOK AD",
        textDangler: "ẢNH HƯỞNG THẾ NÀO ĐẾN DOANH NGHIỆP",
    },
    subTitle:
        "Facebook Ads không chỉ là một công cụ quảng cáo, mà là đòn bẩy chiến lược giúp doanh nghiệp phát triển toàn diện — từ nhận diện thương hiệu, doanh số đến mối quan hệ khách hàng.",
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.facebook-benefits {
    background-color: #F8F8F8;
}

.facebook-benefit-item {
    background: radial-gradient(50% 50% at 50% 50%, #FFFFFF 0%, #EEEEEE 100%);
    padding: 48px 24px;
    text-align: center;
    transition: all 0.3s ease;

    &:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    &:nth-child(1) {
        border-radius: 80px 80px 80px 0;
    }

    &:nth-child(2) {
        border-radius: 80px 80px 0 80px;
    }

    &:nth-child(3) {
        border-radius: 0 80px 80px 80px;
    }

    &:nth-child(4) {
        border-radius: 80px 0 80px 80px;
    }
}

.facebook-benefit-icon {
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;

    img {
        max-height: 100%;
        width: auto;
    }
}

.facebook-benefit-title {
    font-size: 18px;
    line-height: 1.4;
}

.facebook-benefit-desc {
    font-size: 16px;
    line-height: 1.6;
}
</style>
