@extends('masters.main')

@section('scripts')
<script>

        // Init datepicker (with .js-datepicker and .input-daterange class)
        $('.js-datepicker').add('.datespicker').datepicker({
            weekStart: 1,
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
        });

</script>
@endsection

@section('content')
<div class="text-center">
	<h2>Tarihe Göre Olaylar</h2>
		<br>
		@if($errors->has())
   @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
  @endforeach
@endif

		    <form method="post" action="{{ url('/Olaylar') }}" class="space20">

		{{ csrf_field() }}
		<input type="hidden" name="postCategory" value="dateSearch">
	            <div class="col-md-8 col-md-offset-2">
	                <div class="input-daterange input-group datespicker" data-date-format="mm/dd/yyyy">
	                    <input class="form-control" type="text" id="example-daterange1" name="date1" placeholder="From">
	                    <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
	                    <input class="form-control" type="text" id="example-daterange2" name="date2" placeholder="To">
	                </div>
	            </div>
	             <div class="col-md-8 col-md-offset-2 text-center">
                        <div class="form-material">
                             <button class="btn btn-sm btn-primary" type="submit">Ara</button>
                		</div>
	            </div>
	     </form>
</div>

@endsection