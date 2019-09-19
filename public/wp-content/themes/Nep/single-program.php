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
            <div id="subnav">
                <ul>
					<?php
					/** @var WP_Term[] $categories */
					$categories = get_terms('vrsta');
					foreach ($categories as $category) :
						$isActive = (array_key_exists('vrsta', $_REQUEST) && $category->slug === $_REQUEST['vrsta']) ? true : false;
						?>
                        <li <?=($isActive) ? 'class="active"' : ''?>><a href="/program?vrsta=<?=$category->slug?>"><?=$category->name?></a></li>
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

	            <?php if(get_field('datum')) : ?>
                    <div class="date">
                        <p><?=get_field('datum')?></p>
                    </div>
                <?php endif; ?>

                <?php if(get_field('vreme')) : ?>
                    <div class="time">
                        <p><?=get_field('vreme')?></p>
                    </div>
                <?php endif; ?>

                <?php if(get_field('url_lokacije')) : ?>
                    <div class="location">
                        <a href="<?=get_field('url_lokacije')?>" title="Pregledaj na Maps aplikaciji" rel="nofollow" target="_blank"><?=get_field('naziv_lokacije')?></a>
                    </div>
                <?php endif; ?>

                <?php
                    /** @var WP_Post[] $moderators */
                    $moderators = get_field('predavaci');
                    if ($moderators) :
                ?>
                    <div class="moderator">
                        <ul>
                            <?php foreach ($moderators as $moderator) : ?>
                                <li>
                                    <a href="<?=get_the_permalink($moderator->ID)?>" title="Profil moderatora <?=$moderator->post_title?>"><?=$moderator->post_title?></a>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                <?php endif; ?>

            </div>
        </div>

		<div id="post-content">
            <?php the_content(); ?>
		</div>

		<?php
            /** @var WP_Post[] $moderators */
            $moderators = get_field('predavaci');
            if ($moderators) :
		?>
            <div id="moderators">
                <h2>Predavači:</h2>
                <ul>
                    <?php foreach ($moderators as $moderator) : ?>
                        <li class="moderator">
                            <div class="portrait">
                                <?php if ($portrait = get_field('photo', $moderator->ID)) : ?>
                                    <div class="image" style="background-image: url('<?=$portrait['sizes']['medium']?>');">
                                        <img src="<?=$portrait['sizes']['medium']?>" alt="<?=$portrait['alt']?>">
                                    </div>
                                <?php endif; ?>
                                <h3>
                                    <a href="<?=get_the_permalink($moderator->ID)?>", title="Pregled profila <?=$moderator->post_title ?>">
                                        <?=$moderator->post_title ?>
                                    </a>
                                </h3>
                                <?php if ($jobTitle = get_field('title', $moderator->ID)) : ?>
                                    <p class="job-title"><?=$jobTitle?></p>
                                <?php endif; ?>
                            </div>
                            <div class="post-content">
                                <p><?=getExcerpt($moderator->post_content, 80, true); ?></p>
                                <?php if ($links = get_field('linkovi', $moderator->ID)) : ?>
                                    <ul class="links">
                                        <?php foreach ($links as $link) : ?>
                                            <li>
                                                <a href="<?=$link['url']?>" target="_blank" rel="nofollow"><?=$link['label']?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

	</main>
</div>

<?php get_footer(); ?>
