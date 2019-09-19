<?php get_header(); ?>

<div id="masthead">
	<div class="wrapper">
		<div id="logo">
			<a href="<?php echo home_url(); ?>" title="Go to the front page">
				<?=file_get_contents(get_template_directory() . '/assets/global/NEP Logo.svg')?>
			</a>
		</div>
		<div id="page-title">
            <h1>Program</h1>
			<div id="subnav">
				<ul>
                    <?php
                        /** @var WP_Term[] $categories */
                        $programs = get_terms('nep');
                        foreach ($programs as $program) :
                            $isActive = (array_key_exists('nep', $_REQUEST) && $program->slug === $_REQUEST['nep']) ? true : false;
                    ?>
                        <li <?=($isActive) ? 'class="active"' : ''?>><a href="?<?=addToQueryString(['nep' => $program->slug])?>"><?=$program->name?></a></li>
                    <?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<div id="content">
	<?php get_template_part('partials/sidebar'); ?>
	<main>

		<div id="search" class="with-categories">
            <div class="wrapper-category">
                <form  role="search" method="get" id="category-switch" action="">
                    <label class="screen-reader-text" for="nep">Pretraga za:</label>
					<?php
                        $searchQuery = '';
                        if (array_key_exists('vrsta', $_REQUEST)) {
                            $programTypeQuery = $_REQUEST['vrsta'];
                        }
					?>
                    <select name="vrsta" id="vrsta" onchange="this.form.submit()">
                        <option disabled selected value>---</option>
						<?php
                            /** @var WP_Term[] $categories */
                            $categories = get_terms('vrsta');
                            foreach ($categories as $category) :
                                $isActive = ($category->slug === $programTypeQuery) ? true : false;
                        ?>
                            <option value="<?=$category->slug?>" <?=($isActive) ? 'selected' : ''?>><?=$category->name?></option>
						<?php endforeach; ?>
                    </select>

					<?php if (array_key_exists('nep', $_REQUEST)) : ?>
                        <input type="hidden" value="<?=$_REQUEST['nep']?>" name="nep" id="nep">
					<?php endif; ?>
					<?php if (array_key_exists('s', $_REQUEST)) : ?>
                        <input type="hidden" value="<?=$_REQUEST['s']?>" name="s" id="s">
					<?php endif; ?>
                    <button>&nbsp;</button>
                </form>
            </div>
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

                    <?php if (array_key_exists('vrsta', $_REQUEST)) : ?>
                       <input type="hidden" value="<?=$_REQUEST['vrsta']?>" name="vrsta" id="vrsta">
                   <?php endif; ?>
					<?php if (array_key_exists('nep', $_REQUEST)) : ?>
                        <input type="hidden" value="<?=$_REQUEST['nep']?>" name="nep_program" id="nep">
					<?php endif; ?>
					<button>&nbsp;</button>
				</form>
			</div>
		</div>

		<div id="programs-list">
			<?php if (have_posts()) : ?>
				<ul>
					<?php
                        while (have_posts()) :
                            the_post();
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
			<?php else : ?>
				<div id="no-results">
					<p>Na žalost nema pronađenih programa na osnovu zadatih filtera. <a href="?" rel="nofollow" title="Poništi sve filtere">Poništi sve filtere ></a></p>

                    <img src="<?= get_template_directory_uri() ?>/assets/global/test-signal.svg" alt="Nep Test Signal">
				</div>
			<?php endif; ?>
		</div>

		<?php
		the_posts_pagination([
			'mid_size'  => 4,
			'prev_text' => '<span class="nav-prev-text">Početak</span>',
			'next_text' => '<span class="nav-prev-text">Kraj</span>',
		]);
		?>

	</main>
</div>

<?php get_footer(); ?>
