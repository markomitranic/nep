<?php

namespace Nep\queries;

use WP_Query;

abstract class NepQuery {

	/**
	 * @var array
	 */
	protected $parsedUrlSegments;

	public function __construct() {
		global $query_string;
		wp_parse_str( $query_string, $parsedUrlSegments );
		$this->parsedUrlSegments = $parsedUrlSegments;
	}

	abstract public function getQuery(): WP_Query;

}
