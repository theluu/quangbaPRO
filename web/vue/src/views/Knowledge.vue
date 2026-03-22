<template>
    <div>
        <Banner :items="banners" />
        <KnowledgeCategories :items="categories" />
        <KnowledgeList :items="list" />
        <KnowledgeTopics :items="topics" />
        <KnowledgeForm />
    </div>
</template>

<script setup>
import Banner from '@/components/common/Banner.vue';
import KnowledgeCategories from '@/components/knowledge/KnowledgeCategories.vue';
import KnowledgeTopics from '@/components/knowledge/KnowledgeTopics.vue';
import KnowledgeList from '@/components/knowledge/KnowledgeList.vue';
import KnowledgeForm from '@/components/knowledge/KnowledgeForm.vue';
import { ref, onMounted } from "vue";
import axios from "axios";
import { useAuthStore } from "@/store.js";

const authStore = useAuthStore();

const banners = ref([]);
const categories = ref([]);
const list = ref([]);
const topics = ref([]);

// Fetch dữ liệu từ file JSON bằng Axios
const fetchData = async () => {
  try {
    const endpoint = authStore.config?.endpoint || {};

    // Fetch data song song để tối ưu performance
    const [bannersResponse, categoriesResponse, listResponse, topicsResponse] = await Promise.all([
      axios.get(endpoint.bannerKnowledge).catch(err => {
        console.error("Error fetching banners:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.knowledgeCategories).catch(err => {
        console.error("Error fetching categories:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.knowledgeList).catch(err => {
        console.error("Error fetching list:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.knowledgeTopics).catch(err => {
        console.error("Error fetching topics:", err);
        return { data: { data: [] } };
      }),
    ]);

    banners.value = bannersResponse.data.data || [];
    categories.value = categoriesResponse.data.data || [];
    list.value = listResponse.data.data || [];
    topics.value = topicsResponse.data.data || [];

  } catch (error) {
    console.error("Error fetching data:", error);
  }
};

// Gọi hàm fetchData khi component được mount
onMounted(() => {
  fetchData();
});
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
</style>
