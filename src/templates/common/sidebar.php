<aside class="sidebar">
  <ul>
    <li <?php if($currentPage === 'home' || $currentPage === 'profile') echo 'class="current_page"' ?>><a href="/pages/home_page.php"> 
      <img id="profile-icon" src="/images/home.png" alt="Home Icon">
      </a>
    </li>
    <li <?php if($currentPage === 'faqs') echo 'class="current_page"' ?>><a href="/pages/faqs.php">
    <img id="home-icon" src="/images/faq.png" alt="faq Icon">
    </a></li>
    <?php if($_SESSION['user_type'] === 'admin') { ?>
      <li <?php if($currentPage === 'admin_set') echo 'class="current_page"' ?>><a href="/pages/admin_settings.php">
      <img id="admin-icon" src="/images/admin.png" alt="Profile Icon">
      </a></li>

    <?php } ?>
</aside>



