<?php


namespace Nep\queries\Archives;

use WP_Query;

abstract class ArchiveQuery {

	/**
	 * @var array
	 */
	protected $parsedUrlSegments;

	/**
	 * @var WP_Query
	 */
	protected $query = null;

	public function __construct(WP_Query $query) {
		global $query_string;
		wp_parse_str( $query_string, $parsedUrlSegments );
		$this->parsedUrlSegments = $parsedUrlSegments;

		$this->query = $query;
	}

	abstract public static function factory( WP_Query $query);

	abstract public static function register(): void;

	abstract public function shouldHandle(): bool;

	abstract public function execute(): void;

}
