<?php

/**
 * Event post type and location taxonomy registration.
 *
 * @package TailPress
 */

function youman_time_ago_short( $from ) {
    $now = current_time( 'timestamp' );
    $diff = $now - $from;

    if ( $diff < HOUR_IN_SECONDS ) {
        $mins = round( $diff / MINUTE_IN_SECONDS );
        return $mins . 'm';
    } elseif ( $diff < DAY_IN_SECONDS ) {
        $hours = round( $diff / HOUR_IN_SECONDS );
        return $hours . 'h';
    } else {
        $days = round( $diff / DAY_IN_SECONDS );
        return $days . 'd';
    }
}

function youman_register_location_taxonomy() {
    register_taxonomy('location', 'event', [
        'labels' => [
            'name' => __('Locations', 'tailpress'),
            'singular_name' => __('Location', 'tailpress'),
        ],
        'public' => true,
        'hierarchical' => true, // Like categories (set to false for tag-like behavior)
        'show_in_rest' => true, // Enables Gutenberg and REST API
        'rewrite' => ['slug' => 'locations'],
    ]);
}
add_action('init', 'youman_register_location_taxonomy', 0);

add_action('location_add_form_fields', function() {
    ?>
    <div class="form-field">
        <label for="location_map"><?php _e('Google Map Embed', 'tailpress'); ?></label>
        <input type="text" name="location_map" id="location_map" value="" />
        <p class="description"><?php _e('Paste your Google Maps embed code or URL here.', 'tailpress'); ?></p>
    </div>
    <?php
});

add_action('location_edit_form_fields', function($term) {
    $value = get_term_meta($term->term_id, 'location_map', true);
    ?>
    <tr class="form-field">
        <th scope="row"><label for="location_map"><?php _e('Google Map Embed', 'tailpress'); ?></label></th>
        <td>
            <input type="text" name="location_map" id="location_map" value="<?php echo esc_attr($value); ?>" />
            <p class="description"><?php _e('Paste your Google Maps embed code or URL here.', 'tailpress'); ?></p>
        </td>
    </tr>
    <?php
});

// Save the field
add_action('created_location', function($term_id) {
    if (isset($_POST['location_map'])) {
        update_term_meta($term_id, 'location_map', sanitize_text_field($_POST['location_map']));
    }
});
add_action('edited_location', function($term_id) {
    if (isset($_POST['location_map'])) {
        update_term_meta($term_id, 'location_map', sanitize_text_field($_POST['location_map']));
    }
});



function youman_register_event_post_type() {
    register_post_type('event', [
        'labels' => [
            'name' => __('Events', 'tailpress'),
            'singular_name' => __('Event', 'tailpress'),
            'add_new'            => __('Add New', 'tailpress'),
            'add_new_item'       => __('Add New Event', 'tailpress'),
            'edit_item'          => __('Edit Event', 'tailpress'),
            'new_item'           => __('New Event', 'tailpress'),
            'view_item'          => __('View Event', 'tailpress'),
            'view_items'         => __('View Events', 'tailpress'),
            'search_items'       => __('Search Events', 'tailpress'),
            'not_found'          => __('No events found', 'tailpress'),
            'not_found_in_trash' => __('No events found in Trash', 'tailpress'),
            'all_items'          => __('All Events', 'tailpress'),
            'menu_name'          => __('Events', 'tailpress'),
            'name_admin_bar'     => __('Event', 'tailpress'),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'events'],
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'author'],
        'taxonomies' => ['category', 'post_tag', 'location'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'youman_register_event_post_type', 10);

function youman_add_event_date_metabox() {
    add_meta_box(
        'youman_event_date',
        __('Event Date', 'tailpress'),
        'youman_event_date_metabox_callback',
        'event',
        'side'
    );
}
add_action('add_meta_boxes', 'youman_add_event_date_metabox');

function youman_event_date_metabox_callback($post) {
    $value = get_post_meta($post->ID, '_event_date', true);
    echo '<label for="youman_event_date_field">' . __('Date:', 'tailpress') . '</label> ';
    echo '<input type="date" id="youman_event_date_field" name="youman_event_date_field" value="' . esc_attr($value) . '" />';
}

function youman_save_event_date_meta($post_id) {
    if (array_key_exists('youman_event_date_field', $_POST)) {
        update_post_meta(
            $post_id,
            '_event_date',
            sanitize_text_field($_POST['youman_event_date_field'])
        );
    }
}
add_action('save_post_event', 'youman_save_event_date_meta');

function youman_add_location_metabox_to_event() {
    register_taxonomy_for_object_type('location', 'event');
}
add_action('init', 'youman_add_location_metabox_to_event', 30);
