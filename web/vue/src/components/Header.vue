<template>
  <header class="app-header">
    <div class="container-fluid mobile-container">
      <div class="header-inner d-flex">
        
        <!-- Desktop Logo Section (Hidden on Mobile) -->
        <div class="logo-section d-none d-xl-flex flex-column justify-content-center me-4">
          <RouterLink to="/" class="text-decoration-none">
            <img src="@/assets/images/logos/logo.svg" alt="Logo" class="img-fluid" />
          </RouterLink>
        </div>

        <!-- Mobile Logo Section (Visible only on Mobile) -->
        <div class="logo-section-mobile d-flex d-xl-none flex-column justify-content-center">
             <RouterLink to="/" class="text-decoration-none">
                <img src="@/assets/images/logos/logo.svg" alt="Logo" class="img-fluid" />
             </RouterLink>
        </div>

        <!-- Right Content Section (Desktop) -->
        <div class="right-section flex-grow-1 d-none d-xl-flex flex-column justify-content-between gap-2">
          <!-- Top Bar Info -->
          <div class="top-bar d-flex justify-content-between align-items-center px-2">
            <div class="contact-links d-flex gap-4">
              <RouterLink to="#" class="d-flex align-items-center gap-2 text-white">
                <i class="ico-messenger"></i>
                <span class="fw-medium">Tư Vấn Miễn Phí</span>
              </RouterLink>
              <RouterLink to="#" class="d-flex align-items-center gap-2 text-white">
                <i class="ico-sms"></i>
                <span>Khachhang@Quangbapro.Com</span>
              </RouterLink>
            </div>
            <div class="social-links d-flex">
               <RouterLink to="#" class="social-btn"><i class="fa-brands fa-square-facebook"></i></RouterLink>
               <RouterLink to="#" class="social-btn"><i class="fa-brands fa-youtube"></i></RouterLink>
               <RouterLink to="#" class="social-btn"><i class="fa-brands fa-instagram"></i></RouterLink>
               <RouterLink to="#" class="social-btn"><i class="fa-brands fa-linkedin"></i></RouterLink>
            </div>
          </div>

          <!-- Navigation Pill -->
          <div class="nav-pill bg-white rounded-pill py-2 d-flex align-items-center justify-content-between shadow-sm">
            <!-- Menu -->
            <ul class="nav main-nav ps-3">
              <li 
                v-for="item in navigation" 
                :key="item.id" 
                class="nav-item" 
                :class="{ 'dropdown-hover': item.submenu && item.submenu.length > 0 }"
              >
                <RouterLink 
                  :to="item.url" 
                  class="nav-link fw-bold d-flex align-items-center gap-1"
                >
                  {{ item.title }}
                  <i v-if="item.submenu && item.submenu.length > 0" class="fa-solid fa-chevron-down small-icon"></i>
                </RouterLink>
                <!-- Dropdown -->
                <ul v-if="item.submenu && item.submenu.length > 0" class="dropdown-menu shadow">
                   <li v-for="(sub, subIdx) in item.submenu" :key="subIdx">
                     <RouterLink :to="sub.url" class="dropdown-item">{{ sub.title }}</RouterLink>
                   </li>
                </ul>
              </li>
            </ul>

            <!-- Right Actions inside Pill -->
            <div class="pill-actions d-flex align-items-center gap-3">
              <!-- Hotline -->
              <RouterLink to="tel:09123 45678" class="hotline-box d-flex align-items-center gap-2 pe-3 text-nowrap">
                <div class="icon-circle bg-warning">
                  <i class="fa-regular fa-phone-volume"></i>
                </div>
                <div class="d-flex flex-column lh-1">
                  <span class="text-muted">Hotline</span>
                  <span class="fw-bold">09123 45678</span>
                </div>
              </RouterLink>

              <!-- Search -->
              <button class="btn btn-light rounded-circle search-circle-btn text-primary" @click="toggleSearch">
                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M17.4167 17.4167L15.75 15.75M16.5833 8.66667C16.5833 13.0389 13.0389 16.5833 8.66667 16.5833C4.29441 16.5833 0.75 13.0389 0.75 8.66667C0.75 4.29441 4.29441 0.75 8.66667 0.75C13.0389 0.75 16.5833 4.29441 16.5833 8.66667Z" stroke="#4285F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </button>

              <!-- Register Button -->
              <RouterLink to="#" class="btn btn-warning-color rounded-pill px-4 btn-register text-nowrap">
                <span class="btn-icon"><img src="@/assets/images/icons/angle-right-circle.svg" alt=""></span>
                Đăng ký ngay
              </RouterLink>
            </div>
          </div>
        </div>

        <!-- Mobile Right Column (Visible only on mobile) -->
        <div class="mobile-right flex-fill d-flex d-xl-none flex-column align-items-end ps-2">
            <!-- Socials -->
            <div class="social-links d-flex">
               <RouterLink to="#" class="social-btn"><i class="fa-brands fa-square-facebook"></i></RouterLink>
               <RouterLink to="#" class="social-btn"><i class="fa-brands fa-youtube"></i></RouterLink>
               <RouterLink to="#" class="social-btn"><i class="fa-brands fa-instagram"></i></RouterLink>
               <RouterLink to="#" class="social-btn"><i class="fa-brands fa-linkedin"></i></RouterLink>
            </div>
            
            <!-- Mobile Control Pill -->
            <div class="mobile-pill bg-white rounded-pill px-3 py-2 d-flex align-items-center justify-content-between gap-3 shadow-sm">
                <button class="btn btn-link p-0 text-primary fs-5 border-0" @click="toggleMobileMenu">
                    <svg width="29" height="17" viewBox="0 0 29 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.75 0.75H27.75M0.75 8.25H27.75M0.75 15.75H27.75" stroke="#4285F4" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
                <div class="d-flex align-items-center gap-3">
                  <!-- Phone Icon -->
                  <RouterLink to="tel:09123 45678" class="icon-circle-mobile bg-warning text-white">
                    <i class="fa-solid fa-phone"></i>
                  </RouterLink>
                  <div class="vr"></div>
                  <!-- Search Icon -->
                  <button class="btn btn-light rounded-circle search-circle-btn text-primary" @click="toggleSearch">
                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M17.4167 17.4167L15.75 15.75M16.5833 8.66667C16.5833 13.0389 13.0389 16.5833 8.66667 16.5833C4.29441 16.5833 0.75 13.0389 0.75 8.66667C0.75 4.29441 4.29441 0.75 8.66667 0.75C13.0389 0.75 16.5833 4.29441 16.5833 8.66667Z" stroke="#4285F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </button>
                </div>
            </div>
        </div>

      </div>
    </div>

    <!-- Mobile Menu Overlay (Full Screen) -->
    <transition name="slide-right">
        <div v-if="isMobileMenuOpen" class="mobile-menu-overlay d-xl-none position-fixed top-0 start-0 w-100 h-100 bg-white z-index-modal">
            <!-- Mobile Menu Header -->
            <div class="mobile-menu-header app-header px-3 py-3 d-flex align-items-center justify-content-between">
                 <button class="btn text-white fs-4 p-0" @click="handleMobileMenuClose">
                    <i class="fa-light fa-xmark fs-2"></i>
                 </button>
                 
                 <div class="mobile-menu-logo">
                     <!-- Simplified Logo -->
                      <RouterLink to="/" @click="handleMobileMenuClose" class="text-decoration-none text-white fw-bold fs-4">
                        <img src="@/assets/images/logos/logo.svg" alt="Logo" class="img-fluid" />
                      </RouterLink>
                 </div>
                 
                 <button class="btn text-white fs-4 p-0"  @click="toggleSearch">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M30.75 30.75L27.75 27.75M29.25 15C29.25 22.8701 22.8701 29.25 15 29.25C7.12994 29.25 0.75 22.8701 0.75 15C0.75 7.12994 7.12994 0.75 15 0.75C22.8701 0.75 29.25 7.12994 29.25 15Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                 </button>
            </div>

            <!-- Mobile Menu Content -->
            <div class="mobile-menu-content h-100 overflow-hidden position-relative">
                 <transition name="slide-fade" mode="out-in">
                     <!-- Main Menu Level -->
                      <div v-if="!activeSubmenu" class="main-menu-list h-100 overflow-auto" key="main">
                         <div 
                           v-for="item in navigation" 
                           :key="item.id" 
                           class="menu-item-mobile border-bottom d-flex align-items-center justify-content-between p-0"
                         >
                             <RouterLink 
                               :to="item.url" 
                               class="text-decoration-none fw-semibold p-3 flex-grow-1"
                               @click="handleMobileMenuClose"
                             >
                               {{ item.title.toUpperCase() }}
                             </RouterLink>
                             
                             <button 
                               v-if="item.submenu && item.submenu.length > 0" 
                               class="btn btn-link text-decoration-none p-3" 
                               @click.stop="openSubmenu(item)"
                             >
                                 <i class="fa-solid fa-chevron-right text-muted"></i>
                             </button>
                         </div>
                      </div>

                     <!-- Submenu Level -->
                     <div v-else class="submenu-list h-100 overflow-auto" key="submenu">
                         <!-- Submenu Header -->
                         <div class="submenu-header bg-light p-3 border-bottom d-flex align-items-center gap-2 sticky-top">
                             <button class="btn btn-link text-primary-color p-0 text-decoration-none fw-semibold d-flex align-items-center" @click="activeSubmenu = null">
                                 <i class="fa-solid fa-arrow-left me-2"></i>
                                 {{ activeSubmenu.title }}
                             </button>
                         </div>
                         
                         
                         <ul class="list-unstyled mb-0"><li v-for="(sub, subIdx) in activeSubmenu.submenu" :key="subIdx" class="border-bottom p-3"><RouterLink :to="sub.url" class="text-decoration-none text-dark fw-medium d-flex justify-content-between" @click="handleMobileMenuClose">{{ sub.title }}<i class="fa-solid fa-chevron-right text-muted small"></i></RouterLink></li></ul>


                     </div>
                 </transition>
            </div>
        </div>
    </transition>

    <!-- Mobile Search Overlay -->
    <transition name="slide-right">
        <div v-if="isSearchOpen" class="mobile-search-overlay d-xl-none position-fixed top-0 start-0 w-100 h-100 bg-white z-index-modal">
            <!-- Mobile Search Header -->
            <div class="mobile-menu-header app-header px-3 py-3 d-flex align-items-center justify-content-between">                
                 <!-- Spacer for alignment -->
                 <button class="btn btn-link p-0 text-primary fs-5 border-0" @click="toggleMobileMenu">
                    <svg width="29" height="17" viewBox="0 0 29 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.75 0.75H27.75M0.75 8.25H27.75M0.75 15.75H27.75" stroke="#4285F4" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
                 
                 <div class="mobile-menu-logo">
                     <!-- Simplified Logo -->
                      <RouterLink to="/" @click="handleMobileMenuClose" class="text-decoration-none text-white fw-bold fs-4">
                        <img src="@/assets/images/logos/logo.svg" alt="Logo" class="img-fluid" />
                      </RouterLink>
                 </div>
                 <button class="btn text-white fs-4 p-0" @click="toggleSearch">
                    <i class="fa-light fa-xmark fs-2"></i>
                 </button>                 
            </div>

            <!-- Mobile Search Content -->
            <div class="mobile-menu-content d-flex flex-column align-items-center pt-5 px-3">
                 <div class="input-wrapper w-100 mb-4 text-center border-bottom border-2">
                   <input 
                     ref="mobileSearchInput"
                     type="text" 
                     class="form-control border-0 text-center fs-3 shadow-none bg-transparent" 
                     placeholder="Nhập từ khóa..."
                   />
                 </div>
                 
                 <div class="trends-section text-center">
                   <h6 class="fw-bold mb-3 text-uppercase text-muted">Xu hướng tìm kiếm:</h6>
                   <div class="d-flex flex-wrap justify-content-center gap-2">
                     <a 
                       v-for="(tag, index) in searchTags" 
                       :key="index" 
                       href="#" 
                       class="search-tag text-decoration-none"
                     >
                       {{ tag }}
                     </a>
                   </div>
                 </div>
            </div>
        </div>
    </transition>

    <!-- Full Width Search Overlay -->
    <transition name="fade">
      <div v-if="isSearchOpen" class="search-overlay d-none d-xl-block bg-white w-100 shadow-sm border-top">
        <div class="container">
          <div class="search-content d-flex flex-column align-items-center justify-content-center py-3 py-lg-5">
            <div class="input-wrapper w-100 mb-5 text-center">
              <input 
                ref="searchInput"
                type="text" 
                class="form-control border-0 text-center search-input shadow-none" 
                placeholder="NHẬP TỪ KHÓA TÌM KIẾM"
              />
            </div>
            
            <div class="trends-section text-center">
              <h6 class="fw-bold mb-3 text-uppercase">Xu hướng tìm kiếm:</h6>
              <div class="d-flex flex-wrap justify-content-center gap-2">
                <a 
                  v-for="(tag, index) in searchTags" 
                  :key="index" 
                  href="#" 
                  class="search-tag text-decoration-none"
                >
                  {{ tag }}
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </header>
</template>

