<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Cart;
use App\Models\Record;
use ColorThief\ColorThief;
use Illuminate\Http\Request;
use Session;

class RecordController extends Controller
{
	private $records = null;

	public function getList() {
		// $record = Record::find(1);
		// dd(Helper::slugify($record->name . '-' . $record->catalog));

		$records = Record::where('draft', 0)->orderBy('release_date', 'desc')->get();

		return view('shop.index', [
			'records' => $records,
		]);
	}

	public function getItem($id) {
		$this->records = Record::orderBy('release_date', 'desc')->get();
		$record = Record::find($id);

		$record = Record::find($id);
		$imageFullPath = public_path() . '/' . $record->image;
		// dd($imageFullPath);
		$dominantColor = ColorThief::getPalette($imageFullPath, 5, 7);

		return view('shop.record', [
			'record'   => $record,
			'color'    => $dominantColor,
			'prevNext' => $this->_getPrevAndNextRecord($id),
		]);
	}

	/**
	 * Add to cart
	 *
	 * @param Request $request
	 * @param $record_id
	 * @return \Redirect
	 */
	public function addToCart(Request $request, $record_id) {
		$record = Record::find($record_id);

		$oldCart = Session::has('cart') ? Session::get('cart') : null;

		$cart = new Cart($oldCart);
		$cart->add($record, $record_id);

		Session::put('cart', $cart);
		Session::save();

		return redirect()->route('record.list');
	}

	/**
	 * Shopping Cart View
	 *
	 * @return \View
	 */
	public function shoppingCart() {
		if(!Session::has('cart')) {
			return view('shop.shopping-cart', ['cart' => null]);
		}

		$oldCart = Session::get('cart');
		$cart = new Cart($oldCart);

		return view('shop.shopping-cart', [
			'cart' => $cart,
		]);
	}

	/**
	 * Checkout
	 *
	 * @return \View
	 */
	public function checkout(){
		if(!Session::has('cart')) {
			return view('shop.shopping-cart', ['cart' => null]);
		}

		$oldCart = Session::get('cart');
		$cart = new Cart($oldCart);

		return view('shop.checkout', [
			'cart' => $cart
		]);
	}


	private function _getPrevAndNextRecord($id) {
		foreach($this->records as $index => $record) {
			if($record->id == $id) {
				return [
					'prev' => $index ? $this->records[$index - 1] : null,
					'next' => $index != (sizeof($this->records) - 1) ? $this->records[$index + 1] : null,
				];
			}
		}

		return null;
	}

	private function _getPrevRecord($id) {
		foreach($this->records as $index => $record) {
			if($record->id == $id) {
				return $this->records[$index - 1];
			}
		}
	}

}
