import { computed, h } from 'vue';
import { useRouter } from 'vue-router';

export default {
  name: 'AppLink',
  inheritAttrs: false,
  props: {
    to: {
      type: [String, Object],
      required: true,
    },
  },
  setup(props, { slots, attrs }) {
    const router = useRouter();

    const href = computed(() => {
      if (typeof props.to === 'string') {
        return props.to;
      }

      return router.resolve(props.to).href;
    });

    return () => h(
      'a',
      {
        ...attrs,
        href: href.value,
      },
      slots.default ? slots.default() : []
    );
  },
};
