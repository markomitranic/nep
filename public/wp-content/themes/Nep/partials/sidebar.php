<aside>
	<div class="sidebar">
		<ul>
			<?php
                $ads = get_field('ads', 'option');
                if ($ads) :
                foreach ($ads as $ad) :
            ?>
				<li>
					<a href="<?=$ad['link']?>" target="_blank" rel="nofollow" title="<?=$ad['title']?>">
						<img src="<?=$ad['image']['sizes']['medium']?>" alt="<?=($ad['image']['alt'] ? $ad['image']['alt'] : $ad['title'])?>">
					</a>
				</li>
            <?php
                endforeach;
                endif;
            ?>

			<?php
                $emptySlots = (int) get_field('empty_slots', 'option');
                if ($emptySlots < 0) { $emptySlots = 0; }
                while($emptySlots) :
            ?>
				<li class="inactive">
					<img src="<?=get_template_directory_uri()?>/assets/empties/Asset <?=rand(1,9)?>.svg" alt="Just a cool looking image.">
				</li>
            <?php $emptySlots--; endwhile; ?>
		</ul>
	</div>
	<div class="social">
		<?php if (has_nav_menu('footer-sidebar-menu')) : ?>
			<?php wp_nav_menu(['theme_location' => 'footer-sidebar-menu']); ?>
        <?php endif; ?>
	</div>
</aside>
