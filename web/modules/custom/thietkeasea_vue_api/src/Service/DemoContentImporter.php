<?php

namespace Drupal\thietkeasea_vue_api\Service;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\File\FileExists;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\file\FileInterface;
use Drupal\file\FileRepositoryInterface;
use Drupal\node\NodeInterface;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\taxonomy\Entity\Term;

class DemoContentImporter {

  protected array $assetIndex = [];

  public function __construct(
    protected EntityTypeManagerInterface $entityTypeManager,
    protected FileSystemInterface $fileSystem,
    protected FileRepositoryInterface $fileRepository,
    protected LoggerChannelFactoryInterface $loggerFactory,
  ) {}

  public function importAll(bool $reset = FALSE): array {
    if ($reset) {
      $this->resetDemoContent();
    }

    $categories = $this->importKnowledgeTerms('knowledge-categories.json', 'qb_knowledge_category');
    $topics = $this->importKnowledgeTerms('knowledge-topics.json', 'qb_knowledge_topic');

    return [
      'banners' => $this->importBanners(),
      'services' => $this->importServices(),
      'packages' => $this->importPackages(),
      'themes' => $this->importThemes(),
      'partners' => $this->importPartners(),
      'testimonials' => $this->importTestimonials(),
      'faqs' => $this->importFaqs(),
      'knowledge_categories' => count($categories),
      'knowledge_topics' => count($topics),
      'knowledge' => $this->importKnowledge($categories, $topics, $reset),
    ];
  }

  protected function resetDemoContent(): void {
    $node_storage = $this->entityTypeManager->getStorage('node');
    $paragraph_storage = $this->entityTypeManager->getStorage('paragraph');
    $bundles = [
      'qb_banner',
      'qb_service',
      'qb_package',
      'qb_theme',
      'qb_partner',
      'qb_testimonials',
      'qb_faq',
      'qb_knowledge',
    ];

    foreach ($bundles as $bundle) {
      $ids = $node_storage->getQuery()
        ->accessCheck(FALSE)
        ->condition('type', $bundle)
        ->execute();

      if ($ids) {
        $node_storage->delete($node_storage->loadMultiple($ids));
      }
    }

    $paragraph_ids = $paragraph_storage->getQuery()
      ->accessCheck(FALSE)
      ->condition('type', ['qb_feature_item', 'qb_package_item', 'qb_text_item', 'qb_toc_item', 'qb_content_block'], 'IN')
      ->execute();
    if ($paragraph_ids) {
      $paragraph_storage->delete($paragraph_storage->loadMultiple($paragraph_ids));
    }

    $term_storage = $this->entityTypeManager->getStorage('taxonomy_term');
    foreach (['qb_knowledge_category', 'qb_knowledge_topic'] as $vid) {
      $ids = $term_storage->getQuery()
        ->accessCheck(FALSE)
        ->condition('vid', $vid)
        ->execute();
      if ($ids) {
        $term_storage->delete($term_storage->loadMultiple($ids));
      }
    }
  }

  protected function importBanners(): int {
    $count = 0;
    foreach ($this->loadFixtureItems('banners.json') as $index => $item) {
      $node = $this->upsertNode('qb_banner', (string) ($item['title'] ?? 'Banner ' . ($index + 1)));
      $node->setPublished(TRUE);
      $this->setScalar($node, 'field_sort', $index + 1);
      $this->setScalar($node, 'field_sub_title', $item['subTitle'] ?? '');
      $this->setText($node, 'field_description', $item['desc'] ?? '');
      $this->setImage($node, 'field_image_mobile', $item['imgSrcMb'] ?? NULL, $node->label());
      $this->setImage($node, 'field_image_desktop', $item['imgSrcPc'] ?? NULL, $node->label());
      $node->save();
      $count++;
    }
    return $count;
  }

