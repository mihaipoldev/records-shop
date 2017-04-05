<form method="post" action="{{ route('admin.record.save', ['record_id' => $record->id]) }}">
	<div class="row row-10">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Name:</label>
				<input class="form-control" type="text" name="name" placeholder="Name" required
				       value="{{ old('name') ? old('name') : $record->name ? $record->name : '' }}">
			</div>

			<div class="form-group">
				<label class="control-label">Label:</label>

				<div class="items-selected">
					<span id="label-text" style="display: inline-block; height: 20px; line-height: 20px;">
						{{ $record->label ? $record->label : 'No Label Selected' }}
					</span>

					<input id="label-input" type="hidden" name="label_id" value="{{ $record->label ? $record->label->id : '' }}"/>

					<a class="pull-right ajax-labels-btn" data-url="{{ route('ajax.record.labels', ['record_id' => $record]) }}" data-toggle="modal" data-target="#modal">
						<i class="fa fa-cog" style="font-size: 20px; color: #555"></i>
					</a>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label">Release Date:</label>
				<input class="form-control" type="date" name="release_date" required
				       value="{{ old('release_date') ? old('release_date') : $record->release_date ? $record->release_date : '' }}">
			</div>

			<div class="row row-5">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Catalog:</label>
						<input class="form-control" type="text" name="catalog" placeholder="Catalog" required
						       value="{{ old('catalog') ? old('catalog') : $record->catalog ? $record->catalog : '' }}">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Format:</label>
						<input class="form-control" type="text" name="format" placeholder="Format" required
						       value="{{ old('format') ? old('format') : $record->format ? $record->format : '' }}">
					</div>
				</div>
			</div>
		</div>

		{{-- ATANTION!!!!!! cand e new record nu se poate adauga imagine (pt ca nu am slug) --}}
		<div class="col-md-6">
			<figure class="record-artwork">
				<img id="record-image" class="form-image" src="{{ asset($record->image ? $record->image : '/uploads/no-image.png') }}" style="width: 100%;"/>

				<div id="ceva">

				</div>
				<input id="record-image-input" class="hidden" type="file" data-url="{{ route('admin.record.save.image', ['record_id' => $record->id]) }}"/>
				<label for="record-image-input" class="change-btn">Change</label>

				<div class="background"></div>
			</figure>

			<div>
				<a class="ajax-btn" data-url="{{ route('record.colors', ['record_id' => $record->id]) }}" data-target="#modal" data-toggle="modal">
					Change Colors
				</a>
			</div>
		</div>

		<div class="col-md-12">
			<div id="artists-form-group" class="form-group clearfix">
				<label class="control-label">Artists:</label>

				<div class="items-selected">
					<div id="artists-display" class="clearfix" style="width: 80%; display: inline-block">
						@foreach($record->artists as $artist)
							<div class="artist-selection" data-artist-id="{{ $artist->id }}">
								<span>{{ $artist->name }}</span>
								<i class="fa fa-cog artist-edit" data-url="{{ route('ajax.record.artist.editor', ['artist_id' => $artist->id]) }}" data-toggle="modal"
								   data-target="#artists-modal"></i>
								<i class="fa fa-remove artist-remove" data-delete-url="{{ route('ajax.record.artist.delete', ['artist_id' => $artist->id]) }}"></i>
								<input class="artist-input" type="hidden" name="artists[]" value="{{ $artist->id }}"/>
							</div>
						@endforeach
					</div>

					<a id="manage-artists-btn" class="pull-right clearfix" data-url="{{ route('ajax.record.artists') }}" data-toggle="modal" data-target="#artists-modal">
						<i class="fa fa-cog" style="font-size: 20px; color: #555"></i>
					</a>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Price:</label>
				<input class="form-control" type="number" name="price" placeholder="Price" required
				       value="{{ old('price') ? old('price') : $record->price ? $record->price : '' }}">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Stock:</label>
				<input class="form-control" type="number" name="stock" placeholder="Stock" required
				       value="{{ old('stock') ? old('stock') : $record->stock ? $record->stock : '' }}">
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Description:</label>
				<textarea class="form-control" name="description" rows="5" placeholder="Description"
				          required>{{ old('description') ? old('description') : $record->description ? $record->description : '' }}</textarea>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Description:</label>
				<textarea class="form-control" name="description" rows="5" placeholder="Description"
				          required>{{ old('description') ? old('description') : $record->description ? $record->description : '' }}</textarea>
			</div>
		</div>

		{{ csrf_field() }}

		<div class="col-md-12">
			<button class="btn btn-primary pull-right" type="submit">Save changes</button>
		</div>
	</div>
</form>