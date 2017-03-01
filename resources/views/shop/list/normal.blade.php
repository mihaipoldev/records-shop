<div class="record-wrapper">
	<figure>
		<a href="#">
			<img src="{{ asset($record->image) }}"/>
			<span class="image-opacity"></span>
		</a>
		<div class="play-wrapper">
			<a href="#"><i class="fa fa-play-circle"></i></a>
		</div>
	</figure>

	<div class="details">
		<small class="text-muted">
			@foreach($record->artists as $index => $artist)
				@if($index != 0)
					,
				@endif
				{{ $artist }}
			@endforeach
		</small>

		<a href="{{ route('record.item', ['id'=>$record->id]) }}" class="product-name"> {{ $record }}</a>

		<div class="left-bottom">
            <span style="display: inline-block; margin-right: 5px; color: forestgreen">
                <em>in stock</em>
            </span>
			<a href="#" class="btn-add pull-right">&euro; {{ $record->price }} <i class="fa fa-cart-plus"></i> </a>
		</div>
	</div>
</div>