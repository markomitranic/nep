<?php get_header(); ?>

<div id="masthead">
    <div class="wrapper">
        <div id="logo">
            <a href="<?php echo home_url(); ?>" title="Go to the front page">
                <img src="<?=get_template_directory_uri()?>/assets/global/NEP Logo.svg" alt="NEP Logo">
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
						<img src="<?=get_template_directory_uri()?>/assets/empties/Asset 3.svg" alt="A cool looking image">
					</a>
				</li>
				<li>
					<a href="#" target="_blank" rel="nofollow" title="#">
						<img src="<?=get_template_directory_uri()?>/assets/empties/Asset 5.svg" alt="A cool looking image">
					</a>
				</li>
				<li>
					<a href="#" target="_blank" rel="nofollow" title="#">
						<img src="<?=get_template_directory_uri()?>/assets/empties/Asset 4.svg" alt="A cool looking image">
					</a>
				</li>
				<li>
					<a href="#" target="_blank" rel="nofollow" title="#">
						<img src="<?=get_template_directory_uri()?>/assets/empties/Asset 2.svg" alt="A cool looking image">
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
		Jednogodišnji interdisciplinarni eksperimentalni obrazovni program za studente različitih fakulteta utemeljen na principima saradnje, timskog rada, dijaloga, razmene, otvorenosti i povezivanja različitih znanja, veština i kapaciteta.
	</main>
</div>

<?php get_footer(); ?>
