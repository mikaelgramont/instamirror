<?php
class Renderer {
	public static function grid($list)
	{
		$output = '<ul class="grid">'.PHP_EOL;
		foreach($list as $photo) {
			$output .= self::_photo($photo);
		}
		$output .= '</ul>'.PHP_EOL;
		return $output;
	}

	private static function _photo($photo)
	{
		$image = self::_image($photo);
		$link = 'https://www.instagram.com/p/'.$photo['code'];

		$output = '<li class="photo">';
		$output .= '<a href="'.$link.'" title="'.$photo['caption'].'">'. $image .'</a>';
		$output .= '</li>'.PHP_EOL;
		return $output;
	}

	private static function _image($photo)
	{
		$output = '<img class="photo-img" src="' . $photo['thumbnail_src'] .'">';
		return $output;		
	}
}