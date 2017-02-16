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
		$trackName = 'Goneta';
		$slug = Helper::slugify($trackName);
		$track = Track::create([
			'name'   => $trackName,
			'slug'   => $slug,
			'side'   => 'a',
			'audio'  => 'uploads/records/' . $slug . '-audio-0a211063d1d62e7c6ebd365344003fa2.mp3',
			'wave'   => 'uploads/records/' . $slug . '-wave-0a211063d1d62e7c6ebd361444003fa2.jpg',
			'length' => '10:20',
		]);
		$track->artists()->saveMany([
			Artist::where('name', 'Mihai Pol')->first(),
		]);

		$trackName = 'Science Friction';
		$slug = Helper::slugify($trackName);
		$track = Track::create([
			'name'   => $trackName,
			'slug'   => $slug,
			'side'   => 'b',
			'audio'  => 'uploads/records/' . $slug . '-audio-0a211063d1d62e7c6ebd365344003fa1.mp3',
			'wave'   => 'uploads/records/' . $slug . '-wave-0a211063d1d62e7c6e12361444003fa2.jpg',
			'length' => '9:40',
		]);
		$track->artists()->saveMany([
			Artist::where('name', 'Mihai Pol')->first(),
		]);

		$name = 'Goneta';
		$slug = Helper::slugify($name);
		$record = Record::create([
			'name'         => $name,
			'slug'         => $slug,
			'release_date' => '2016-05-30',
			'label_id'     => Label::where('name', 'Capodopere')->first()->id,
			'catalog'      => 'CPD002',
			'format'       => '1x12"',
			'description'  => 'We proudly present to you the second blissful vinyl only release on Capodopere Records headed by Mihai Pol. Side A will throw you inside a finger-snapping track with a satisfying beat that will be shadowing the composition for all the ten minutes of your experience. Going to the B side - dreamy keys and ambient sounds are the ones that guide this piece of art, leaving a hypnotic state - followed by an atmospheric and dubby finale. Taste it yourself.',
			'image'        => 'uploads/records/' . $slug . '-0a211063d1d62e7c6ebd365344003fa3.jpg',
			'price'        => '10',
			'stock'        => 3,
		]);
		$record->artists()->saveMany([
			Artist::where('name', 'Mihai Pol')->first(),
		]);
		$record->tracks()->saveMany([
			Track::where('name', 'Goneta')->first(),
			Track::where('name', 'Science Friction')->first(),
		]);
	}

	private function pamparam() {
		$trackName = 'Param';
		$slug = Helper::slugify($trackName);
		$track = Track::create([
			'name'   => $trackName,
			'slug'   => $slug,
			'side'   => 'a',
			'audio'  => 'uploads/records/' . $slug . '-audio-0a211063d1d62e7c6ebd365344003fa2.mp3',
			'wave'   => 'uploads/records/' . $slug . '-wave-0a211063d1d62e7c6ebd361444003fa2.jpg',
			'length' => '',
		]);
		$track->artists()->saveMany([
			Artist::where('name', 'Mihai Pol')->first(),
		]);

		$trackName = 'Pam';
		$slug = Helper::slugify($trackName);
		$track = Track::create([
			'name'   => $trackName,
			'slug'   => $slug,
			'side'   => 'b1',
			'audio'  => 'uploads/records/' . $slug . '-audio-0a211063d1d62e7c6ebd365344003fa1.mp3',
			'wave'   => 'uploads/records/' . $slug . '-wave-0a211063d1d62e7c6e12361444003fa2.jpg',
			'length' => '',
		]);
		$track->artists()->saveMany([
			Artist::where('name', 'Mihai Pol')->first(),
		]);

		$trackName = 'Pam';
		$slug = Helper::slugify($trackName);
		$track = Track::create([
			'name'   => $trackName,
			'slug'   => $slug,
			'side'   => 'b2',
			'audio'  => 'uploads/records/' . $slug . '-audio-0a211063d2362e7c6ebd365344003fa1.mp3',
			'wave'   => 'uploads/records/' . $slug . '-wave-0a211063d1342e7c6e12361444003fa2.jpg',
			'length' => '',
		]);
		$track->artists()->save(Artist::where('name', 'Mihai Pol')->first());
		$track->artists()->save(Artist::where('name', 'Suciu')->first(), [
			'order' => 1,
			'remix' => true,
		]);

		$name = 'Pamparam';
		$slug = Helper::slugify($name);
		$record = Record::create([
			'name'         => $name,
			'slug'         => $slug,
			'release_date' => '2017-04-20',
			'label_id'     => Label::where('name', 'Synesthesia')->first()->id,
			'catalog'      => 'SYNSTH001',
			'format'       => '1x12"',
			'description'  => '',
			'image'        => 'uploads/records/' . $slug . '-0a211063d1d62e7c6ebd365344003fa3.jpg',
			'price'        => '10',
			'stock'        => 3,
		]);
		$record->artists()->saveMany([
			Artist::where('name', 'Mihai Pol')->first(),
		]);
		$record->tracks()->saveMany([
			Track::where('name', 'Param')->first(),
			Track::where('name', 'Pam')->first(),
		]);
	}

	private function insideOut() {
		$artist = Artist::where('name', 'Suciu')->first();

		$trackName = 'Translucid';
		$slug = Helper::slugify($trackName);
		$track1 = Track::create([
			'name'   => $trackName,
			'slug'   => $slug,
			'side'   => 'a',
			'audio'  => 'uploads/records/' . $slug . '-audio-0a211063d1d62e7c6ebd365344003fa2.mp3',
			'wave'   => 'uploads/records/' . $slug . '-wave-0a211063d1d62e7c6ebd361444003fa2.jpg',
			'length' => '',
		]);
		$track1->artists()->save($artist);

		$trackName = 'Jesus Chrysler';
		$slug = Helper::slugify($trackName);
		$track2 = Track::create([
			'name'   => $trackName,
			'slug'   => $slug,
			'side'   => 'b',
			'audio'  => 'uploads/records/' . $slug . '-audio-0a211063d1d62e7c6ebd365344003fa1.mp3',
			'wave'   => 'uploads/records/' . $slug . '-wave-0a211063d1d62e7c6e12361444003fa2.jpg',
			'length' => '',
		]);
		$track2->artists()->save($artist);


		$name = 'Inside Out';
		$slug = Helper::slugify($name);
		$record = Record::create([
			'name'         => $name,
			'slug'         => $slug,
			'release_date' => '2016-12-13',
			'label_id'     => Label::where('name', 'Substantia Nigra')->first()->id,
			'catalog'      => 'SN001',
			'format'       => '1x12"',
			'description'  => '',
			'image'        => 'uploads/records/' . $slug . '-0a211063d1d62e7c6ebd365344003fa3.jpg',
			'price'        => '12',
			'stock'        => 6,
		]);
		$record->artists()->save($artist);
		$record->tracks()->save($track1, [
			'order' => 0,
		]);
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
		$slug = Helper::slugify($name);
		$record = Record::create([
			'name'         => $name,
			'slug'         => $slug,
			'release_date' => '2012-06-27',
			'label_id'     => $label->id,
			'catalog'      => 'AMP003',
			'format'       => '1x12"',
			'description'  => '',
			'image'        => 'uploads/records/' . $slug . '-0a211063d1d62e7c6ebd365344003fa3.jpg',
			'price'        => '20',
			'stock'        => 1,
		]);

		/** tracks */
		$name = 'Channeling';
		$slug = Helper::slugify($name);
		$track1 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'a',
			'audio'  => 'uploads/records/' . $slug . '-audio-0a211063d1d62e7c6ebd365344003fa2.mp3',
			'wave'   => 'uploads/records/' . $slug . '-wave-0a211063d1d62e7c6ebd361444003fa2.jpg',
			'length' => '',
		]);

		$name = 'Ex';
		$slug = Helper::slugify($name);
		$track2 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'b',
			'audio'  => 'uploads/records/' . $slug . '-audio-0a211063d1d62e7c6ebd365344003fa1.mp3',
			'wave'   => 'uploads/records/' . $slug . '-wave-0a211063d1d62e7c6e12361444003fa2.jpg',
			'length' => '',
		]);

		/** track_artist */
		$track1->artists()->save($artist);
		$track2->artists()->save($artist);

		/** record_artist */
		$record->artists()->save($artist);

		/** record_track */
		$record->tracks()->save($track1, [
			'order' => 0,
		]);
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
		$slug = Helper::slugify($name);
		$record = Record::create([
			'name'         => $name,
			'slug'         => $slug,
			'release_date' => '2014-04-10',
			'label_id'     => $label->id,
			'catalog'      => 'MEANDER014',
			'format'       => '1x12"',
			'description'  => '',
			'image'        => 'uploads/records/' . $slug . '-0a211063d1d62e7c6ebd365344003fa3.jpg',
			'price'        => '20',
			'stock'        => 1,
		]);

		/** tracks */
		$tracks = [];

		$name = 'Anatrack';
		$slug = Helper::slugify($name);
		$track1 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'a',
			'audio'  => 'uploads/records/' . $slug . '-audio-0a211063d1d62e7c6ebd365344003fa2.mp3',
			'wave'   => 'uploads/records/' . $slug . '-wave-0a211063d1d62e7c6ebd361444003fa2.jpg',
			'length' => '',
		]);

		$name = 'Change';
		$slug = Helper::slugify($name);
		$track2 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'b1',
			'audio'  => 'uploads/records/' . $slug . '-audio-0a211063d1d62e7c6ebd365344003fa1.mp3',
			'wave'   => 'uploads/records/' . $slug . '-wave-0a211063d1d62e7c6e12361444003fa2.jpg',
			'length' => '',
		]);

		$name = 'You Know';
		$slug = Helper::slugify($name);
		$track3 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'b2',
			'audio'  => 'uploads/records/' . $slug . '-audio-0a211063d1d62e7c6ebd365344003fa1.mp3',
			'wave'   => 'uploads/records/' . $slug . '-wave-0a211063d1d62e7c6e12361444003fa2.jpg',
			'length' => '',
		]);

		/** track_artist */
		$track1->artists()->save($artist);
		$track2->artists()->save($artist);
		$track3->artists()->save($artist);

		/** record_artist */
		$record->artists()->save($artist);

		/** record_track */
		$record->tracks()->save($track1, [
			'order' => 0,
		]);
		$record->tracks()->save($track2, [
			'order' => 1,
		]);
		$record->tracks()->save($track2, [
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
		$slug = Helper::slugify($name);
		$record = Record::create([
			'name'         => $name,
			'slug'         => $slug,
			'release_date' => '2014-11-24',
			'label_id'     => $label->id,
			'catalog'      => 'DIA002',
			'format'       => '1x12"',
			'description'  => '',
			'image'        => 'uploads/records/' . $slug . '-0a211063d1d62e7c6ebd365344003fa3.jpg',
			'price'        => '11',
			'stock'        => 5,
		]);
		$record->artists()->save($artist);
		$record->artists()->save($artist2);

		/** tracks */
		$name = 'Acajou';
		$slug = Helper::slugify($name);
		$track1 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'a',
			'audio'  => 'uploads/records/' . $slug . '-audio-0a211063d1d62e7c6ebd365344003fa2.mp3',
			'wave'   => 'uploads/records/' . $slug . '-wave-0a211063d1d62e7c6ebd361444003fa2.jpg',
			'length' => '',
		]);
		$track1->artists()->save($artist);

		$name = 'Was Zu Sagen';
		$slug = Helper::slugify($name);
		$track2 = Track::create([
			'name'   => $name,
			'slug'   => $slug,
			'side'   => 'b',
			'audio'  => 'uploads/records/' . $slug . '-audio-0a211063d1d62e7c6ebd365344003fa1.mp3',
			'wave'   => 'uploads/records/' . $slug . '-wave-0a211063d1d62e7c6e12361444003fa2.jpg',
			'length' => '',
		]);
		$track2->artists()->save($artist2);

		/** record_track */
		$record->tracks()->save($track1, [
			'order' => 0,
		]);
		$record->tracks()->save($track2, [
			'order' => 1,
		]);
	}
}