  protected function importServices(): int {
    $count = 0;

    foreach ($this->loadFixtureItems('services.json') as $index => $item) {
      $node = $this->upsertNode('qb_service', (string) ($item['title'] ?? 'Industry service ' . ($index + 1)), [
        'field_service_type' => 'industry',
      ]);
      $node->setPublished(TRUE);
      $this->setScalar($node, 'field_service_type', 'industry');
      $this->setScalar($node, 'field_sort', $index + 1);
      $this->setImage($node, 'field_image', $item['src'] ?? NULL, $node->label());
      $node->save();
      $count++;
    }

    foreach ($this->loadFixtureItems('marketing.json') as $index => $item) {
      $node = $this->upsertNode('qb_service', (string) ($item['title'] ?? 'Marketing service ' . ($index + 1)), [
        'field_service_type' => 'marketing',
      ]);
      $node->setPublished(TRUE);
      $this->setScalar($node, 'field_service_type', 'marketing');
      $this->setScalar($node, 'field_sort', $index + 1);
      $this->setText($node, 'field_description', $item['desc'] ?? '');
      $this->setImage($node, 'field_image', $item['src'] ?? NULL, $node->label());
      $this->setParagraphReferences($node, 'field_features', array_map(function ($feature) {
        return $this->createTextParagraph('qb_feature_item', $this->extractText($feature));
      }, $item['features'] ?? []));
      $node->save();
      $count++;
    }

    return $count;
  }

  protected function importPackages(): int {
    $count = 0;
    foreach ($this->loadFixtureItems('packages.json') as $index => $item) {
      $node = $this->upsertNode('qb_package', (string) ($item['title'] ?? 'Package ' . ($index + 1)));
      $node->setPublished(TRUE);
      $this->setScalar($node, 'field_sort', $index + 1);
      $this->setScalar($node, 'field_package_type', str_replace('-', '_', (string) ($item['type'] ?? 'base')));
      $this->setScalar($node, 'field_price_text', $item['price'] ?? '');
      $this->setLink($node, 'field_link', $item['link'] ?? '#');

      $paragraphs = [];
      foreach ($item['lists'] ?? [] as $list_item) {
        $paragraph = Paragraph::create(['type' => 'qb_package_item']);
        $this->setScalar($paragraph, 'field_text', $list_item['text'] ?? '');
        $this->setScalar($paragraph, 'field_value', $list_item['value'] ?? '');
        $this->setScalar($paragraph, 'field_disabled', !empty($list_item['disabled']) ? 1 : 0);
        $paragraph->save();
        $paragraphs[] = $paragraph;
      }

      $this->setParagraphReferences($node, 'field_items', $paragraphs);
      $node->save();
      $count++;
    }
    return $count;
  }

  protected function importThemes(): int {
    $count = 0;

    $theme_sets = [
      ['file' => 'theme.json', 'type' => 'theme'],
      ['file' => 'wp-featured.json', 'type' => 'wp_featured'],
      ['file' => 'wp-why.json', 'type' => 'wp_why'],
    ];

    foreach ($theme_sets as $theme_set) {
      foreach ($this->loadFixtureItems($theme_set['file']) as $index => $item) {
        $title = (string) ($item['title'] ?? ucfirst($theme_set['type']) . ' ' . ($index + 1));
        $node = $this->upsertNode('qb_theme', $title, [
          'field_theme_type' => $theme_set['type'],
        ]);
        $node->setPublished(TRUE);
        $this->setScalar($node, 'field_sort', $index + 1);
        $this->setScalar($node, 'field_theme_type', $theme_set['type']);
        $this->setScalar($node, 'field_alt', $item['alt'] ?? $title);
        $this->setScalar($node, 'field_price_text', $item['price'] ?? '');
        $this->setText($node, 'field_description', $item['desc'] ?? '');
        $this->setLink($node, 'field_link', $item['link'] ?? '#');
        $this->setImage($node, 'field_image', $item['src'] ?? ($item['icon'] ?? NULL), $title);
        $node->save();
        $count++;
      }
    }

    return $count;
  }

