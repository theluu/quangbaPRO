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
    $data = array_map([$this->contentMapperService, 'mapBannerNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function services(): JsonResponse {
    $nodes = $this->loadNodesByTypeAndField('qb_service', 'field_service_type', 'industry');
    $data = array_map([$this->contentMapperService, 'mapServiceNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function marketing(): JsonResponse {
    $nodes = $this->loadNodesByTypeAndField('qb_service', 'field_service_type', 'marketing');
    $data = array_map([$this->contentMapperService, 'mapServiceNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function packages(): JsonResponse {
    $nodes = $this->loadNodesByType('qb_package');
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
    $data = array_map([$this->contentMapperService, 'mapThemeNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function wpFeatured(): JsonResponse {
    $nodes = $this->loadNodesByTypeAndField('qb_theme', 'field_theme_type', 'wp_featured');
    $data = array_map([$this->contentMapperService, 'mapThemeNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function wpWhy(): JsonResponse {
    $nodes = $this->loadNodesByTypeAndField('qb_theme', 'field_theme_type', 'wp_why');
    $data = array_map([$this->contentMapperService, 'mapThemeNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function partners(): JsonResponse {
    $nodes = $this->loadNodesByType('qb_partner');
    $data = array_map([$this->contentMapperService, 'mapPartnerNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function testimonials(): JsonResponse {
    $nodes = $this->loadNodesByType('qb_testimonials');
    $data = array_map([$this->contentMapperService, 'mapTestimonialNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function faqs(): JsonResponse {
    $nodes = $this->loadNodesByTypeAndField('qb_faq', 'field_faq_type', 'designweb');
    $data = array_map([$this->contentMapperService, 'mapFaqNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function wpFaq(): JsonResponse {
    $nodes = $this->loadNodesByTypeAndField('qb_faq', 'field_faq_type', 'wp');
    $data = array_map([$this->contentMapperService, 'mapFaqNode'], $nodes);

    return new JsonResponse([
      'message' => 'success!',
      'data' => $data,
    ]);
  }

  public function knowledgeList(): JsonResponse {
    $nodes = $this->loadNodesByType('qb_knowledge');
    $data = array_map([$this->contentMapperService, 'mapKnowledgeListNode'], $nodes);

    return new JsonResponse([
      'message' => 'success',
      'data' => $data,
    ]);
  }

  public function knowledgeDetail(Request $request): JsonResponse {
    $node = $this->resolveKnowledgeNode($request);
    $data = $node ? $this->contentMapperService->mapKnowledgeDetailNode($node) : [];

    return new JsonResponse([
      'data' => $data,
    ]);
  }

  public function knowledgeCategories(): JsonResponse {
    $data = $this->contentMapperService->collectKnowledgeTerms('field_category', TRUE);

    return new JsonResponse([
      'message' => 'success',
      'data' => $data,
    ]);
  }

  public function knowledgeTopics(): JsonResponse {
    $data = $this->contentMapperService->collectKnowledgeTerms('field_topic', FALSE);

    return new JsonResponse([
      'message' => 'success',
      'data' => $data,
    ]);
  }

  public function knowledgeRelatedNews(Request $request): JsonResponse {
    $node = $this->resolveKnowledgeNode($request);
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
    return new JsonResponse([
      'message' => 'success!',
      'key' => $key,
      'data' => [],
    ]);
  }

  public function placeholderObject(string $key): JsonResponse {
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
