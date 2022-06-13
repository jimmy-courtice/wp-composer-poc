<?php

if (! class_exists('Kirki')) {
    return;
}

// Panels.
new \Kirki\Panel(
    'bw2wp_theme_option_panel',
    [
        'priority'    => 10,
        'title'       => esc_html__( 'BS2WP Theme Options', 'bs2wp' ),
        'description' => esc_html__( 'Use this to customize the theme.', 'bs2wp' ),
    ]
);

// Sections.
new \Kirki\Section(
    'bs2wp_subscribe_bar',
    [
        'title'       => esc_html__( 'Subscribe bar', 'bs2wp' ),
        'description' => esc_html__( 'This is the subscribe bar', 'bs2wp' ),
        'panel'       => 'bw2wp_theme_option_panel',
        'priority'    => 160,
    ]
);

new \Kirki\Section(
    'bs2wp_global_footer_cta',
    [
        'title'       => esc_html__( 'Global Footer CTA Section', 'bs2wp' ),
        'description' => esc_html__( 'This is the global footer cta section', 'bs2wp' ),
        'panel'       => 'bw2wp_theme_option_panel',
        'priority'    => 160,
    ]
);

new \Kirki\Section(
    'bs2wp_footer_section',
    [
        'title'       => esc_html__( 'Footer Section', 'bs2wp' ),
        'description' => esc_html__( 'Footer Section Description.', 'bs2wp' ),
        'panel'       => 'bw2wp_theme_option_panel',
        'priority'    => 160,
    ]
);

// Controls.
new \Kirki\Field\Textarea(
    [
        'settings'    => 'subscribe_text',
        'label'       => esc_html__( 'Bs2Wp Subscribe Bar Text', 'bs2wp' ),
        'section'     => 'bs2wp_subscribe_bar',
        'default'     => esc_html__( 'This is a default value', 'bs2wp' ),
    ]
);

new \Kirki\Field\Code(
    [
        'settings'    => 'subscribe_form',
        'label'       => esc_html__( 'Subscribe form HTML', 'bs2wp' ),
        'description' => esc_html__( 'Please enter some code here for your opt-in form.', 'bs2wp' ),
        'section'     => 'bs2wp_subscribe_bar',
        'default'     => '',
        'choices'     => [
            'language' => 'html',
        ],
    ]
);

new \Kirki\Field\Textarea(
    [
        'settings'    => 'footer_copyright',
        'label'       => esc_html__( 'Bs2Wp Copyright Text', 'bs2wp' ),
        'section'     => 'bs2wp_footer_section',
        'default'     => esc_html__( 'This is a default value', 'bs2wp' ),
        'partial_refresh' => array(
            'footer_copyright' => array(
               'selector' => 'footer .copyright p',
                'render_callback' => function() {
                   return get_theme_mod('footer_copyright');
                }
            )
        )
    ]
);

// Footer CTA.
new \Kirki\Field\Checkbox_Switch(
    [
        'settings'    => 'global_footer_cta_switch',
        'label'       => esc_html__( 'Show Global Footer CTA', 'bs2wp' ),
        'description' => esc_html__( 'Show Global Footer CTA', 'bs2wp' ),
        'section'     => 'bs2wp_global_footer_cta',
        'default'     => 'on',
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'bs2wp' ),
            'off' => esc_html__( 'Disable', 'bs2wp' ),
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings' => 'global_footer_cta_subtitle',
        'label'    => esc_html__( 'Footer CTA Subtitle', 'bs2wp' ),
        'section'  => 'bs2wp_global_footer_cta',
        'default'  => esc_html__( 'This is a default value', 'bs2wp' ),
        'priority' => 10,
        'partial_refresh' => array(
            'global_footer_cta_subtitle' => array(
                'selector' => '.footer-calltoaction .sub-title',
                'render_callback' => function() {
                    return get_theme_mod('global_footer_cta_subtitle');
                }
            )
        )
    ]
);

new \Kirki\Field\Text(
    [
        'settings' => 'global_footer_cta_title',
        'label'    => esc_html__( 'Footer CTA Title', 'bs2wp' ),
        'section'  => 'bs2wp_global_footer_cta',
        'default'  => esc_html__( 'This is a default value', 'bs2wp' ),
        'priority' => 10,
        'partial_refresh' => array(
            'global_footer_cta_title' => array(
                'selector' => '.footer-calltoaction h2',
                'render_callback' => function() {
                    return get_theme_mod('global_footer_cta_title');
                }
            )
        )
    ]
);

new \Kirki\Field\Textarea(
    [
        'settings'    => 'global_footer_cta_copy',
        'label'    => esc_html__( 'Footer CTA Copy', 'bs2wp' ),
        'section'     => 'bs2wp_global_footer_cta',
        'default'     => esc_html__( 'This is a default value', 'bs2wp' ),
        'partial_refresh' => array(
            'global_footer_cta_copy' => array(
                'selector' => '.footer-calltoaction .cta-copy',
                'render_callback' => function() {
                    return get_theme_mod('global_footer_cta_copy');
                }
            )
        )
    ]
);

new \Kirki\Field\Text(
    [
        'settings' => 'global_footer_cta_link_text',
        'label'    => esc_html__( 'Footer CTA Link Text', 'bs2wp' ),
        'section'  => 'bs2wp_global_footer_cta',
        'default'  => esc_html__( 'This is a default value', 'bs2wp' ),
        'priority' => 10,
        'partial_refresh' => array(
            'global_footer_cta_link_text' => array(
                'selector' => '.footer-calltoaction a',
                'render_callback' => function() {
                    return get_theme_mod('global_footer_cta_link_text');
                }
            )
        )
    ]
);

new \Kirki\Field\URL(
    [
        'settings' => 'global_footer_cta_link_url',
        'label'    => esc_html__( 'Footer CTA Link URL', 'bs2wp' ),
        'section'  => 'bs2wp_global_footer_cta',
        'default'  => 'https://example.com/',
        'priority' => 10
    ]
);