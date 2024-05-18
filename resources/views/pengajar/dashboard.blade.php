@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-sub-header">
                <h3 class="page-title">{{ __('Dashboard') }}</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{route('pengajar/dashboard')}}">{{ __('Dashboard') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

