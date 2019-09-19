<?php get_header(); ?>

<div id="masthead">
	<div class="wrapper">
		<div id="logo">
			<a href="<?php echo home_url(); ?>" title="Go to the front page">
				<?=file_get_contents(get_template_directory() . '/assets/global/NEP Logo.svg')?>
			</a>
		</div>
		<div id="page-title">
			<p>Biblioteka</p>
            <div id="subnav">
                <ul>
					<?php
					/** @var WP_Term[] $categories */
					$categories = get_terms('nep');
					foreach ($categories as $category) :
						$isActive = (array_key_exists('nep', $_REQUEST) && $category->slug === $_REQUEST['nep']) ? true : false;
						?>
                        <li <?=($isActive) ? 'class="active"' : ''?>><a href="/biblioteka/?nep<?=$category->slug?>"><?=$category->name?></a></li>
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
	                    $categoryName = null;

                        if (!($categoryLink = get_category_link($nepProgram->term_id))) {
	                        $categoryLink = null;
                        }
                        if (!($categoryColor = get_field('color', $nepProgram->taxonomy . '_' . $nepProgram->term_id))) {
	                        $categoryColor = 'aubergine';
                        }
                    ?>
                        <a href="<?=$categoryLink?>" class="category" style="background-color: <?=$categoryColor?>">
                            <span style="border-right-color: <?=$categoryColor?>"></span>
                            <p class="shouldShave" data-rows="1"><?=$nepProgram->name?></p>
                        </a>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <h1><?php the_title(); ?></h1>
            <p class="date"><?=get_the_date()?></p>
        </div>

		<div id="post-content">
            <?php the_content(); ?>
		</div>

		<?php
            /** @var WP_Post $authorParticipant */
            $author = get_field('autor-mentor');
		    if (!is_null($author)) :
		?>

            <div id="author">
                <h2>Autor:</h2>
                <div class="wrapper">
                    <div class="portrait">
		                <?php if ($portrait = get_field('photo', $author->ID)) : ?>
                            <div class="image" style="background-image: url('<?=$portrait['sizes']['medium']?>');">
                                <img src="<?=$portrait['sizes']['medium']?>" alt="<?=$portrait['alt']?>">
                            </div>
		                <?php endif; ?>
                        <h3>
                            <a href="<?=get_the_permalink($author->ID)?>", title="Pregled profila <?=$author->post_title ?>">
				                <?=$author->post_title ?>
                            </a>
                        </h3>
		                <?php if ($jobTitle = get_field('title', $author->ID)) : ?>
                            <p class="job-title"><?=$jobTitle?></p>
		                <?php endif; ?>
                    </div>
                    <div class="post-content">
                        <p><?=getExcerpt($author->post_content, 80, true); ?></p>
		                <?php if ($links = get_field('linkovi', $author->ID)) : ?>
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
            </div>
        <?php endif; ?>
	</main>
</div>

<?php get_footer(); ?>
