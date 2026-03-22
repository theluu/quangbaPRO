<template>
  <div class="facebook-page">
    <Banner />
    <FacebookAdsBenefits :items="facebookBenefits" />
    <FacebookIntroduction />
    <FacebookServices :item="facebookServices" />
    <FacebookDisparity :item="facebookDisparity" />
    <FacebookProcess :items="facebookProcess" />
    <FacebookCommit />
    <Testimonials :is-bg-white="true" :items="testimonials" />
    <Partners :items="partners" />
    <WpFAQ :items="wpfaq" />
    <KnowledgeForm />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useAuthStore } from "@/store.js";
import Banner from "@/components/facebook/Banner.vue";
import FacebookAdsBenefits from "@/components/facebook/FacebookAdsBenefits.vue";
import FacebookIntroduction from "@/components/facebook/FacebookIntroduction.vue";
import FacebookServices from "@/components/facebook/FacebookServices.vue";
import FacebookDisparity from "@/components/facebook/FacebookDisparity.vue";
import FacebookProcess from "@/components/facebook/FacebookProcess.vue";
import FacebookCommit from "@/components/facebook/FacebookCommit.vue";
import Testimonials from '@/components/home/Testimonials.vue';
import Partners from '@/components/home/Partners.vue';
import WpFAQ from "@/components/themewp/WpFAQ.vue";
import KnowledgeForm from "@/components/knowledge/KnowledgeForm.vue";

const authStore = useAuthStore();
const facebookBenefits = ref([]);
const facebookServices = ref([]);
const facebookDisparity = ref([]);
const facebookProcess = ref([]);
const testimonials = ref([]);
const partners = ref([]);
const wpfaq = ref([]);

const fetchData = async () => {
  try {
    const endpoint = authStore.config?.endpoint || {};
    const [responseFacebookBenefits, responseServices, responseDisparity, responseProcess, responseTestimonials, responsePartners, responseWpfaq] = await Promise.all([
      axios.get(endpoint.facebookBenefits).catch((err) => {
        console.error("Error fetching facebookBenefits:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.facebookServices).catch((err) => {
        console.error("Error fetching facebookServices:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.facebookDisparity).catch((err) => {
        console.error("Error fetching facebookDisparity:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.facebookProcess).catch((err) => {
        console.error("Error fetching facebookProcess:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.testimonials).catch((err) => {
        console.error("Error fetching partners:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.partners).catch((err) => {
        console.error("Error fetching partners:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.wpfaq).catch((err) => {
        console.error("Error fetching partners:", err);
        return { data: { data: [] } };
      }),
    ]);

    facebookBenefits.value = responseFacebookBenefits.data.data || [];
    facebookServices.value = responseServices.data.data || [];
    facebookDisparity.value = responseDisparity.data.data || [];
    facebookProcess.value = responseProcess.data.data || [];
    testimonials.value = responseTestimonials.data.data || [];
    partners.value = responsePartners.data.data || [];
    wpfaq.value = responseWpfaq.data.data || [];
  } catch (error) {
    console.error("Error fetching data:", error);
  }
};

onMounted(() => {
  fetchData();
});
</script>
