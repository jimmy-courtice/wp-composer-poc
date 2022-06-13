<?php
// Content None
?>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

    <?php
    printf(
        '<p>' . wp_kses(
        /* translators: %s: Link to WP admin new post page. */
            __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'bs2wp' ),
            array(
                'a' => array(
                    'href' => array(),
                ),
            )
        ) . '</p>',
        esc_url( admin_url( 'post-new.php' ) )
    );
    ?>

<?php elseif ( is_search() ) : ?>
<div class="search-results-none">
    <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bs2wp' ); ?></p>
</div>
    <?php get_search_form(); ?>
<?php else : ?>
<div class="search-results-none">
    <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bs2wp' ); ?></p>
</div>
    <?php get_search_form(); ?>
<?php endif; ?>


