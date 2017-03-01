<?php

use App\Helpers\Helper;
use App\Models\Artist;
use App\Models\Label;
use App\Models\Record;
use App\Models\Track;
use Illuminate\Database\Seeder;

class RecordTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		// generate random string md5(uniqid(rand(), true));
		$this->goneta();
		$this->pamparam();
		$this->insideOut();
		$this->morfoza();
		$this->basorelief();
		$this->acajouWasZuSagen();
	}
	
	private function goneta() {
		/** artists */
		$artist = Artist::where('name', 'Mihai Pol')->first();

		/** label */
		$label = Label::where('name', 'Capodopere')->first();

		/** record */
		$name = 'Goneta';
		$catalog = 'CPD002';
		$slug = Helper::slugify($name . '-' . $catalog);
		$path = "uploads/records/$slug";
		$record = Record::create([
			'name'         => $name,
			'slug'         => $slug,
			'release_date' => '2016-05-30',
			'label_id'     => $label->id,
			'catalog'      => $catalog,
			'format'       => '1x12"',
			'description'  => '',
			'image'        => $path . '/image.jpg',
			'price'        => '11',
			'stock'        => 5,
		]);
		$record->artists()->save($artist);

		/** tracks */
		$name = 'Goneta';
		$slug = Helper::slugify($name . '-' . $catalog);
		$track1 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'a',
			'audio'  => $path . '/audio-' . Helper::slugify($name) . '.mp3',
			'wave'   => $path . '/wave-' . Helper::slugify($name) . '.jpg',
			'length' => '10:20',
		]);
		$track1->artists()->save($artist);

		$name = 'Science Friction';
		$slug = Helper::slugify($name . '-' . $catalog);
		$track2 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'b',
			'audio'  => $path . '/audio-' . Helper::slugify($name) . '.mp3',
			'wave'   => $path . '/wave-' . Helper::slugify($name) . '.jpg',
			'length' => '9:40',
		]);
		$track2->artists()->save($artist);

		/** record_track */
		$record->tracks()->save($track1);
		$record->tracks()->save($track2, [
			'order' => 1,
		]);
	}

	private function pamparam() {
		/** artists */
		$artist = Artist::where('name', 'Mihai Pol')->first();
		$artist2 = Artist::where('name', 'Suciu')->first();

		/** label */
		$label = Label::where('name', 'Synesthesia')->first();

		/** record */
		$name = 'Pamparam';
		$catalog = 'SYNSTH002';
		$slug = Helper::slugify($name . '-' . $catalog);
		$path = "uploads/records/$slug";
		$record = Record::create([
			'name'         => $name,
			'slug'         => $slug,
			'release_date' => '2017-04-20',
			'label_id'     => $label->id,
			'catalog'      => $catalog,
			'format'       => '1x12"',
			'description'  => '',
			'image'        => $path . '/image.jpg',
			'price'        => '14',
			'stock'        => 2,
		]);
		$record->artists()->save($artist);
		$record->artists()->save($artist2, [
			'order' => 1,
			'remix' => true,
		]);

		/** tracks */
		$name = 'Param';
		$slug = Helper::slugify($name . '-' . $catalog);
		$track1 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'a',
			'audio'  => $path . '/audio-' . Helper::slugify($name) . '.mp3',
			'wave'   => $path . '/wave-' . Helper::slugify($name) . '.jpg',
			'length' => '10:20',
		]);
		$track1->artists()->save($artist);

		$name = 'Pam';
		$slug = Helper::slugify($name . '-' . $catalog);
		$track2 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'b1',
			'audio'  => $path . '/audio-' . Helper::slugify($name) . '.mp3',
			'wave'   => $path . '/wave-' . Helper::slugify($name) . '.jpg',
			'length' => '9:40',
		]);
		$track2->artists()->save($artist);

		$name = 'Pam';
		$slug = Helper::slugify($name . '-' . $catalog);
		$track3 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'b2',
			'audio'  => $path . '/audio-' . Helper::slugify($name) . '.mp3',
			'wave'   => $path . '/wave-' . Helper::slugify($name) . '.jpg',
			'length' => '9:40',
		]);
		$track3->artists()->save($artist);
		$track3->artists()->save($artist2, [
			'order' => 1,
			'remix' => true,
		]);

		/** record_track */
		$record->tracks()->save($track1);
		$record->tracks()->save($track2, [
			'order' => 1,
		]);
		$record->tracks()->save($track3, [
			'order' => 2,
		]);
	}

	private function insideOut() {
		/** artists */
		$artist = Artist::where('name', 'Suciu')->first();

		/** label */
		$label = Label::where('name', 'Substantia Nigra')->first();

		/** record */
		$name = 'Inside Out';
		$catalog = 'SN001';
		$slug = Helper::slugify($name . '-' . $catalog);
		$path = "uploads/records/$slug";
		$record = Record::create([
			'name'         => $name,
			'slug'         => $slug,
			'release_date' => '2016-12-13',
			'label_id'     => $label->id,
			'catalog'      => $catalog,
			'format'       => '1x12"',
			'description'  => '',
			'image'        => $path . '/image.jpg',
			'price'        => '9',
			'stock'        => 7,
		]);
		$record->artists()->save($artist);

		/** tracks */
		$name = 'Translucid';
		$slug = Helper::slugify($name . '-' . $catalog);
		$track1 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'a',
			'audio'  => $path . '/audio-' . Helper::slugify($name) . '.mp3',
			'wave'   => $path . '/wave-' . Helper::slugify($name) . '.jpg',
			'length' => '10:20',
		]);
		$track1->artists()->save($artist);

		$name = 'Jesus Chrysler';
		$slug = Helper::slugify($name . '-' . $catalog);
		$track2 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'b',
			'audio'  => $path . '/audio-' . Helper::slugify($name) . '.mp3',
			'wave'   => $path . '/wave-' . Helper::slugify($name) . '.jpg',
			'length' => '9:40',
		]);
		$track2->artists()->save($artist);

		/** record_track */
		$record->tracks()->save($track1);
		$record->tracks()->save($track2, [
			'order' => 1,
		]);
	}

	private function morfoza() {
		/** artists */
		$artist = Artist::where('name', 'Sit')->first();

		/** label */
		$label = Label::where('name', 'Amphia')->first();

		/** record */
		$name = 'Morfoza';
		$catalog = 'AMP003';
		$slug = Helper::slugify($name . '-' . $catalog);
		$path = "uploads/records/$slug";
		$record = Record::create([
			'name'         => $name,
			'slug'         => $slug,
			'release_date' => '2012-06-27',
			'label_id'     => $label->id,
			'catalog'      => $catalog,
			'format'       => '1x12"',
			'description'  => '',
			'image'        => $path . '/image.jpg',
			'price'        => '20',
			'stock'        => 1,
		]);
		$record->artists()->save($artist);

		/** tracks */
		$name = 'Channeling';
		$slug = Helper::slugify($name . '-' . $catalog);
		$track1 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'a',
			'audio'  => $path . '/audio-' . Helper::slugify($name) . '.mp3',
			'wave'   => $path . '/wave-' . Helper::slugify($name) . '.jpg',
			'length' => '',
		]);
		$track1->artists()->save($artist);

		$name = 'Ex';
		$slug = Helper::slugify($name . '-' . $catalog);
		$track2 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'b',
			'audio'  => $path . '/audio-' . Helper::slugify($name) . '.mp3',
			'wave'   => $path . '/wave-' . Helper::slugify($name) . '.jpg',
			'length' => '',
		]);
		$track2->artists()->save($artist);

		/** record_track */
		$record->tracks()->save($track1);
		$record->tracks()->save($track2, [
			'order' => 1,
		]);
	}

	private function basorelief() {
		/** artists */
		$artist = Artist::where('name', 'Cristi Cons')->first();

		/** label */
		$label = Label::where('name', 'Meander')->first();

		/** record */
		$name = 'Basorelief';
		$catalog = 'MEANDER014';
		$slug = Helper::slugify($name . '-' . $catalog);
		$path = "uploads/records/$slug";
		$record = Record::create([
			'name'         => $name,
			'slug'         => $slug,
			'release_date' => '2014-04-10',
			'label_id'     => $label->id,
			'catalog'      => $catalog,
			'format'       => '1x12"',
			'description'  => '',
			'image'        => $path . '/image.jpg',
			'price'        => '20',
			'stock'        => 1,
		]);
		$record->artists()->save($artist);

		/** tracks */
		$name = 'Anatrack';
		$slug = Helper::slugify($name . '-' . $catalog);
		$track1 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'a',
			'audio'  => $path . '/audio-' . Helper::slugify($name) . '.mp3',
			'wave'   => $path . '/wave-' . Helper::slugify($name) . '.jpg',
			'length' => '',
		]);
		$track1->artists()->save($artist);

		$name = 'Change';
		$slug = Helper::slugify($name . '-' . $catalog);
		$track2 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'b1',
			'audio'  => $path . '/audio-' . Helper::slugify($name) . '.mp3',
			'wave'   => $path . '/wave-' . Helper::slugify($name) . '.jpg',
			'length' => '',
		]);
		$track2->artists()->save($artist);

		$name = 'You Know';
		$slug = Helper::slugify($name . '-' . $catalog);
		$track3 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'b2',
			'audio'  => $path . '/audio-' . Helper::slugify($name) . '.mp3',
			'wave'   => $path . '/wave-' . Helper::slugify($name) . '.jpg',
			'length' => '',
		]);
		$track3->artists()->save($artist);

		/** record_track */
		$record->tracks()->save($track1);
		$record->tracks()->save($track2, [
			'order' => 1,
		]);
		$record->tracks()->save($track3, [
			'order' => 2,
		]);
	}

	private function acajouWasZuSagen() {
		/** artists */
		$artist = Artist::where('name', 'Vlad Radu')->first();
		$artist2 = Artist::where('name', 'Cristi Cons')->first();

		/** label */
		$label = Label::where('name', 'Dialegestai')->first();

		/** record */
		$name = 'Acajou / Was Zu Sagen';
		$catalog = 'DIA002';
		$slug = Helper::slugify($name . '-' . $catalog);
		$path = "uploads/records/$slug";
		$record = Record::create([
			'name'         => $name,
			'slug'         => $slug,
			'release_date' => '2014-11-24',
			'label_id'     => $label->id,
			'catalog'      => $catalog,
			'format'       => '1x12"',
			'description'  => '',
			'image'        => $path . '/image.jpg',
			'price'        => '11',
			'stock'        => 5,
		]);
		$record->artists()->save($artist);
		$record->artists()->save($artist2);

		/** tracks */
		$name = 'Acajou';
		$slug = Helper::slugify($name . '-' . $catalog);
		$track1 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'a',
			'audio'  => $path . '/audio-' . strtolower($name) . '.mp3',
			'wave'   => $path . '/wave-' . strtolower($name) . '.jpg',
			'length' => '',
		]);
		$track1->artists()->save($artist);

		$name = 'Was Zu Sagen';
		$slug = Helper::slugify($name);
		$track2 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'b',
			'audio'  => $path . '/audio-' . strtolower($name) . '.mp3',
			'wave'   => $path . '/wave-' . strtolower($name) . '.jpg',
			'length' => '',
		]);
		$track2->artists()->save($artist2);

		/** record_track */
		$record->tracks()->save($track1);
		$record->tracks()->save($track2, [
			'order' => 1,
		]);
	}
}
