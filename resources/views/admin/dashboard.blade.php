@extends('layouts.admin.main')
@section('headerTitle', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="widget card">
                <div class="card-block">
                    <h5 class="card-title">Dashboard, Hi {{ \Auth::user()->name }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('admin-assets/js/dashboard/dashboard.js') }}"></script>
@endpush