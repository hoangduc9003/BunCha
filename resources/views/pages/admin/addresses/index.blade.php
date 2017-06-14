@extends('layouts.admin.application', ['menu' => 'addresses'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
<script src="{!! \URLHelper::asset('js/delete_item.js', 'admin') !!}"></script>
@stop

@section('title')
@stop

@section('header')
Addresses
@stop

@section('breadcrumb')
<li class="active">Addresses</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <p class="text-right">
                <a href="{!! action('Admin\AddressController@create') !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.create')</a>
            </p>
        </h3>
        {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <th style="width: 10px">ID</th>
                <th>@lang('admin.pages.addresses.columns.address_detail')</th>
                <th>@lang('admin.pages.addresses.columns.country')</th>
                <th>@lang('admin.pages.addresses.columns.city')</th>
                <th>@lang('admin.pages.addresses.columns.district')</th>

                <th style="width: 40px">@lang('admin.pages.addresses.columns.is_enabled')</th>
                <th style="width: 40px">&nbsp;</th>
            </tr>
            @foreach( $models as $model )
                <tr>
                    <td>{{ $model->id }}</td>
                <td>{{ $model->address_detail }}</td>
                <td>{{ $model->country }}</td>
                <td>{{ $model->city }}</td>
                <td>{{ $model->district }}</td>

                    <td>
                        @if( $model->is_enabled )
                            <span class="badge bg-green">@lang('admin.pages.addresses.columns.is_enabled_true')</span>
                        @else
                            <span class="badge bg-red">@lang('admin.pages.addresses.columns.is_enabled_false')</span>
                        @endif
                    </td>
                    <td>
                        <a href="{!! action('Admin\AddressController@show', $model->id) !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-sm delete-button" data-delete-url="{!! action('Admin\AddressController@destroy', $model->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="box-footer">
        {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
    </div>
</div>
@stop
