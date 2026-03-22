import { defineStore } from "pinia";
import { reactive } from "vue";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    config: reactive({
      path: { baseUrl: "/", pathPrefix: "/", currentLanguage: "en" },
      user: { uid: 0 }, // Sử dụng reactive để đảm bảo phản ứng
      languages: {},
      endpoint: {
        blockhome: "",
        banners: "",
        partners: "",
        newsHome: "",
        introductionHome: "",
        packages: "",
        services: "",
        featured: "",
        themes: "",
        testimonials: "",
        marketing: "",
        marketingHome: "",
        benefits: "",
        solutions: "",
        processes: "",
        commitments: "",
        reasonses: "",
        faqs: "",
        bannerKnowledge: "",
        knowledgeCategories: "",
        knowledgeList: "",
        knowledgeTopics: "",
        knowledgeDetail: "",
        knowledgeRelatedNews: "",
        seoIntro: "",
        seoDefinition: "",
        seoServices: "",
        seoPricing: "",
        seoProcess: "",
        seoCommitment: "",
        seoContactForm: "",
        wppackages: "",
        bannerAbout: "",
        aboutContent: "",
        aboutMission: "",
        aboutWhy: "",
        googleAdsFeatures: "",
        googleAdsStrategies: "",
        googleAdsProcess: "",
        googleAdsCommitment: "",
        navigation: "",
      },
    }),
    loggedin: false,
  }),
  actions: {
    async login(email, password) {
      return await fetch(this.config.endpoint.login, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, password }),
      })
        .then(async (response) => {
          const res = await response.json();
          if (!response.ok) {
            const error = new Error(res.error || "Login failed");
            error.response = { status: response.status, data: res };
            throw error;
          }
          this.config.user = { ...this.config.user, ...res.data };
          this.loggedin = res.data?.uid > 0;
          return res.data;
        })
        .catch((err) => {
          console.error("Login error:", err);
          throw err;
        });
    },
    async logout() {
      return await fetch(this.config.endpoint.logout, {
        method: "POST",
      })
        .then(async (response) => {
          const res = await response.json();
          this.config.user = { ...this.config.user, ...res.data }; // Cập nhật user trong reactive object
          this.loggedin = false;
          return res.data;
        })
        .catch((err) => {
          console.error("Logout error:", err);
          throw err;
        });
    },
    updateUser(data) {
      Object.assign(this.config.user, data); // Cập nhật trực tiếp vào reactive object
    },
    markNotificationsAsRead() {
      return new Promise((resolve, reject) => {
        try {
          this.config.user.notifications.unread = 0;
          resolve();
        } catch (error) {
          reject(error);
        }
      });
    },
  },
});
