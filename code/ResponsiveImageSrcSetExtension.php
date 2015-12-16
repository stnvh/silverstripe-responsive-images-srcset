<?php

class ResponsiveImageSrcSetExtension extends ResponsiveImageExtension implements Flushable {

	/**
	 * @return void
	 */
	public static function flush() {
		SS_Cache::factory('srcset')->clean(Zend_Cache::CLEANING_MODE_ALL);
	}

	/**
	 * Transforms old style min-width media queries into srcset width values
	 * Adds retina sizes if the retina config option is set
	 *
	 * @param string $setName The name of the responsive image set to get
	 * @return array
	 */
	protected function getConfigForSet($setName) {
		$cache = SS_Cache::factory('srcset');
		$conf = unserialize($cache->load('config'));

		if(!$conf) {
			$conf = parent::getConfigForSet($setName);

			$prev = null;
			$orig = array();

			$retina = array();

			foreach($conf['sizes'] as $i => &$size) {
				$curr = &$size;
				$last = $i == count($conf['sizes']) - 1 ? true : false;

				$curr['query'] = preg_replace('/\(min-width: ?([0-9]+)px\)/', '$1w', $curr['query']);

				$orig[] = $curr;

				if($prev) $prev['query'] = $curr['query'];

				if($last) {
					$val = intval($curr['query']);
					$prevVal = intval($orig[$i - 1]['query']);

					$curr['query'] = ($val + ($val - $prevVal)) . 'w';
				}

				$prev = &$curr;
			}

			if(isset($conf['retina']) && $conf['retina']) {
				foreach($conf['sizes'] as $break) {
					$retina[] = array(
						'query' => $break['query'] . ' 2x',
						'size' => implode('x', array_map(function($size) {
							return intval($size) * 2;
						}, explode('x', $break['size'])))
					);
				}

				$conf['sizes'] = array_merge($conf['sizes'], $retina);
			}

			$cache->save(serialize($conf), 'config');
		}

		return $conf;
	}

}
