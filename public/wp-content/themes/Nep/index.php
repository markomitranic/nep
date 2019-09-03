<?php get_header(); ?>

<div id="masthead">
    <div class="wrapper">
        <div id="logo">
            <a href="<?php echo home_url(); ?>" title="Go to the front page">
				<?=file_get_contents(get_template_directory() . '/assets/global/NEP Logo.svg')?>
            </a>
        </div>
        <div id="page-title">
            <h1>Vesti</h1>
            <div id="years">
                <ul>
                    <?php wp_get_archives('type=yearly'); ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="content">
	<?php get_template_part('partials/sidebar'); ?>
	<main>

        <div id="search">
            <div class="wrapper">
                <form  role="search" method="get" id="searchform" class="searchform" action="">
                    <label class="screen-reader-text" for="s">Pretraga za:</label>
                    <?php
                        $searchQuery = '';
                        if (array_key_exists('s', $_REQUEST)) {
                            $searchQuery = $_REQUEST['s'];
                        }
                    ?>
                    <input type="text" value="<?=$searchQuery?>" placeholder="Pretraga" name="s" id="s">
                    <button>&nbsp;</button>
                </form>
            </div>
        </div>

        <div id="news-list">
            <?php if (have_posts()) : ?>
            <ul>
	            <?php
                    while (have_posts()) :
	                    the_post();
                ?>
                <li>
                    <a href="<?=get_permalink()?>" title="<?=get_the_title()?>">
                        <div class="image" style="background-image:url('<?=get_field('hero_image')['sizes']['medium']?>');">
                            <img src="<?=get_field('hero_image')['sizes']['medium']?>" alt="<?=get_field('hero_image')['alt']?>">
                        </div>
                        <div class="info">
                            <h2><?=get_the_title()?></h2>
                            <p class="excerpt shouldShave" data-rows="3"><?=getExcerpt(get_the_excerpt(), 20)?></p>
                        </div>
                    </a>
                </li>
                <?php endwhile; ?>
            </ul>
            <?php else : ?>
                <div id="no-results">
                    <p>Na žalost nema pronađenih vesti za termin: "<?=$searchQuery?>".</p>
                    <p>Ispod se nalaze neke od najnovijih vesti, možda je to ono što tražite?</p>
                </div>

                <ul>
	                <?php
                        $latestPostsQuery = new WP_Query([
                            'posts_per_page' => 4
                        ]);

                        if ( $latestPostsQuery->have_posts() ) :
                            while ( $latestPostsQuery->have_posts() ) :
                                $latestPostsQuery->the_post();
                    ?>
                    <li>
                        <a href="#" title="">
                            <div class="image" style="background-image:url('<?=get_field('hero_image')['sizes']['medium']?>');">
                                <img src="<?=get_field('hero_image')['sizes']['medium']?>" alt="<?=get_field('hero_image')['alt']?>">
                            </div>
                            <div class="info">
                                <h2><?=get_the_title()?></h2>
                                <p class="excerpt shouldShave" data-rows="3"><?=getExcerpt(get_the_excerpt(), 20)?></p>
                            </div>
                        </a>
                    </li>
                    <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
	                ?>
                </ul>
            <?php endif; ?>
        </div>

		<?php
            the_posts_pagination([
                'mid_size'  => 4,
                'prev_text' => '<span class="nav-prev-text">Početak</span>',
                'next_text' => '<span class="nav-prev-text">Kraj</span>'
            ]);
        ?>

    </main>
</div>

<?php get_footer(); ?>
