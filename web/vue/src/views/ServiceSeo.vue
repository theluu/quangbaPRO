<template>
  <div class="page-wrap">
    <SeoIntroduction v-if="seoIntro" :item="seoIntro" />
    <SeoDefinition v-if="seoDefinition" :item="seoDefinition" />
    <SeoServices v-if="seoServices" :item="seoServices" />
    <SeoPricing v-if="seoPricing" :item="seoPricing" />
    <SeoProcess v-if="seoProcess" :item="seoProcess" />
    <SeoCommitment v-if="seoCommitment" :item="seoCommitment" />
    <KnowledgeForm />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import SeoIntroduction from "@/components/seo/SeoIntroduction.vue";
import SeoDefinition from "@/components/seo/SeoDefinition.vue";
import SeoServices from "@/components/seo/SeoServices.vue";
import SeoPricing from "@/components/seo/SeoPricing.vue";
import SeoProcess from "@/components/seo/SeoProcess.vue";
import SeoCommitment from "@/components/seo/SeoCommitment.vue";
import KnowledgeForm from "@/components/knowledge/KnowledgeForm.vue";
import { useAuthStore } from "@/store.js";

const authStore = useAuthStore();

// Khởi tạo tất cả data refs
const seoIntro = ref([]);
const seoDefinition = ref([]);
const seoServices = ref([]);
const seoPricing = ref([]);
const seoProcess = ref([]);
const seoCommitment = ref([]);

// Helper function để fetch data an toàn
const fetchEndpoint = async (url, name) => {
  try {
    const response = await axios.get(url);
    return response.data?.data || null;
  } catch (err) {
    console.error(`Error fetching ${name}:`, err);
    return null;
  }
};

// Fetch dữ liệu từ API
const fetchData = async () => {
  try {
    const endpoint = authStore.config?.endpoint || {};

    // Fetch tất cả data song song để tối ưu performance
    const [
      introData,
      definitionData,
      servicesData,
      pricingData,
      processData,
      commitmentData,
    ] = await Promise.all([
      fetchEndpoint(endpoint.seoIntro, "seo intro"),
      fetchEndpoint(endpoint.seoDefinition, "seo definition"),
      fetchEndpoint(endpoint.seoServices, "seo services"),
      fetchEndpoint(endpoint.seoPricing, "seo pricing"),
      fetchEndpoint(endpoint.seoProcess, "seo process"),
      fetchEndpoint(endpoint.seoCommitment, "seo commitment"),
    ]);

    // Gán data vào refs
    seoIntro.value = introData;
    seoDefinition.value = definitionData;
    seoServices.value = servicesData;
    seoPricing.value = pricingData;
    seoProcess.value = processData;
    seoCommitment.value = commitmentData;
  } catch (error) {
    console.error("Error in fetchData:", error);
  }
};

onMounted(() => {
  fetchData();
});
</script>

<style lang="scss" scoped>
.page-wrap {
  padding: 0;
  overflow: hidden;
}
</style>
