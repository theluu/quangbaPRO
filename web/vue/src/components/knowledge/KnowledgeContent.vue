<template>
  <div class="knowledge-content">
    <div class="container">
      <div class="row">
        <!-- Main Content Column -->
        <div class="col-lg-8">
          <div class="article-header">
            <h1 class="article-title">{{ article.title }}</h1>
            <div class="article-meta">
              <div class="meta-item">
                <i class="fa-regular fa-user"></i>
                <span>Tác giả: {{ article.author }}</span>
              </div>
              <div class="meta-item">
                <i class="fa-regular fa-calendar"></i>
                <span>{{ article.publishDate }}</span>
              </div>
              <div class="meta-item">
                <i class="fa-regular fa-eye"></i>
                <span>Lượt xem: {{ article.views }}</span>
              </div>
            </div>
            <div class="article-intro">{{ article.intro }}</div>
          </div>

          <!-- Table of Contents -->
          <div class="toc-box" v-if="article.toc && article.toc.length">
            <div class="toc-header" @click="toggleToc">
              <i class="fa-solid fa-list-ul"></i>
              <span>Mục lục bài viết</span>
              <i class="fa-solid" :class="isTocOpen ? 'fa-angle-up' : 'fa-angle-down'"></i>
            </div>
            <div class="toc-body" v-show="isTocOpen">
              <ul>
                <li v-for="(item, index) in article.toc" :key="index">
                  <a :href="`#section-${index + 1}`">{{ item }}</a>
                </li>
              </ul>
            </div>
          </div>

          <!-- Article Body -->
          <div class="article-body">
            <div v-for="(block, index) in article.content" :key="index" class="content-block">
              <!-- Heading -->
              <h2 v-if="block.type === 'heading'" :id="`section-${block.id}`" class="content-heading">
                {{ block.text }}
              </h2>
              
              <!-- Subheading -->
              <h3 v-if="block.type === 'subheading'" class="content-subheading">
                {{ block.text }}
              </h3>

              <!-- Text -->
              <p v-if="block.type === 'text'" class="content-text">
                {{ block.text }}
              </p>

              <!-- Image -->
              <div v-if="block.type === 'image'" class="content-image">
                <img :src="getImgUrl('../../../src/assets/images/knowledge', block.src)" :alt="block.alt" />
              </div>
            </div>
          </div>

          <!-- Share Actions -->
          <div class="share-actions">
             <button class="btn btn-share"><i class="fa-solid fa-share-nodes"></i> Chia sẻ</button>
             <button class="btn btn-social btn-facebook"><i class="fa-brands fa-facebook-f"></i></button>
             <button class="btn btn-social btn-twitter"><i class="fa-brands fa-twitter"></i></button>
          </div>
        </div>

        <!-- Sidebar Column -->
        <div class="col-lg-4">
          <div class="sidebar-widget">
            <div class="widget-title">KIẾN THỨC MỚI NHẤT</div>
            <div class="widget-content">
              <div v-for="news in relatedNews" :key="news.id" class="sidebar-news-item">
                <div class="news-thumb">
                  <img :src="getImgUrl('../../../src/assets/images/knowledge', news.src)" :alt="news.title" />
                </div>
                <div class="news-info">
                  <h4 class="news-title">
                     <RouterLink :to="{ name: 'knowledge-detail', params: { id: news.id }}">{{ news.title }}</RouterLink>
                  </h4>
                  <div class="news-date">By Hoang Quyen • {{ news.date }}</div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="sidebar-widget consultation-widget">
            <div class="consultation-card">
               <div class="card-icon"><i class="fa-solid fa-phone-volume"></i></div>
               <h3>TƯ VẤN ĐIỆN THOẠI</h3>
               <p>Liên hệ để được tư vấn miễn phí về dịch vụ của chúng tôi</p>
               <div class="action-buttons">
                  <a href="tel:0123456789" class="btn btn-call"><i class="fa-solid fa-phone"></i> 0123 456 789</a>
                  <a href="#" class="btn btn-zalo"><i class="fa-solid fa-comment-dots"></i> Chat Zalo</a>
                  <a href="#" class="btn btn-messenger"><i class="fa-brands fa-facebook-messenger"></i> Chat Facebook</a>
               </div>
            </div>
          </div>

          <div class="sidebar-widget video-widget">
             <div class="widget-title">VIDEO QUẢNG CÁO</div>
             <div class="video-container">
                 <img src="@/assets/images/knowledge/video-thumb.png" alt="Video Thumbnail" class="img-fluid" />
                 <div class="play-button"><i class="fa-solid fa-play"></i></div>
             </div>
             <div class="video-caption">Giới thiệu về dịch vụ của chúng tôi</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, defineProps } from 'vue';
