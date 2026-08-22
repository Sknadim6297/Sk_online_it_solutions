<?php
require_once __DIR__ . '/../includes/blog_app.php';
require_once __DIR__ . '/../includes/careers_app.php';
blog_require_login();

$pageTitle = 'Dashboard';
$pageSubtitle = 'Overview of content, careers, and recent activity.';
$activeMenu = 'dashboard';
$stats = blog_dashboard_stats();
$openRoles = careers_count_active();
$recentPosts = blog_get_posts_list(['page' => 1], 5)['items'];
$includeChartJs = true;
$userName = blog_current_user()['name'] ?? 'Admin';

include __DIR__ . '/includes/header.php';
?>

<section class="admin-welcome">
  <div>
    <h2>Welcome back, <?php echo blog_escape(explode(' ', $userName)[0]); ?>!</h2>
    <p>Manage blog posts, careers, categories, and SEO from one place.</p>
  </div>
  <div class="admin-welcome-actions">
    <a href="careers.php" class="btn-ghost"><i class="ri-briefcase-4-line"></i> Careers</a>
    <a href="post-form.php" class="btn-white"><i class="ri-add-line"></i> Create Post</a>
  </div>
</section>

<div class="admin-stats">
  <div class="admin-stat">
    <div class="admin-stat-body">
      <span>Total Posts</span>
      <strong><?php echo (int) $stats['total_posts']; ?></strong>
    </div>
    <div class="admin-stat-icon admin-stat-icon--blue"><i class="ri-article-line"></i></div>
  </div>
  <div class="admin-stat">
    <div class="admin-stat-body">
      <span>Published</span>
      <strong><?php echo (int) $stats['published_posts']; ?></strong>
    </div>
    <div class="admin-stat-icon admin-stat-icon--green"><i class="ri-checkbox-circle-line"></i></div>
  </div>
  <div class="admin-stat">
    <div class="admin-stat-body">
      <span>Open Roles</span>
      <strong><?php echo (int) $openRoles; ?></strong>
    </div>
    <div class="admin-stat-icon admin-stat-icon--amber"><i class="ri-briefcase-4-line"></i></div>
  </div>
  <div class="admin-stat">
    <div class="admin-stat-body">
      <span>Media Files</span>
      <strong><?php echo (int) $stats['media']; ?></strong>
    </div>
    <div class="admin-stat-icon admin-stat-icon--purple"><i class="ri-image-line"></i></div>
  </div>
</div>

<div class="admin-grid">
  <div class="admin-card admin-col-8">
    <div class="admin-card-head">
      <div>
        <h3><i class="ri-bar-chart-2-line"></i> Publishing Overview</h3>
        <p>Draft vs published posts</p>
      </div>
    </div>
    <div class="admin-card-body admin-card-body--chart">
      <canvas id="statusChart" height="100"></canvas>
    </div>
  </div>
  <div class="admin-card admin-col-4">
    <div class="admin-card-head">
      <div>
        <h3><i class="ri-pie-chart-line"></i> Categories</h3>
        <p>Posts per category</p>
      </div>
    </div>
    <div class="admin-card-body admin-card-body--chart">
      <canvas id="categoryChart" height="200"></canvas>
    </div>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card-head">
    <div>
      <h3><i class="ri-time-line"></i> Recent Posts</h3>
      <p>Your latest content updates</p>
    </div>
    <a class="btn btn-primary btn-sm" href="post-form.php"><i class="ri-add-line"></i> Add Blog</a>
  </div>
  <div class="table-responsive">
    <table class="table admin-table mb-0">
      <thead>
        <tr>
          <th>Title</th>
          <th>Category</th>
          <th>Status</th>
          <th>Created</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!$recentPosts) : ?>
          <tr>
            <td colspan="5">
              <div class="admin-empty">
                <i class="ri-article-line"></i>
                <strong>No posts yet</strong>
                <p class="admin-muted mb-3">Create your first blog post to see it here.</p>
                <a class="btn btn-primary" href="post-form.php"><i class="ri-add-line"></i> Create First Post</a>
              </div>
            </td>
          </tr>
        <?php endif; ?>
        <?php foreach ($recentPosts as $post) : ?>
          <tr>
            <td>
              <strong><?php echo blog_escape($post['title']); ?></strong><br>
              <small class="admin-muted"><?php echo blog_escape($post['slug']); ?></small>
            </td>
            <td><?php echo blog_escape($post['category_name'] ?? 'Uncategorized'); ?></td>
            <td><span class="status-pill <?php echo blog_escape($post['status']); ?>"><?php echo blog_escape(ucfirst($post['status'])); ?></span></td>
            <td><?php echo blog_escape(date('d M Y', strtotime($post['created_at']))); ?></td>
            <td class="text-end">
              <div class="admin-actions">
                <a class="btn-action btn-action-view" href="post-view.php?id=<?php echo (int) $post['id']; ?>" title="View"><i class="ri-eye-line"></i><span class="action-label">View</span></a>
                <a class="btn-action btn-action-edit" href="post-form.php?id=<?php echo (int) $post['id']; ?>" title="Edit"><i class="ri-pencil-line"></i><span class="action-label">Edit</span></a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
<script>
(function () {
  const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
  const gridColor = isDark ? 'rgba(148,163,184,0.15)' : 'rgba(148,163,184,0.25)';
  const textColor = isDark ? '#94a3b8' : '#64748b';

  const statusCanvas = document.getElementById('statusChart');
  if (window.Chart && statusCanvas) {
    new Chart(statusCanvas, {
      type: 'bar',
      data: {
        labels: ['Draft', 'Published'],
        datasets: [{
          label: 'Posts',
          data: [<?php echo (int) $stats['status_chart']['draft']; ?>, <?php echo (int) $stats['status_chart']['published']; ?>],
          backgroundColor: ['#f59e0b', '#2563eb'],
          borderRadius: 10,
          borderSkipped: false,
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, ticks: { color: textColor, stepSize: 1 }, grid: { color: gridColor } },
          x: { ticks: { color: textColor }, grid: { display: false } },
        },
      },
    });
  }

  const categoryCanvas = document.getElementById('categoryChart');
  const catLabels = <?php echo json_encode(array_column($stats['category_chart'], 'name') ?: ['No categories']); ?>;
  const catData = <?php echo json_encode(array_map('intval', array_column($stats['category_chart'], 'total')) ?: [1]); ?>;

  if (window.Chart && categoryCanvas) {
    new Chart(categoryCanvas, {
      type: 'doughnut',
      data: {
        labels: catLabels,
        datasets: [{
          data: catData,
          backgroundColor: ['#2563eb', '#7c3aed', '#16a34a', '#f59e0b', '#dc2626', '#0891b2'],
          borderWidth: 0,
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '65%',
        plugins: {
          legend: { position: 'bottom', labels: { color: textColor, padding: 12, boxWidth: 12 } },
        },
      },
    });
  }
})();
</script>
