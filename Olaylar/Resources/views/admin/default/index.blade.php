@extends('masters.admin')

@section('breadcrumb')
{{ $headName }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ url('assets/admin/js/plugins/datatables/jquery.dataTables.min.css') }}">
@endsection

@section('scripts')
<script src="{{ url('assets/admin/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/admin/js/pages/base_tables_datatables.js') }}"></script>
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

@section('modals')

@endsection


@section('content')
<div class="block block-bordered">
    <div class="block-header bg-gray-lighter">
   	 	<ul class="block-options">
           @include('Olaylar::admin.navigation')
        </ul>
        <h3 class="block-title"><i class="fa fa-pencil-square-o"></i> Olay Ara</h3>
    </div>
    
    <div class="row">
	    <div class="block-content">
	    <form method="post" action="{{ url('/admin/modules/Olaylar') }}" class="space20">
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
                             <button class="btn btn-sm btn-primary" type="submit">Search</button>
                		</div>
	            </div>
	     </form>
	    </div>
	</div>
</div>
<br>

<div class="block block-bordered">
    <div class="block-header bg-gray-lighter">
   	 	<ul class="block-options">
           @include('Olaylar::admin.navigation')
        </ul>
        <h3 class="block-title"><i class="fa fa-pencil-square-o"></i> {{ $headName }}</h3>
    </div>
    
    <div class="row">

    <div class="block-content">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table class="table table-bordered table-striped js-dataTable-full">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Başlangıç Tarihi</th>
                    <th>Bitiş Tarihi</th>
                    <th>Toplam Obje Sayısı</th>
                    <th>Toplam Görüntülenme Sayısı</th>
                    <th class="text-center" style="width: 10%;">Status</th>
                    <th class="text-center" style="width: 10%;">*</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
              		<tr>
              			<td>{{ $data->id }}</td>
              			<td>{{ $data->name }}</td>
              			<td>{{ $data->baslangicTarihi }}</td>
              			<td>{{ $data->bitisTarihi }}</td>
              			<td>{{ $data->toplamObjeSayisi }}</td>
              			<td>{{ $data->toplamGoruntulenmeSayisi }}</td>
              			<td>{{ ($data->status == 1) ? "Aktif" : "Pasif" }}</td>
              			<td class="text-center">
                       <div class="btn-group">
                          <a class="btn btn-xs btn-default" href="{{ url('admin/modules/Olaylar/'.$data->id) }}" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                          <a class="btn btn-xs btn-default" href="{{ url('admin/modules/Olaylar/'.$data->id.'/edit') }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-xs btn-default confirm" href="{{ url('admin/modules/Olaylar/'.$data->id.'/delete') }}" ><i class="fa fa-times"></i></a>
                      </div>   
                    </td>
              		</tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection



