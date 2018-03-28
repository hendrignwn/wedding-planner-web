@extends('layouts.admin.main')
@section('headerTitle', 'Partner #' . $model->id)
@section('pageTitle', 'Partner #' . $model->id)

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    
                    <div class="pull-left mrg-btm-20">
                        <a href="{{ route('user-relation.index') }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                        <a href="{{ route('user-relation.edit', ['id' => $model->id]) }}" class="btn btn-primary btn-rounded btn-sm">Update Partner</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="20%">ID</th>
                                    <td>{{ $model->id }}</td>
                                </tr>
                                <tr>
                                    <th> Relation </th>
                                    <td> {{ $model->getRelationName() }} </td>
                                </tr>
                                <tr>
                                    <th> Wedding Day </th>
                                    <td> {{ \Carbon\Carbon::parse($model->wedding_day)->format('d M Y') }} </td>
                                </tr>
                                <tr>
                                    <th> Venue </th>
                                    <td> {{ $model->venue }} </td>
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
                                <h4>Male</h4>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th width="20%">ID</th>
                                            <td>{{ $model->maleUser->id }}</td>
                                        </tr>
                                        <tr>
                                            <th> Name </th>
                                            <td>
                                                <a href="{!! route('user-app.show', ['id' => $model->maleUser->id]) !!}">
                                                    {{ $model->maleUser->name }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Email </th>
                                            <td>{{ $model->maleUser->email }}</td>
                                        </tr>
                                        <tr>
                                            <th> Phone </th>
                                            <td>{{ $model->maleUser->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th> Last Login At </th>
                                            <td>{{ $model->maleUser->last_login_at }}</td>
                                        </tr>
                                        <tr>
                                            <th> Created At </th>
                                            <td>{{ $model->maleUser->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th> Updated At </th>
                                            <td>{{ $model->maleUser->updated_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-block">

                            <div class="pull-left mrg-btm-20">
                                <h4>Female</h4>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th width="20%">ID</th>
                                            <td>{{ $model->femaleUser->id }}</td>
                                        </tr>
                                        <tr>
                                            <th> Name </th>
                                            <td>
                                                <a href="{!! route('user-app.show', ['id' => $model->femaleUser->id]) !!}">
                                                    {{ $model->femaleUser->name }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Email </th>
                                            <td>{{ $model->femaleUser->email }}</td>
                                        </tr>
                                        <tr>
                                            <th> Phone </th>
                                            <td>{{ $model->femaleUser->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th> Last Login At </th>
                                            <td>{{ $model->femaleUser->last_login_at }}</td>
                                        </tr>
                                        <tr>
                                            <th> Created At </th>
                                            <td>{{ $model->femaleUser->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th> Updated At </th>
                                            <td>{{ $model->femaleUser->updated_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-block">

                            <div class="pull-left mrg-btm-20">
                                <h4>Cost</h4>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th style="text-align:right">Cost</th>
                                        </tr>
                                    </thead>
                                    @php
                                    $no = 1;
                                    $grandCost = 0;
                                    @endphp
                                    @foreach ($model->getListCosts() as $cost)
                                    <tbody>
                                        <tr>
                                            <th>{!! $no++ !!}</th>
                                            <th>{!! $cost->content->name !!}</th>
                                            <th style="text-align:right">{!! \App\Helpers\FormatConverter::rupiahFormat($cost->value) !!}</th>
                                        </tr>
                                    </tbody>
                                        @php
                                            $grandCost += $cost->value;
                                        @endphp
                                    @endforeach
                                    <tfoot class="label-info">
                                        <tr>
                                            <th>#</th>
                                            <th>Total</th>
                                            <th style="text-align:right">{!! \App\Helpers\FormatConverter::rupiahFormat($grandCost) !!}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-block">

                            <div class="pull-left mrg-btm-20">
                                <h4>Concepts</h4>
                            </div>

                            <div class="table-responsive">
                                <table id="concept-table" class="table table-lg table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <td></td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

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
oTable = $('#concept-table').DataTable({
    processing: true,
    serverSide: true,
    dom: 'lBfrtip',
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
    url: '{!! route('concept.user-data', ['userRelationId' => $model->id]) !!}',
        data: function (d) {
            d.range = $('input[name=drange]').val();
        }
    },
    columns: [
		{ data: "rownum", name: "rownum" },
		{ data: "name", name: "name" },
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