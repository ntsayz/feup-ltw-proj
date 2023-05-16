<aside class="sidebar">
  <ul>
    <li <?php if($currentPage === 'home' || $currentPage === 'profile') echo 'class="current_page"' ?>><a href="/pages/home_page.php">HOME</a></li>
    <li <?php if($currentPage === 'faqs') echo 'class="current_page"' ?>><a href="/pages/faqs.php">FAQs</a></li>
    <?php if($_SESSION['user_type'] === 'admin') { ?>
      <li <?php if($currentPage === 'admin_set') echo 'class="current_page"' ?>><a href="/pages/admin_settings.php">ADMINISTRATOR SETTINGS</a></li>

    <?php } ?>
</aside>



