<?php

namespace Nep\queries\Archives;

class Ucesnik extends ArchiveQuery {

	use ArchiveHookTrait;

	/** @var string  */
	const PARTICIPANT_POST_TYPE = 'ucesnik';

	/**
	 * @var string
	 */
	private $participationType = '';

	/**
	 * @var string
	 */
	private $programSlug = '';

	public function shouldHandle(): bool {
		if (
			!is_admin() &&
		    $this->query->is_main_query() &&
			$this->query->is_archive() &&
			array_key_exists('post_type', $this->query->query_vars) &&
			$this->query->query_vars['post_type'] === self::PARTICIPANT_POST_TYPE
		) {
			return true;
		}

		return false;
	}

	public function execute(): void {
		if (!$this->shouldHandle()) {
			return;
		}

		$this->query->query_vars['meta_query'][] = $this->getParticipationTypeMetaQuery();
	}

	private function getParticipationTypeMetaQuery(): array
	{
		if (array_key_exists('participant', $_REQUEST)) {
			$this->participationType = sanitize_text_field($_REQUEST['participant']);
		} else {
			return [];
		}

		return [
			'key'	  	=> 'participation_type',
			'value'	  	=> $this->participationType,
			'compare' 	=> 'LIKE',
		];
	}

}
