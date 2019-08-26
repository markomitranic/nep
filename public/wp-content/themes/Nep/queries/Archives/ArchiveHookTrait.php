<?php


namespace Nep\queries\Archives;

use WP_Query;

trait ArchiveHookTrait {

	public static function register(): void
	{
		add_action( 'pre_get_posts', [ self::class, 'factory'] );
	}

	public static function factory( WP_Query $query)
	{
		(new self($query))->execute();
	}

}
