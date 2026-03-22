<template>
  <div class="google-ads-page">
    <AdsServices :data="adsServicesData" @register="handleClick" />
    <AdsStrategies :data="adsStrategiesData" />
    <AdsProcess :data="adsProcessData" @register="handleClick" />
    <AdsCommitment :data="adsCommitmentData" />
    <Testimonials :items="testimonials" isButton @click="handleClick" isBgWhite />    
    <Partners :items="partners" />
    <WpFAQ :items="wpfaq" />
    <KnowledgeForm />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useAuthStore } from "@/store.js";
import Testimonials from '@/components/home/Testimonials.vue';
import Partners from '@/components/home/Partners.vue';
import WpFAQ from "@/components/themewp/WpFAQ.vue";
import KnowledgeForm from "@/components/knowledge/KnowledgeForm.vue";
import AdsServices from '@/components/googleads/AdsServices.vue';
import AdsStrategies from '@/components/googleads/AdsStrategies.vue';
import AdsProcess from '@/components/googleads/AdsProcess.vue';
import AdsCommitment from '@/components/googleads/AdsCommitment.vue';

const authStore = useAuthStore();

const testimonials = ref([]);
const partners = ref([]);
const wpfaq = ref([]);
const adsServicesData = ref({});
const adsStrategiesData = ref({});
const adsProcessData = ref({});
const adsCommitmentData = ref({});

const handleClick = () => {
  console.log("Button clicked");
};

const fetchData = async () => {
  try {
    const endpoint = authStore.config?.endpoint || {};
    const [responseTestimonial, responsePartners, responseWpfaq, responseAdsServices, responseAdsStrategies, responseAdsProcess, responseAdsCommitment] = await Promise.all([
      axios.get(endpoint.testimonials).catch((err) => {
        console.error("Error fetching testimonials:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.partners).catch((err) => {
        console.error("Error fetching partners:", err);
        return { data: { data: [] } };
      }),
          axios.get(endpoint.wpfaq).catch((err) => {
        console.error("Error fetching wpfaq:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.googleAdsFeatures).catch((err) => {
        console.error("Error fetching ads services:", err);
        return { data: { data: {} } };
      }),
      axios.get(endpoint.googleAdsStrategies).catch((err) => {
        console.error("Error fetching ads strategies:", err);
        return { data: { data: {} } };
      }),
      axios.get(endpoint.googleAdsProcess).catch((err) => {
        console.error("Error fetching ads process:", err);
        return { data: { data: {} } };
      }),
      axios.get(endpoint.googleAdsCommitment).catch((err) => {
        console.error("Error fetching ads commitment:", err);
        return { data: { data: {} } };
      }),
    ]);

    testimonials.value = responseTestimonial.data.data || [];
    partners.value = responsePartners.data.data || [];
    wpfaq.value = responseWpfaq.data.data || [];
    adsServicesData.value = responseAdsServices.data.data || {};
    adsStrategiesData.value = responseAdsStrategies.data.data || {};
    adsProcessData.value = responseAdsProcess.data.data || {};
    adsCommitmentData.value = responseAdsCommitment.data.data || {};
  } catch (error) {
    console.error("Error fetching data:", error);
  }
};

onMounted(() => {
  fetchData();
});
</script>
<style scoped lang="scss">
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";


</style>