<script>
import { defineComponent } from 'vue';
import { useAuthStore } from '@/store';
import axios from 'axios';

export default defineComponent({
  name: 'Header',
  data() {
    return {
      isMobileMenuOpen: false,
      isSearchOpen: false,
      activeSubmenu: null,
      navigation: [],
      searchTags: [
        "Thiết kế website",
        "Chuẩn SEO",
        "Google Ad",
        "Facebook Ad",
        "Quảng bá thương hiệu",
        "Theme website"
      ]
    };
  },
  created() {
    this.fetchNavigation();
  },
  methods: {
    async fetchNavigation() {
      const authStore = useAuthStore();
      const endpoint = authStore.config?.endpoint?.navigation;
      if (endpoint) {
        try {
          const response = await axios.get(endpoint);
          this.navigation = response.data.data || [];
        } catch (error) {
          console.error("Error fetching navigation:", error);
        }
      }
    },
    toggleMobileMenu() {
      this.isMobileMenuOpen = !this.isMobileMenuOpen;
      if (this.isMobileMenuOpen) this.isSearchOpen = false;
      this.activeSubmenu = null; // Reset submenu when opening/closing
    },
    handleMobileMenuClose() {
        this.isMobileMenuOpen = false;
        this.activeSubmenu = null;
    },
    openSubmenu(item) {
        this.activeSubmenu = item;
    },
    toggleSearch() {
      this.isSearchOpen = !this.isSearchOpen;
      if (this.isSearchOpen) {
        this.isMobileMenuOpen = false; // Close mobile menu if search opens
        this.$nextTick(() => {
          if (this.$refs.searchInput) {
            this.$refs.searchInput.focus();
          }
          if (this.$refs.mobileSearchInput) {
            this.$refs.mobileSearchInput.focus();
          }
        });
      }
    }
  }
});
</script>

