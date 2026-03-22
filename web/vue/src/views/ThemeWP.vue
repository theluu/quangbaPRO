<template>
  <div class="theme-wp">
    <Banner />
    <WpPackages :items="wppackages" />
    <WpGift />
    <Services :items="services" />
    <Themes :items="themes" />
    <WpFeatured :items="wpfeatured" />
    <DesignWebProcess :items="processes" />
    <WpWhy :items="wpwhy" />
    <Testimonials :items="testimonials" />
    <Partners class="section-partner-background" :items="partners" />
    <WpFAQ :items="wpfaq" />
    <KnowledgeForm />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useAuthStore } from "@/store.js";
import Banner from "@/components/themewp/Banner.vue";
import WpPackages from "@/components/themewp/WpPackages.vue";
import WpGift from "@/components/themewp/WpGift.vue";
import Services from "@/components/home/Services.vue";
import WpWhy from "@/components/themewp/WpWhy.vue";
import Themes from "@/components/home/Themes.vue";
import WpFeatured from "@/components/themewp/WpFeatured.vue";
import DesignWebProcess from "@/components/designweb/DesignWebProcess.vue";
import Testimonials from '@/components/home/Testimonials.vue';
import Partners from '@/components/home/Partners.vue';
import WpFAQ from "@/components/themewp/WpFAQ.vue";
import KnowledgeForm from "@/components/knowledge/KnowledgeForm.vue";

const authStore = useAuthStore();
const wppackages = ref([]);
const themes = ref([]);
const services = ref([]);
const wpwhy = ref([]);
const wpfeatured = ref([]);
const processes = ref([]);
const testimonials = ref([]);
const partners = ref([]);
const wpfaq = ref([]);

// Fetch dữ liệu từ file JSON bằng Axios
const fetchData = async () => {
  try {
    const endpoint = authStore.config?.endpoint || {};
    const [
      responseWppackages,
      responseThemes,
      responseWpwhy,
      responseServices,
      responseWpfeatured,
      processesRes,
      responseTestimonials,
      responsePartners,
      responseWpfaq,
    ] = await Promise.all([
      axios.get(endpoint.wppackages).catch((err) => {
        console.error("Error fetching wppackages:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.themes).catch((err) => {
        console.error("Error fetching themes:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.wpwhy).catch((err) => {
        console.error("Error fetching why:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.services).catch((err) => {
        console.error("Error fetching partners:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.wpfeatured).catch((err) => {
        console.error("Error fetching partners:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.processes).catch((err) => {
        console.error("Error fetching partners:", err);
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

    wppackages.value = responseWppackages.data.data || [];
    themes.value = responseThemes.data.data || [];
    wpwhy.value = responseWpwhy.data.data || [];
    services.value = responseServices.data.data || [];
    wpfeatured.value = responseWpfeatured.data.data || [];
    processes.value = processesRes.data.data || [];
    testimonials.value = responseTestimonials.data.data || [];
    partners.value = responsePartners.data.data || [];
    wpfaq.value = responseWpfaq.data.data || [];
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
