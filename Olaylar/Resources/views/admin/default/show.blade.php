@extends('masters.admin')

@section('title')
@endsection

@section('breadcrumb')
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection

@section('modals')
@endsection

@section('content')
@if($errors->has())
   @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
  @endforeach
@endif


<form action="{{ url('/admin/modules/Olaylar/'.$data->id) }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="hidden" name="postCategory" value="edit">
<input name="_method" type="hidden" value="PUT" />
<div class="block block-bordered">
    <div class="block-header bg-gray-lighter">
   	 	<ul class="block-options">
           @include('Olaylar::admin.navigation')
        </ul>
        <h3 class="block-title"><i class="fa fa-pencil"></i> OLAY BILGILERI</h3>
    </div>
    <div class="block-content push-10-t form-horizontal">
 
            <div class="row push-10-t">
            <div class="col-md-12">
	            <div class="col-md-6">
	            	<div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-text2" name="name" value="{{ $data->name }}" type="text" disabled="">
	                        <label for="material-text2">Olay Adı</label>
	                    </div>
	            </div>
	            </div>
	            
	            <div class="col-md-6">
	            	<div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-text2" name="olusturan" value="{{ $data->user->username }}" type="text" disabled="">
	                        <label for="material-text2">Oluşturan</label>
	                    </div>
	            </div>
	            </div>
	            <div class="col-md-6">
	            	<div class="form-group">
	                    <div class="form-material floating">
	                        <input class="js-datepicker form-control" type="text" id="example-datepicker4" name="baslangicTarihi" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="{{ $data->baslangicTarihi }}" disabled="">
	                        <label for="material-text2">Başlangıç Tarihi</label>
	                    </div>
	            </div>
	            </div>
	            <div class="col-md-6">
	            	<div class="form-group">
	                    <div class="form-material floating">
	                        <input class="js-datepicker form-control" type="text" id="example-datepicker4" name="bitisTarihi" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="{{ $data->bitisTarihi }}" disabled="">
	                        <label for="material-text2">Bitiş Tarihi</label>
	                    </div>
	            </div>
	            </div>
	       
	         </div>
            </div>
            <br>
        
    </div>
</div>
<div class="block block-bordered">
    <div class="block-header bg-gray-lighter">
   	 	<ul class="block-options">
           @include('Olaylar::admin.navigation')
        </ul>
        <h3 class="block-title"><i class="fa fa-pencil"></i> OLAY OBJELERI</h3>
    </div>
    <div class="block-content push-10-t form-horizontal">
 			<div class="row">
 				<ul class="list list-timeline pull-t">
					@foreach($data->objeler as $obje)
	                <li>
	                  	  <div class="list-timeline-time">{{ $obje->created_at }}</div>
	                    <i class="{{ $obje->tip->icon }} list-timeline-icon bg-primary"></i>
	                    <div class="list-timeline-content">
	                  		
	                        <p class="font-w600">{{ $obje->tip->name }}</p>
	                        <p class="font-s13">{{ $obje->sourceUrl }} [<a class="confirm" href="{{ url('/admin/modules/Olaylar/'.$data->id.'/'.$obje->id.'/delete') }}">X</a>]</p>
	                    </div>
	                </li>
	                @endforeach
	                <!-- END System Notification -->
	            </ul>
 			</div>
    </div>
</div>

</form>
@endsection