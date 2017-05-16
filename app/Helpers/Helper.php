<?php

namespace App\Helpers;

class Helper
{
	public static function slugify($text) {
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, '-');

		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);

		// lowercase
		$text = strtolower($text);

		if(empty($text)) {
			return 'n-a';
		}

		return $text;
	}


	/**
	 * Upload File and get the path
	 *
	 * @param $file
	 * @param $path
	 * @return string
	 */
	public static function uploadFileAndGetPath($file, $path, $name) {
		$name = $name . '.' . $file->getClientOriginalExtension();
		$newName = Helper::getNewName($path, $name);
		$file->move('uploads/' . $path . '/', $newName);

		return 'uploads/' . $path . '/' . $newName;
	}

	/**
	 * Get File Name with index to not overwrite
	 *
	 * @param $path
	 * @return string
	 */
	public static function getNewName($path, $name) {
		$nameExploded = explode('.', $name);
		$index = 0;
		while(file_exists('uploads/' . $path . '/' . $nameExploded[0] . ($index ? $index : '') . '.' . $nameExploded[1])) {
			$index++;
		}

		return $nameExploded[0] . ($index ? $index : '') . '.' . $nameExploded[1];
	}

	public static function toHex($n) {
		$n = intval($n);
		if(!$n) {
			return '00';
		}

		$n = max(0, min($n, 255)); // make sure the $n is not bigger than 255 and not less than 0
		$index1 = (int)($n - ($n % 16)) / 16;
		$index2 = (int)$n % 16;

		return substr("0123456789ABCDEF", $index1, 1)
		. substr("0123456789ABCDEF", $index2, 1);
	}

	public static function rgbaToHex($rgba) {
		$rgbaExploded = explode(")", explode("(", $rgba)[1])[0];
		$rgbaExploded = explode(",", $rgbaExploded);


		$red = (int)((int)$rgbaExploded[0] * $rgbaExploded[3] + 255 * (1 - $rgbaExploded[3]));
		$green = (int)((int)$rgbaExploded[1] * $rgbaExploded[3] + 255 * (1 - $rgbaExploded[3]));
		$blue = (int)((int)$rgbaExploded[2] * $rgbaExploded[3] + 255 * (1 - $rgbaExploded[3]));

		$hex = '#' . base_convert($red, 10, 16) . base_convert($green, 10, 16) . base_convert($blue, 10, 16);

		return $hex;
	}

}