<?php
get_header();

$participationType = null;
if (array_key_exists('tip_participacije', $_REQUEST)) {
	$participationType = $_REQUEST['tip_participacije'];
}
?>


<div id="masthead">
    <div class="wrapper">
        <div id="logo">
            <a href="<?php echo home_url(); ?>" title="Go to the front page">
				<?=file_get_contents(get_template_directory() . '/assets/global/NEP Logo.svg')?>
            </a>
        </div>
        <div id="page-title">
	        <?php
                if (isParticipationType($post->ID, 'mentor')) {
	                $participationTypeLink = '/ucesnik/?tip_participacije=mentor';
	                $participationTypePageTitle = 'Predavači i Mentori';
                } elseif (isParticipationType($post->ID, 'alumni')) {
	                $participationTypeLink = '/ucesnik/?tip_participacije=alumni';
	                $participationTypePageTitle = 'Alumni';
                } elseif (!empty($participationTypes = get_the_terms($post->ID, 'tip_participacije'))) {
	                $participationTypeLink = '/ucesnik/?tip_participacije=' . $participationTypes[0]->slug;
	                $participationTypePageTitle = $participationTypes[0]->name;
                } else {
	                $participationTypeLink = '/ucesnik/';
	                $participationTypePageTitle = 'Učesnici';
                }
	        ?>
            <p><?=$participationTypePageTitle?></p>
            <div id="categories">
                <ul>
		            <?php
		            /** @var WP_Term[] $categories */
		            $categories = get_terms('nep');
		            foreach ($categories as $category) :
			            $isActive = (array_key_exists('nep', $_REQUEST) && $category->slug === $_REQUEST['nep']) ? true : false;
			            ?>
                        <li <?=($isActive) ? 'class="active"' : ''?>><a href="/ucesnik/?nep=<?=$category->slug?>"><?=$category->name?></a></li>
		            <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="content">
	<?php get_template_part('partials/sidebar'); ?>
	<main>

		<div class="post-title">
			<?php
                /** @var WP_Term[] $categories */
                $nepPrograms = get_the_terms($post->ID, 'nep');
                if (!empty($nepPrograms)) :
            ?>
				<ul id="category-list">
					<?php foreach ($nepPrograms as $nepProgram) : ?>
						<li>
							<?php
                                $nepProgramName = null;

                                if (!($nepProgramColor = get_field('color', $nepProgram->taxonomy . '_' . $nepProgram->term_id))) {
                                    $nepProgramColor = 'aubergine';
                                }
							?>
							<a href="<?='/program/?nep=' . $nepProgram->slug?>" class="category" style="background-color: <?=$nepProgramColor?>">
								<span style="border-right-color: <?=$nepProgramColor?>"></span>
								<p class="shouldShave" data-rows="1">#<?=$nepProgram->name?></p>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
        </div>
        <div id="back-to-category">
            <a href="<?=$participationTypeLink?>" title="Nazad na <?=$participationTypePageTitle?>">< <?=$participationTypePageTitle?></a>
        </div>
        <div id="bio">
            <div class="portrait">
                <?php if ($portrait = get_field('photo')) : ?>
                    <img src="<?=$portrait['sizes']['medium']?>" alt="<?=$portrait['alt']?>">
                <?php endif; ?>
                <h1><?php the_title(); ?></h1>
                <?php if ($jobTitle = get_field('title')) : ?>
                    <p class="job-title"><?=$jobTitle?></p>
                <?php endif; ?>
            </div>
            <div id="post-content">
                <?php the_content(); ?>

                <?php if ($links = get_field('linkovi')) : ?>
                    <ul class="links">
                        <?php foreach ($links as $link) : ?>
                            <li>
                                <a href="<?=$link['url']?>" target="_blank" rel="nofollow"><?=$link['label']?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <?php
            if (isParticipationType($post->ID, 'alumni') && !isParticipationType($post->ID, 'mentor')) :
                /** @var WP_Term[] $skills */
                $skills = get_the_terms($post->ID, 'vestine');
                if (!empty($nepPrograms)) :
        ?>
            <div id="skills">
                <h2>Veštine</h2>
                <ul>
                    <?php foreach ($skills as $skill) : ?>
                        <li><?=$skill->name?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php
                endif;
            endif;
        ?>
        <?php
            if (isParticipationType($post->ID, 'mentor')) :
                $relatedProgramsQuery = new WP_Query([
                    'posts_per_page' => 20,
                    'post_type' => 'program',
                    'meta_query' =>[
                        [
                            'key' => 'predavaci',
                            'value' => '"' . $post->ID . '"',
                            'compare' => 'LIKE'
                        ]
                    ]
                ]);

                if ($relatedProgramsQuery->have_posts()) :
        ?>
            <div id="programs-list">
                    <h2>Aktivnosti</h2>
                    <ul>
                        <?php
                            while ( $relatedProgramsQuery->have_posts() ) :
                                $relatedProgramsQuery->the_post();

                                /** @var WP_Term[] $programs */
                                $programs = get_the_terms($post->ID, 'nep');
                                $programName = null;
                                if (!empty($programs)) {
                                    $programName = $programs[0]->name;
                                    $programColor = get_field('color', $programs[0]->taxonomy . '_' . $programs[0]->term_id);
                                }

                                /** @var WP_Term[] $types */
                                $types = get_the_terms($post->ID, 'vrsta');
                                $typeName = null;
                                if (!empty($types)) {
                                    $typeName = $types[0]->name;
                                    $typeColor = get_field('color', $types[0]->taxonomy . '_' . $types[0]->term_id);
                                }
                            ?>
                            <li>
                                <a href="<?=get_permalink()?>" title="Profil <?=get_the_title()?>">
                                    <?php $image = get_field('photo'); ?>
                                    <div class="image" style="background-image:url(<?=$image['sizes']['thumbnail']?>);">
                                        <?php if (!is_null($programName)) : ?>
                                            <div class="program" style="background-color: <?=$programColor?>">
                                                <span style="border-left-color: <?=$programColor?>"></span>
                                                <p>#<?=$programName?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!is_null($typeName)) : ?>
                                            <div class="type" style="background-color: <?=$typeColor?>">
                                                <span style="border-right-color: <?=$typeColor?>"></span>
                                                <p class="shouldShave" data-rows="1"><?=$typeName?></p>
                                            </div>
                                        <?php endif; ?>
                                        <img src="<?=$image['sizes']['thumbnail']?>" alt="<?=$image['alt']?>">
                                    </div>
                                    <div class="info">
                                        <p class="date"><?=get_field('datum')?></p>
                                        <h2><?=get_the_title()?></h2>
                                        <p class="excerpt shouldShave" data-rows="6"><?=getExcerpt(get_the_excerpt(), 20)?></p>
                                    </div>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
            </div>
        <?php
                endif;
            endif;
            wp_reset_postdata();
        ?>
	</main>
</div>

<?php get_footer(); ?>
