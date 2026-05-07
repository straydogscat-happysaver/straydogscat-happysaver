<?php
if (!isset($_SESSION)) {
    session_start();
}

$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>

<style>
/* ================= MODERN NAVBAR STYLE ================= */

.navbar {
    padding: 10px 15px;
    backdrop-filter: blur(8px);
}

.nav-link {
    border-radius: 10px;
    padding: 6px 12px;
    margin-right: 4px;
    transition: 0.2s ease-in-out;
    display: flex;
    align-items: center;
    gap: 6px;
}

.nav-link:hover {
    background: rgba(255,255,255,0.1);
    transform: translateY(-1px);
}

.navbar-brand {
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* Active style (optional if you set active class manually) */
.nav-link.active {
    background: #0d6efd;
    color: #fff !important;
}

/* User badge style */
.user-badge {
    background: rgba(255,255,255,0.15);
    padding: 4px 10px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.role-badge {
    font-size: 10px;
    padding: 3px 8px;
    border-radius: 12px;
}
</style>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

  <div class="container-fluid">


    <!-- TOGGLE -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">

      <!-- LEFT MENU -->
      <ul class="navbar-nav me-auto">

        
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">
            <i class="bi bi-speedometer2 text-warning"></i> Home
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="pets.php">
            <i class="bi bi-heart-fill text-danger"></i> Pets
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="posts.php">
            <i class="bi bi-chat-left-text-fill text-success"></i> Posts
          </a>
        </li>
        <li class="nav-item">
  <a class="nav-link fw-semibold" href="adoptions.php">
    <i class="bi bi-house-heart-fill text-warning"></i> Adoptions
  </a>
</li>

 <li class="nav-item">
                <a class="nav-link" href="privacy.php">
                    <i class="bi bi-shield-lock-fill text-secondary"></i> Privacy
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="terms.php">
                    <i class="bi bi-file-earmark-text-fill text-light"></i> Terms
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="contact.php">
                    <i class="bi bi-telephone-fill text-info"></i> Contact
                </a>
            </li>
<li class="nav-item">
          <a class="nav-link" href="about.php">
            <i class="bi bi-house-door-fill text-info"></i> About Us
          </a>
        </li>


        <?php if ($is_admin) { ?>
        <li class="nav-item">
          <a class="nav-link" href="settings.php">
            <i class="bi bi-sliders text-light"></i> Settings
          </a>
        </li>
        <?php } ?>

      </ul><!-- RIGHT USER -->
<ul class="navbar-nav ms-auto align-items-lg-center">

<?php if (!empty($_SESSION['user'])) { ?>

    <!-- USER -->
    <li class="nav-item me-2">
        <span class="nav-link text-light d-flex align-items-center gap-2">
            <i class="bi bi-person-circle"></i>
            <?= htmlspecialchars($_SESSION['user']) ?>

            <?php if (!empty($_SESSION['role'])) { ?>
                <span class="badge bg-<?= $_SESSION['role'] === 'admin' ? 'danger' : 'primary' ?>">
                    <?= strtoupper($_SESSION['role']) ?>
                </span>
            <?php } ?>
        </span>
    </li>

    <!-- LOGOUT -->
    <li class="nav-item">
        <a class="btn btn-outline-light btn-sm px-3 d-flex align-items-center gap-1"
           href="logout.php">
            <i class="bi bi-box-arrow-right"></i>
            Logout
        </a>
    </li>

<?php } else { ?>

    <!-- LOGIN (optional fallback) -->
    <li class="nav-item">
        <a class="btn btn-success btn-sm" href="logout.php">
            <i class="bi bi-box-arrow-in-right"></i> Logout
        </a>
    </li>

<?php } ?>

</ul>
    </div>
  </div>
</nav>