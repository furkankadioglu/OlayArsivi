@extends('masters.main')

@section('blankcontent')
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
@if($datas != "[]")
	@foreach($datas as $data)
<div class="block">
@if(Session::has('flash_message') && Session::has('flash_message_category'))
    <div class="alert alert-{{ Session::get('flash_message') }}">
    {{ Session::get('flash_message') }}
    </div>
@endif
    <div class="block-header">
        <div class="clearfix">
            <div class="pull-left push-15-r">
                  @if(!is_null($data->user->photo))
	                <img src="{{ url('/uploads/photos/125px_'.$data->user->photo->fileName) }}" class="img-avatar img-avatar-48" alt="">
	                @else
	                <img src="http://placehold.it/150x150" class="img-avatar img-avatar-thumb img-avatar-48" alt="">
	                @endif
            </div>
            <div class="push-5-t">
                <a class="font-w600" href="{{ url('/Olaylar/'.$data->slug)}}">{{ $data->name }}</a> <span class="font-s12"></span><br>
                <a class="font-s12" href="{{ url('/Users/'.$data->user->slug)}}">{{ $data->user->username }}</a> - <span class="font-s12 text-muted">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->diffForHumans() }} <br><i>({{ $data->baslangicTarihi }} - {{ $data->bitisTarihi }})</i></span>

            </div>
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
            <div class="col-xs-4">
                <a class="font-w600 text-gray-dark" href="javascript:void(0)" onclick="return BegeniEkle({{ $data->id }});">
                    <i class="fa fa-thumbs-up push-5-r"></i>
                    <span class="hidden-xs begenisonuc_{{ $data->id }}">Liked</span>
                </a>
            </div>

            @else
             <div class="col-xs-4">
                <a class="font-w600 text-gray-dark" href="javascript:void(0)" onclick="return BegeniEkle({{ $data->id }});">
                    <i class="fa fa-thumbs-up push-5-r"></i>
                    <span class="hidden-xs begenisonuc_{{ $data->id }}">Like</span>
                </a>
            </div>
            @endif
            @if($data->varmi("favori") == 1)
            <div class="col-xs-4">
                <a class="font-w600 text-gray-dark" href="javascript:void(0)" onclick="return FavoriEkle({{ $data->id }});">
                    <i class="fa fa-star push-5-r"></i>
                    <span class="hidden-xs favorisonuc_{{ $data->id }}">Added</span>
                </a>
            </div>
            @else
            <div class="col-xs-4">
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

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        {{ $datas->links() }}
    </div>
</div>


	@endforeach
@else
    <div class="row">
            <div class="block-content block-content-full">
            <div class="text-center"><span class="font-w600">Aranan kriterlerde bir olay bulunamadı.</span></div>
            </div>
    </div>
@endif

@endsection