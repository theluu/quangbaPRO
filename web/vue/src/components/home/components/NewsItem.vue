<template>
    <div class="news-item">
        <div class="news-item-img">
            <RouterLink :to="{ name: 'knowledge-detail', params: { id: item.id } }">
                <img :src="getImgUrl('../../../src/assets/images/news',props.item.src)" :alt="item.title" />
            </RouterLink>
        </div>
        <div class="news-item-content">
            <h3 class="news-item-title">
                <RouterLink :to="{ name: 'knowledge-detail', params: { id: item.id } }">
                    {{ item.title }}
                </RouterLink>
            </h3>
            <div class="news-item-date"><i class="fa-light fa-calendar-days me-1"></i> {{ item.createdDate }}</div>
            <div class="news-item-desc">{{ item.desc }}</div>
            <div class="news-item-view-detail">
                <RouterLink :to="{ name: 'knowledge-detail', params: { id: item.id } }">
                    {{  Drupal.t('Xem thêm') }} <i class="fa-regular fa-arrow-right-long ms-1"></i>
                </RouterLink>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { defineProps } from 'vue';
    import getImgUrl from '@/utils/getUrlImg'
    const props = defineProps({
        item: {
            type: Object,
            default: () => {}
        }
    })
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.news-item {
    border-radius: 20px;
    border: 1px solid #EEEEEE;
    padding: 20px;
}
.news-item-img {
    margin-bottom: 20px;
    img {
        width: 100%;
        border-radius: 16px;
    }
}
.news-item-title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 16px;
}
.news-item-date {
    font-size: 15px;
    margin-bottom: 16px;
}
.news-item-desc {
    margin-bottom: 16px;
}
.news-item-view-detail {
    a {
        color: $primary-1;
    }
}
</style>