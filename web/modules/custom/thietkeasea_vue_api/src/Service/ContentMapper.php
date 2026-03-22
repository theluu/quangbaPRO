<?php

namespace Drupal\thietkeasea_vue_api\Service;

use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\File\FileUrlGeneratorInterface;
use Drupal\path_alias\AliasManagerInterface;
use Drupal\node\NodeInterface;
use Drupal\paragraphs\ParagraphInterface;
use Drupal\taxonomy\TermInterface;

class ContentMapper {

  public function __construct(
    protected EntityTypeManagerInterface $entityTypeManager,
    protected DateFormatterInterface $dateFormatter,
    protected FileUrlGeneratorInterface $fileUrlGenerator,
    protected AliasManagerInterface $pathAliasManager,
  ) {}

  public function mapBannerNode(NodeInterface $node): array {
    [$imageMobileUrl] = $this->extractImageData($node, ['field_image_mobile', 'field_banner_mobile']);
    [$imageDesktopUrl] = $this->extractImageData($node, ['field_image_desktop', 'field_banner_desktop']);

    return [
      'id' => (int) $node->id(),
      'imgSrcMb' => $imageMobileUrl,
      'imgSrcPc' => $imageDesktopUrl,
      'title' => $node->label(),
      'subTitle' => $this->getString($node, ['field_sub_title', 'field_subtitle']),
      'desc' => $this->getText($node, ['field_description', 'body']),
    ];
  }

  public function mapKnowledgeListNode(NodeInterface $node): array {
    [$thumbnailUrl] = $this->extractImageData($node, ['field_thumbnail', 'field_image']);

    return [
      'id' => (int) $node->id(),
      'slug' => $this->getAlias($node),
      'src' => $thumbnailUrl,
      'title' => $node->label(),
      'createdDate' => $this->dateFormatter->format($node->getCreatedTime(), 'custom', 'd/m/Y'),
      'desc' => $this->getText($node, ['field_summary', 'body']),
    ];
  }

  public function mapServiceNode(NodeInterface $node): array {
    [$imageUrl] = $this->extractImageData($node, ['field_image']);

    return [
      'id' => (int) $node->id(),
      'src' => $imageUrl,
      'title' => $node->label(),
      'desc' => $this->getText($node, ['field_description', 'body']),
      'features' => $this->mapTextParagraphItems($node, 'field_features'),
    ];
  }

  public function mapPackageNode(NodeInterface $node): array {
    return [
      'id' => (int) $node->id(),
      'title' => $node->label(),
      'price' => $this->getString($node, ['field_price_text']),
      'type' => $this->getString($node, ['field_package_type']),
      'lists' => $this->mapPackageItems($node, 'field_items'),
      'link' => $this->getLinkUri($node, 'field_link'),
    ];
  }

  public function mapThemeNode(NodeInterface $node): array {
    [$imageUrl] = $this->extractImageData($node, ['field_image']);
    $data = [
      'id' => (int) $node->id(),
      'src' => $imageUrl,
      'title' => $node->label(),
    ];

    $alt = $this->getString($node, ['field_alt']);
    if ($alt !== '') {
      $data['alt'] = $alt;
    }

    $price = $this->getString($node, ['field_price_text']);
    if ($price !== '') {
      $data['price'] = $price;
    }

    $desc = $this->getText($node, ['field_description']);
    if ($desc !== '') {
      $data['desc'] = $desc;
    }

    $link = $this->getLinkUri($node, 'field_link');
    if ($link !== '') {
      $data['link'] = $link;
    }

    return $data;
  }

  public function mapPartnerNode(NodeInterface $node): array {
    [$logoUrl] = $this->extractImageData($node, ['field_logo', 'field_image']);

    return [
      'id' => (int) $node->id(),
      'src' => $logoUrl,
      'alt' => $this->getString($node, ['field_alt']) ?: $node->label(),
    ];
  }

  public function mapTestimonialNode(NodeInterface $node): array {
    [$avatarUrl] = $this->extractImageData($node, ['field_avatar', 'field_image']);

    return [
      'id' => (int) $node->id(),
      'name' => $this->getString($node, ['field_customer_name']) ?: $node->label(),
      'location' => $this->getString($node, ['field_location']),
      'avatar' => $avatarUrl,
      'testimonial' => $this->getText($node, ['field_testimonial', 'body']),
      'rating' => (int) $this->getString($node, ['field_rating']),
    ];
  }

  public function mapFaqNode(NodeInterface $node): array {
    return [
      'id' => (int) $node->id(),
      'question' => $this->getString($node, ['field_question']) ?: $node->label(),
      'answer' => $this->getText($node, ['field_answer', 'body']),
    ];
  }

