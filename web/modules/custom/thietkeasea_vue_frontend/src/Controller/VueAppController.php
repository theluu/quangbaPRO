<?php

namespace Drupal\thietkeasea_vue_frontend\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\ContainerInterface;

class VueAppController extends ControllerBase {

  protected RequestStack $requestStack;

  public function __construct(RequestStack $request_stack) {
    $this->requestStack = $request_stack;
  }

  public static function create(ContainerInterface $container): static {
    return new static(
      $container->get('request_stack')
    );
  }

  public function build(): array {
    $seo = $this->getSeoData();

    $build = [
      '#type' => 'container',
      '#attributes' => ['id' => 'app'],
      '#title' => $seo['title'],
      '#attached' => [
        'library' => [
          'core/drupal',
          'core/drupalSettings',
        ],
        'drupalSettings' => [
          'isPublicFrontend' => TRUE,
          'recaptchaV3SiteKey' => $this->config('qb_contact_lead.settings')->get('recaptcha_v3_site_key') ?? '',
          'user' => [
            'uid' => (int) $this->currentUser()->id(),
            'name' => $this->currentUser()->getAccountName(),
          ],
          'languages' => [
            'vi' => ['name' => 'Vietnamese', 'langCode' => 'vi'],
            'en' => ['name' => 'English', 'langCode' => 'en'],
            'zh-hans' => ['name' => 'Chinese, Simplified', 'langCode' => 'zh-hans'],
          ],
          'endpoint' => $this->buildEndpointMap(),
        ],
      ],
    ];

    $build['#attached']['html_head'][] = [[
      '#tag' => 'meta',
      '#attributes' => [
        'name' => 'description',
        'content' => $seo['description'],
      ],
    ], 'thietkeasea_vue_frontend_meta_description'];

    $build['#attached']['html_head'][] = [[
      '#tag' => 'meta',
      '#attributes' => [
        'property' => 'og:title',
        'content' => $seo['title'],
      ],
    ], 'thietkeasea_vue_frontend_og_title'];

    $build['#attached']['html_head'][] = [[
      '#tag' => 'meta',
      '#attributes' => [
        'property' => 'og:description',
        'content' => $seo['description'],
      ],
    ], 'thietkeasea_vue_frontend_og_description'];

    $build['#attached']['html_head'][] = [[
      '#tag' => 'meta',
      '#attributes' => [
        'property' => 'og:url',
        'content' => $seo['canonical'],
      ],
    ], 'thietkeasea_vue_frontend_og_url'];

    $build['#attached']['html_head_link'][] = [[
      'rel' => 'canonical',
      'href' => $seo['canonical'],
    ], 'thietkeasea_vue_frontend_canonical'];

    $recaptcha_site_key = $this->config('qb_contact_lead.settings')->get('recaptcha_v3_site_key');
    if (!empty($recaptcha_site_key)) {
      $build['#attached']['html_head'][] = [[
        '#tag' => 'script',
        '#attributes' => [
          'src' => 'https://www.google.com/recaptcha/api.js?render=' . $recaptcha_site_key,
          'async' => TRUE,
          'defer' => TRUE,
        ],
      ], 'thietkeasea_vue_frontend_recaptcha_v3'];
    }

    $this->attachVueAssets($build);
    return $build;
  }

  protected function getSeoData(): array {
    $request = $this->requestStack->getCurrentRequest();
    $path = rtrim($request->getPathInfo(), '/') ?: '/';
    $host = $request->getSchemeAndHttpHost();

    $map = [
      '/' => [
        'title' => 'QuangBaPRO | Thiet ke web va marketing',
        'description' => 'QuangBaPRO cung cap dich vu thiet ke website, SEO, Facebook Ads va Google Ads.',
      ],
      '/dashboard-vue' => [
        'title' => 'QuangBaPRO | Thiet ke web va marketing',
        'description' => 'QuangBaPRO cung cap dich vu thiet ke website, SEO, Facebook Ads va Google Ads.',
      ],
      '/design-web' => [
        'title' => 'Thiet ke web theo yeu cau | QuangBaPRO',
        'description' => 'Dich vu thiet ke web theo yeu cau voi giao dien doc quyen, toi uu chuyen doi va than thien SEO.',
      ],
      '/marketing' => [
        'title' => 'Dich vu marketing tong the | QuangBaPRO',
        'description' => 'Giai phap marketing tong the giup doanh nghiep tang nhan dien thuong hieu va chuyen doi.',
      ],
      '/theme-wp' => [
        'title' => 'Theme WordPress | QuangBaPRO',
        'description' => 'Kho giao dien WordPress va giai phap website ban hang, gioi thieu doanh nghiep.',
      ],
      '/knowledge' => [
        'title' => 'Kien thuc marketing va website | QuangBaPRO',
        'description' => 'Tong hop bai viet ve website, SEO, Facebook Ads, Google Ads va marketing online.',
      ],
      '/service-seo' => [
        'title' => 'Dich vu SEO tong the | QuangBaPRO',
        'description' => 'Dich vu SEO tong the giup website tang thu hang ben vung va mo rong luong truy cap tu nhien.',
      ],
      '/about' => [
        'title' => 'Gioi thieu QuangBaPRO',
        'description' => 'Thong tin gioi thieu ve QuangBaPRO, tam nhin, su menh va cac dich vu dang cung cap.',
      ],
      '/facebook-ads' => [
        'title' => 'Dich vu Facebook Ads | QuangBaPRO',
        'description' => 'Giai phap Facebook Ads giup tiep can dung khach hang muc tieu va toi uu chi phi quang cao.',
      ],
      '/google-ads' => [
        'title' => 'Dich vu Google Ads | QuangBaPRO',
        'description' => 'Dich vu Google Ads giup tang lead, don hang va do luong hieu qua theo tung chien dich.',
      ],
    ];

    if (str_starts_with($path, '/knowledge/')) {
      $seo = [
        'title' => 'Chi tiet bai viet kien thuc | QuangBaPRO',
        'description' => 'Noi dung kien thuc chuyen sau ve website, SEO va marketing online.',
      ];
    }
    else {
      $seo = $map[$path] ?? [
        'title' => 'QuangBaPRO',
        'description' => 'Dich vu thiet ke web, SEO va marketing online.',
      ];
    }

    $seo['canonical'] = $host . $request->getRequestUri();
    return $seo;
  }

