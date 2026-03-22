<template>
  <!-- section faq -->
  <section class="section-design-web-faq section-pad bg-grey-1">
    <div class="container">
      <SectionTitle 
        :headingTitle="headingSection.headingTitle"
        :subTitle="headingSection.subTitle"
        lineBottom
      />
      <div class="row">
        <div class="col-lg-6">
          <div class="faq-list">
            <div class="faq-item" v-for="faq in leftItems" :key="faq.id">
              <div 
                class="faq-question" 
                :class="{ active: activeId === faq.id }"
                @click="toggleFaq(faq.id)"
              >
                <div class="faq-icon">
                  <i class="fa-regular fa-circle-chevron-down"></i>
                </div>
                <h4 class="faq-title">{{ faq.question }}</h4>
              </div>
              <transition name="slide-fade">
                <div class="faq-answer" v-show="activeId === faq.id">
                  <p>{{ faq.answer }}</p>
                </div>
              </transition>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mt-4 mt-lg-0">
          <div class="faq-list">
            <div class="faq-item" v-for="faq in rightItems" :key="faq.id">
              <div 
                class="faq-question" 
                :class="{ active: activeId === faq.id }"
                @click="toggleFaq(faq.id)"
              >
                <div class="faq-icon">
                  <i class="fa-regular fa-circle-chevron-down"></i>
                </div>
                <h4 class="faq-title">{{ faq.question }}</h4>
              </div>
              <transition name="slide-fade">
                <div class="faq-answer" v-show="activeId === faq.id">
                  <p>{{ faq.answer }}</p>
                </div>
              </transition>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- e: section faq -->
</template>

<script setup>
import { ref, defineProps, computed } from 'vue';
import SectionTitle from '@/components/SectionTitle.vue';

const headingSection = {
  headingTitle: {
    textPrimary: "FAQ",
    textDangler: "CÂU HỎI THƯỜNG GẶP"
  },
  subTitle: 'Giải đáp nhanh thắc mắc của khách hàng'
};

const activeId = ref(null);

const props = defineProps({
  items: {
    type: Array,
    default: () => []
  }
});

const leftItems = computed(() => {
  const mid = Math.ceil(props.items.length / 2);
  return props.items.slice(0, mid);
});

const rightItems = computed(() => {
  const mid = Math.ceil(props.items.length / 2);
  return props.items.slice(mid);
});

const toggleFaq = (id) => {
  activeId.value = activeId.value === id ? null : id;
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.section-design-web-faq {
  background: url("@/assets/images/design-web/bg-faq.png") center center no-repeat;
  background-size: cover;
}
.faq-list {
  background: white;
  border-radius: 16px;
  padding: 24px;
  // box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.faq-item {
  border-bottom: 1px solid #eee;
  
  &:last-child {
    border-bottom: none;
  }
}

.faq-question {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 16px 0;
  cursor: pointer;
  transition: all 0.3s ease;  
  &:hover, &.active {
    color: $primary-1;
  }
  &.active {    
    .faq-icon i {
      transform: rotate(180deg);
    }
  }
}

.faq-icon {
  @include square(24px);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  transition: all 0.3s ease;
  
  i {
    font-size: 24px;
    transition: all 0.3s ease;
  }
}

.faq-title {
  flex: 1;
  font-size: 18px;
  font-weight: 600;
  margin: 0;
  line-height: 1.5;
}

.faq-toggle {
  flex-shrink: 0;
  
  i {
    font-size: 18px;
    color: #666;
    transition: all 0.3s ease;
  }
}

.faq-answer {
  padding: 16px 0;
}

.slide-fade-enter-active {
  transition: all 0.3s ease;
}

.slide-fade-leave-active {
  transition: all 0.3s ease;
}

.slide-fade-enter-from {
  transform: translateY(-10px);
  opacity: 0;
}

.slide-fade-leave-to {
  transform: translateY(-10px);
  opacity: 0;
}
</style>
