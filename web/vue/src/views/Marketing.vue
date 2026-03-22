<template>
    <div class="section-marketing section-pad bg-grey-1">
        <div class="container">
            <SectionTitle 
                :headingTitle="{ textPrimary: 'DỊCH VỤ', textDangler: 'MARKETING' }"
                subTitle="Tiếp cận khách hàng tiềm năng một cách nhanh chóng, hiệu quả và tiết kiệm chi phí."
            />             
            <MarketingServices :items="marketingItems" />
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import SectionTitle from '@/components/SectionTitle.vue';
import MarketingServices from '@/components/marketing/MarketingServices.vue';
import { useAuthStore } from "@/store.js";

const authStore = useAuthStore();
const marketingItems = ref([]);

const fetchData = async () => {
    try {
        const endpoint = authStore.config?.endpoint || {};
        const [responseMarketing] = await Promise.all([
            axios.get(endpoint.marketing).catch(err => {
                console.error("Error fetching marketing:", err);
                return { data: { data: [] } };
            }),
        ]);

        marketingItems.value = responseMarketing.data.data || [];
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

onMounted(() => {
    fetchData();
});
</script>

<style lang="scss" scoped>

</style>