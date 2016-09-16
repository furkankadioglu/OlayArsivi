@extends('masters.main')

@section('scripts')
@endsection

@section('content')
<div class="text-center">
	<h2>Rapor Bildirimi</h2>
		<br>
		@if($errors->has())
   @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
  @endforeach
@endif
</div>


<form action="{{ url('/Olaylar/') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="hidden" name="postCategory" value="report">
<input type="hidden" name="objeId" value="{{ $objeId }}">

<div class="block">
    <div class="block-content push-10-t form-horizontal">
            @if(Session::has('flash_message') && Session::has('flash_message_category'))
              <div class="alert alert-{{ Session::get('flash_message') }}">
              {{ Session::get('flash_message') }}
              </div>
            @endif
 
            <div class="row push-10-t">
            <div class="col-md-8 col-md-offset-2">
              <div class="form-group">
                      <div class="form-material floating">
                          <input class="form-control" id="material-text2" name="objeId" value="{{ $objeId }}" type="text" disabled="">
                          <label for="material-text2">Obje No</label>
                      </div>
              </div>
               <div class="form-group">
                      <div class="form-material floating">
                          <textarea name="description" id="material-text2" cols="10" rows="3" class="form-control"></textarea>
                          <label for="material-text2">Şikayet Sebebiniz</label>
                      </div>
              </div>

               <div class="form-group">
                      <div class="form-material floating">
                          <input class="form-control" id="material-text2" name="telefon" value="" type="text" >
                          <label for="material-text2">Telefon Numaranız</label>
                      </div>
              </div>

              <div class="form-group">
                      <div class="form-material floating">
                          <input class="form-control" id="material-text2" name="mail" placeholder="email@domain.com" type="text">
                          <label for="material-text2">Mail Adresiniz</label>
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
          <button class="btn btn-sm btn-primary" type="submit">Gönder</button>
      </div>
      <br><br>
    </div>
  </div>
</div>

</form>
@endsection