  protected function importPartners(): int {
    $count = 0;
    foreach ($this->loadFixtureItems('partners.json') as $index => $item) {
      $title = 'Partner ' . ($index + 1);
      $node = $this->upsertNode('qb_partner', $title);
      $node->setPublished(TRUE);
      $this->setScalar($node, 'field_sort', $index + 1);
      $this->setScalar($node, 'field_alt', $item['alt'] ?? $title);
      $this->setLink($node, 'field_link', $item['link'] ?? '#');
      $this->setImage($node, 'field_logo', $item['src'] ?? NULL, $item['alt'] ?? $title);
      $this->setImage($node, 'field_image', $item['src'] ?? NULL, $item['alt'] ?? $title);
      $node->save();
      $count++;
    }
    return $count;
  }

  protected function importTestimonials(): int {
    $count = 0;
    foreach ($this->loadFixtureItems('testimonials.json') as $index => $item) {
      $title = (string) ($item['name'] ?? 'Testimonial ' . ($index + 1));
      $node = $this->upsertNode('qb_testimonials', $title);
      $node->setPublished(TRUE);
      $this->setScalar($node, 'field_sort', $index + 1);
      $this->setScalar($node, 'field_customer_name', $item['name'] ?? '');
      $this->setScalar($node, 'field_location', $item['location'] ?? '');
      $this->setScalar($node, 'field_rating', $item['rating'] ?? 5);
      $this->setText($node, 'field_testimonial', $item['testimonial'] ?? '');
      $this->setImage($node, 'field_avatar', $item['avatar'] ?? NULL, $title);
      $node->save();
      $count++;
    }
    return $count;
  }

  protected function importFaqs(): int {
    $count = 0;
    $faq_sets = [
      ['file' => 'designweb-faq.json', 'type' => 'designweb'],
      ['file' => 'wp-faq.json', 'type' => 'wp'],
    ];

    foreach ($faq_sets as $faq_set) {
      foreach ($this->loadFixtureItems($faq_set['file']) as $index => $item) {
        $title = (string) ($item['question'] ?? 'FAQ ' . ($index + 1));
        $node = $this->upsertNode('qb_faq', $title, [
          'field_faq_type' => $faq_set['type'],
        ]);
        $node->setPublished(TRUE);
        $this->setScalar($node, 'field_sort', $index + 1);
        $this->setScalar($node, 'field_faq_type', $faq_set['type']);
        $this->setScalar($node, 'field_question', $item['question'] ?? '');
        $this->setText($node, 'field_answer', $item['answer'] ?? '');
        $node->save();
        $count++;
      }
    }

    return $count;
  }

  protected function importKnowledgeTerms(string $filename, string $vocabulary): array {
    $terms = [];
    foreach ($this->loadFixtureItems($filename) as $item) {
      $name = trim((string) ($item['title'] ?? ''));
      if ($name === '') {
        continue;
      }

      $term = $this->upsertTerm($vocabulary, $name);
      $this->setImage($term, 'field_icon', $item['icon'] ?? NULL, $name);
      $this->setImage($term, 'field_image', $item['icon'] ?? NULL, $name);
      $term->save();
      $terms[$name] = $term;
    }
    return $terms;
  }