<style lang="scss" scoped>
  @import "@/assets/mixins.scss";
@import "@/assets/variables.scss";
/* Variables matched to image roughly */
$primary-blue: #0056b3; 
$header-bg: #0060c0; /* Adjusting to fit the vibrant blue in image */
$highlight-yellow: #ffb800;
$gradient-start: #ff6b00;
$gradient-end: #ffb800;
.container-fluid {
  @include breakpoint(xxl) {
    padding: 0 80px;
  }
}
.app-header {
  background-color: $header-bg;
  padding: 0;
  border-bottom: 1px solid rgba(255,255,255,0.1);
  position: relative;
}

.header-inner {
  position: relative;
  z-index: 1001; 
}

/* Logo Styles */
.logo-wrapper {
  .logo-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, $gradient-start, $gradient-end);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 800;
    font-size: 24px;
    width: 36px;
    height: 36px;
  }
}
.logo-section {
  img {
    max-width: 210px;
    @media (min-width: 1560px) {
      max-width: 260px;
    }
  }
}
.logo-section-mobile {
  @include flexWidth(154px);
    img {
      max-height: 60px;
    }
}
.top-bar {
  padding-top: 16px;
  padding-bottom: 16px;
}
.social-links {
  gap: 0 16px;
  @include breakpoint(xl) {
    gap: 0 20px;
  }
}

