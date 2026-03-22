<template>
  <!-- section -->
  <section class="section-marketing">
    <div class="section-inner section-pad">
      <div class="container">
        <SectionTitle 
          :headingCate="headingSection.headingCate" 
          :headingTitle="headingSection.headingTitle"
          :subTitle="headingSection.subTitle"
          :isWhiteText="true"
        />
        <div class="row row-gap-y">
          <div class="col-md-6 col-lg-3" v-for="item in items" :key="item.id">
            <MarketingItem :item="item" />
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import SectionTitle from '@/components/SectionTitle.vue';
import MarketingItem from './components/MarketingItem.vue';
import { defineProps } from 'vue';

const { items } = defineProps({
  items: {
    type: Array,
    default: () => []
  }
})

const headingSection = {
  headingCate: {
    iconClass: "ico-sms-tracking",
    text: "MARKETING ONLINE"
  },
  headingTitle: {
    textPrimary: "DỊCH VỤ",
    textDangler: "MARKETING"
  },
  subTitle: 'Kết hợp nhiều nền tảng: SEO, SEM, mạng xã hội, email marketing, affiliate, KOLs/Influencers... để tăng độ phủ thương hiệu và thúc đẩy doanh số.'
}
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.section-marketing {
  background: radial-gradient(50% 50% at 50% 50%, #0076CA 0%, #0064AC 100%);
  color: $white;
}
.section-inner {
  background: url('@/assets/images/marketing/bg-marketing.png') no-repeat bottom right;
}
.row-gap-y {
  gap: 24px 0;
  @include breakpoint(md) {
    gap: 48px 0;
  }
}
</style>
