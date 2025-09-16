<article id="post-<?php the_ID(); ?>" <?php post_class('flex flex-col md:flex-row bg-white rounded-2xl shadow p-8 mb-12'); ?>>
    <?php
        $event_date = get_post_meta(get_the_ID(), '_event_date', true);
        $date_obj = $event_date ? DateTime::createFromFormat('Y-m-d', $event_date) : false;
    ?>
    <div class="flex-shrink-0 flex flex-col items-center justify-center md:w-40 md:mr-8 mb-6 md:mb-0">
        <?php if ($date_obj): ?>
            <div class="bg-zinc-950 text-white rounded-xl px-6 py-4 text-center shadow-lg">
                <div class="text-4xl font-bold leading-none"><?php echo esc_html($date_obj->format('d')); ?></div>
                <div class="text-lg uppercase tracking-widest"><?php echo esc_html($date_obj->format('M')); ?></div>
                <div class="text-sm"><?php echo esc_html($date_obj->format('Y')); ?></div>
            </div>
        <?php endif; ?>
    </div>
    <div class="flex-1 flex flex-col justify-between">
        <header>
            <h2 class="text-2xl font-semibold text-zinc-950 mb-2">
                <a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a>
            </h2>
            <div class="flex items-center text-sm text-zinc-600 mb-4">
                <?php
                    echo get_avatar(get_the_author_meta('ID'), 32, '', esc_attr(sprintf(__('Avatar for %s', 'tailpress'), get_the_author())), [
                        'class' => 'h-8 w-8 rounded-full mr-2 object-cover grayscale'
                    ]);
                ?>
                <span class="font-medium"><?php the_author(); ?></span>
            </div>
        </header>
        <div class="mb-6 text-base text-zinc-700">
            <?php the_excerpt(); ?>
        </div>
        <a class="inline-block rounded-full bg-zinc-950 px-5 py-2 text-sm font-semibold text-white transition hover:bg-zinc-800" aria-label="<?php echo esc_attr(sprintf(__('Read more: %s', 'tailpress'), get_the_title())); ?>" href="<?php the_permalink(); ?>">
            <?php _e('Read more', 'tailpress'); ?>
        </a>
    </div>
</article>
