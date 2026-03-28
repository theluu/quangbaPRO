<?php

namespace Drupal\thietkeasea_vue_api\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Menu\MenuLinkTreeInterface;
use Drupal\Core\Menu\MenuTreeParameters;
use Drupal\node\NodeInterface;
use Drupal\thietkeasea_vue_api\Service\ContentMapper;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends ControllerBase {

  public function __construct(
    protected EntityTypeManagerInterface $entityTypeManagerService,
    protected EntityFieldManagerInterface $entityFieldManager,
    protected ContentMapper $contentMapperService,
    protected MenuLinkTreeInterface $menuLinkTree,
  ) {}

  public static function create(ContainerInterface $container): static {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('entity_field.manager'),
      $container->get('thietkeasea_vue_api.content_mapper'),
      $container->get('menu.link_tree'),
    );
  }

  public function banners(): JsonResponse {
    $nodes = $this->loadNodesByType('qb_banner');
    if (!$nodes) {
      return $this->jsonFixtureResponse('banners');
    }

    $data = array_map([$this->contentMapperService, 'mapBannerNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function services(): JsonResponse {
    $nodes = $this->loadNodesByTypeAndField('qb_service', 'field_service_type', 'industry');
    if (!$nodes) {
      return $this->jsonFixtureResponse('services');
    }

    $data = array_map([$this->contentMapperService, 'mapServiceNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function marketing(): JsonResponse {
    $nodes = $this->loadNodesByTypeAndField('qb_service', 'field_service_type', 'marketing');
    if (!$nodes) {
      return $this->jsonFixtureResponse('marketing');
    }

    $data = array_map([$this->contentMapperService, 'mapServiceNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function packages(): JsonResponse {
    $nodes = $this->loadNodesByType('qb_package');
    if (!$nodes) {
      return $this->jsonFixtureResponse('packages');
    }

    $data = array_map([$this->contentMapperService, 'mapPackageNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function wpPackages(): JsonResponse {
    return $this->packages();
  }

  public function themes(): JsonResponse {
    $nodes = $this->loadNodesByTypeAndField('qb_theme', 'field_theme_type', 'theme');
    if (!$nodes) {
      return $this->jsonFixtureResponse('theme');
    }

    $data = array_map([$this->contentMapperService, 'mapThemeNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function wpFeatured(): JsonResponse {
    $nodes = $this->loadNodesByTypeAndField('qb_theme', 'field_theme_type', 'wp_featured');
    if (!$nodes) {
      return $this->jsonFixtureResponse('wpfeatured');
    }

    $data = array_map([$this->contentMapperService, 'mapThemeNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function wpWhy(): JsonResponse {
    $nodes = $this->loadNodesByTypeAndField('qb_theme', 'field_theme_type', 'wp_why');
    if (!$nodes) {
      return $this->jsonFixtureResponse('wpwhy');
    }

    $data = array_map([$this->contentMapperService, 'mapThemeNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function partners(): JsonResponse {
    $nodes = $this->loadNodesByType('qb_partner');
    if (!$nodes) {
      return $this->jsonFixtureResponse('partners');
    }

    $data = array_map([$this->contentMapperService, 'mapPartnerNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function testimonials(): JsonResponse {
    $nodes = $this->loadNodesByType('qb_testimonials');
    if (!$nodes) {
      return $this->jsonFixtureResponse('testimonials');
    }

    $data = array_map([$this->contentMapperService, 'mapTestimonialNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function faqs(): JsonResponse {
    $nodes = $this->loadNodesByTypeAndField('qb_faq', 'field_faq_type', 'designweb');
    if (!$nodes) {
      return $this->jsonFixtureResponse('faqs');
    }

    $data = array_map([$this->contentMapperService, 'mapFaqNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function wpFaq(): JsonResponse {
    $nodes = $this->loadNodesByTypeAndField('qb_faq', 'field_faq_type', 'wp');
    if (!$nodes) {
      return $this->jsonFixtureResponse('wpfaq');
    }

    $data = array_map([$this->contentMapperService, 'mapFaqNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function knowledgeList(): JsonResponse {
    $nodes = $this->loadNodesByType('qb_knowledge');
    if (!$nodes) {
      return $this->jsonFixtureResponse('knowledgeList');
    }

    $data = array_map([$this->contentMapperService, 'mapKnowledgeListNode'], $nodes);

    return new JsonResponse([
      'message' => 'success',
      'data' => $data,
    ]);
  }

  public function knowledgeDetail(Request $request): JsonResponse {
    $node = $this->resolveKnowledgeNode($request);
    if (!$node) {
      return $this->jsonFixtureResponse('knowledgeDetail');
    }

    $data = $node ? $this->contentMapperService->mapKnowledgeDetailNode($node) : [];

    return new JsonResponse([
      'data' => $data,
    ]);
  }

  public function knowledgeCategories(): JsonResponse {
    $data = $this->contentMapperService->collectKnowledgeTerms('field_category', TRUE);
    if (!$data) {
      return $this->jsonFixtureResponse('knowledgeCategories');
    }

    return new JsonResponse([
      'message' => 'success',
      'data' => $data,
    ]);
  }

  public function knowledgeTopics(): JsonResponse {
    $data = $this->contentMapperService->collectKnowledgeTerms('field_topic', FALSE);
    if (!$data) {
      return $this->jsonFixtureResponse('knowledgeTopics');
    }

    return new JsonResponse([
      'message' => 'success',
      'data' => $data,
    ]);
  }

  public function knowledgeRelatedNews(Request $request): JsonResponse {
    $node = $this->resolveKnowledgeNode($request);
    if (!$node) {
      return $this->jsonFixtureResponse('knowledgeRelatedNews');
    }

    $data = $node ? $this->contentMapperService->mapKnowledgeRelatedNews($node) : [];

    return new JsonResponse([
      'message' => 'success',
      'data' => $data,
    ]);
  }

  public function navigation(): JsonResponse {
    $parameters = (new MenuTreeParameters())
      ->setMaxDepth(2)
      ->onlyEnabledLinks();

    $tree = $this->menuLinkTree->load('main', $parameters);
    $manipulators = [
      ['callable' => 'menu.default_tree_manipulators:checkAccess'],
      ['callable' => 'menu.default_tree_manipulators:generateIndexAndSort'],
    ];
    $tree = $this->menuLinkTree->transform($tree, $manipulators);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $this->mapMenuTree($tree),
    ]);
  }

  public function search(Request $request): JsonResponse {
    $keyword = trim((string) $request->query->get('q', ''));
    if ($keyword === '') {
      return new JsonResponse([
        'message' => 'success',
        'keyword' => '',
        'data' => [],
      ]);
    }

    $nodes = $this->searchKnowledgeNodes($keyword);
    $data = array_map([$this->contentMapperService, 'mapKnowledgeListNode'], $nodes);

    return new JsonResponse([
      'message' => 'success',
      'keyword' => $keyword,
      'data' => $data,
    ]);
  }

  public function placeholderList(string $key): JsonResponse {
    $fixture = $this->loadJsonFixture($key);
    if ($fixture !== NULL) {
      return new JsonResponse($fixture);
    }

    return new JsonResponse([
      'message' => 'success!',
      'key' => $key,
      'data' => [],
    ]);
  }

  public function placeholderObject(string $key): JsonResponse {
    $fixture = $this->loadJsonFixture($key);
    if ($fixture !== NULL) {
      return new JsonResponse($fixture);
    }

    return new JsonResponse([
      'message' => 'success!',
      'key' => $key,
      'data' => new \stdClass(),
    ]);
  }

  protected function resolveKnowledgeNode(Request $request): ?NodeInterface {
    $nid = $request->query->get('nid');
    if ($nid) {
      $node = $this->entityTypeManagerService->getStorage('node')->load($nid);
      if ($node instanceof NodeInterface && $node->bundle() === 'qb_knowledge' && $node->isPublished()) {
        return $node;
      }
    }

    $nodes = $this->loadNodesByType('qb_knowledge', 1);
    return $nodes[0] ?? NULL;
  }

  protected function jsonFixtureResponse(string $key): JsonResponse {
    $fixture = $this->loadJsonFixture($key);

    if ($fixture !== NULL) {
      return new JsonResponse($fixture);
    }

    return new JsonResponse([
      'message' => 'success!',
      'key' => $key,
      'data' => [],
    ]);
  }

  protected function loadJsonFixture(string $key): ?array {
    $map = [
      'banners' => 'banners.json',
      'services' => 'services.json',
      'marketing' => 'marketing.json',
      'packages' => 'packages.json',
      'theme' => 'theme.json',
      'wpfeatured' => 'wp-featured.json',
      'wpwhy' => 'wp-why.json',
      'partners' => 'partners.json',
      'testimonials' => 'testimonials.json',
      'faqs' => 'designweb-faq.json',
      'wpfaq' => 'wp-faq.json',
      'knowledgeList' => 'knowledge-list.json',
      'knowledgeDetail' => 'knowledge-detail.json',
      'knowledgeCategories' => 'knowledge-categories.json',
      'knowledgeTopics' => 'knowledge-topics.json',
      'knowledgeRelatedNews' => 'knowledge-related-news.json',
      'featured' => 'featured.json',
      'blockhome' => 'blockhome.json',
      'introductionHome' => 'abouthome.json',
      'benefits' => 'designweb-benefits.json',
      'solutions' => 'designweb-solutions.json',
      'processes' => 'designweb-process.json',
      'commitments' => 'designweb-commitment.json',
      'reasonses' => 'designweb-reasons.json',
      'bannerKnowledge' => 'banner-knowledge.json',
      'marketingHome' => 'marketingHome.json',
      'seoIntro' => 'seo-intro.json',
      'seoDefinition' => 'seo-definition.json',
      'seoServices' => 'seo-services.json',
      'seoPricing' => 'seo-pricing.json',
      'seoProcess' => 'seo-process.json',
      'seoCommitment' => 'seo-commitment.json',
      'seoContactForm' => 'seo-contact-form.json',
      'bannerAbout' => 'banner-about.json',
      'aboutContent' => 'about-content.json',
      'aboutMission' => 'about-mission.json',
      'aboutWhy' => 'about-why.json',
      'facebookBenefits' => 'facebook-benefits.json',
      'facebookServices' => 'facebook-services.json',
      'facebookDisparity' => 'facebook-disparity.json',
      'facebookProcess' => 'facebook-process.json',
      'googleAdsFeatures' => 'google-ads-features.json',
      'googleAdsStrategies' => 'google-ads-strategies.json',
      'googleAdsProcess' => 'google-ads-process.json',
      'googleAdsCommitment' => 'google-ads-commitment.json',
    ];

    if (!isset($map[$key])) {
      return NULL;
    }

    $path = \Drupal::root() . '/vue/data/' . $map[$key];
    if (!is_file($path)) {
      return NULL;
    }

    $content = file_get_contents($path);
    if ($content === FALSE) {
      return NULL;
    }

    $decoded = json_decode($content, TRUE);
    return is_array($decoded) ? $decoded : NULL;
  }

  /**
   * @return \Drupal\node\NodeInterface[]
   */
  protected function loadNodesByType(string $bundle, ?int $limit = NULL): array {
    $query = $this->entityTypeManagerService->getStorage('node')->getQuery()
      ->condition('type', $bundle)
      ->condition('status', 1)
      ->accessCheck(TRUE)
      ->sort('created', 'DESC');

    if ($limit !== NULL) {
      $query->range(0, $limit);
    }

    $nids = $query->execute();
    if (!$nids) {
      return [];
    }

    $nodes = $this->entityTypeManagerService->getStorage('node')->loadMultiple($nids);
    return array_values(array_filter($nodes, fn ($node) => $node instanceof NodeInterface));
  }

  /**
   * @return \Drupal\node\NodeInterface[]
   */
  protected function loadNodesByTypeAndField(string $bundle, string $fieldName, string $fieldValue): array {
    $query = $this->entityTypeManagerService->getStorage('node')->getQuery()
      ->condition('type', $bundle)
      ->condition('status', 1)
      ->condition($fieldName, $fieldValue)
      ->accessCheck(TRUE)
      ->sort('field_sort', 'ASC')
      ->sort('created', 'DESC');

    $nids = $query->execute();
    if (!$nids) {
      return [];
    }

    $nodes = $this->entityTypeManagerService->getStorage('node')->loadMultiple($nids);
    return array_values(array_filter($nodes, fn ($node) => $node instanceof NodeInterface));
  }

  protected function mapMenuTree(array $tree): array {
    $items = [];

    foreach ($tree as $element) {
      if (!$element->access || !$element->access->isAllowed()) {
        continue;
      }

      $link = $element->link;
      $url = $link->getUrlObject();

      $items[] = [
        'id' => $link->getPluginId(),
        'title' => $link->getTitle(),
        'url' => $url->isRouted() ? $url->toString() : $url->getUri(),
        'submenu' => $this->mapMenuTree($element->subtree),
      ];
    }

    return $items;
  }

  /**
   * @return \Drupal\node\NodeInterface[]
   */
  protected function searchKnowledgeNodes(string $keyword, int $limit = 24): array {
    $storage = $this->entityTypeManagerService->getStorage('node');
    $query = $storage->getQuery()
      ->condition('type', 'qb_knowledge')
      ->condition('status', 1)
      ->accessCheck(TRUE)
      ->sort('created', 'DESC')
      ->range(0, $limit);

    $fieldDefinitions = $this->entityFieldManager->getFieldDefinitions('node', 'qb_knowledge');
    $orGroup = $query->orConditionGroup()
      ->condition('title', $keyword, 'CONTAINS');

    $optionalFields = [
      'field_summary' => 'field_summary.value',
      'body' => 'body.value',
      'field_intro_html' => 'field_intro_html.value',
    ];

    foreach ($optionalFields as $fieldName => $queryField) {
      if (isset($fieldDefinitions[$fieldName])) {
        $orGroup->condition($queryField, $keyword, 'CONTAINS');
      }
    }

    $query->condition($orGroup);

    $nids = $query->execute();
    if (!$nids) {
      return [];
    }

    $nodes = $storage->loadMultiple($nids);
    return array_values(array_filter($nodes, fn ($node) => $node instanceof NodeInterface));
  }

}
