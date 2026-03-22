<template>
  <div class="collection-item__circular-progress">
    <div class="collection-item__pie" :data-pie="pieConfig" ref="pieElement"></div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';

// Định nghĩa props
const { percentValue } = defineProps({
  percentValue: {
    type: Number,
    default: 0,
  },
});

// Ref để lấy phần tử DOM
const pieElement = ref(null);

// State cho giá trị tiến trình
const progress = ref(percentValue);

// Tạo cấu hình data-pie
const pieConfig = computed(() =>
  JSON.stringify({
    percent: progress.value,
    colorSlice: '#337845',
    colorCircle: '#D6F0F4',
    strokeWidth: 10,
    size: 100,
    cut: 50,
    round: true,
  })
);

// Biến để lưu instance CircularProgressBar
let circleInstance = null;

onMounted(() => {
  if (pieElement.value && typeof window !== 'undefined' && window.CircularProgressBar) {
    // Tạo instance mới cho component này
    circleInstance = new window.CircularProgressBar('collection-item__pie');
    circleInstance.initial(pieElement.value); // Khởi tạo với phần tử DOM cụ thể
    const options = {
      index: 1, // Có thể điều chỉnh nếu cần
      percent: percentValue,
    };
    circleInstance.animationTo(options); // Chạy animation
    // console.log('CircularProgressBar initialized:', pieElement.value);
  } else {
    // console.error('CircularProgressBar hoặc pieElement không khả dụng.');
  }
});

onUnmounted(() => {
  // Dọn dẹp instance khi component bị hủy
  if (circleInstance) {
    circleInstance = null;
    // console.log('CircularProgressBar cleaned up');
  }
});
</script>

<style lang="scss">
  @import "@/assets/mixins.scss";
  .collection-item {
    &__circular-progress {
      position: absolute;
      bottom: 16px;
      right: 16px;
      @include mobile {
        bottom: 42px;
        right: 6px;
      }
    }
    &__pie {
      @include mobile {
        width: 50px !important;
        height: 50px !important;
        svg {
          width: 100% !important; 
          height: 100% !important; 
        }
      }      
    }
  }
  
</style>