<div class="record-wrapper">
    <figure>
        <a href="#">
            <img src="{{ asset($record->image_path) }}"/>
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
                {{ $artist->name }}
            @endforeach
        </small>

        <a href="{{ route('record.item', ['id'=>$record->id]) }}" class="product-name"> {{ $record->name }}</a>
        {{--<i class="fa fa-circle"></i>--}}
        <div class="left-bottom">
                                <span style="display: inline-block; margin-right: 5px; color: forestgreen">
                                    <em>in stock</em>
                                </span>
            <a href="#" class="btn-add pull-right">&euro; {{ $record->label_id }} <i class="fa fa-cart-plus"></i> </a>
        </div>

        {{--<a href="{{ route('record', ['id'=>$record->id]) }}">--}}
        {{--@foreach($record->artists as $index => $artist)--}}
        {{--@if($index != 0)--}}
        {{--,--}}
        {{--@endif--}}
        {{--{{ $artist->name }}--}}
        {{--@endforeach--}}
        {{--– {{ $record->title }}</a>--}}
    </div>
</div>