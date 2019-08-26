<?php

namespace Nep\queries\Archives;

use WP_Query;

class Ucesnik extends ArchiveQuery {

	use ArchiveHookTrait;

	/**
	 * @var string
	 */
	private $participationType = '';

	public function shouldHandle(): bool {
		return true;
	}

	public function execute(): void {
		if (!self::shouldHandle()) {
			return;
		}

		$this->query->query_vars['meta_query'] = $this->getParticipationTypeMetaQuery();
		$this->query->query_vars['posts_per_page'] = 1;

////		$program = (int) (array_key_exists('naziv_programa', $_REQUEST)) ? $_REQUEST['naziv_programa'] : null;
////		if (!is_null($program)) {
////			$filterArguments['somemeta'] = $program;
////		}
//
		if (!is_null($searchFilter = $this->getSearchFilter())) {
			$this->query->query_vars['s'] = $searchFilter;
		}

	}

	private function getParticipationTypeMetaQuery(): array
	{
		if (array_key_exists('vrsta', $_REQUEST)) {
			$this->participationType = sanitize_text_field($_REQUEST['vrsta']);
		} else {
			return [];
		}

		return [
			'meta_query' => [
				[
					'key'	  	=> 'participation_type',
					'value'	  	=> $this->participationType,
					'compare' 	=> 'LIKE',
				]
			],
		];
	}

	private function getSearchFilter(): ?string
	{
		if (array_key_exists('pretraga', $_REQUEST) && (strlen($_REQUEST['pretraga']) > 0)) {
			return sanitize_text_field($_REQUEST['pretraga']);
		}

		return null;
	}

}
