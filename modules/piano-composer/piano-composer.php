<?php
class PianoComposer {
    private $options = [
        "revengine_piano_active",
        "revengine_piano_sandbox_mode",
        "revengine_piano_id",
    ];

    function __construct($revengine_globals) {
        $this->revengine_globals = &$revengine_globals;
        add_action('admin_init', [ $this, 'register_settings' ]);
        add_action('admin_menu', [ $this, 'options_page' ]);
        add_action('wp_head', [ $this, 'scripts' ]);
    }

    function options_page() {
        add_submenu_page(
            'revengine_options',
            __('Piano Composer', 'piano-composer'),
            __('Piano Composer', 'piano-composer'),
            // an admin-level user.
            'manage_options',
            'revengine-piano_composer-options',
            [ $this, 'admin_options_template' ]
        );
    }

    public function register_settings() {
        foreach($this->options as $option) {
            register_setting( 'revengine-piano_composer-options-group', $option );
        }
    }

    function admin_options_template() {
        require_once plugin_dir_path( dirname( __FILE__ ) ).'piano-composer/templates/admin/piano-composer-options.php';
    }

    function scripts() {
        $post_id = get_queried_object_id();
        $post = get_queried_object();
        if (!empty($post->post_type)) {
            $post_type = $post->post_type;
        } else if (!empty($post->taxonomy)) {
            $post_type = $post->taxonomy;
        } else {
            $post_type = "";
        }
        $options = [
            "post_type" => $post_type,
            "date_published" => get_the_date("c"),
            "logged_in" => !empty(get_current_user_id()),
        ];
        if ( function_exists( 'wc_memberships' ) ) {
            $memberships = array_map(function($i) { return $i->plan->name; },wc_memberships_get_user_active_memberships());
            $options["memberships"] = $memberships;
        }
        if ($post_type === "article") {
            $options["author"] = get_the_author_meta("display_name");
            $tags = get_the_terms($post_id, "article_tag");
            if ($tags) {
                $options["tags"] = array_map(function($i) { return $i->name; }, $tags);
            }
            $sections = get_the_terms($post_id, "section");
            if ($sections) {
                $options["sections"] = array_map(function($i) { return $i->name; }, $sections);
            }
            $term_list = wp_get_post_terms($post_id, 'section', ['fields' => 'all']);
            foreach($term_list as $term) {
                if( get_post_meta($post_id, '_yoast_wpseo_primary_section',true) == $term->term_id ) {
                    $options["primary_section"] = $term->name;
                }
            }
        } else if ($post_type === "opinion-piece") {
            $options["author"] = get_the_author_meta("display_name");
            $tags = get_the_terms($post_id, "opinion-piece-tag");
            if ($tags) {
                $options["tags"] = array_map(function($i) { return $i->name; }, $tags);
            }
            $options["sections"] = ["opinionista"];
        }
        foreach($this->options as $option) {
            $options[$option] = get_option($option);
        }
        // trigger_error(json_encode($options), E_USER_NOTICE);
        if ($options["revengine_piano_active"]) {
            $furl = plugin_dir_url( __FILE__ ) . 'js/piano.js';
            $fname = plugin_dir_path( __FILE__ ) . 'js/piano.js';
            $ver = date("ymd-Gis", filemtime($fname));
            wp_enqueue_script( "revengine-piano-composer", $furl, null, $ver, true );
            wp_localize_script( "revengine-piano-composer", "revengine_piano_composer_vars", $options);
        }
    }
}