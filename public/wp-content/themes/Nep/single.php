<?php get_header(); ?>

<div id="masthead">
	<div class="wrapper">
		<div id="logo">
			<a href="<?php echo home_url(); ?>" title="Go to the front page">
				<?=file_get_contents(get_template_directory() . '/assets/global/NEP Logo.svg')?>
			</a>
		</div>
		<div id="page-title">
			<p>Vesti</p>
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

        <div class="post-title">
            <?php
                /** @var WP_Term[] $categories */
                $categories = get_categories();
                if (!empty($categories)) :
            ?>
            <ul id="category-list">
                <?php foreach ($categories as $category) : ?>
                <li>
	                <?php
	                    $categoryName = null;

                        if (!($categoryLink = get_category_link($category->term_id))) {
	                        $categoryLink = null;
                        }
                        if (!($categoryColor = get_field('color', $category->taxonomy . '_' . $category->term_id))) {
	                        $categoryColor = 'aubergine';
                        }
                    ?>
                        <a href="<?=$categoryLink?>" class="category" style="background-color: <?=$categoryColor?>">
                            <span style="border-right-color: <?=$categoryColor?>"></span>
                            <p class="shouldShave" data-rows="1"><?=$category->name?></p>
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

	</main>
</div>

<?php get_footer(); ?>