  protected function importKnowledge(array $categories, array $topics, bool $reset): int {
    $list = $this->loadFixtureItems('knowledge-list.json');
    $detail = $this->loadFixture('knowledge-detail.json')['data'] ?? [];
    $created_nodes = [];
    $category_list = array_values($categories);
    $topic_list = array_values($topics);

    if (!$reset && $this->countBundle('qb_knowledge') >= count($list)) {
      return $this->countBundle('qb_knowledge');
    }

    foreach ($list as $index => $item) {
      $title = (string) ($item['title'] ?? 'Knowledge ' . ($index + 1));
      $node = $this->entityTypeManager->getStorage('node')->create([
        'type' => 'qb_knowledge',
        'title' => $title,
        'status' => 1,
      ]);

      if (!$node instanceof NodeInterface) {
        continue;
      }

      $this->setText($node, 'field_summary', $item['desc'] ?? '');
      $this->setImage($node, 'field_thumbnail', $item['src'] ?? NULL, $title);
      $created = $this->parseDate((string) ($item['createdDate'] ?? ''));
      if ($created !== NULL) {
        $node->setCreatedTime($created);
      }

      if ($category_list) {
        $term = $category_list[$index % count($category_list)];
        $this->setEntityReferences($node, 'field_category', [$term]);
      }
      if ($topic_list) {
        $term = $topic_list[$index % count($topic_list)];
        $this->setEntityReferences($node, 'field_topic', [$term]);
      }

      if ($index === 0 && is_array($detail)) {
        $node->setTitle((string) ($detail['title'] ?? $title));
        $this->setText($node, 'field_intro_html', $detail['intro'] ?? '', 'basic_html');
        $this->setScalar($node, 'field_highlight_title', $detail['hightLineConent']['title'] ?? '');
        $this->setParagraphReferences($node, 'field_highlight_items', array_map(function ($line) {
          return $this->createTextParagraph('qb_text_item', $this->extractText($line));
        }, $detail['hightLineConent']['content'] ?? []));
        $this->setParagraphReferences($node, 'field_toc_items', array_map(
          fn(array $toc_item) => $this->createTocParagraph($toc_item),
          $detail['toc'] ?? []
        ));
        $content_blocks = [];
        foreach ($detail['content'] ?? [] as $block) {
          if (is_array($block)) {
            array_push($content_blocks, ...$this->createContentBlockParagraphs($block));
          }
        }
        $this->setParagraphReferences($node, 'field_content_blocks', $content_blocks);
        $publish = $this->parseDate((string) ($detail['publishDate'] ?? ''));
        if ($publish !== NULL) {
          $node->setCreatedTime($publish);
        }

        if (!empty($categories['SEO'])) {
          $this->setEntityReferences($node, 'field_category', [$categories['SEO']]);
        }
        if (!empty($topics['SEO'])) {
          $this->setEntityReferences($node, 'field_topic', [$topics['SEO']]);
        }
      }
      else {
        $this->setText($node, 'field_intro_html', '<p>' . htmlspecialchars((string) ($item['desc'] ?? ''), ENT_QUOTES, 'UTF-8') . '</p>', 'basic_html');
      }

      $node->save();
      $created_nodes[] = $node;
    }

    if (!empty($created_nodes[0]) && count($created_nodes) > 1) {
      $related = array_slice($created_nodes, 1, 6);
      $this->setEntityReferences($created_nodes[0], 'field_related_news', $related);
      $created_nodes[0]->save();
    }

    return count($created_nodes);
  }

  protected function createTextParagraph(string $bundle, string $text): Paragraph {
    $paragraph = Paragraph::create(['type' => $bundle]);
    $this->setScalar($paragraph, 'field_text', $text);
    $paragraph->save();
    return $paragraph;
  }

  protected function createTocParagraph(array $item): Paragraph {
    $paragraph = Paragraph::create(['type' => 'qb_toc_item']);
    $this->setScalar($paragraph, 'field_anchor_id', $item['id'] ?? '');
    $this->setScalar($paragraph, 'field_text', $item['text'] ?? '');

    $children = [];
    foreach ($item['children'] ?? [] as $child) {
      $child_paragraph = $this->createTocParagraph($child);
      $children[] = ['target_id' => $child_paragraph->id()];
    }

    if ($children && $paragraph->hasField('field_children')) {
      $paragraph->set('field_children', $children);
    }

    $paragraph->save();
    return $paragraph;
  }

  protected function createContentBlockParagraphs(array $item): array {
    $type = (string) ($item['type'] ?? 'text');
    $chunks = [$item['text'] ?? ''];

    if ($type === 'text') {
      $chunks = $this->chunkText((string) ($item['text'] ?? ''), 240);
    }

    $paragraphs = [];
    foreach ($chunks as $chunk) {
      $paragraphs[] = $this->createContentBlockParagraph($item, $chunk);
    }

    return $paragraphs;
  }

  protected function createContentBlockParagraph(array $item, ?string $text_override = NULL): Paragraph {
    $paragraph = Paragraph::create(['type' => 'qb_content_block']);
    $this->setScalar($paragraph, 'field_block_type', $item['type'] ?? 'text');
    $this->setScalar($paragraph, 'field_anchor_id', $item['id'] ?? '');
    $this->setScalar($paragraph, 'field_alt', $item['alt'] ?? '');
    $this->setScalar($paragraph, 'field_text', $text_override ?? ($item['text'] ?? ''));
    $this->setImage($paragraph, 'field_image', $item['src'] ?? NULL, $item['alt'] ?? 'Content image');
    $paragraph->save();
    return $paragraph;
  }