.menu-item-mobile {
  .btn-link {
    color: $text-link;
    &:hover, &:focus {
      color: $text-link-hover;
    }
  }
  a {
    color: $text-link;
    &:hover, &:focus {
      color: $text-link-hover;
    }
  }
  .btn-link, a {
    &.active {
      color: $primary-1;
    }
  }
  .border-start {
    border-color: #eee !important;
    height: 100%;
    display: flex;
    align-items: center;
    border-left: 1px solid #eee !important;
  }
}
/* Social Buttons Mobile */
.social-btn-mobile {
  width: 24px;
  height: 24px;
  border: 1px solid rgba(255,255,255,0.4);
  border-radius: 4px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 12px;
  
   &:hover {
    color: $danger-3;
  }
}

.mobile-pill {
    /* Mimic the pill on bottom right */
    box-shadow: 0 4px 6px rgba(0,0,0,0.15);
    width: 100%;
    position: relative;
    &::after {
      content: "";
      width: 1200px;
      top: 0;
      bottom: 0;
      background-color: $white;
      position: absolute;
      left: 100%;
      margin-left: -50px;
      z-index: -1;
    }
}
.mobile-right {
  .social-links {
    margin: 12px 0;
  }
}

.icon-circle-mobile {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

/* Mobile Menu Overlay */
.z-index-modal {
    z-index: 2000;
}

.mobile-menu-header {
    height: 80px; /* Approximate height of header */
    .btn-link.text-primary {
      svg {
        path {
          stroke: $white;
        }
      }
    }
}

.mobile-menu-logo {
  img {
    max-height: 60px;
  }
}

.mobile-menu-content {
    padding-top: 0;
    height: calc(100% - 80px);
}

.cursor-pointer {
    cursor: pointer;
}

/* Social Buttons Desktop */
.social-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  transition: all 0.2s;
  font-size: 16px;
  @include breakpoint(xl) {
    font-size: 20px;
  }
  &:hover {
    color: $danger-3;
  }
}

