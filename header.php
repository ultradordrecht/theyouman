<?php
/**
 * Theme header template.
 *
 * @package TailPress
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-white dark:bg-gray-400 text-zinc-900 antialiased'); ?>>
<?php do_action('tailpress_site_before'); ?>

<div id="page" class="min-h-screen flex flex-col">
    <?php do_action('tailpress_header'); ?>

    <header class="container mx-auto py-6">
        <div class="md:flex md:justify-between md:items-center">
            <div class="flex justify-between items-center">
                <div>
                    <?php if (has_custom_logo()): ?>
                        <?php the_custom_logo(); ?>
                    <?php else: ?>
                        <div class="flex items-center gap-2">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="!no-underline lowercase font-medium text-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-40 md:w-50 mb-4" viewBox="0 0 180 40">
                                    <rect width="100%" height="100%" fill="#b30000" rx="12" ry="12"/>
                                    <text x="50%" y="50%" text-anchor="middle" dominant-baseline="middle"
                                            font-family="sans-serif" font-size="22" font-weight="bold" font-style="italic" fill="#fff" letter-spacing="1.2">
                                        <?php bloginfo('name'); ?>
                                    </text>
                                </svg>
                            </a>
                            <?php if ($description = get_bloginfo('description')): ?>
                                <span class="text-sm font-light text-dark/80"><?php echo esc_html($description); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (has_nav_menu('primary')): ?>
                    <div class="md:hidden">
                        <button type="button" aria-label="Toggle navigation" id="primary-menu-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                <?php endif; ?>
            </div>

            <div id="primary-navigation" class="hidden md:flex md:bg-transparent gap-6 items-center border border-light md:border-none rounded-xl p-4 md:p-0">
                <nav>
                    <?php if (current_user_can('administrator') && !has_nav_menu('primary')): ?>
                        <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="text-sm text-zinc-600"><?php esc_html_e('Edit Menus', 'tailpress'); ?></a>
                    <?php else: ?>
                        <?php
                        wp_nav_menu([
                            'container_id'    => 'primary-menu',
                            'container_class' => '',
                            'menu_class'      => 'md:flex md:-mx-4 [&_a]:!no-underline',
                            'theme_location'  => 'primary',
                            'li_class'        => 'md:mx-4',
                            'fallback_cb'     => false,
                        ]);
                        ?>
                    <?php endif; ?>
                </nav>

                <div class="inline-block mt-4 md:mt-0"><?php get_search_form(); ?></div>
            </div>
        </div>
    </header>

    <div id="content" class="site-content grow">
        <?php if (is_front_page()): ?>
            <section class="container mx-auto py-12">
                <div class="max-w-(--breakpoint-md)">
                    <div class="[&_a]:text-primary">
                        <h1 class="leading-tight text-3xl md:text-5xl font-medium tracking-tight text-balance text-zinc-950">
                            Independent artist
                        </h1>
                        <p class="my-6 text-lg md:text-xl text-zinc-600 leading-8">
                            Yvo van der Vat is The Youman and founder of The Youmanism somewhere around the year 2000. 
                            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'the-youman-legacy' ) ) ); ?>">legacy</a>
                        </p>
                    </div>
                    <div>
                        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'events' ) ) ); ?>" class="inline-flex rounded-full px-4 py-1.5 text-sm font-semibold transition bg-dark text-white hover:bg-dark/90 !no-underline">
                            Events
                        </a>
                        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'ds17' ) ) ); ?>" class="inline-flex rounded-full px-4 py-1.5 text-sm font-semibold transition bg-dark text-white hover:bg-dark/90 !no-underline">
                            DS17
                        </a>
                        <a href="/projects/" class="inline-flex rounded-full px-4 py-1.5 text-sm font-semibold transition bg-dark text-white hover:bg-dark/90 !no-underline">
                            Projects
                        </a>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php do_action('tailpress_content_start'); ?>
        <main>
