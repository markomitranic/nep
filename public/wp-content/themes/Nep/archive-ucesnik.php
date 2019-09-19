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
                switch ($participationType) {
                    case 'alumni':
                        $pageTitle = 'Alumni';
                        break;
                    case 'mentor':
                        $pageTitle = 'Predavači i Mentori';
                        break;
                    default:
                        $pageTitle = 'Učesnici';
                }
            ?>
            <h1><?=$pageTitle?></h1>
			<div id="subnav">
				<ul>
					<?php
					/** @var WP_Term[] $categories */
					$categories = get_terms('nep');
					foreach ($categories as $category) :
						$isActive = (array_key_exists('nep', $_REQUEST) && $category->slug === $_REQUEST['nep']) ? true : false;
						?>
                        <li <?=($isActive) ? 'class="active"' : ''?>><a href="?<?=addToQueryString(['nep' => $category->slug])?>"><?=$category->name?></a></li>
					<?php endforeach; ?>
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
					if (array_key_exists('pretraga', $_REQUEST)) {
						$searchQuery = $_REQUEST['pretraga'];
					}
					?>
                    <input type="text" value="<?=$searchQuery?>" placeholder="Pretraga" name="s" id="s">

                    <?php if (array_key_exists('tip_participacije', $_REQUEST)) : ?>
                       <input type="hidden" value="<?=$_REQUEST['tip_participacije']?>" name="tip_participacije" id="tip_participacije">
                   <?php endif; ?>
					<?php if (array_key_exists('nep', $_REQUEST)) : ?>
                        <input type="hidden" value="<?=$_REQUEST['nep']?>" name="nep" id="nep">
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
						?>
						<li>
							<a href="<?=get_permalink()?>" title="Profil <?=get_the_title()?>">
                                <?php $image = get_field('photo'); ?>
								<div class="image" style="background-image:url(<?=$image['sizes']['thumbnail']?>);">
									<img src="<?=$image['sizes']['thumbnail']?>" alt="<?=$image['alt']?>">
								</div>
								<div class="info">
									<h2><?=get_the_title()?></h2>
								</div>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php else : ?>
				<div id="no-results">
					<p>Na žalost nema pronađenih učesnika na osnovu zadatih filtera. <a href="?" rel="nofollow" title="Poništi sve filtere">Poništi sve filtere ></a></p>

                    <img src="<?= get_template_directory_uri() ?>/assets/global/test-signal.svg" alt="Nep Test Signal">
				</div>
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
