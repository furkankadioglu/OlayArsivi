@extends('masters.main')

@section('scripts')
<script>
    var i = 0;
    function AddInput(Type, displayType)
    {
      i++;
      input = jQuery('<div class="form-group" id="' + i +'">\
                      <div class="floating">\
                          <div class="col-md-10"><input class="form-control" name="' + Type +'[]" placeholder="' + displayType + '" type="text"></div>\
                          <div class="col-md-2"><div class="btn-group"><a class="btn btn-xs btn-default" onclick="return deleteInput(' + i +');" data-toggle="tooltip" title="Show">X</a></div></div>\
                      </div>\
              </div>');
      $('#' + Type).append(input);
    }

    function deleteInput(ID)
    {
      jQuery('#' + ID).remove();
    }
</script>
@endsection

@section('content')
<div class="text-center">
	<h2>{{ $olay->name }} <br><small>Yeni Obje</small></h2>
		<br>
		@if($errors->has())
   @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
  @endforeach
@endif

  


</div>
<script>

        // Init datepicker (with .js-datepicker and .input-daterange class)
        $('.js-datepicker').add('.datespicker').datepicker({
            weekStart: 1,
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
        });

</script>
<form action="{{ url('/Olaylar/') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="hidden" name="postCategory" value="add">
<input type="hidden" name="olayId" value="{{ $olay->id }}">

<div class="block">
    <div class="row">
    <br>
      <div class="col-md-8 col-md-offset-2">
        <div class="col-md-4">
          <a class="block block-link-hover2 text-center" onclick="return AddInput('links', 'Link Url');">
              <div class="block-content block-content-full bg-primary">
                  <i class=" fa-2x fa fa-link fa-align-justify text-white"></i>
                  <div class="font-w600 text-white-op push-15-t">Link</div>
              </div>
          </a>
          </div>
          <div class="col-md-4">
          <a class="block block-link-hover2 text-center" onclick="return AddInput('photos', 'Photo Url');">
              <div class="block-content block-content-full bg-primary">
                  <i class=" fa-2x fa fa-picture-o fa-align-justify text-white"></i>
                  <div class="font-w600 text-white-op push-15-t">Photo</div>
              </div>
          </a>
          </div>
          <div class="col-md-4">
          <a class="block block-link-hover2 text-center" onclick="return AddInput('videos', 'Video Url');">
              <div class="block-content block-content-full bg-primary">
                  <i class=" fa-2x fa fa-camera fa-align-justify text-white"></i>
                  <div class="font-w600 text-white-op push-15-t">Video</div>
              </div>
          </a>
          </div>
    </div>
    </div>
    <div class="row">
      <div class="block-content push-10-t form-horizontal">
      <div class="col-md-8 col-md-offset-2">
      <div id="links"></div>
      <div id="photos"></div>
      <div id="videos"></div>
      </div>
            
        
    </div>
    </div>
</div>
<div class="block block-bordered">
  <div class="block-content">
    <div class="form-group">
      <div class="col-sm-12 text-center">
          <button class="btn btn-sm btn-primary" type="submit">Ekle</button>
      </div>
      <br><br>
    </div>
  </div>
</div>

</form>
@endsection