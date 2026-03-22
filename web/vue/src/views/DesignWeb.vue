<template>
  <div class="page-wrap">
    <DesignWebHero />
    <DesignWebBenefits :items="benefits" />
    <DesignWebSolutions :items="solutions" />
    <DesignWebProcess :items="processes" />
    <DesignWebCommitment :items="commitments" />
    
    <Partners :items="partners" />
    <Testimonials :items="testimonials" />
    <DesignWebReasons :items="reasons" />
    <DesignWebFAQ :items="faqs" />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

import Partners from '@/components/home/Partners.vue';
import Testimonials from '@/components/home/Testimonials.vue';
import DesignWebHero from '@/components/designweb/DesignWebHero.vue';
import DesignWebBenefits from '@/components/designweb/DesignWebBenefits.vue';
import DesignWebSolutions from '@/components/designweb/DesignWebSolutions.vue';
import DesignWebProcess from '@/components/designweb/DesignWebProcess.vue';
import DesignWebCommitment from '@/components/designweb/DesignWebCommitment.vue';
import DesignWebReasons from '@/components/designweb/DesignWebReasons.vue';
import DesignWebFAQ from '@/components/designweb/DesignWebFAQ.vue';
import { useAuthStore } from "@/store.js";

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const authStore = useAuthStore();

const partners = ref([]);
const testimonials = ref([]);
const benefits = ref([]);
const reasons = ref([]);
const solutions = ref([]);
const processes = ref([]);
const commitments = ref([]);
const faqs = ref([]);

// Fetch dữ liệu từ file JSON bằng Axios
const fetchData = async () => {
  try {
    const endpoint = authStore.config?.endpoint || {};

    // Fetch partners và testimonials song song để tối ưu performance
    const [partnersResponse, testimonialsResponse, benefitsResponse, reasonRes, solutionsRes, processesRes, commitmentRes, faqRes] = await Promise.all([
      axios.get(endpoint.partners).catch(err => {
        console.error("Error fetching partners:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.testimonials).catch(err => {
        console.error("Error fetching partners:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.benefits).catch(err => {
        console.error("Error fetching partners:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.reasonses).catch(err => {
        console.error("Error fetching partners:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.solutions).catch(err => {
        console.error("Error fetching partners:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.processes).catch(err => {
        console.error("Error fetching partners:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.commitments).catch(err => {
        console.error("Error fetching partners:", err);
        return { data: { data: [] } };
      }),
      axios.get(endpoint.faqs).catch(err => {
        console.error("Error fetching partners:", err);
        return { data: { data: [] } };
      }),
    ]);

    partners.value = partnersResponse.data.data || [];
    testimonials.value = testimonialsResponse.data.data || [];reasons
    benefits.value = benefitsResponse.data.data || [];
    reasons.value = reasonRes.data.data || []
    solutions.value = solutionsRes.data.data || []
    processes.value = processesRes.data.data || []    
    commitments.value = commitmentRes.data.data || []    
    faqs.value = faqRes.data.data || []    
    
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
:deep(.section-testimonial) {
  background-color: $white !important;
}
</style>