  public function mapKnowledgeDetailNode(NodeInterface $node): array {
    return [
      'id' => (int) $node->id(),
      'slug' => $this->getAlias($node),
      'title' => $node->label(),
      'author' => $node->getOwner()?->getDisplayName() ?? '',
      'publishDate' => $this->dateFormatter->format($node->getCreatedTime(), 'custom', 'd/m/Y H:i'),
      'comments' => 0,
      'intro' => $this->getFormattedText($node, ['field_intro_html', 'body']),
      'hightLineConent' => [
        'title' => $this->getString($node, ['field_highlight_title']),
        'content' => $this->mapTextParagraphItems($node, 'field_highlight_items'),
      ],
      'toc' => $this->mapTocItems($node, 'field_toc_items'),
      'content' => $this->mapContentBlocks($node, 'field_content_blocks'),
      'categories' => $this->mapReferencedTerms($node, 'field_category'),
      'topics' => $this->mapReferencedTerms($node, 'field_topic'),
      'relatedNews' => $this->mapKnowledgeRelatedNews($node),
    ];
  }

  public function mapKnowledgeRelatedNews(NodeInterface $node): array {
    if (!$node->hasField('field_related_news') || $node->get('field_related_news')->isEmpty()) {
      return [];
    }

    $items = [];
    foreach ($node->get('field_related_news')->referencedEntities() as $related) {
      if (!$related instanceof NodeInterface) {
        continue;
      }
      [$thumbnailUrl] = $this->extractImageData($related, ['field_thumbnail', 'field_image']);
      $items[] = [
        'id' => (int) $related->id(),
        'slug' => $this->getAlias($related),
        'src' => $thumbnailUrl,
        'title' => $related->label(),
        'date' => $this->dateFormatter->format($related->getCreatedTime(), 'custom', 'd/m/Y'),
      ];
    }

    return $items;
  }

  public function collectKnowledgeTerms(string $fieldName, bool $includeCount): array {
    $nodes = $this->loadPublishedKnowledgeNodes();
    $terms = [];

    foreach ($nodes as $node) {
      if (!$node->hasField($fieldName) || $node->get($fieldName)->isEmpty()) {
        continue;
      }

      foreach ($node->get($fieldName)->referencedEntities() as $term) {
        if (!$term instanceof TermInterface) {
          continue;
        }

        $tid = (int) $term->id();
        if (!isset($terms[$tid])) {
          [$iconUrl] = $this->extractImageData($term, ['field_icon', 'field_image']);
          $terms[$tid] = [
            'id' => $tid,
            'title' => $term->label(),
            'count' => 0,
            'icon' => $iconUrl,
            'items' => [],
          ];
        }
        $terms[$tid]['count']++;
      }
    }

    $output = array_values($terms);
    if ($includeCount) {
      foreach ($output as &$item) {
        $suffix = $item['count'] === 1 ? ' bài viết' : ' bài viết';
        $item['count'] = $item['count'] . $suffix;
      }
    }
    else {
      foreach ($output as &$item) {
        unset($item['count']);
      }
    }

    return $output;
  }

  protected function mapReferencedTerms(NodeInterface $node, string $fieldName): array {
    if (!$node->hasField($fieldName) || $node->get($fieldName)->isEmpty()) {
      return [];
    }

    $items = [];
    foreach ($node->get($fieldName)->referencedEntities() as $term) {
      if ($term instanceof TermInterface) {
        $items[] = [
          'id' => (int) $term->id(),
          'title' => $term->label(),
        ];
      }
    }
    return $items;
  }

  protected function mapTextParagraphItems(NodeInterface $node, string $fieldName): array {
    if (!$node->hasField($fieldName) || $node->get($fieldName)->isEmpty()) {
      return [];
    }

    $items = [];
    foreach ($node->get($fieldName)->referencedEntities() as $paragraph) {
      if ($paragraph instanceof ParagraphInterface) {
        $items[] = $this->getText($paragraph, ['field_text']);
      }
    }

    return array_values(array_filter($items));
  }

  protected function mapTocItems(NodeInterface $node, string $fieldName): array {
    if (!$node->hasField($fieldName) || $node->get($fieldName)->isEmpty()) {
      return [];
    }

    $items = [];
    foreach ($node->get($fieldName)->referencedEntities() as $paragraph) {
      if ($paragraph instanceof ParagraphInterface) {
        $items[] = $this->mapTocParagraph($paragraph);
      }
    }

    return $items;
  }

  protected function mapTocParagraph(ParagraphInterface $paragraph): array {
    $item = [
      'id' => $this->getString($paragraph, ['field_anchor_id']),
      'text' => $this->getText($paragraph, ['field_text']),
    ];

    if ($paragraph->hasField('field_children') && !$paragraph->get('field_children')->isEmpty()) {
      $children = [];
      foreach ($paragraph->get('field_children')->referencedEntities() as $child) {
        if ($child instanceof ParagraphInterface) {
          $children[] = [
            'id' => $this->getString($child, ['field_anchor_id']),
            'text' => $this->getText($child, ['field_text']),
          ];
        }
      }
      if ($children) {
        $item['children'] = $children;
      }
    }

    return $item;
  }

