<?php
require_once __DIR__ . '/../includes/blog_app.php';
blog_logout();
blog_flash('success', 'You have been signed out.');
header('Location: login.php');
exit;
