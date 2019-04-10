<nav id="main-navbar" class="navbar">
    <h2 class="hide">Main navigation</h2>
    <div class="container">
        <div class="row align-items-center justify-content-between w-100 no-gutters">
            <div class="col col-auto">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo__innova--desktop.svg" alt="<?php echo get_bloginfo('name'); ?>" class="navbar-brand__logo navbar-brand__logo--desktop" />
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo__innova--mobile.svg" alt="<?php echo get_bloginfo('name'); ?>" class="navbar-brand__logo navbar-brand__logo--mobile" />
                </a>
            </div><!-- /.col col-auto -->
            <div class="col col-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?php if(is_front_page()) { echo '#main'; } else { echo esc_url(home_url('/')).'#main'; } ?>" class="nav-link<?php if(is_front_page()) echo ' scroll'; ?>">Home</a>
                    </li><!-- /.nav-item -->
                    <li class="nav-item">
                        <a href="<?php if(is_front_page()) { echo '#range-of-readers'; } else { echo esc_url(home_url('/')).'#range-of-readers'; } ?>" class="nav-link<?php if(is_front_page()) echo ' scroll'; ?>">Readers</a>
                    </li><!-- /.nav-item -->
                    <li class="nav-item">
                        <a href="<?php if(is_front_page()) { echo '#range-of-practice-tests'; } else { echo esc_url(home_url('/')).'#range-of-practice-tests'; } ?>" class="nav-link<?php if(is_front_page()) echo ' scroll'; ?>">Practice Tests</a>
                    </li><!-- /.nav-item -->
                    <li class="nav-item">
                        <a href="<?php if(is_front_page()) { echo '#about'; } else { echo esc_url(home_url('/')).'#about'; } ?>" class="nav-link<?php if(is_front_page()) echo ' scroll'; ?>">About Innova</a>
                    </li><!-- /.nav-item -->
                    <li class="nav-item">
                        <a href="<?php if(is_front_page()) { echo '#distributions'; } else { echo esc_url(home_url('/')).'#distributions'; } ?>" class="nav-link<?php if(is_front_page()) echo ' scroll'; ?>">Find a Distributor</a>
                    </li><!-- /.nav-item -->
                </ul><!-- /.navbar-nav -->
                <button id="mmenu-triger" class="hamburger hamburger--squeeze" type="button" aria-label="Menu">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div><!-- /.col col-auto -->
        </div><!-- /.row align-items-center justify-content-between w-100 no-gutters -->
    </div><!-- /.container -->
</nav><!-- /#main-navbar.navbar -->