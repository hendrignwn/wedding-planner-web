@extends('layouts.admin.main')
@section('headerTitle', 'Vendor #' . $model->id)
@section('pageTitle', 'Vendor #' . $model->id)

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    
                    <div class="pull-left mrg-btm-20">
                        <a href="{{ route('vendor.index') }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                        <a href="{{ route('vendor.edit', ['id'=>$model->id]) }}" class="btn btn-success btn-rounded btn-sm"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Update</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="20%">ID</th>
                                    <td>{{ $model->id }}</td>
                                </tr>
                                <tr>
                                    <th> Category </th>
                                    <td> {{ $model->category }} </td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $model->name }} </td>
                                </tr>
                                <tr>
                                    <th> Description </th>
                                    <td> {{ $model->description }} </td>
                                </tr>
                                <tr>
                                    <th> Image </th>
                                    <td> {!! $model->getFileImg() !!} </td>
                                </tr>
                                <tr>
                                    <th> Image Thumbnail </th>
                                    <td> {!! $model->getFileThumbImg() !!} </td>
                                </tr>
                                <tr>
                                    <th> Website </th>
                                    <td> {!! $model->website !!} </td>
                                </tr>
                                <tr>
                                    <th> Instagram </th>
                                    <td> {!! $model->instagram !!} </td>
                                </tr>
                                <tr>
                                    <th> Address </th>
                                    <td> {!! $model->address !!} </td>
                                </tr>
                                <tr>
                                    <th> Phone </th>
                                    <td> {!! $model->phone !!} </td>
                                </tr>
                                <tr>
                                    <th> Created At </th>
                                    <td> {{ $model->created_at }} </td>
                                </tr>
                                <tr>
                                    <th> Updated At </th>
                                    <td> {{ $model->updated_at }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="card">
                        <div class="card-block">

                            <div class="pull-left mrg-btm-20">
                                <h4>Detail Lists</h4>
                            </div>

                            <div class="table-responsive">
                                <table id="detail-table" class="table table-lg table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Value</th>
                                            <th>Created at</th>
                                            <th>Updated At</th>
                                            <td></td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{ url('admin/vendor-detail/create', ['vendorId'=>$model->id]) }}" class="btn btn-primary btn-rounded">Add New Detail</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
</div>
@endsection

@push('script')
<script>
var oTable;
oTable = $('#detail-table').DataTable({
    processing: true,
    serverSide: true,
    dom: 'lBfrtip',
    order:  [[ 3, "asc" ]],
    pagingType: 'full_numbers',
    buttons: [
        {
            extend: 'print',
            autoPrint: true,
            customize: function ( win ) {
                $(win.document.body)
                    .css( 'padding', '2px' )
                    .prepend(
                        '<img src="{{asset('img/logo.png')}}" style="float:right; top:0; left:0;height: 40px;right: 10px;background: #101010;padding: 8px;border-radius: 4px" /><h5 style="font-size: 9px;margin-top: 0px;"><br/><font style="font-size:14px;margin-top: 5px;margin-bottom:20px;"> Report Concept</font><br/><br/><font style="font-size:8px;margin-top:15px;">{{date('Y-m-d h:i:s')}}</font></h5><br/><br/>'
                    );


                $(win.document.body).find( 'div' )
                    .css( {'padding': '2px', 'text-align': 'center', 'margin-top': '-50px'} )
                    .prepend(
                        ''
                    );

                $(win.document.body).find( 'table' )
                    .addClass( 'compact' )
                    .css( { 'font-size': '9px', 'padding': '2px' } );


            },
            title: '',
            orientation: 'landscape',
            exportOptions: {columns: ':visible'} ,
            text: '<i class="fa fa-print" data-toggle="tooltip" title="" data-original-title="Print"></i>',
            //className: 'btn btn-primary'
        },
        {extend: 'colvis', text: '<i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="Column visible"></i>'},
        {extend: 'csv', text: '<i class="fa fa-file-excel-o" data-toggle="tooltip" title="" data-original-title="Export CSV"></i>'}
    ],
    //sDom: "<'table-responsive fixed't><'row'<p i>> B",
    sPaginationType: "bootstrap",
    destroy: true,
    responsive: true,
    scrollCollapse: true,
    oLanguage: {
        "sLengthMenu": "_MENU_ ",
        "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
    },
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    ajax: {
    url: '{!! route('content-detail.data', ['id' => $model->id]) !!}',
        data: function (d) {
            d.range = $('input[name=drange]').val();
        }
    },
    columns: [
		{ data: "rownum", name: "rownum" },
		{ data: "name", name: "name" },
		{ data: "value", name: "value" },
		{ data: "created_at", name: "created_at", visible:false },
		{ data: "updated_at", name: "updated_at" },
        { data: "action", name: "action", searchable: false, orderable: false },
    ],
}).on( 'processing.dt', function ( e, settings, processing ) {if(processing){Pace.start();} else {Pace.stop();}});

$("#concept-table_wrapper > .dt-buttons").appendTo("div.export-options-container");

$('#formsearch').submit(function () {
    oTable.search( $('#search-table').val() ).draw();
    return false;
} );

oTable.page.len(25).draw();

function modalDelete(id) {
    $('#modal-delete').modal('show');
    $('#delete_value').val(id);
}

function deleteRecord(){
    $('#modal-delete').modal('hide');
    var id = $('#delete_value').val();
    $.ajax({
        url: '{{route("user.index")}}' + "/" + id + '?' + $.param({"_token" : '{{ csrf_token() }}' }),
        type: 'DELETE',
        complete: function(data) {
            oTable.draw();
        }
    });
}

</script>
@endpush