  protected function upsertNode(string $bundle, string $title, array $conditions = []): NodeInterface {
    $storage = $this->entityTypeManager->getStorage('node');
    $query = $storage->getQuery()
      ->accessCheck(FALSE)
      ->condition('type', $bundle)
      ->condition('title', $title)
      ->range(0, 1);

    foreach ($conditions as $field_name => $value) {
      $query->condition($field_name, $value);
    }

    $ids = $query->execute();

    if ($ids) {
      $node = $storage->load(reset($ids));
      if ($node instanceof NodeInterface) {
        return $node;
      }
    }

    return $storage->create([
      'type' => $bundle,
      'title' => $title,
      'status' => 1,
    ]);
  }

  protected function upsertTerm(string $vocabulary, string $name): Term {
    $storage = $this->entityTypeManager->getStorage('taxonomy_term');
    $ids = $storage->getQuery()
      ->accessCheck(FALSE)
      ->condition('vid', $vocabulary)
      ->condition('name', $name)
      ->range(0, 1)
      ->execute();

    if ($ids) {
      $term = $storage->load(reset($ids));
      if ($term instanceof Term) {
        return $term;
      }
    }

    return Term::create([
      'vid' => $vocabulary,
      'name' => $name,
    ]);
  }

  protected function setParagraphReferences(EntityInterface $entity, string $field_name, array $paragraphs): void {
    if (!$entity->hasField($field_name)) {
      return;
    }

    $values = [];
    foreach ($paragraphs as $paragraph) {
      if ($paragraph instanceof Paragraph) {
        $values[] = [
          'target_id' => $paragraph->id(),
          'target_revision_id' => $paragraph->getRevisionId(),
        ];
      }
    }
    $entity->set($field_name, $values);
  }

  protected function setEntityReferences(EntityInterface $entity, string $field_name, array $referenced_entities): void {
    if (!$entity->hasField($field_name)) {
      return;
    }

    $values = [];
    foreach ($referenced_entities as $referenced_entity) {
      if ($referenced_entity instanceof EntityInterface && $referenced_entity->id()) {
        $values[] = ['target_id' => $referenced_entity->id()];
      }
    }
    $entity->set($field_name, $values);
  }

  protected function setScalar(EntityInterface $entity, string $field_name, mixed $value): void {
    if (!$entity->hasField($field_name)) {
      return;
    }

    $definition = $entity->get($field_name)->getFieldDefinition();
    $type = $definition->getType();
    if (str_starts_with($type, 'text')) {
      $entity->set($field_name, [
        'value' => (string) $value,
        'format' => 'basic_html',
      ]);
      return;
    }

    if (in_array($type, ['string', 'email', 'list_string'], TRUE) && is_scalar($value)) {
      $max_length = $definition->getSetting('max_length');
      $value = $this->truncateUtf8((string) $value, (int) ($max_length ?: 255));
    }

    $entity->set($field_name, $value);
  }

  protected function setText(EntityInterface $entity, string $field_name, string $text, string $format = 'basic_html'): void {
    if (!$entity->hasField($field_name)) {
      return;
    }

    $type = $entity->get($field_name)->getFieldDefinition()->getType();
    if (str_starts_with($type, 'text')) {
      $entity->set($field_name, [
        'value' => $text,
        'format' => $format,
      ]);
      return;
    }

    $entity->set($field_name, strip_tags($text));
  }

  protected function setLink(EntityInterface $entity, string $field_name, ?string $uri): void {
    if (!$entity->hasField($field_name)) {
      return;
    }

    $uri = trim((string) $uri);
    if ($uri === '' || $uri === '#') {
      $uri = 'internal:/';
    }
    elseif (!str_contains($uri, ':')) {
      $uri = 'internal:' . ($uri[0] === '/' ? $uri : '/' . $uri);
    }

    $entity->set($field_name, ['uri' => $uri]);
  }