  protected function mapContentBlocks(NodeInterface $node, string $fieldName): array {
    if (!$node->hasField($fieldName) || $node->get($fieldName)->isEmpty()) {
      return [];
    }

    $items = [];
    foreach ($node->get($fieldName)->referencedEntities() as $paragraph) {
      if (!$paragraph instanceof ParagraphInterface) {
        continue;
      }

      [$imageUrl, $imageAlt] = $this->extractImageData($paragraph, ['field_image']);
      $item = [
        'type' => $this->getString($paragraph, ['field_block_type']),
        'id' => $this->getString($paragraph, ['field_anchor_id']),
        'text' => $this->getText($paragraph, ['field_text']),
      ];

      if ($imageUrl) {
        $item['src'] = $imageUrl;
        $item['alt'] = $this->getString($paragraph, ['field_alt']) ?: $imageAlt;
      }

      $items[] = array_filter($item, static fn ($value) => $value !== '' && $value !== NULL);
    }

    return $items;
  }

  protected function mapPackageItems(NodeInterface $node, string $fieldName): array {
    if (!$node->hasField($fieldName) || $node->get($fieldName)->isEmpty()) {
      return [];
    }

    $items = [];
    foreach ($node->get($fieldName)->referencedEntities() as $paragraph) {
      if (!$paragraph instanceof ParagraphInterface) {
        continue;
      }

      $items[] = [
        'text' => $this->getString($paragraph, ['field_text']),
        'disabled' => $this->getBoolean($paragraph, ['field_disabled']),
        'value' => $this->getString($paragraph, ['field_value']),
      ];
    }

    return $items;
  }

  protected function getAlias(NodeInterface $node): string {
    return $this->pathAliasManager->getAliasByPath('/node/' . $node->id());
  }

  protected function getString(ContentEntityInterface $entity, array $fieldCandidates): string {
    foreach ($fieldCandidates as $fieldName) {
      if ($entity->hasField($fieldName) && !$entity->get($fieldName)->isEmpty()) {
        return trim((string) $entity->get($fieldName)->value);
      }
    }
    return '';
  }

  protected function getText(ContentEntityInterface $entity, array $fieldCandidates): string {
    foreach ($fieldCandidates as $fieldName) {
      if ($entity->hasField($fieldName) && !$entity->get($fieldName)->isEmpty()) {
        $item = $entity->get($fieldName)->first();
        if (isset($item->value)) {
          return trim((string) $item->value);
        }
      }
    }
    return '';
  }

  protected function getFormattedText(ContentEntityInterface $entity, array $fieldCandidates): string {
    foreach ($fieldCandidates as $fieldName) {
      if ($entity->hasField($fieldName) && !$entity->get($fieldName)->isEmpty()) {
        $item = $entity->get($fieldName)->first();
        if (isset($item->processed) && $item->processed !== NULL) {
          return (string) $item->processed;
        }
        if (isset($item->value)) {
          return (string) $item->value;
        }
      }
    }
    return '';
  }

  protected function getBoolean(ContentEntityInterface $entity, array $fieldCandidates): bool {
    foreach ($fieldCandidates as $fieldName) {
      if ($entity->hasField($fieldName) && !$entity->get($fieldName)->isEmpty()) {
        return (bool) $entity->get($fieldName)->value;
      }
    }

    return FALSE;
  }

  protected function getLinkUri(ContentEntityInterface $entity, string $fieldName): string {
    if (!$entity->hasField($fieldName) || $entity->get($fieldName)->isEmpty()) {
      return '';
    }

    $uri = (string) $entity->get($fieldName)->uri;
    if (str_starts_with($uri, 'internal:')) {
      return substr($uri, strlen('internal:'));
    }

    return $uri;
  }

  protected function extractImageData(ContentEntityInterface $entity, array $fieldCandidates): array {
    foreach ($fieldCandidates as $fieldName) {
      if (!$entity->hasField($fieldName) || $entity->get($fieldName)->isEmpty()) {
        continue;
      }

      $target = $entity->get($fieldName)->entity;
      if (!$target instanceof EntityInterface) {
        continue;
      }

      if ($target->getEntityTypeId() === 'media') {
        foreach (['field_media_image', 'thumbnail'] as $mediaField) {
          if ($target->hasField($mediaField) && !$target->get($mediaField)->isEmpty()) {
            $file = $target->get($mediaField)->entity;
            if ($file) {
              return [
                $this->fileUrlGenerator->generateString($file->getFileUri()),
                (string) ($target->get($mediaField)->alt ?? ''),
              ];
            }
          }
        }
      }

      if ($target->getEntityTypeId() === 'file') {
        return [
          $this->fileUrlGenerator->generateString($target->getFileUri()),
          '',
        ];
      }
    }

    return ['', ''];
  }

  /**
   * @return \Drupal\node\NodeInterface[]
   */
  protected function loadPublishedKnowledgeNodes(): array {
    $nids = $this->entityTypeManager->getStorage('node')->getQuery()
      ->condition('type', 'qb_knowledge')
      ->condition('status', 1)
      ->accessCheck(TRUE)
      ->sort('created', 'DESC')
      ->execute();

    if (!$nids) {
      return [];
    }

    $nodes = $this->entityTypeManager->getStorage('node')->loadMultiple($nids);
    return array_values(array_filter($nodes, fn ($node) => $node instanceof NodeInterface));
  }

}
