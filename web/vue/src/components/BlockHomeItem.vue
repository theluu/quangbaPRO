<template>
  <div class="collection-item" :class="item.status">
    <div class="collection-item__contents">
      <div class="collection-item__infos">
        <h6 class="collection-item__title">{{ item.title }}</h6>
        <div v-if="item.caption" class="collection-item__caption">
          {{ item.caption }}
        </div>
        <div v-if="item.code" class="collection-item__code">
          {{ item.code }}
        </div>
        <div v-if="item.status === 'inprogress'" class="collection-item__score">
          <template v-if="item.percentValue">
            <span class="collection-item__percent-num">{{ item.percentValue }}</span>
            <span class="collection-item__pie-text">%</span>
          </template>
        </div>
        <template v-if="item.status === 'completed-noscore'">
          <a-tooltip>
            <template #title>This test has been completed. To know the results, please contact your school or organization</template>
            <div class="collection-item__tag">
              Completed <i class="fa-light fa-circle-question"></i>
            </div>
          </a-tooltip>
        </template>
        <template v-if="item.status === 'completed'">
          <template v-if="item.scoreValue">
            <div class="collection-item__score">
              <span class="collection-item__score-num">{{ item.scoreValue }}</span>
            </div>
          </template>
        </template>
        <template v-if="item.status === 'evaluating'">
          <template v-if="item.scoreValue">
            <div class="collection-item__score">
              <span class="collection-item__note-text">{{ Drupal.t('Evaluating...') }}</span>
            </div>
          </template>
        </template>
        <template v-if="item.status === 'expired'">
          <a-tooltip>
            <template #title>This test has expired. Please purchase a test attempt to continue</template>
            <div class="collection-item__tag">
              Expired <i class="fa-light fa-circle-question"></i>
            </div>
          </a-tooltip>
        </template>
      </div>
    </div>
    <template v-if="item.status === 'available' || item.status === 'completed-noscore' || item.status === 'expired'">
      <div class="collection-item__btn iot-grbt" @click="handleButtonClick">
        {{ item.buttonText }}
      </div>      
    </template>
    <template v-else>
      <a :href="item.urlTest || '#'" class="collection-item__btn iot-grbt">
        {{ item.buttonText }}
      </a>
    </template>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

// Định nghĩa prop item
const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
});

// Định nghĩa emits
const emit = defineEmits(['openModal']);

// Hàm xử lý click button
const handleButtonClick = () => {
  emit('openModal', { urlTest: props.item.urlTest || '' });
};
</script>