.contact-links {
  font-weight: 600;
  font-size: 14px;
}


/* Nav Pill */
.nav-pill {
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
  padding-left: 12px;
  padding-right: 12px;
  position: relative;
  &::after {
    content: "";
    width: 1200px;
    top: 0;
    bottom: 0;
    background-color: $white;
    position: absolute;
    left: 100%;
    margin-left: -50px;
    z-index: -1;
  }
}

.main-nav {
  .nav-link {
    font-size: 14px;
    padding: 11px 8px;
    transition: color 0.2s;
    font-weight: 600;
    color: $text-link;
    position: relative;
    @include breakpoint(xxl) {
      font-size: 15px;
    }
    @media (min-width: 1560px) {
      font-size: 15px;
      padding: 11px 12px;
    }
    &::after {
      @include breakpoint(xl) {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 24px;
        height: 2px;
        background-color: $danger-3;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease-in-out;
        border-radius: 4px;
        margin-left: -12px;
      } 
    } 
    &:hover, &.active {
      color: $danger-3;
      &::after {
        transform: scaleX(1);
      }
    }
  }
  
  .small-icon {
    font-size: 10px;
    margin-top: 2px;
  }
}

/* Hover Dropdown */
.dropdown-hover {
  position: relative;
  &:hover {
    .dropdown-menu {
      display: block;
      margin-top: 0;
    }
  }
}
.dropdown-menu {
  @include breakpoint(xl) {
    border: none;
    box-shadow: 0 3px 7px rgba($black,0.16);
  }
  .dropdown-item {
    font-size: 15px;
    font-weight: 500;
    padding: 8px 15px;
    &:hover, &:focus {
      background-color: $danger-3;
      color: $white;
    }
  }
}

/* Right Actions */
.hotline-box {
  color: #3B3B3B;
  border-right: 1px solid #eee;
  font-size: 14px;
  .fw-bold {
    color: $black;
  }
}
.icon-circle {
  @include square(40px);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  color: $white;
  flex: 0 0 40px;
}

.small-text {
  font-size: 11px;
}
.btn-register {
  min-height: 40px;
}
.vr {
  background: #eee;
  opacity: 1;
}
.search-circle-btn {
  @include square(36px);
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f0f6ff;
  border-color: transparent;
  flex: 0 0 36px;
  min-height: 36px;
  padding: 0;
  @include breakpoint(xl) {
    @include square(40px);
    flex: 0 0 40px;
    min-height: 40px;
  }
  &:hover {
    background-color: #e0edff;
  }
}

/* Button override */
.btn-warning {
  background-color: $highlight-yellow;
  border: none;
  color: white !important;
  &:hover {
    filter: brightness(0.95);
  }
}

/* Search Overlay */
.search-overlay {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  min-height: 300px;
}
.search-content {
  .input-wrapper {
    border-bottom: 2px solid $grey-4;
  }
}

.search-input {
  font-size: 1.5rem;
  color: #555;
  &::placeholder {
    color: #888;
  }
}

.search-tag {
  background-color: #eaf2ff;
  color: #2476FF;
  padding: 8px 16px;
  border-radius: 50px;
  font-size: 0.9rem;
  transition: all 0.2s;
  
  &:hover {
    background-color: #dbe9ff;
    color: #0056b3;
  }
}

// Vue Transitions
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.slide-right-enter-active,
.slide-right-leave-active {
  transition: transform 0.3s ease;
}

.slide-right-enter-from,
.slide-right-leave-to {
  transform: translateX(100%);
}

@media (max-width: 1199px) {
  .tagline {
    display: none;
  }
  
  .mobile-container {
      max-width: 100% !important;
      padding-left: 15px;
      padding-right: 15px;
  }
}
</style>