  protected function attachVueAssets(array &$build): void {
    $root = \Drupal::root();
    $cssPath = '/vue/dist/index.css';
    $jsPath = '/vue/dist/index.js';
    $circularProgressPath = '/vue/node_modules/circular-progress-bar/dist/circularProgressBar.min.js';

    if (is_file($root . $cssPath)) {
      $build['#attached']['html_head_link'][] = [[
        'rel' => 'stylesheet',
        'href' => $cssPath,
      ], 'thietkeasea_vue_frontend_css'];
    }

    if (is_file($root . $circularProgressPath)) {
      $build['#attached']['html_head'][] = [[
        '#tag' => 'script',
        '#attributes' => [
          'src' => $circularProgressPath,
        ],
      ], 'thietkeasea_vue_frontend_circular_progress'];
    }

    if (is_file($root . $jsPath)) {
      $build['#attached']['html_head'][] = [[
        '#tag' => 'script',
        '#attributes' => [
          'src' => $jsPath,
          'type' => 'module',
        ],
      ], 'thietkeasea_vue_frontend_js'];
    }
  }

  protected function buildEndpointMap(): array {
    $listPlaceholderKeys = [
      'blockhome',
      'introductionHome',
      'featured',
      'newsHome',
      'benefits',
      'solutions',
      'processes',
      'commitments',
      'reasonses',
      'bannerKnowledge',
      'marketingHome',
      'seoIntro',
      'seoDefinition',
      'seoServices',
      'seoPricing',
      'seoProcess',
      'seoCommitment',
      'seoContactForm',
      'bannerAbout',
      'aboutContent',
      'aboutMission',
      'aboutWhy',
      'facebookBenefits',
      'facebookServices',
      'facebookDisparity',
      'facebookProcess',
      'googleAdsFeatures',
      'googleAdsStrategies',
      'googleAdsProcess',
      'googleAdsCommitment',
    ];

    $endpoints = [
      'navigation' => Url::fromRoute('thietkeasea_vue_api.navigation')->toString(),
      'search' => Url::fromRoute('thietkeasea_vue_api.search')->toString(),
      'banners' => Url::fromRoute('thietkeasea_vue_api.banners')->toString(),
      'services' => Url::fromRoute('thietkeasea_vue_api.services')->toString(),
      'marketing' => Url::fromRoute('thietkeasea_vue_api.marketing')->toString(),
      'marketingHome' => Url::fromRoute('thietkeasea_vue_api.marketing')->toString(),
      'packages' => Url::fromRoute('thietkeasea_vue_api.packages')->toString(),
      'wppackages' => Url::fromRoute('thietkeasea_vue_api.wppackages')->toString(),
      'themes' => Url::fromRoute('thietkeasea_vue_api.themes')->toString(),
      'wpfeatured' => Url::fromRoute('thietkeasea_vue_api.wpfeatured')->toString(),
      'featured' => Url::fromRoute('thietkeasea_vue_api.wpfeatured')->toString(),
      'wpwhy' => Url::fromRoute('thietkeasea_vue_api.wpwhy')->toString(),
      'partners' => Url::fromRoute('thietkeasea_vue_api.partners')->toString(),
      'testimonials' => Url::fromRoute('thietkeasea_vue_api.testimonials')->toString(),
      'faqs' => Url::fromRoute('thietkeasea_vue_api.faqs')->toString(),
      'wpfaq' => Url::fromRoute('thietkeasea_vue_api.wpfaq')->toString(),
      'knowledgeList' => Url::fromRoute('thietkeasea_vue_api.knowledge_list')->toString(),
      'newsHome' => Url::fromRoute('thietkeasea_vue_api.knowledge_list')->toString(),
      'knowledgeDetail' => Url::fromRoute('thietkeasea_vue_api.knowledge_detail')->toString(),
      'knowledgeCategories' => Url::fromRoute('thietkeasea_vue_api.knowledge_categories')->toString(),
      'knowledgeTopics' => Url::fromRoute('thietkeasea_vue_api.knowledge_topics')->toString(),
      'knowledgeRelatedNews' => Url::fromRoute('thietkeasea_vue_api.knowledge_related_news')->toString(),
      'knowledgeRelatedPosts' => Url::fromRoute('thietkeasea_vue_api.knowledge_related_posts')->toString(),
      'knowledgeComments' => Url::fromRoute('thietkeasea_vue_api.knowledge_comments')->toString(),
      'knowledgeCommentSubmit' => Url::fromRoute('thietkeasea_vue_api.knowledge_comment_submit')->toString(),
    ];

    foreach ($listPlaceholderKeys as $key) {
      if (!isset($endpoints[$key])) {
        $endpoints[$key] = Url::fromRoute('thietkeasea_vue_api.placeholder_list', ['key' => $key])->toString();
      }
    }

    return $endpoints;
  }

}
