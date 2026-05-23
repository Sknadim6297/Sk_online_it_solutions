<?php
require_once __DIR__ . '/includes/blog_app.php';

header('Content-Type: application/xml; charset=UTF-8');

$pdo = blog_db();
$baseUrl = rtrim(blog_url(''), '/');
$posts = $pdo->query("SELECT slug, updated_at, COALESCE(published_at, created_at) AS published_at FROM posts WHERE deleted_at IS NULL AND status = 'published' ORDER BY COALESCE(published_at, created_at) DESC")->fetchAll();
$categories = blog_category_list();

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url><loc><?php echo htmlspecialchars($baseUrl . '/index', ENT_QUOTES, 'UTF-8'); ?></loc><changefreq>weekly</changefreq><priority>1.0</priority></url>
  <url><loc><?php echo htmlspecialchars($baseUrl . '/blog', ENT_QUOTES, 'UTF-8'); ?></loc><changefreq>daily</changefreq><priority>0.9</priority></url>
  <?php foreach ($categories as $category) : ?>
    <url><loc><?php echo htmlspecialchars($baseUrl . '/blog?category=' . rawurlencode($category['slug']), ENT_QUOTES, 'UTF-8'); ?></loc><changefreq>weekly</changefreq><priority>0.6</priority></url>
  <?php endforeach; ?>
  <?php foreach ($posts as $post) : ?>
    <url>
      <loc><?php echo htmlspecialchars($baseUrl . '/blog/' . $post['slug'], ENT_QUOTES, 'UTF-8'); ?></loc>
      <lastmod><?php echo htmlspecialchars(date('Y-m-d', strtotime($post['updated_at'] ?: $post['published_at'])), ENT_QUOTES, 'UTF-8'); ?></lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
    </url>
  <?php endforeach; ?>
</urlset>
