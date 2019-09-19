<?php get_header(); ?>

<div id="masthead">
    <div class="wrapper">
        <div id="logo">
            <a href="<?php echo home_url(); ?>" title="Go to the front page">
				<?=file_get_contents(get_template_directory() . '/assets/global/NEP Logo.svg')?>
            </a>
        </div>
        <div id="page-title" class="flashing misli-buducnost-visible">
            <div class="misli-buducnost">
	            <?=file_get_contents(get_template_directory() . '/assets/global/frontpage-hero.svg')?>
            </div>
            <h1><?=get_the_title()?></h1>
        </div>
    </div>
</div>

<div id="content">
    <?php get_template_part('partials/sidebar'); ?>
	<main>

        <div id="funnel-blocks">
            <div id="news">
                <ul>
	                <?php
                        $latestPostsQuery = new WP_Query([
                            'posts_per_page' => 6
                        ]);
                        $newsCounter = 1;

                        if ( $latestPostsQuery->have_posts() ) :
                            while ( $latestPostsQuery->have_posts() ) :
                                $latestPostsQuery->the_post();
                                ?>
                                <li>
                                    <a href="<?=get_the_permalink()?>" title="<?=get_the_title()?>">
                                        <div class="image" style="background-image:url('<?=get_field('hero_image')['sizes']['medium']?>');">
                                            <img src="<?=get_field('hero_image')['sizes']['medium']?>" alt="<?=get_field('hero_image')['alt']?>">
                                        </div>
                                        <div class="info">
                                            <h2>Vesti</h2>
                                            <p class="counter"><?=$newsCounter?>/6</p>
                                            <p class="excerpt shouldShave" data-rows="3"><?=get_the_title()?></p>
                                        </div>
                                    </a>
                                </li>
                            <?php
                                $newsCounter++;
                            endwhile;
                        endif;
                        wp_reset_postdata();
	                ?>
                </ul>
            </div>
            <div id="programs">
                <a href="/program/" title="NEP Programski sadržaji">
                    <h2>Program</h2>
                    <p>radionica / predavanje prezentacija / poseta / mentorska sesija / finalni događaj / ekskurzija</p>
                </a>
            </div>
            <div id="media">
                <a href="/media/" title="Galerija media sadržaja za NEP programa">
                    <div class="slider-wrapper">
                        <?php
                            $galleryItems = get_field('gallery_content', 64);
                            $randomGalleryImages = [];
                            for ($i=6; $i > 0; $i--) {
                                $randomKey = rand(0, count($galleryItems) - 1);
                                if (array_key_exists($randomKey, $randomGalleryImages)) {
                                    continue;
                                }

                                $item = $galleryItems[$randomKey];
                                if ($item['acf_fc_layout'] !== 'picture') {
                                    $i++;
                                    continue;
                                }
                                $randomGalleryImages[$randomKey] = $item['image'];
                            }

                            foreach ( $randomGalleryImages as $image ) :
                        ?>
                            <div class="image" style="background-image:url('<?=$image['sizes']['thumbnail']?>');">
                                <img src="<?=$image['sizes']['medium']?>" alt="<?=$image['alt']?>">
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="info">
                        <h2>Media</h2>
                    </div>
                </a>
            </div>
            <div id="empty" style="background-image:url('<?=get_template_directory_uri()?>/assets/empties/Asset <?=rand(1,9)?>.svg');"></div>

            <?php
                /** @var WP_Post $featuredProgram */
                if ($featuredProgram = get_field('istaknuti_program')) :
            ?>
                <div id="event" class="full-block">
                    <a href="<?=get_the_permalink($featuredProgram->ID)?>" title="<?=$featuredProgram->post_title?>">
                        <div class="image" style="background-image:url('<?=get_field('photo', $featuredProgram->ID)['sizes']['medium_large']?>');">
                            <img src="<?=get_field('photo', $featuredProgram->ID)['sizes']['medium_large']?>" alt="<?=get_field('photo', $featuredProgram->ID)['alt']?>">
                        </div>
                        <div class="info">
                            <div class="announcement">
	                            <?php
                                    /** @var WP_Term[] $categories */
                                    $nepPrograms = get_the_terms($featuredProgram->ID, 'nep');
                                    if (!empty($nepPrograms)) :
	                            ?>
                                    <p class="program">#<?=$nepPrograms[0]->name?></p>
                                <?php endif; ?>
                                <h2><?=$featuredProgram->post_title?></h2>
                            </div>
                            <div class="signature">
                                <p class="venue"><?=get_field('naziv_lokacije', $featuredProgram->ID)?></p>
                                <p class="date"><?=get_field('datum', $featuredProgram->ID)?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>

	</main>
</div>

<?php get_footer(); ?>
