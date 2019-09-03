<?php get_header(); ?>

<div id="masthead">
	<div class="wrapper">
		<div id="logo">
			<a href="<?php echo home_url(); ?>" title="Go to the front page">
				<?=file_get_contents(get_template_directory() . '/assets/global/NEP Logo.svg')?>
			</a>
		</div>
		<div id="page-title">
            <p>Program</p>
            <div id="categories">
                <ul>
					<?php
					/** @var WP_Term[] $categories */
					$categories = get_terms('vrsta');
					foreach ($categories as $category) :
						$isActive = (array_key_exists('vrsta', $_REQUEST) && $category->slug === $_REQUEST['vrsta']) ? true : false;
						?>
                        <li <?=($isActive) ? 'class="active"' : ''?>><a href="?<?=addToQueryString(['vrsta' => $category->slug])?>"><?=$category->name?></a></li>
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

                                if (!($nepProgramLink = get_category_link($nepProgram->term_id))) {
                                    $nepProgramLink = null;
                                }
                                if (!($nepProgramColor = get_field('color', $nepProgram->taxonomy . '_' . $nepProgram->term_id))) {
                                    $nepProgramColor = 'aubergine';
                                }
					        ?>
                            <a href="<?=$nepProgramLink?>" class="category" style="background-color: <?=$nepProgramColor?>">
                                <span style="border-right-color: <?=$nepProgramColor?>"></span>
                                <p class="shouldShave" data-rows="1">#<?=$nepProgram->name?></p>
                            </a>
                        </li>
			        <?php endforeach; ?>
                </ul>
	        <?php endif; ?>
	        <?php
                /** @var WP_Term[] $categories */
                $programTypes = get_the_terms($post->ID, 'vrsta');
                if (!empty($programTypes)) :
	        ?>
                <ul class="programType">
                    <?php foreach ($programTypes as $programType) : ?>
                    <li>
                        <a href="/program/?vrsta=<?=$programType->slug?>" title="Svi programi u kategoriji<?=$programType->name?>">
                            <?=$programType->name?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <h1><?php the_title(); ?></h1>
        </div>

        <div id="itinerary">
            <div class="wrapper">
                <div class="date">
                    <p><?=get_field('datum')?></p>
                </div>
                <div class="time">
                    <p><?=get_field('vreme')?></p>
                </div>
                <div class="location">
                    <a href="<?=get_field('url_lokacije')?>" title="Pregledaj na Maps aplikaciji" rel="nofollow" target="_blank"><?=get_field('naziv_lokacije')?></a>
                </div>
                <div class="moderator">
                    <ul>
	                    <?php
                            /** @var WP_Post[] $moderators */
                            $moderators = get_field('predavaci');
                            foreach ($moderators as $moderator) :
	                    ?>
                            <li>
                                <a href="<?=get_the_permalink($moderator->ID)?>" title="Profil moderatora <?=$moderator->post_title?>"><?=$moderator->post_title?></a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>

		<div id="post-content">
            <?php the_content(); ?>
		</div>

	</main>
</div>

<?php get_footer(); ?>
