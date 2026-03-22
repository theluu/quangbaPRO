<template>
    <div class="text-center view-detail">
        <RouterLink
            class="btn btn-warning-color rounded-pill px-4 py-2"
            to="#"
          >
            <i class="fa-regular fa-arrow-right-long me-1"></i>
            {{ textLink }}
        </RouterLink>
    </div>
</template>
<script setup>
    import { defineProps } from 'vue';
    const props = defineProps({
        textLink: {
            type: String,
            default: ''
        }
    })
</script>
<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.view-detail {
    margin-top: 40px;
    overflow: hidden;
    .btn {
        position: relative;
        &::before, &::after {
            content: "";
            display: block;
            width: 2000px;
            height: 1px;
            background-color: #D9D9D9;
            position: absolute;
            top: 50%;
            transform: translate(0,-50%);
        }
        &::before {
            right: 100%;
            margin-right: 48px;
        }
        &::after {
            left: 100%;
            margin-left: 48px;
        }
    }
}
</style>