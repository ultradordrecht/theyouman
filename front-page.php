<?php
/**
 * Template Name: Front Page
 *
 * @package TailPress
 */

 get_header();

?>

<section class="container w-full md:w-1/3 ml-0 mr-auto py-12">
    <!-- Latest Events -->
    <h2 class="text-2xl font-bold mb-4">Evenementen</h2>
    <!-- <div class="grid md:grid-cols-2 gap-8 mb-12"> -->
        <?php
        $events = new WP_Query([
            'post_type' => 'event',
            'posts_per_page' => 3,
            'orderby' => 'meta_value',
            'meta_key' => '_event_date',
            'order' => 'ASC',
            'meta_query' => [
                [
                    'key' => '_event_date',
                    'value' => date('Y-m-d'),
                    'compare' => '>=',
                    'type' => 'DATE'
                ]
            ]
        ]);
        if ($events->have_posts()) :
            while ($events->have_posts()) : $events->the_post();
                get_template_part('template-parts/event');
            endwhile;
            wp_reset_postdata();
        else:
            echo '<p>No upcoming events.</p>';
        endif;
        ?>
    <!-- </div> -->

</section>

<section class="container rounded-2xl shadow  w-full ml-0 mr-auto py-12">

    <!-- Latest Blog Posts -->
    <h2 class="text-2xl font-bold mb-4">Latest Posts</h2>
    <!-- <div class="grid md:grid-cols-2 gap-8 mb-12"> -->
        <?php
        $posts = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 3,
        ]);
        if ($posts->have_posts()) :
            while ($posts->have_posts()) : $posts->the_post();
                get_template_part('template-parts/content');
            endwhile;
            wp_reset_postdata();
        else:
            echo '<p>No blog posts found.</p>';
        endif;
        ?>
    <!-- </div> -->

    <!-- Image Gallery (using a gallery post type or ACF gallery field) -->
    <h2 class="text-2xl font-bold mb-4">Gallery</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <?php
        // Example: If you use a custom post type 'gallery' with featured images
        $gallery = new WP_Query([
            'post_type' => 'gallery',
            'posts_per_page' => 8,
        ]);
        if ($gallery->have_posts()) :
            while ($gallery->have_posts()) : $gallery->the_post();
                if (has_post_thumbnail()) {
                    echo '<a href="' . esc_url(get_permalink()) . '" class="block">';
                    the_post_thumbnail('medium', ['class' => 'rounded-xl w-full']);
                    echo '</a>';
                }
            endwhile;
            wp_reset_postdata();
        else:
            echo '<p>No images in the gallery.</p>';
        endif;
        ?>
    </div>
</section>

<?php
get_footer();