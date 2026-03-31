<template>
  <div class="knowledge-comment-form mt-4 mt-lg-5">
    <KnowledgeSectionTitle icon="fa-regular fa-pen-to-square" title="Để lại bình luận" />

    <form class="comment-form" @submit.prevent="handleSubmit">
      <div class="row g-3">
        <div class="col-md-4">
          <input
            v-model.trim="form.name"
            type="text"
            class="form-control"
            :class="{ 'is-invalid': errors.name }"
            placeholder="Họ và tên *"
          />
          <div v-if="errors.name" class="field-error">{{ errors.name }}</div>
        </div>
        <div class="col-md-8">
          <textarea
            v-model.trim="form.content"
            class="form-control"
            :class="{ 'is-invalid': errors.content }"
            rows="5"
            placeholder="Nội dung bình luận *"
          ></textarea>
          <div v-if="errors.content" class="field-error">{{ errors.content }}</div>
        </div>
        <div class="col-12 d-flex justify-content-end">
          <button type="submit" class="btn btn-submit" :disabled="isSubmitting || !nid">
            {{ isSubmitting ? 'ĐANG GỬI...' : 'GỬI BÌNH LUẬN' }}
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import KnowledgeSectionTitle from '@/components/knowledge/components/KnowledgeSectionTitle.vue';
import { useAuthStore } from '@/store.js';

const props = defineProps({
  nid: {
    type: Number,
    default: 0,
  },
});

const emit = defineEmits(['submitted']);
const authStore = useAuthStore();

const form = reactive({
  name: '',
  content: '',
});

const errors = reactive({
  name: '',
  content: '',
});

const isSubmitting = ref(false);

const validate = () => {
  errors.name = '';
  errors.content = '';

  if (!form.name || form.name.length < 2) {
    errors.name = 'Vui lòng nhập họ tên hợp lệ.';
  }

  if (!form.content || form.content.length < 3) {
    errors.content = 'Vui lòng nhập nội dung bình luận.';
  }

  return !errors.name && !errors.content;
};

const resetForm = () => {
  form.name = '';
  form.content = '';
};

const handleSubmit = async () => {
  if (isSubmitting.value || !props.nid || !validate()) {
    return;
  }

  isSubmitting.value = true;

  try {
    const endpoint = authStore.config?.endpoint?.knowledgeCommentSubmit;
    const response = await fetch(endpoint, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        nid: props.nid,
        name: form.name,
        content: form.content,
      }),
    });

    const result = await response.json();

    if (!response.ok) {
      throw new Error(result.message || 'Không thể gửi bình luận.');
    }

    emit('submitted', {
      comments: result.data || [],
      count: result.count || 0,
    });
    resetForm();
  }
  catch (error) {
    alert(error.message || 'Không thể gửi bình luận.');
  }
  finally {
    isSubmitting.value = false;
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/mixins.scss";
@import "@/assets/variables.scss";

.comment-form {
  border-top: 1px solid $grey-6;
  padding-top: 24px;
}

.form-control {
  border-radius: 16px;
  padding: 14px 16px;
}

.field-error {
  color: $danger-1;
  font-size: 14px;
  margin-top: 6px;
}

.btn-submit {
  min-width: 180px;
}
</style>
