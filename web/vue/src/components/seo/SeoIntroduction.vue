<template>
  <section class="section-seo-intro">
    <div class="container">
      <div class="row align-items-lg-center">
        <div class="col-lg-6">
          <h2 class="seo-intro-title fw-bold">{{ item.title }}</h2>
          <p v-if="item.subtitle" class="seo-intro-text-lead">
            {{ item.subtitle }}
          </p>
          <div
            v-if="item.text"
            class="seo-intro-text"
            v-html="formatText(item.text)"
          ></div>
          <div class="seo-intro-cta mb-3 mb-md-4">
            <a href="#" class="btn btn-green-color btn-custom rounded-pill">
              <i class="fa-light fa-pen-to-square"></i>
              Đăng ký tư vấn
            </a>
          </div>
          <!-- <ul v-if="item.points && item.points.length" class="seo-intro-list list-unstyled d-none d-lg-flex">
            <li
              v-for="(point, index) in item.points"
              :key="index"
              class="seo-intro-list-item"
            >
              <span class="icon"><i :class="point.iconClass"></i></span>
              <span class="txt flex-fill">{{ point.point }}</span>
            </li>
          </ul> -->
        </div>
        <div class="col-lg-6 text-center text-lg-start">
          <img
            v-if="item.src"
            :src="getImgUrl('../../src/assets/images/seo', item.src)"
            :alt="item.title"
            class="img-fluid"
          />
        </div>
      </div>
    </div>
  </section>
  <!-- e: section -->
</template>

<script setup>
import { defineProps } from "vue";
import getImgUrl from "@/utils/getUrlImg";
import SectionTitle from "@/components/SectionTitle.vue";

const { item } = defineProps({
  item: {
    type: Object,
    default: () => ({}),
  },
});

const headingSection = {
  headingCate: {
    iconClass: "fa-light fa-chart-line-up",
    text: "Dịch vụ SEO",
  },
};

// Format text with line breaks
const formatText = (text) => {
  if (!text) return "";
  return text.replace(/\n/g, "<br>");
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.section-seo-intro {
  background-color: #fdf8f4;
  padding: 24px 0;
  @include breakpoint(lg) {
    padding-top: 72px;
    padding-bottom: 72px;
  }
}

.seo-intro-title {
  font-size: 22px;
  line-height: 1.4;
  margin-bottom: 24px;
  font-weight: 700;

  @include breakpoint(md) {
    margin-bottom: 36px;
    font-size: 40px;
  }
}

.seo-intro-text-lead {
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 24px;
  line-height: 1.4;
}

.seo-intro-text {
  font-size: 18px;
  line-height: 1.4;
  margin-bottom: 24px;

  // :deep(br) {
  //   display: block;
  //   margin: 8px 0;
  //   content: "";

  //   @include breakpoint(md) {
  //     margin: 10px 0;
  //   }
  // }
}

// .seo-intro-cta {
//   .btn-register {
//     display: inline-flex;
//     align-items: center;
//     justify-content: center;
//     gap: 8px;
//     padding: 12px 24px;
//     font-size: 15px;
//     font-weight: 600;
//     border-radius: 50px;
//     background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
//     border: none;
//     color: white;
//     text-decoration: none;
//     transition: all 0.3s ease;
//     box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
//     min-width: 180px;

//     @include breakpoint(md) {
//       padding: 14px 28px;
//       font-size: 16px;
//       min-width: 200px;
//     }

//     &:hover {
//       transform: translateY(-2px);
//       box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
//       background: linear-gradient(135deg, #10b981 0%, #059669 100%);
//     }

//     &:active {
//       transform: translateY(0);
//     }

//     i {
//       font-size: 16px;

//       @include breakpoint(md) {
//         font-size: 18px;
//       }
//     }
//   }
// }

// .seo-intro-list {
//   display: flex;
//   flex-wrap: wrap;
//   margin: 0 -12px;
//   gap: 20px 0;
//   font-weight: 600;
//   font-size: 15px;

//   @include breakpoint(xl) {
//     gap: 24px 0;
//     font-size: 16px;
//   }

//   li {
//     @include flexWidth(50%);
//     padding-left: 12px;
//     padding-right: 12px;
//     position: relative;
//     display: flex;
//     align-items: flex-start;
//     min-height: 22px;

//     .icon {
//       flex: 0 0 22px;
//       width: 22px;
//       display: flex;
//       align-items: center;
//       justify-content: center;
//       color: $primary-1;
//       font-size: 16px;
//       margin-top: 2px;

//       @include breakpoint(xl) {
//         font-size: 18px;
//       }
//     }

//     .txt {
//       padding-left: 10px;
//       color: #333;
//       flex: 1;
//     }
//   }
// }
</style>
