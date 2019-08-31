<?php
/**
 * Block Name: Slider
 */

$id = 'slider-block-' . $block['id'];

$slides = get_field('slides');

?>

<div id="<?php echo $id; ?>" class="wp-block-slider">
    <ul>
	    <?php foreach ($slides as $slide) : ?>
            <li>
                <div class="image" style="background-image: <?= $slide['sizes']['medium_large'] ?>">
                    <img src="<?= $slide['sizes']['medium_large'] ?>" alt="<?=$slide['alt']?>">
                </div>
            </li>
	    <?php endforeach; ?>
    </ul>
</div>