<style lang="scss" scoped>
  @import "@/assets/mixins.scss";

  .enter-code {
    background-color: #F4F7FF;
    &__container {
      display: flex;
      padding: 1.5rem 0;
      gap: 3rem;      
      }
      @include mobile {
        flex-direction: column; 
      }
    &__col-left {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: center;
      @include mobile {
        width: 100%; 
      }
    }
    &__title {
      font-size: 16px;
      font-weight: bold;
      margin: 0;
      color: $primary-500;
    }
     &__desc {
      font-style: italic;
      font-weight: 400;
      color: $primary-500;
    }
    &__input {
      height: 44px;
    }
    &__next-btn {
      height: 44px;
    }   
    &__next-btn {
      min-width: 116px;
    }
    &__colright {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      max-width: 495px;
      margin: 0 0 0 auto;
      gap: 16px;
      @include mobile {
        width: 100%; 
      }
    }
  }

  .welcome {
    display: flex;
    padding: 1.5rem 0;
    gap: 3rem;
    @include mobile {
      flex-direction: column; 
    }
    &__col-left {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: center;
      width: 42%;
      @include mobile {
        width: 100%; 
      }
    }
    &__title {
      background: linear-gradient(90deg, #012E7C 40.47%, #32B3C7 62.35%);
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
      color: transparent;
      display: inline-flex;
      font-size: 32px;
      font-weight: bold;
      margin: 0 0 8px;
    }
    &__desc {
      font-family: $font-family-heading;
      margin: 0 0 4rem;
    }
    &__sm-title {
      font-family: $font-family-heading;
      font-size: 16px;
      font-weight: bold;
      margin: 0 0 1.6rem;
      @include mobile {
        font-size: 14px; 
      }
    }
    &__input {
      margin: 0 0 4px;
    }
    &__note {
      color: var(--Text-Body-3, #9A9A9A);
      font-size: 12px;
      font-style: italic;
      font-weight: 400;
      margin: 0 0 1.6rem;
    }
    &__next-btn {
      margin: 0 0 2rem;
      min-width: 116px;
      @include mobile {
        margin: 0 auto 2rem; 
      }
    }
    &__note-box {
      display: flex;
      padding: 8px 16px;
      justify-content: space-between;
      align-items: center;
      align-self: stretch;
      border-radius: 16px;
      background: rgba(254, 238, 222, 0.50);
      color: var(--Text-Body-2, #505050);
      gap: 8px;
      @include mobile {
        flex-direction: column;
        font-size: 14px;
        padding: 16px;
      }
    }
    &__check-device {
      display: flex;
      height: 36px;
      padding: 4px 12px;
      justify-content: center;
      align-items: center;
      gap: 10px;
      font-size: 14px;
      font-style: normal;
      font-weight: 700;
      border-radius: 1000px;
      background: var(--Text-Yellow, #FAA859);
      color: #fff;
      white-space: nowrap;
      margin-left: 1rem;
    }
    .fa-triangle-exclamation {
      font-size: 24px;
      color: #FAA859;
    }
  }

  .all-collection { 
    .fa-arrow-down {
      width: 32px;
      height: 32px;
      background: #D6F0F4;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: #32B3C7;
      border-radius: 50%;
    }
    &__exp-more {
      display: flex;
      gap: 8px;
      margin-bottom: 2rem;
      justify-content: flex-end;
      align-items: center;
      font-size: 14px;
      font-weight: 400;
      color: $primary-500;
      cursor: pointer;
      width: fit-content;
      justify-self: flex-end;
      &.active {
        .fa-arrow-down {
          transform: rotate(180deg);
        }
      }
    }
    &__items-wrapper {
      position: relative;
    }
    &__search {
      position: absolute;
      right: 0;
      bottom: calc(100% - 4rem);
      z-index: 9;
      width: 27%;
      @include mobile {
        position: relative; 
        width: 100%;
      }
    }
    &__search-input {
      border-radius: 100px;
      border: 1px solid var(--Primary-primary-200, #9DA9B7);
      background: #FFF;
      overflow: hidden;
      .ant-input {
        border: none;
      }
    }
    &__items-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 2rem;
      @include tablet {
        grid-template-columns: repeat(2, 1fr);
      }
      @include mobile {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
      }
    }
  }

  .collection-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;    
    &.demo {
      .collection-item__title {
        margin: auto 0;
        font-size: 28px;
      }
      .collection-item__contents {
        background: #D4DEFF;
      }
      .collection-item__btn {
        background: linear-gradient(180deg, #6B80B9 0%, #02317E 100%);
      }
      .collection-item__infos {
        &:before {
          content: "\e901";
          width: 60px;
          height: 60px;
          background-size: contain;
          position: absolute;
          left: 0;
          top: 0;
          font-family: 'iaticon' !important;
          speak: never;
          font-style: normal;
          font-weight: normal;
          font-variant: normal;
          text-transform: none;
          line-height: 1;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;
          font-size: 28px;
          z-index: 9;
          border-radius: 0px 50px 50px 50px;
          background: #E1E7F9;
          justify-content: center;
          display: flex;
          align-items: center;
          color: #02317E;
          @include mobile {
            width: 40px;
            height: 40px;
          }
        }
        &:after {
          content: '';
          width: 91px;
          height: 91px;
          border-radius: 100px 100px 0px 100px;
          background: #E1E7F9;
          position: absolute;
          right: 0;
          bottom: 0;
        }
      }
      
    }
    &.purchased {
      .collection-item__infos {
        justify-content: center;
        &:before {
          content: "\e900";
          width: 60px;
          height: 60px;
          background-size: contain;
          position: absolute;
          left: 0;
          top: 0;
          font-family: 'iaticon' !important;
          speak: never;
          font-style: normal;
          font-weight: normal;
          font-variant: normal;
          text-transform: none;
          line-height: 1;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;
          font-size: 28px;
          z-index: 9;
          border-radius: 0px 50px 50px 50px;
          background: #E1E7F9;
          justify-content: center;
          display: flex;
          align-items: center;
          color: #02317E;
          @include mobile {
            width: 40px;
            height: 40px;
          }
        }
      } 
      .collection-item__contents {
        background: var(--iat_blue-50, #D4DEFF);
      }
      .collection-item__btn {
        background: linear-gradient(180deg, #6B80B9 0%, #02317E 100%);
      }
    }
    &.available {
      .collection-item__infos {
        justify-content: center;
        &:before {
          content: "\e900";
          width: 60px;
          height: 60px;
          background-size: contain;
          position: absolute;
          left: 0;
          top: 0;
          font-family: 'iaticon' !important;
          speak: never;
          font-style: normal;
          font-weight: normal;
          font-variant: normal;
          text-transform: none;
          line-height: 1;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;
          font-size: 28px;
          z-index: 9;
          border-radius: 0px 50px 50px 50px;
          background: #AEEDF8;
          justify-content: center;
          display: flex;
          align-items: center;
          color: #00B1D0;
          @include mobile {
            width: 40px;
            height: 40px;
          }
        }
      }      
      .collection-item__contents {
        background: #DFF8FC;
      }
      .collection-item__btn {
        background: var(--iat_gradient-blue-gradient, linear-gradient(357deg, #02317E 2.05%, #2BD4EE 97.46%));
      }
    }
    &.inprogress {
      .collection-item__contents {
        background: var(--iat_orange-50, #FFF3E0);
      }
      .collection-item__btn {
        background: linear-gradient(176deg, #FFA629 4.22%, #E05D00 98.21%);
      }
    }
    &.completed {
      .collection-item__contents {
        background: var(--iat_green-50, #E6F5E9);
      }
      .collection-item__btn {
        background: linear-gradient(180deg, #249D44 0%, #002C0C 100%);
      }
      .collection-item__score {
        background: var(--iat_green-100, #C3E5C8);
      }
    }
    &.completed-noscore {
      .collection-item__contents {
        background: var(--iat_green-50, #E6F5E9);
      }
      .collection-item__btn {
        background: linear-gradient(180deg, #FFA629 0%, #E04362 100%);        
      }
      .collection-item__score {
        background: var(--iat_green-100, #C3E5C8);
      }
    }
    &.evaluating {
      .collection-item__contents {
        background: var(--iat_green-50, #E6F5E9);
      }
      .collection-item__btn {
        background: linear-gradient(180deg, #249D44 0%, #002C0C 100%);
        pointer-events: none;
        opacity: 0.5;
      }
      .collection-item__score {
        background: var(--iat_green-100, #C3E5C8);
      }
    }
    &.expired {
      .collection-item__contents {
        background: var(--iat_red-50, #FBE5EB);
      }
      .collection-item__btn {
        background: linear-gradient(176deg, #FFA629 4.22%, #E04362 98.21%);
      }
      .collection-item__tag {
        background: var(--iat_red-100, #fff);
        color: var(--iat_red-600-primary, #C86478);
        border: 1px solid var(--iat_red-600-primary, #C86478);
      }
    }
    &__note-text {
      font-size: 14px;
      font-weight: 400;
      color: #249D44;
      font-style: italic;
      text-align: center;
      margin-top: 1rem;
    }
    &__code {
      color: #294563;
      font-size: 14px;
      font-style: italic;
      font-weight: 400;
      margin-top: 4px;
      @include mobile {
        font-size: 12px; 
      }
    }
    &__score {
      width: 110px;
      height: 110px;
      display: flex;
      align-items: center;
      justify-content: center;      
      background: var(--iat_orange-100, #FFE0B2);
      position: absolute;
      z-index: 6;
      right: 0;
      bottom: 0;
      border-radius: 100px 100px 0px 100px;      
      @include mobile {
        width: 80px;
        height: 80px;
        font-size: 32px;
        right: 8px;
      }
    }
    &__percent-num {
      font-family: $font-family-heading;
      background: var(--iat_gradient-orange-gradient, linear-gradient(176deg, #FFA629 4.22%, #E05D00 98.21%));
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-size: 48px;
      font-weight: 700;
      line-height: 1;
    }
    &__score-num {
      font-family: $font-family-heading;
      background: var(--iat_gradient-green-gradient, linear-gradient(180deg, #249D44 0%, #002C0C 100%));
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-size: 48px;
      font-weight: 700;
      line-height: 1;
    }
    &__pie-text {
      background: var(--iat_gradient-orange-gradient, linear-gradient(176deg, #FFA629 4.22%, #E05D00 98.21%));
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-family: $font-family-heading;
      font-size: 22px;
      font-style: normal;
      font-weight: 700;
      line-height: 1;
      position: relative;
      top: 1rem;
    }
    &__title {
      font-size: 22px;
      font-weight: 700;
      color: $primary-500;
      position: relative;
      z-index: 10;
      margin: 0 0 0.4rem;
      @include mobile {
        font-size: 18px;
        margin: 0rem 0 0.4rem;
      }
    }
    &__caption {
      font-size: 20px;
      font-weight: 400;
      color: $primary-500;
      @include mobile {
        font-size: 14px; 
      }
    }
    &__contents {
      position: relative;
      border-radius: 0px 20px;
      overflow: hidden;
      background: #D4DEFF;
    }
    &__img {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    &__contents {
      padding: 50%;
    }
    &__infos {
      position: absolute;
      width: 100%;
      height: 100%;
      left: 0;
      top: 0;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      padding: 15px;
    }
    &__test-taken {
      display: inline-flex;
      padding: 4px 8px;
      justify-content: center;
      align-items: center;
      gap: 10px;
      border-radius: 12px;
      background: #FFF;
      font-size: 12px;
      font-style: italic;
      font-weight: 400;
      color: var(--Text-Body-3, #9A9A9A);
      margin-top: auto;
    }    
    &__btn {
      padding: 10px 20px;
      font-size: 14px;
      font-weight: bold;
      margin-top: 1.6rem;
      min-width: 118px;
      text-transform: uppercase;
      cursor: pointer;
      &.-green {
        background: linear-gradient(180deg, #249D44 0%, #002C0C 100%);
      }
      &.-pink {
        background: linear-gradient(180deg, #C86478 0%, #954B5A 100%);
      }
    }
    &__tag {
      position: absolute;
      bottom: 16px;
      right: 16px;
      padding: 4px 8px;
      border-radius: 100px;
      background: #FFF;
      font-size: 12px;
      font-weight: 400;
      color: var(--Text-Body-3, #249D44);
      border-radius: 100px;
      border: 1px solid var(--iat_green-600-primary, #249D44);
      background: var(--icon-illustration-white, #FFF);
      z-index: 10;
      .fa-circle-question {
        font-size: 14px;
      }
    }    
  }
</style>