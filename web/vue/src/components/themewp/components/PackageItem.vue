<template>
  <div class="package position-relative" :class="getClassColor(item.type)">
    <div class="package-layout">
      <div class="package-price text-center">{{ item.price }}</div>
      <h3 class="package-title fw-bold text-uppercase text-center">
        {{ item.title }}
      </h3>
      <div class="package-content">
        <template v-if="item.type === 'on-demand'">
          <ul class="list-unstyled list-check-circle list-feature-package mb-0">
            <li v-for="(list, index) in item.lists" :key="index">
              <div class="package-list-icon">
                <i class="ico-check-circle"></i>
              </div>
              <div class="package-list-label flex-fill">{{ list.text }}</div>
            </li>
          </ul>
          <div class="view-more">
            <RouterLink to="#" class="text-primary-color"
              ><i class="fa-regular fa-arrow-right-long me-1"></i>
              {{ Drupal.t("Xem thêm") }}</RouterLink
            >
          </div>
        </template>
        <template v-else>
          <ul class="list-unstyled list-feature-package mb-0">
            <li v-for="(list, index) in item.lists" :key="index">
              <div class="package-list-label flex-fill">{{ list.text }}</div>
              <div
                v-if="list.disabled"
                class="package-list-icon text-danger-color"
              >
                <i class="fa-light fa-circle-xmark"></i>
              </div>
              <div
                v-else-if="!list.disabled && !list.value"
                class="package-list-icon text-primary-color"
              >
                <i class="fa-light fa-circle-check"></i>
              </div>
              <div v-else class="package-list-value text-primary-color">
                {{ list.value }}
              </div>
            </li>
          </ul>
        </template>
      </div>
    </div>
    <div class="text-center">
      <RouterLink
        class="btn rounded-pill px-4 py-2"
        to="#"
        :class="getClassBtn(item.type)"
      >
        <span class="btn-icon">
          <img src="@/assets/images/icons/angle-right-circle.svg" alt="" />
        </span>
        {{ Drupal.t("Đăng ký") }}
      </RouterLink>
    </div>
  </div>
</template>
<script setup>
import { defineProps } from "vue";
const { item } = defineProps({
  item: {
    type: Object,
    default: () => {},
  },
});

const getClassBtn = (type) => {
  if (type === "base") {
    return "btn-green-color";
  } else if (type === "professional") {
    return "btn-primary-color";
  } else if (type === "vip") {
    return "btn-warning-color";
  }
  return "btn-danger-color";
};

const getClassColor = (type) => {
  if (type === "base") {
    return "is-green-color";
  } else if (type === "professional") {
    return "is-primary-color";
  } else if (type === "vip") {
    return "is-warning-color";
  }
  return "is-danger-color";
};
</script>
<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
.package {
  border-radius: 16px;
  background-color: $white;
  padding: 24px 0;
  min-height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  &.is-green-color {
    .package-price {
      color: $green-1;
    }
    .package-title {
      background-color: $green-1;
    }
  }
  &.is-primary-color {
    .package-price {
      color: $primary-1;
    }
    .package-title {
      background-color: $primary-1;
    }
  }
  &.is-warning-color {
    .package-price {
      color: $danger-3;
    }
    .package-title {
      background-color: $danger-3;
    }
  }
  &.is-danger-color {
    .package-price {
      color: $danger-2;
    }
    .package-title {
      background-color: $danger-2;
    }
  }
}
.package-price {
  padding: 0 16px 12px;
  font-weight: 700;
  font-size: 32px;
}
.package-title {
  font-size: 18px;
  padding: 12px 16px;
  background-color: $green-1;
  color: $white;
}
.package-content {
  padding: 0 16px 16px;
}
.list-feature-package {
  font-weight: 500;
  li {
    padding: 12px 0;
    border-bottom: 1px solid $grey-4;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
  }
}
.package-list-icon {
  font-size: 20px;
}
.view-more {
  padding: 12px 0;
  border-bottom: 1px solid $grey-4;
}
</style>
