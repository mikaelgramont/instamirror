<?php
class Instagram {
	private $_cacheKey = 'photos';

	public function __construct($tag, $cache, $blacklist)
	{
		$this->_tag = $tag;
		$this->_cache = $cache;
		$this->_blacklist = $blacklist;
	}

	private function _scrape()
	{
		$insta_source = file_get_contents('https://instagram.com/explore/tags/'.$this->_tag);
		$shards = explode('window._sharedData = ', $insta_source);
		$insta_json = explode(';</script>', $shards[1]); 
		$insta_array = json_decode($insta_json[0], TRUE);
		$photosRaw = $insta_array['entry_data']['TagPage'][0]['tag']['media']['nodes'];
		$photos = array();
		// TODO loop over entries, and skip those in the blacklist.
		foreach ($photosRaw as $photo) {
			if (in_array($photo['code'], $this->_blacklist)) {
				continue;
			}
			$photos[] = $photo;
		}

		return $photos;
	}

	public function getPhotos()
	{
		if (USE_CACHE) {
			if (!$photos = $this->_cache->load($this->_cacheKey)) {
				$photos = $this->_scrape();
				$this->_cache->save($photos, $this->_cacheKey);
			}
		} else {
			$photos = $this->_scrape();
		}
		return $photos;
	}
}