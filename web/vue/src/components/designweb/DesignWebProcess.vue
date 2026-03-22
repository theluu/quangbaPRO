<template>
  <!-- section process -->
  <section class="section-design-web-process section-pad bg-grey-1">
    <div class="container">
      <SectionTitle 
        :headingTitle="headingSection.headingTitle"
        :subTitle="headingSection.subTitle"
      />
      <div class="process-wrapper">
        <div class="process-center-image">
          <!-- <img src="@/assets/images/misc/design-process-center.svg" alt="Design Process" /> -->
           
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-6 col-xl-4 col-item">
            <template  v-for="(process, index) in props.items" :key="process.id">
              <ProcessItem :item="process" v-if="index < 3"/>
            </template>              
          </div>
          <div class="col-lg-4 d-none d-xl-block">
            <img src="@/assets/images/design-web/process.png" alt=""/>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-4 col-item">
            <template  v-for="(process, index) in props.items" :key="process.id">
              <ProcessItem :item="process" v-if="index >= 3"/>
            </template>              
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- e: section process -->
</template>

<script setup>
import { defineProps } from "vue";
import SectionTitle from '@/components/SectionTitle.vue';
import ProcessItem from './components/ProcessItem.vue';

const props = defineProps({
  items: {
    type: Array,
    default: () => []
  }
});

const headingSection = {
  headingTitle: {
    textPrimary: "QUY TRÌNH",
    textDangler: "THIẾT KẾ WEBSITE TỐI ƯU"
  },
  subTitle: '6 bước chi tiết để chúng tôi có thể xây dựng cho bạn một website chuyên nghiệp nhất'
};

</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.process-wrapper {
  position: relative;
  margin-top: 60px;
}

</style>
