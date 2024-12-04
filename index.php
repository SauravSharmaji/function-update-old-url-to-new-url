<?php function update_old_url_to_new_url() {
    global $wpdb;

    // Old and new URLs
    $old_url = 'https://finance.sarkarieducation.net/apply/';
    $new_url = 'https://sarkarieducation.net/apply-job/';

    // Update in post content
    $wpdb->query(
        $wpdb->prepare(
            "UPDATE {$wpdb->posts} 
             SET post_content = REPLACE(post_content, %s, %s)",
            $old_url,
            $new_url
        )
    );

    // Update in meta fields
    $wpdb->query(
        $wpdb->prepare(
            "UPDATE {$wpdb->postmeta} 
             SET meta_value = REPLACE(meta_value, %s, %s)",
            $old_url,
            $new_url
        )
    );

    // Update in options table
    $wpdb->query(
        $wpdb->prepare(
            "UPDATE {$wpdb->options} 
             SET option_value = REPLACE(option_value, %s, %s)",
            $old_url,
            $new_url
        )
    );

    // Optional: Add a success message in admin area
    if (is_admin()) {
        echo '<div class="notice notice-success"><p>URL replacement complete!</p></div>';
    }
}
add_action('admin_init', 'update_old_url_to_new_url');
