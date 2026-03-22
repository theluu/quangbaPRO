<template>
    <div class="partner-item">
        <img :src="getImgUrl(props.item.src)" :alt="item.alt" />
    </div>
</template>
<script setup>
    import { defineProps } from 'vue';
    const props = defineProps({
        item: {
            type: Object,
            default: () => {}
        }
    })
    
    const getImgUrl = (path) => {
        return new URL(`../../assets/images/partners/${path}`, import.meta.url).href
    }
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.partner-item {
    background-color: $white;
    border-radius: 12px;
    position: relative;
    padding-top: 49%;
    img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        max-height: 80%;
    }
}
</style>