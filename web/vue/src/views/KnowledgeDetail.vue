<template>
  <div class="page-knowledge-detail">
    <div class="section-breadcrumb bg-grey-1">
        <Breadcrumb :crumbs="breadcrumbs" />
    </div>
    
    <div class="section-knowledge-detail">
        <div class="container knowledge-layout">
            <div class="row">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <KnowledgeDetailComponent :article="knowledgeDetail" />
                </div>
                <div class="col-lg-4">
                    <RelatedNews :relatedNews="relatedNews" />
                </div>
            </div>
            <KnowledgeRelatedPosts :items="relatedPosts" />
            <KnowledgeComments :items="comments" />
            <KnowledgeCommentForm :nid="numericId" @submitted="handleCommentSubmitted" />
        </div>
        <KnowledgeTopics :items="topics" />
    </div>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router';
import { ref, onMounted, computed, watch } from "vue";
import axios from "axios";
import KnowledgeTopics from '@/components/knowledge/KnowledgeTopics.vue';
import KnowledgeDetailComponent from '@/components/knowledge/KnowledgeDetail.vue';
import RelatedNews from '@/components/knowledge/RelatedNews.vue';
import KnowledgeRelatedPosts from '@/components/knowledge/KnowledgeRelatedPosts.vue';
import KnowledgeComments from '@/components/knowledge/KnowledgeComments.vue';
import KnowledgeCommentForm from '@/components/knowledge/KnowledgeCommentForm.vue';
import Breadcrumb from '@/components/Breadcrumb.vue';
import { useAuthStore } from "@/store.js";

const authStore = useAuthStore();
const route = useRoute();
const id = computed(() => route.params.id);
const numericId = computed(() => Number.parseInt(id.value, 10) || 0);

const breadcrumbs = computed(() => [
    { text: 'Trang chủ', to: '/' },
    { text: 'Kiến thức', to: '/knowledge' },
    { text: knowledgeDetail.value?.categories?.[0]?.title || 'Chi tiết bài viết', to: '/knowledge' },
    { text: knowledgeDetail.value?.title || '', to: '' }
]);

const topics = ref([]);
const knowledgeDetail = ref({});
const relatedNews = ref([]);
const relatedPosts = ref([]);
const comments = ref([]);

// Fetch dữ liệu từ file JSON bằng Axios
const fetchData = async () => {
  try {
    const endpoint = authStore.config?.endpoint || {};
    const params = numericId.value ? { nid: numericId.value } : {};

    const [topicsResponse, detailResponse, latestResponse, relatedPostsResponse, commentsResponse] = await Promise.all([
      axios.get(endpoint.knowledgeTopics).catch(err => {
        console.error("Error fetching topics:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.knowledgeDetail, { params }).catch(err => {
        console.error("Error fetching details:", err);
        return { data: { data: {} } };
      }),
      axios.get(endpoint.knowledgeRelatedNews, { params }).catch(err => {
        console.error("Error fetching latest news:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.knowledgeRelatedPosts, { params }).catch(err => {
        console.error("Error fetching related posts:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.knowledgeComments, { params }).catch(err => {
        console.error("Error fetching comments:", err);
        return { data: { data: [] } };
      }),
    ]);

    topics.value = topicsResponse.data.data || [];
    knowledgeDetail.value = detailResponse.data.data || {};
    relatedNews.value = latestResponse.data.data || [];
    relatedPosts.value = relatedPostsResponse.data.data || [];
    comments.value = commentsResponse.data.data || [];
    knowledgeDetail.value.comments = commentsResponse.data.count ?? knowledgeDetail.value.comments ?? 0;

  } catch (error) {
    console.error("Error fetching data:", error);
  }
};

const handleCommentSubmitted = ({ comments: nextComments, count }) => {
  comments.value = nextComments || [];
  knowledgeDetail.value = {
    ...knowledgeDetail.value,
    comments: count ?? nextComments?.length ?? 0,
  };
};

onMounted(() => {
  fetchData();
});

watch(() => route.params.id, () => {
  fetchData();
});
</script>

<style lang="scss" scoped>
  @import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.section-breadcrumb {
  padding: 12px 0;
}
.knowledge-layout {
    padding-bottom: 60px;
}
.section-knowledge-detail {
  padding-top: 36px;
  padding-bottom: 48px;
}
</style>
