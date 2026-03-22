<template>
  <div class="knowledge-detail-content">
    <div class="article-header">
      <h1 class="article-title">{{ article.title }}</h1>
      <div class="article-meta">
        <div class="meta-item">
          <i class="fa-light fa-user"></i>
          <span>Tác giả: <span class="text-uppercase">{{ article.author }}</span></span>
        </div>
        <div class="meta-item">
          <i class="fa-light fa-calendar-days"></i>
          <span>{{ article.publishDate }}</span>
        </div>
        <div class="meta-item">
          <i class="fa-light fa-comment-dots"></i>
          <span>{{ article.comments }}</span>
        </div>
      </div>
      <div class="article-intro" v-html="article.intro"></div>
    </div>

    <!-- Hightline Content -->
    <div class="hightline-content" v-if="article.hightLineConent">
      <p>{{ article.hightLineConent.title }}</p>
      <ul class="mb-0">
        <li v-for="(item, index) in article.hightLineConent.content" :key="index">
          {{ item }}
        </li>
      </ul>
    </div>

    <!-- Table of Contents -->
    <div class="toc-box" v-if="article.toc && article.toc.length">
      <div class="toc-header" @click="toggleTocbox">
        <i class="fa-solid fa-list-ul"></i>
        <span>Nội dung chính</span>
        <i class="fa-solid" :class="isTocOpen ? 'fa-angle-up' : 'fa-angle-down'"></i>
      </div>
      <div class="toc-body" v-show="isTocOpen">
        <ul>
          <li v-for="(item, index) in article.toc" :key="index">
            <div class="toc-item-row" @click="handleTocItemClick(item)">
                <a :href="item.children && item.children.length ? 'javascript:void(0)' : `#section-${item.id}`" 
                   :class="{ 'has-children': item.children && item.children.length, 'active': expandedItems.includes(item.id) }"
                   @click.prevent="item.children && item.children.length ? null : scrollToSection(item.id)"
                   >
                     {{ item.text }}
                </a>
            </div>
            
            <ul v-if="item.children && item.children.length" v-show="expandedItems.includes(item.id)" class="sub-toc">
                <li v-for="(child, cIndex) in item.children" :key="cIndex">
                    <a :href="`#section-${child.id}`" @click.prevent="scrollToSection(child.id)">{{ child.text }}</a>
                </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>

    <!-- Article Body -->
    <div class="article-body">
      <template v-for="(block, index) in article.content" :key="index" class="content-block">
        <!-- Heading -->
        <h2 v-if="block.type === 'heading'" :id="`section-${block.id}`" class="content-heading">
          {{ block.text }}
        </h2>
        
        <!-- Subheading -->
        <h3 v-if="block.type === 'subheading'" :id="`section-${block.id || block.text}`" class="content-subheading">
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
      </template>
    </div>

    <!-- Share Actions -->
    <div class="share-actions d-flex align-items-center flex-wrap justify-content-end">
       <span><i class="fa-light fa-share-nodes me-1"></i> Chia sẻ</span>
       <button class="btn btn-social"><i class="fa-brands fa-facebook-f"></i></button>
       <button class="btn btn-social"><i class="fa-brands fa-twitter"></i></button>
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
  }
});

const isTocOpen = ref(true);
const expandedItems = ref([]);

const toggleTocbox = () => {
  isTocOpen.value = !isTocOpen.value;
};

const handleTocItemClick = (item) => {
    if (item.children && item.children.length) {
        if (expandedItems.value.includes(item.id)) {
            expandedItems.value = expandedItems.value.filter(id => id !== item.id);
        } else {
            expandedItems.value.push(item.id);
        }
    } else {
        scrollToSection(item.id);
    }
};

const scrollToSection = (id) => {
    const element = document.getElementById(`section-${id}`);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.article-title {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 24px;
}

.article-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 24px;
  margin-bottom: 24px;
  font-size: 15px;

  .meta-item {
    display: flex;
    align-items: center;
    gap: 10px;
  }
}

.article-intro {
  margin-bottom: 24px;
  line-height: 1.6;
}

.hightline-content {
  font-style: italic;
  margin-bottom: 24px;
  @include breakpoint("md") {
    margin-bottom: 36px;
  }
  ul {
    padding-left: 17px;
    li {
      &:not(:last-child) {
        margin-bottom: 16px;
      }
    }
  }
}

.toc-box {
  background-color: $grey-1;
  border-radius: 8px;
  padding: 16px;
  margin-bottom: 24px;
  @include breakpoint("md") {
    margin-bottom: 36px;
  }
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
        margin-bottom: 16px;
        
        .toc-item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            
            a {
               color: $text-base-color;
               text-decoration: none;
               font-weight: 600;
               flex: 1;
               
               &:hover, &.active {
                 color: $primary-1;
               }
               
               &.has-children {
                   font-weight: 600;
               }
            }
            
            .toggle-icon {
                font-size: 12px;
                color: #666;
                margin-left: 8px;
                width: 20px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
        
        .sub-toc {
            margin-top: 16px;
            padding-left: 0;
            
            li {
                margin-bottom: 16px;
                a {                   
                    &:hover {
                        color: $primary-1;
                    }
                }
            }
        }
      }
    }
  }
}

.article-body {
  h2 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 16px;
  }
  
  h3 {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 16px;
  }

  p {
    margin-bottom: 16px;
  }

  img {
    max-width: 100%;
    border-radius: 16px;
    margin-bottom: 16px;
  }
}

.share-actions {
  margin-top: 40px;
  gap: 10px;
  
  .btn-social {
    @include square(30px);
    border-radius: 50%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: $black;    
    flex: 0 0 auto;
    min-height: unset;
    &:hover {
       transform: translateY(-2px);
    }
  }
}
</style>
