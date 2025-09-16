<?php
/**
 * Single event template file.
 *
 * @package TailPress
 */

get_header();
?>

<div class="container my-8 mx-auto">
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <?php get_template_part('template-parts/event', 'single'); ?>

            <?php if (comments_open() || get_comments_number()): ?>
                <?php comments_template(); ?>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php
get_footer();
