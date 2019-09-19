<?php
/**
* Template Name: Gallery Page
*/

get_header();
?>

<div id="masthead">
	<div class="wrapper">
		<div id="logo">
			<a href="<?php echo home_url(); ?>" title="Go to the front page">
				<?=file_get_contents(get_template_directory() . '/assets/global/NEP Logo.svg')?>
			</a>
		</div>
		<div id="page-title">
            <h1><?php the_title(); ?></h1>
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
            <div class="wrapper-category">
                <form  role="search" method="get" id="category-switch" action="">
                    <label class="screen-reader-text" for="vrsta">Pretraga za:</label>
                    <?php
                    $searchQuery = '';
                    if (array_key_exists('vrsta', $_REQUEST)) {
                        $programQuery = $_REQUEST['vrsta'];
                    }
                    ?>
                    <select name="vrsta" id="vrsta" onchange="this.form.submit()">
                        <option disabled selected value>---</option>
                        <?php
                        /** @var WP_Term[] $categories */
                        $categories = get_terms('vrsta', ['hide_empty' => false, 'parent' => 0]);
                        foreach ($categories as $category) :
                            $isActive = ($category->slug === $programQuery) ? true : false;
                            ?>
                            <option value="<?=$category->slug?>" <?=($isActive) ? 'selected' : ''?>><?=$category->name?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (array_key_exists('nep', $_REQUEST)) : ?>
                        <input type="hidden" value="<?=$_REQUEST['nep']?>" name="nep" id="nep">
                    <?php endif; ?>
                </form>
            </div>
        </div>

		<div id="post-content">
            <?php the_content(); ?>
		</div>

        <div id="gallery-page-content">
            <ul class="masonry">
                <?php
                    $contentItems = get_field('gallery_content');

                    $isNepQuery = (array_key_exists('nep', $_REQUEST)) ? true : false;
                    if ($isNepQuery) {
                        /** @var WP_Term $queriedNep */
                        $queriedNep = get_term_by('slug', $_REQUEST['nep'], 'nep');
                        if (!$queriedNep) {
                            $isNepQuery = false;
                        }
                    }

                    $isTypeQuery = (array_key_exists('vrsta', $_REQUEST)) ? true : false;
                    if ($isTypeQuery) {
                        /** @var WP_Term $queriedType */
                        $queriedType = get_term_by('slug', $_REQUEST['vrsta'], 'vrsta');
                        if (!$queriedType) {
	                        $isTypeQuery = false;
                        }
                    }

                    $filteredItemCount = 0;

                    foreach ($contentItems as $contentItem) :
                        if ($isNepQuery && $contentItem['nep'] !== $queriedNep->term_id) {
                            continue;
                        }
	                    if ($isTypeQuery && $contentItem['vrsta_aktivnosti'] !== $queriedType->term_id) {
		                    continue;
	                    }

	                    $filteredItemCount++;
                ?>
                    <div class="grid-sizer"></div>
                    <div class="gutter-sizer"></div>
                    <li>
                        <?php if ($contentItem['acf_fc_layout'] === 'picture') : ?>
                            <a href="<?=$contentItem['image']['url']?>" target="_blank" title="Otvori u novom tabu">
                                <div class="wrapper">
                                    <img src="<?=$contentItem['image']['sizes']['medium']?>" alt="<?=$contentItem['image']['alt']?>">
                                    <p>#NEP2 - Ekskurzija</p>
                                </div>
                            </a>
                        <?php elseif ($contentItem['acf_fc_layout'] === 'embed_youtube_vimeo') : ?>
                            <div class="video-wrapper">
                                <?=$contentItem['embed_url']?>
                                <p>#NEP2 - Ekskurzija</p>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php
                    endforeach;
                    if (empty($filteredItemCount)) :
                ?>
                    <div id="no-results">
                        <p>Na žalost nema pronađenih sadržaja na osnovu zadatih filtera. <a href="?" rel="nofollow" title="Poništi sve filtere">Poništi sve filtere ></a></p>

                        <img src="<?= get_template_directory_uri() ?>/assets/global/test-signal.svg" alt="Nep Test Signal">
                    </div>
                <?php endif; ?>
            </ul>
        </div>

	</main>
</div>

<?php get_footer(); ?>
