<template>
    <div class="section-heading text-center" :class=" lineBottom ? 'section-line-bottom' : 'section-line-slides' ">
        <div v-if="headingCate">
            <div class="section-heading-cate text-uppercase">
                <span class="icon me-2"><i :class="headingCate.iconClass"></i></span>
                <span class="txt">{{ headingCate.text }}</span>
            </div>
        </div>
        <div v-if="headingTitle">
            <h2 class="section-title mb-0 text-uppercase" :class="{'text-white' : isWhiteText}">
                <span class="text-primary-color">{{ headingTitle.textPrimary }}</span>&nbsp;<span class="text-danger-color">{{ headingTitle.textDangler }}</span>
            </h2>
        </div>
        <div v-if="subTitle" class="section-sub-title" :class="{'text-white' : isWhiteText}" v-html="subTitle"></div>
    </div>
</template>
<script setup>
    import { defineProps } from 'vue';
    const props = defineProps({
        lineBottom: {
            type: Boolean,
            default: false
        },
        headingCate: {
            iconClass: {
                type: String
            },
            text: {
                type: String
            }
        },
        headingTitle: {
            textPrimary: {
                type: String
            },
            textDangler: {
                type: String
            }
        },
        subTitle: {
            type: String
        },
        isWhiteText: {
            type: Boolean,
            default: false
        }
    });
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.section-heading {
    margin-bottom: 24px;
    @include breakpoint(md) {
        margin-bottom: 48px;
    }
}
.section-line-bottom {
    .section-title {
        &::after {
            display: block;
            content: "";
            height: 2px;
            width: 100px;
            background-color: $danger-1;
            margin: 16px auto 0;
        }
    }    
}
.section-heading-cate {
    padding: 12px 24px;
    border-radius: 50px;
    background-color: $grey-1;
    display: inline-flex;
    color: $grey-3;
    margin-bottom: 16px;
    align-items: center;
    span {
        display: inline-block;
        line-height: 1;
    }
    .icon {
        vertical-align: middle;
        color: $primary-1;
        [class*='fa-'] { 
            vertical-align: 0;
        }
    }
}
.section-title {
    font-weight: 700;
    font-size: 22px;
    @include breakpoint(md) {
        font-size: 32px;
    }
    &.text-white {
        .text-primary-color, .text-danger-color {
            color: $white;
        }
    }
}
.section-sub-title {
    margin-top: 24px;
}
.bg-grey-1 {
    .section-heading-cate {
        background-color: $white;
    }
}
.section-line-slides {
    .section-title {
        display: inline-block;
        padding-left: 86px;
        padding-right: 86px;
        position: relative;
        @include breakpoint(md) {
            padding-left: 96px;
            padding-right: 96px;
        }
        &::before, &::after {
            content: "";
            display: block;
            height: 2px;
            width: 70px;
            background-color: $danger-1;
            position: absolute;
            top: 50%;
            transform: translate(0,-50%);
            @include breakpoint(md) {
                width: 80px;
            }
        }
        &::before {
            left: 0;
        }
        &::after {
            right: 0;
        }
    }
}
</style>
