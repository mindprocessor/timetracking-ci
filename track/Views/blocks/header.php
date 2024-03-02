<header>

<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">24/7 Intouch</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="/" up-follow>Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('/timelogs');?>" up-follow>TimeLogs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('/incident-report');?>" up-follow>Incident Report</a>
            </li>
            <?php if(current_user()->level == 'admin'): ?>
                <li>
                    <a class="nav-link" href="<?=base_url('/admin');?>">Admin Panel</a>
                </li>
            <?php endif; ?>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
            <a href="<?=base_url('/auth/logout');?>" class="btn btn-outline-danger">Logout</a>
        </ul>
    </div>
  </div>
</nav>

</header>