  protected function setImage(EntityInterface $entity, string $field_name, ?string $basename, string $alt = ''): void {
    if (!$entity->hasField($field_name) || !$basename) {
      return;
    }

    $file = $this->importAssetFile($basename);
    if (!$file instanceof FileInterface) {
      return;
    }

    $entity->set($field_name, [
      'target_id' => $file->id(),
      'alt' => $alt,
      'title' => $alt,
    ]);
  }

  protected function importAssetFile(string $basename): ?FileInterface {
    $source = $this->findAssetByBasename($basename);
    if (!$source || !is_file($source)) {
      $this->loggerFactory->get('thietkeasea_vue_api')->warning('Demo asset not found: @name', ['@name' => $basename]);
      return NULL;
    }

    $directory = 'public://demo-import';
    $this->fileSystem->prepareDirectory($directory, FileSystemInterface::CREATE_DIRECTORY | FileSystemInterface::MODIFY_PERMISSIONS);
    $destination = $directory . '/' . $basename;

    $existing = $this->entityTypeManager->getStorage('file')->loadByProperties(['uri' => $destination]);
    $file = $existing ? reset($existing) : NULL;

    if (!$file instanceof FileInterface) {
      $data = file_get_contents($source);
      if ($data === FALSE) {
        return NULL;
      }
      $file = $this->fileRepository->writeData($data, $destination, FileExists::Replace);
      $file->setPermanent();
      $file->save();
    }

    return $file;
  }

  protected function findAssetByBasename(string $basename): ?string {
    if (!$this->assetIndex) {
      $roots = [
        \Drupal::root() . '/vue/src/assets/images',
        \Drupal::root() . '/vue/dist/assets',
      ];

      foreach ($roots as $root) {
        if (!is_dir($root)) {
          continue;
        }

        $iterator = new \RecursiveIteratorIterator(
          new \RecursiveDirectoryIterator($root, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
          if ($file->isFile()) {
            $this->assetIndex[$file->getBasename()] = $file->getPathname();
          }
        }
      }
    }

    return $this->assetIndex[$basename] ?? NULL;
  }

  protected function loadFixture(string $filename): array {
    $path = \Drupal::root() . '/vue/data/' . $filename;
    if (!is_file($path)) {
      return [];
    }

    $data = json_decode((string) file_get_contents($path), TRUE);
    return is_array($data) ? $data : [];
  }

  protected function loadFixtureItems(string $filename): array {
    $fixture = $this->loadFixture($filename);
    $items = $fixture['data'] ?? [];
    return is_array($items) ? $items : [];
  }

  protected function countBundle(string $bundle): int {
    return (int) $this->entityTypeManager->getStorage('node')->getQuery()
      ->accessCheck(FALSE)
      ->condition('type', $bundle)
      ->count()
      ->execute();
  }

  protected function parseDate(string $value): ?int {
    $value = trim($value);
    if ($value === '') {
      return NULL;
    }

    $formats = ['d/m/Y H:i', 'd/m/Y'];
    foreach ($formats as $format) {
      $date = \DateTimeImmutable::createFromFormat($format, $value);
      if ($date instanceof \DateTimeImmutable) {
        return $date->getTimestamp();
      }
    }

    $timestamp = strtotime($value);
    return $timestamp !== FALSE ? $timestamp : NULL;
  }

  protected function extractText(mixed $value): string {
    if (is_array($value)) {
      return (string) ($value['text'] ?? '');
    }
    return (string) $value;
  }

  protected function chunkText(string $text, int $limit): array {
    $text = trim($text);
    if ($text === '') {
      return [''];
    }

    $wrapped = wordwrap($text, $limit, "\n", TRUE);
    $chunks = array_filter(array_map('trim', explode("\n", $wrapped)), static fn(string $chunk) => $chunk !== '');
    return $chunks ?: [''];
  }

  protected function truncateUtf8(string $value, int $limit): string {
    if ($limit <= 0) {
      return $value;
    }

    return mb_strlen($value) > $limit ? mb_substr($value, 0, $limit) : $value;
  }

}
