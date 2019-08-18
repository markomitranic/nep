<?php get_header(); ?>

<div id="masthead">
    <div class="wrapper">
        <div id="logo">
            <a href="<?php echo home_url(); ?>" title="Go to the front page">
                <?=file_get_contents(get_template_directory() . '/assets/global/NEP Logo.svg')?>
            </a>
        </div>
        <div id="page-title">
            <h1>Tehnologija / Umetnost / Nauka / Preduzetništvo / Aktivizam / Eksperiment / Inovacija</h1>
        </div>
    </div>
</div>

<div id="content">
	<aside>
		<div class="description">
			<p><?= get_bloginfo('description'); ?></p>
		</div>
		<div class="sidebar">
			<ul>
				<li class="inactive">
                    <img src="<?=get_template_directory_uri()?>/assets/empties/Asset <?=rand(1,9)?>.svg" alt="A cool looking image">
				</li>
				<li>
					<a href="#" target="_blank" rel="nofollow" title="#">
						<img src="<?=get_template_directory_uri()?>/assets/empties/Asset <?=rand(1,9)?>.svg" alt="A cool looking image">
					</a>
				</li>
				<li>
					<a href="#" target="_blank" rel="nofollow" title="#">
						<img src="<?=get_template_directory_uri()?>/assets/empties/Asset <?=rand(1,9)?>.svg" alt="A cool looking image">
					</a>
				</li>
				<li>
					<a href="#" target="_blank" rel="nofollow" title="#">
						<img src="<?=get_template_directory_uri()?>/assets/empties/Asset <?=rand(1,9)?>.svg" alt="A cool looking image">
					</a>
				</li>
				<li>
					<a href="#" target="_blank" rel="nofollow" title="#">
						<img src="<?=get_template_directory_uri()?>/assets/empties/Asset <?=rand(1,9)?>.svg" alt="A cool looking image">
					</a>
				</li>
			</ul>
		</div>
		<div class="social">
			<ul>
				<li><a href="">Vimeo</a></li>
				<li><a href="">Instagram</a></li>
			</ul>
		</div>
	</aside>
	<main>

        <div id="intro">
            <p>Jednogodišnji interdisciplinarni eksperimentalni obrazovni program za studente različitih fakulteta utemeljen na principima saradnje, timskog rada, dijaloga, razmene, otvorenosti i povezivanja različitih znanja, veština i kapaciteta.</p>
        </div>

        <div id="funnel-blocks">
            <div id="news">
                <ul>
                    <li>
                        <a href="#" title="">
                            <div class="image" style="background-image:url('<?=get_template_directory_uri()?>/assets/temp/vesti-naslovna.png');">
                                <img src="<?=get_template_directory_uri()?>/assets/temp/vesti-naslovna.png" alt="">
                            </div>
                            <div class="info">
                                <h2>Vesti</h2>
                                <p class="counter">1/6</p>
                                <p class="excerpt shouldShave" data-rows="3">Predavanje Marije Kojić, učesnice 2. genereracije NEP-a, na Beogradskom Sajmu Nameštaja</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="">
                            <div class="image" style="background-image:url('<?=get_template_directory_uri()?>/assets/temp/media-naslovna.jpg');">
                                <img src="<?=get_template_directory_uri()?>/assets/temp/media-naslovna.jpg" alt="">
                            </div>
                            <div class="info">
                                <h2>Vesti</h2>
                                <p class="counter">2/6</p>
                                <p class="excerpt shouldShave" data-rows="3">Marko Mitranic je odradio neverovatan podvig Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores delectus dolorem fugit laborum nam placeat quis quo sed sequi. Animi eius, eligendi id ipsum nulla officiis pariatur tenetur totam unde!</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div id="programs">
                <a href="#" title="">
                    <h2>Program</h2>
                    <p>radionica / predavanje prezentacija / poseta / mentorska sesija / finalni događaj / ekskurzija</p>
                </a>
            </div>
            <div id="media">
                <a href="#" title="">
                    <div class="image" style="background-image:url('<?=get_template_directory_uri()?>/assets/temp/media-naslovna.jpg');">
                        <img src="<?=get_template_directory_uri()?>/assets/temp/media-naslovna.jpg" alt="">
                    </div>
                    <div class="info">
                        <h2>Media</h2>
                    </div>
                </a>
            </div>
            <div id="empty" style="background-image:url('<?=get_template_directory_uri()?>/assets/empties/Asset <?=rand(1,9)?>.svg');"></div>
            <div id="event" class="full-block">
                <a href="" title="">
                    <div class="image" style="background-image:url('<?=get_template_directory_uri()?>/assets/temp/izlozba-naslovna.jpg');">
                        <img src="<?=get_template_directory_uri()?>/assets/temp/izlozba-naslovna.jpg" alt="">
                    </div>
                    <div class="info">
                        <div class="announcement">
                            <p class="program">#nep4</p>
                            <h2>Final Exhibition</h2>
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
        </div>

	</main>
</div>

<?php get_footer(); ?>
