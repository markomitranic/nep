<?php get_header(); ?>
<?php get_template_part('partials/masthead'); ?>

<div id="content">
    <?php get_template_part('partials/sidebar'); ?>
	<main>

        <div id="intro">
            <p>Jednogodišnji interdisciplinarni eksperimentalni obrazovni program za studente različitih fakulteta utemeljen na principima saradnje, timskog rada, dijaloga, razmene, otvorenosti i povezivanja različitih znanja, veština i kapaciteta.</p>
        </div>

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
                <a href="/galerija/" title="Galerija media sadržaja za NEP programa">
                    <div class="image" style="background-image:url('<?=get_template_directory_uri()?>/assets/temp/media-naslovna.jpg');">
                        <img src="<?=get_template_directory_uri()?>/assets/temp/media-naslovna.jpg" alt="">
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
                                <p class="program">#nep4</p>
                                <h2><?=$featuredProgram->post_title?></h2>
                            </div>
                            <div class="signature">
                                <p class="venue">G12HUB</p>
                                <?php
                                $startDate = new DateTimeImmutable();
                                $endDate = new DateTimeImmutable('+ 25 days');
                                ?>
                                <p class="date"><?=$startDate->format('d. M')?> - <?=$endDate->format('d. M')?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>

	</main>
</div>

<?php get_footer(); ?>
