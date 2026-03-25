<template>
  <section class="section-search section-pad">
    <div class="container">
      <div class="search-header text-center mb-4">
        <h1 class="search-title">Kết quả tìm kiếm</h1>
        <p class="search-subtitle" v-if="keyword">
          Từ khóa: <strong>{{ keyword }}</strong>
        </p>
      </div>

      <Breadcrumb :crumbs="breadcrumbs" class="mb-4 mb-md-5" />

      <div v-if="loading" class="search-empty text-center py-5">
        Đang tìm kiếm...
      </div>

      <div v-else-if="!keyword" class="search-empty text-center py-5">
        Nhập từ khóa để bắt đầu tìm kiếm.
      </div>

      <div v-else-if="items.length === 0" class="search-empty text-center py-5">
        Không tìm thấy kết quả phù hợp.
      </div>

      <div v-else class="row gy-4">
        <div
          v-for="item in items"
          :key="item.id"
          class="col-md-6 col-lg-4"
        >
          <NewsItem :item="item" />
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import Breadcrumb from '@/components/Breadcrumb.vue';
import NewsItem from '@/components/home/components/NewsItem.vue';
import axios from 'axios';
import { computed, ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import { useAuthStore } from '@/store';

const route = useRoute();
const authStore = useAuthStore();

const loading = ref(false);
const items = ref([]);

const keyword = computed(() => String(route.query.q || '').trim());

const breadcrumbs = computed(() => [
  { text: 'Trang chủ', to: '/' },
  { text: 'Tìm kiếm', to: keyword.value ? `/tim-kiem?q=${encodeURIComponent(keyword.value)}` : '/tim-kiem' },
]);

const fetchResults = async () => {
  items.value = [];

  if (!keyword.value) {
    return;
  }

  const endpoint = authStore.config?.endpoint?.search;
  if (!endpoint) {
    return;
  }

  loading.value = true;
  try {
    const response = await axios.get(endpoint, {
      params: { q: keyword.value },
    });
    items.value = response.data.data || [];
  } catch (error) {
    console.error('Error fetching search results:', error);
  } finally {
    loading.value = false;
  }
};

watch(
  () => route.query.q,
  () => {
    fetchResults();
  },
  { immediate: true }
);
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.section-search {
  min-height: 50vh;
}

.search-title {
  font-size: 40px;
  font-weight: 800;
  margin-bottom: 12px;
}

.search-subtitle {
  font-size: 18px;
  margin-bottom: 0;
}

.search-empty {
  font-size: 20px;
  color: $text-base-color;
}

:deep(.breadcrumb) {
  justify-content: center;
}
</style>
