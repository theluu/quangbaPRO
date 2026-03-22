<template>
    <div class="featured-item text-center">
        <div class="featured-item-icon mb-3">
            <img :src="getImgUrl(srcRoot,item.src)" :alt="item.title" />
        </div>
        <h3 class="featured-item-title fw-bold mb-3 text-capitalize">{{ item.title }}</h3>
        <div class="featured-item-text">{{ item.desc }}</div>
    </div>
</template>
<script setup>
    import { defineProps } from 'vue';
    import getImgUrl from '@/utils/getUrlImg'
    const { item } = defineProps({
        item: {
            type: Object,
            default: () => {}
        },
        srcRoot: {
            type: String,
            default: '../../../src/assets/images/features'
        }
    })
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.featured-item {
    background-color: $white;
    border-radius: 16px;
    padding: 24px;
    min-height: 100%;
}
.featured-item-icon {
    img {
        border-radius: 50%;
    }
}
.featured-item-title {
    font-size: 18px;
}
</style>