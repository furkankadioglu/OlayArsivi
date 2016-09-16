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
        <h3 class="block-title"><i class="fa fa-pencil-square-o"></i> {{ $headName }}</h3>
    </div>
    
    <div class="row">

    <div class="block-content">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table class="table table-bordered table-striped js-dataTable-full">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Sebep</th>
                    <th>Telefon</th>
                    <th>Olay</th>
                    <th>Mail</th>
                    <th>Obje URL</th>
                    <th class="text-center" style="width: 10%;">*</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
              		<tr>
              			<td>{{ $data->id }}</td>
              			<td><span data-toggle="tooltip" title="{{ $data->description }}">{{ str_limit($data->description, 30, "...") }}</span></td>
              			<td>{{ $data->telefon }}</td>
                    <td><a href="{{ url('/Olaylar/'.$data->obje->olay->slug) }}" target="_blank">{{ $data->obje->olay->name }}</a></td>
              			<td>{{ $data->mail }}</td>
              			<td><a href="{{ $data->obje->sourceUrl }}" target="_blank"><i class="fa fa-link"></i></a> <span data-toggle="tooltip" title="{{ $data->obje->sourceUrl }}">{{ str_limit($data->obje->sourceUrl, 15, "...") }}</td>
              			<td class="text-center">
                       <div class="btn-group">
                          <a class="btn btn-xs btn-default" href="{{ url('admin/modules/Olaylar/raporlar/'.$data->id.'/edit') }}" data-toggle="tooltip" title="Objeyi Kaldır ve Sil"><i class="fa fa-check"></i></a>
                          <a class="btn btn-xs btn-default confirm" href="{{ url('admin/modules/Olaylar/raporlar/'.$data->id.'/delete') }}" data-toggle="tooltip" title="Sil"><i class="fa fa-times"></i></a>
                      </div>   
                    </td>
              		</tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection



