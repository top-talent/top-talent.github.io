<nav id="mobile-navigation">
    <ul class="navigation single-item-wrapper reset-list">
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
    </ul><!-- /.navigation single-item-wrapper reset-list -->
</nav><!-- /#mobile-navigation -->