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
        <h3 class="block-title"><i class="fa fa-pencil"></i> {{ $headName }} EDIT</h3>
    </div>
    <div class="block-content push-10-t form-horizontal">
 
            <div class="row push-10-t">
            <div class="col-md-8 col-md-offset-2">
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-text2" name="name" value="{{ $data->name }}" type="text">
	                        <label for="material-text2">Olay Adı</label>
	                    </div>
	            </div>
	            
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-text2" name="slug" value="{{ $data->slug }}" type="text">
	                        <label for="material-text2">Olay Slug</label>
	                    </div>
	            </div>
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-text2" name="olusturan" value="{{ $data->user->username }}" type="text" disabled="">
	                        <label for="material-text2">Oluşturan</label>
	                    </div>
	            </div>
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="js-datepicker form-control" type="text" id="example-datepicker4" name="baslangicTarihi" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="{{ $data->baslangicTarihi }}">
	                        <label for="material-text2">Başlangıç Tarihi</label>
	                    </div>
	            </div>
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="js-datepicker form-control" type="text" id="example-datepicker4" name="bitisTarihi" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="{{ $data->bitisTarihi }}">
	                        <label for="material-text2">Bitiş Tarihi</label>
	                    </div>
	            </div>
	       
	         </div>
            </div>
            <br>
        
    </div>
</div>

<div class="block block-bordered">
	<div class="block-content">
		<div class="form-group">
	    <div class="col-sm-12 text-center">
	        <button class="btn btn-sm btn-primary" type="submit">Save</button>
	    </div>
	    <br><br>
		</div>
	</div>
</div>

</form>
@endsection