<?php
// Footer
?>

<footer class="footer-calltoaction text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 overflow-hidden">
                <p class="sub-title"><?php echo wp_kses_post(get_theme_mod('global_footer_cta_subtitle', 'Join the course')); ?></p>
                <h2><?php echo wp_kses_post(get_theme_mod('global_footer_cta_title', 'Bootstrap to WordPress 2.0')); ?></h2>
                <p class="cta-copy"><?php echo wp_kses_post(get_theme_mod('global_footer_cta_copy', 'Learn how to design and build custom, beautiful & responsive WordPress websites and themes for beginners in 2021 and beyond!')); ?></p>
                <a href="<?php echo esc_url(get_theme_mod('global_footer_cta_link_url','https://example.com/')); ?>" class="btn btn-primary"><?php echo wp_kses_post(get_theme_mod('global_footer_cta_link_text', 'Join now ->')); ?></a>
            </div>
        </div>
    </div>

    <div class="copyright text-center">
        <p><?php echo wp_kses_post(get_theme_mod('footer_copyright', '&copy; Copyright Jimmy Courtice')); ?></p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
