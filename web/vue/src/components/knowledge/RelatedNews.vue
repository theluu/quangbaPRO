<template>
  <div class="related-news-sidebar">
    <div class="sidebar-widget">
      <h3 class="widget-title text-uppercase fw-bold fs-5 mb-3" style="background-image: url('../../../src/assets/images/knowledge/bg-sidebar-1.png');"><span class="inner">{{ Drupal.t('KIẾN THỨC MỚI NHẤT') }}</span></h3>
      <div class="widget-content">
        <div v-for="(news, index) in relatedNews" :key="news.id" class="sidebar-news-item" :class="{ 'is-first': index === 0 }">
          <div class="news-thumb">
            <img :src="getImgUrl('../../../src/assets/images/knowledge', news.src)" :alt="news.title" />
          </div>
          <div class="news-info">
            <h4 class="news-title">
              <RouterLink :to="{ name: 'knowledge-detail', params: { id: news.id }}">{{ news.title }}</RouterLink>
            </h4>
            <div class="news-date"><i class="fa-light fa-calendar-days"></i> {{ news.date }}</div>
            <div v-if="index === 0" class="news-desc">{{ news.description }}</div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="sidebar-widget consultation-widget">
      <h3 class="widget-title text-uppercase fw-bold fs-5" style="background-image: url('../../../src/assets/images/knowledge/bg-sidebar-2.png');"><span class="inner">{{ Drupal.t('TƯ VẤN ĐIỆN THOẠI') }}</span></h3>
      <div class="consultation-card">
        <div class="py-4">
          <div class="mb-3 fw-semibold">{{ Drupal.t('Bạn ngại đặt hàng? Vui lòng để lại số điện thoại để được tư vấn miễn phí') }}</div>
          <div class="consultation-by d-flex gap-3 flex-wrap">
            <div class="consultation-by-item">
              <RouterLink :to="'/lien-he'" target="_blank">
                <img src="@/assets/images/knowledge/phone.png" alt="Phone" class="img-fluid" />
              </RouterLink>
            </div>
            <div class="consultation-by-item">
              <RouterLink :to="'/lien-he'" target="_blank">
                <img src="@/assets/images/knowledge/zalo.png" alt="Zalo" class="img-fluid" />
              </RouterLink>
            </div>
            <div class="consultation-by-item">
              <RouterLink :to="'/lien-he'" target="_blank">
                <img src="@/assets/images/knowledge/messenger.png" alt="Messenger" class="img-fluid" />
              </RouterLink>
            </div>
          </div>
        </div>
      </div>
    </div><!--/.consultation-widget-->

    <div class="sidebar-widget consultation-widget no-bg">
      <h3 class="widget-title text-uppercase fw-bold fs-5" style="background-image: url('../../../src/assets/images/knowledge/bg-sidebar-2.png');"><span class="inner">{{ Drupal.t('TƯ VẤN ĐIỆN THOẠI') }}</span></h3>
      <div class="consultation-card">
        <div class="py-0">
          <div>{{ Drupal.t('Bạn ngại đặt hàng? Vui lòng để lại số điện thoại để được tư vấn miễn phí') }}</div>
        </div>
      </div>
    </div><!--/.consultation-widget-->

    <div class="sidebar-widget video-widget mb-0">
      <h3 class="widget-title text-uppercase fw-bold fs-5 mb-3" style="background-image: url('../../../src/assets/images/knowledge/bg-sidebar-3.png');"><span class="inner">{{ Drupal.t('VIDEO QUẢNG CÁO') }}</span></h3>
      <div class="video-container">
        <iframe width="100%" height="250" src="https://www.youtube.com/embed/LXb3EKWsInQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      </div>
      <div class="video-caption mt-4">{{ Drupal.t('Kênh video Youtube Chính Thức Của Quangbapro.Com') }}</div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import getImgUrl from '@/utils/getUrlImg';

const props = defineProps({
  relatedNews: {
    type: Array,
    default: () => []
  }
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.sidebar-widget {
  margin-bottom: 30px;
}

.widget-title {
  border-radius: 24px 8px 24px 8px;
  position: relative;
  z-index: 2;
  .inner {
    display: block;
    padding: 16px 24px;
    background: rgba(#FBBC05,0.8);
    background: linear-gradient(90deg, rgba(251, 188, 5, 0.8) 0%, rgba(255, 157, 61, 0.8) 100%);
    border-radius: 24px 8px 24px 8px;
  }
}

.sidebar-news-item {
  display: flex;
  gap: 16px;
  margin-bottom: 16px;
  
  &:last-child {
    margin-bottom: 0;
  }

  &.is-first {
    display: block;
    .news-thumb {
      width: 100%;
      height: auto;
      margin-bottom: 16px;
      img {
        aspect-ratio: 16/9;
      }
    }
    .news-title {
      font-size: 18px;
      margin-bottom: 16px;
    }
    .news-date {
      margin-bottom: 16px;
    }
  }
  
  .news-thumb {
    width: 160px;
    // height: 70px;
    flex-shrink: 0;
    
    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 16px;
    }
  }
  
  .news-title {
    font-size: 16px;
    line-height: 1.4;
    margin-bottom: 12px;
    font-weight: 600;
  }
  
  .news-date {
    font-size: 15px;
  }

  .news-desc {
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
}
.consultation-widget {
  .widget-title {
    margin-bottom: 0;
  }
}
.consultation-widget.no-bg {
  .consultation-card {
    background-color: transparent;
    padding-left: 0;
    padding-right: 0;
  }
}
.consultation-card {
  background-color: $grey-1;
  padding: 40px 16px 16px;
  border-radius: 0 0 24px 24px;
  margin-top: -24px;
  .card-icon {
     width: 60px;
     height: 60px;
     background: #FFF3E0;
     color: $primary-1;
     border-radius: 50%;
     display: flex;
     align-items: center;
     justify-content: center;
     margin: 0 auto 16px;
     font-size: 24px;
  }
  
  h3 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 8px;
    text-transform: uppercase;
  }
  
  p {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
  }
  
  .action-buttons {
    display: flex;
    flex-direction: column;
    gap: 10px;
    
    .btn {
       width: 100%;
       font-weight: 600;
       padding: 10px;
    }
    
    .btn-call {
       background: #ff0000;
       color: white;
       
       &:hover {
         background: darken(#ff0000, 10%);
       }
    }
    
    .btn-zalo {
       background: #0068ff;
       color: white;
    }
    
    .btn-messenger {
       background: #0084ff;
       color: white;
    }
  }
}

.video-widget { 
  .video-container {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    
    iframe {
      width: 100%;
      height: 250px;
      border: 0;
    }
  }
}
</style>