import getImgUrl from '@/utils/getUrlImg';

const props = defineProps({
  article: {
    type: Object,
    default: () => ({})
  },
  relatedNews: {
    type: Array,
    default: () => []
  }
});

const isTocOpen = ref(true);
const toggleToc = () => {
  isTocOpen.value = !isTocOpen.value;
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.knowledge-content {
  padding-bottom: 60px;
}

.article-title {
  font-size: 28px;
  font-weight: 700;
  color: #333;
  margin-bottom: 16px;
}

.article-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  margin-bottom: 24px;
  color: #666;
  font-size: 14px;

  .meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    
    i {
      color: $primary-1;
    }
  }
}

.article-intro {
  font-style: italic;
  font-weight: 500;
  margin-bottom: 24px;
  color: #555;
  line-height: 1.6;
}

.toc-box {
  background: #f8f9fa;
  border: 1px solid #e9ecef;
  border-radius: 8px;
  padding: 16px;
  margin-bottom: 30px;

  .toc-header {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 700;
    cursor: pointer;
    user-select: none;
    
    i:last-child {
      margin-left: auto;
    }
  }

  .toc-body {
    margin-top: 12px;
    
    ul {
      list-style: none;
      padding: 0;
      margin: 0;
      
      li {
        margin-bottom: 8px;
        
        a {
           color: #333;
           text-decoration: none;
           font-size: 15px;
           
           &:hover {
             color: $primary-1;
             text-decoration: underline;
           }
        }
      }
    }
  }
}

.article-body {
  .content-heading {
    font-size: 24px;
    font-weight: 700;
    margin-top: 32px;
    margin-bottom: 16px;
    color: #333;
  }
  
  .content-subheading {
    font-size: 20px;
    font-weight: 600;
    margin-top: 24px;
    margin-bottom: 12px;
    color: #444;
  }

  .content-text {
    margin-bottom: 16px;
    line-height: 1.6;
    color: #333;
    font-size: 16px;
    text-align: justify;
  }

  .content-image {
    margin: 24px 0;
    text-align: center;
    
    img {
      max-width: 100%;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
  }
}

.share-actions {
  margin-top: 40px;
  display: flex;
  gap: 10px;
  
  .btn-share {
    background: #f0f2f5;
    color: #333;
    font-weight: 600;
    
    &:hover {
      background: #e4e6eb;
    }
  }
  
  .btn-social {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    
    &.btn-facebook {
      background: #1877f2;
    }
    
    &.btn-twitter {
      background: #1da1f2;
    }
    
    &:hover {
       transform: translateY(-2px);
    }
  }
}

.sidebar-widget {
  margin-bottom: 30px;
  
  .widget-title {
    background: $text-base-color; // Or orange from design
    color: white;
    padding: 12px 16px;
    font-weight: 700;
    text-transform: uppercase;
    border-radius: 4px;
    margin-bottom: 20px;
    
    // Style override to match image specific widgets if needed
  }
  
  &.consultation-widget .widget-title {
     // Specific style
  }
}

.sidebar-news-item {
  display: flex;
  gap: 16px;
  margin-bottom: 20px;
  padding-bottom: 20px;
  border-bottom: 1px solid #eee;
  
  &:last-child {
    border-bottom: none;
    margin-bottom: 0;
  }
  
  .news-thumb {
    width: 100px;
    height: 70px;
    flex-shrink: 0;
    
    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 4px;
    }
  }
  
  .news-info {
    .news-title {
      font-size: 15px;
      line-height: 1.4;
      margin-bottom: 8px;
      font-weight: 600;
      
      a {
        color: #333;
        text-decoration: none;
        
        &:hover {
          color: $primary-1;
        }
      }
    }
    
    .news-date {
       font-size: 12px;
       color: #999;
    }
  }
}

.consultation-card {
  background: white;
  border: 1px solid #eee;
  padding: 24px;
  text-align: center;
  border-radius: 8px;
  
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
  .widget-title {
     background: #b18f6a; // Bronze color from image roughly
  }
  
  .video-container {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    
    .play-button {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 50px;
      height: 50px;
      background: rgba(0,0,0,0.6);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 20px;
      border: 2px solid white;
      transition: all 0.3s;
    }
    
    &:hover .play-button {
       background: $primary-1;
       border-color: $primary-1;
       transform: translate(-50%, -50%) scale(1.1);
    }
  }
  
  .video-caption {
    margin-top: 10px;
    font-weight: 600;
    color: #333;
  }
}
</style>
