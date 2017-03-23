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

}