<?php

namespace Drupal\thietkeasea_vue_frontend\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

class VueAppController extends ControllerBase {

  public function build(): array {
    $build = [
      '#type' => 'container',
      '#attributes' => ['id' => 'app'],
      '#attached' => [
        'drupalSettings' => [
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

    $this->attachVueAssets($build);
    return $build;
  }

  protected function attachVueAssets(array &$build): void {
    $root = \Drupal::root();
    $cssPath = '/vue/dist/index.css';
    $jsPath = '/vue/dist/index.js';
    $drupalSettingsPath = '/vue/dist/drupalSettings.js';
    $circularProgressPath = '/vue/node_modules/circular-progress-bar/dist/circularProgressBar.min.js';

    if (is_file($root . $cssPath)) {
      $build['#attached']['html_head_link'][] = [[
        'rel' => 'stylesheet',
        'href' => $cssPath,
      ], 'thietkeasea_vue_frontend_css'];
    }

    if (is_file($root . $drupalSettingsPath)) {
      $build['#attached']['html_head'][] = [[
        '#tag' => 'script',
        '#attributes' => [
          'src' => $drupalSettingsPath,
          'type' => 'application/javascript',
        ],
      ], 'thietkeasea_vue_frontend_drupal_settings_polyfill'];
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
      'navigation',
    ];

    $endpoints = [
      'banners' => Url::fromRoute('thietkeasea_vue_api.banners')->toString(),
      'services' => Url::fromRoute('thietkeasea_vue_api.services')->toString(),
      'marketing' => Url::fromRoute('thietkeasea_vue_api.marketing')->toString(),
      'packages' => Url::fromRoute('thietkeasea_vue_api.packages')->toString(),
      'wppackages' => Url::fromRoute('thietkeasea_vue_api.wppackages')->toString(),
      'themes' => Url::fromRoute('thietkeasea_vue_api.themes')->toString(),
      'wpfeatured' => Url::fromRoute('thietkeasea_vue_api.wpfeatured')->toString(),
      'wpwhy' => Url::fromRoute('thietkeasea_vue_api.wpwhy')->toString(),
      'partners' => Url::fromRoute('thietkeasea_vue_api.partners')->toString(),
      'testimonials' => Url::fromRoute('thietkeasea_vue_api.testimonials')->toString(),
      'faqs' => Url::fromRoute('thietkeasea_vue_api.faqs')->toString(),
      'wpfaq' => Url::fromRoute('thietkeasea_vue_api.wpfaq')->toString(),
      'knowledgeList' => Url::fromRoute('thietkeasea_vue_api.knowledge_list')->toString(),
      'knowledgeDetail' => Url::fromRoute('thietkeasea_vue_api.knowledge_detail')->toString(),
      'knowledgeCategories' => Url::fromRoute('thietkeasea_vue_api.knowledge_categories')->toString(),
      'knowledgeTopics' => Url::fromRoute('thietkeasea_vue_api.knowledge_topics')->toString(),
      'knowledgeRelatedNews' => Url::fromRoute('thietkeasea_vue_api.knowledge_related_news')->toString(),
    ];

    foreach ($listPlaceholderKeys as $key) {
      $endpoints[$key] = Url::fromRoute('thietkeasea_vue_api.placeholder_list', ['key' => $key])->toString();
    }

    return $endpoints;
  }

}
