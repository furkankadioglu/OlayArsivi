@extends('masters.main')

@section('content')

@extends('masters.main')

@section('content')
@if(Auth::check())
<script>
       function BegeniEkle(EntryID)
       {
	        var tag = $(this);
	        $.post("{{ url('/Olaylar/')}}", { userId: {{ Auth::user()->id }}, postCategory: "begeniEkle", dataId: EntryID, _token: "{{ csrf_token() }}" },

	        function(data) 
	        {
	        $("span.begenisonuc_" + EntryID).html('Liked');
	        	console.log("Like: Ok");
			});
    	}

    	function FavoriEkle(EntryID)
       {
	        var tag = $(this);
	        $.post("{{ url('/Olaylar/')}}", { userId: {{ Auth::user()->id }}, postCategory: "favoriEkle", dataId: EntryID, _token: "{{ csrf_token() }}" },

	        function(data) 
	        {
	        $("span.favorisonuc_" + EntryID).html('Added');
	        	console.log("Like: Ok");
			});
    	}
</script>
@endif

<div class="block">
    <div class="block-header">
        <div class="clearfix">
                @if(Auth::check())
                <div class="pull-right"><a class="btn btn-xs btn-default" href="{{ url('/Olaylar/Objeler/create/'.$data->id) }}"><div class="btn-group"><i class="fa fa-plus "></i></div>  Yeni Obje </a> </div>
                @endif
        </div>

            <div class="push-5-t text-center">
                <a class="h1" href="{{ url('/Olaylar/'.$data->slug)}}">{{ $data->name }}</a><br>
                <i>{{ $data->baslangicTarihi }}</i> - <i>{{ $data->bitisTarihi }}</i> <br>
            </div>
    </div>
    <div class="block-content block-content-full">
        <p class="push-10 pull-t"></p>

        <div class="col-md-12">
        	{{ str_limit($data->description, 180, "...") }}
        </div>
        <div class="row"><br><br><br></div>
        <div class="row">
        	@if($data->objeler)
        @foreach($data->sonObjeler as $obje)
            <div class="col-md-4">
            <div class="block block-bordered block-rounded">
                <div class="block-content">
                    <div class="push-10 bg-primary text-center text-white">
                    <br>
                        <span class="text-white"><a href="{{ url('/Olaylar/redirect/'.$obje->slug) }}" target="_blank" class="text-white" data-toggle="tooltip" title="{{ $obje->tip->name }}: {{ $obje->sourceUrl }}"><i class="fa {{ $obje->tip->icon }} fa-4x"></i></a></span>
                        <br>
                        <br>
                    </div>
                    <div class="push-10 clearfix text-center">
                        <a class="font-w600" href="{{ url('/Olaylar/redirect/'.$obje->slug) }}" target="_blank" data-toggle="tooltip" title="{{ $obje->tip->name }}: {{ $obje->sourceUrl }}">{{ $obje->name }}</a> <i>(<a href="{{ url('/Olaylar/Objeler/rapor/'.$obje->id) }}"><i class="fa fa-flag"></i></a>)</i>
                    </div>
                </div>
            </div>
            </div>
        @endforeach
        @endif

        </div>
        @if(Auth::check())
		<hr>
        <div class="row text-center font-s13">
      @if($data->varmi("like") == 1)
            <div class="col-xs-6">
                <a class="font-w600 text-gray-dark" href="javascript:void(0)" onclick="return BegeniEkle({{ $data->id }});">
                    <i class="fa fa-thumbs-up push-5-r"></i>
                    <span class="hidden-xs begenisonuc_{{ $data->id }}">Liked</span>
                </a>
            </div>

            @else
             <div class="col-xs-6">
                <a class="font-w600 text-gray-dark" href="javascript:void(0)" onclick="return BegeniEkle({{ $data->id }});">
                    <i class="fa fa-thumbs-up push-5-r"></i>
                    <span class="hidden-xs begenisonuc_{{ $data->id }}">Like</span>
                </a>
            </div>
            @endif
            @if($data->varmi("favori") == 1)
            <div class="col-xs-6">
                <a class="font-w600 text-gray-dark" href="javascript:void(0)" onclick="return FavoriEkle({{ $data->id }});">
                    <i class="fa fa-star push-5-r"></i>
                    <span class="hidden-xs favorisonuc_{{ $data->id }}">Added</span>
                </a>
            </div>
            @else
            <div class="col-xs-6">
                <a class="font-w600 text-gray-dark" href="javascript:void(0)" onclick="return FavoriEkle({{ $data->id }});">
                    <i class="fa fa-star push-5-r"></i>
                    <span class="hidden-xs favorisonuc_{{ $data->id }}">Favorite</span>
                </a>
            </div>
            @endif
        </div>
        @endif

    </div>
</div>
</div>
</div>
</div>


@endsection

@endsection