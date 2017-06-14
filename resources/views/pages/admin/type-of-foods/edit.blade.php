@extends('layouts.admin.application', ['menu' => 'type_of_foods'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
<script src="{{ \URLHelper::asset('libs/moment/moment.min.js', 'admin') }}"></script>
<script src="{{ \URLHelper::asset('libs/datetimepicker/js/bootstrap-datetimepicker.min.js', 'admin') }}"></script>
<script>
$('.datetime-field').datetimepicker({'format': 'YYYY-MM-DD HH:mm:ss'});
</script>
@stop

@section('title')
@stop

@section('header')
TypeOfFoods
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\TypeOfFoodController@index') !!}"><i class="fa fa-files-o"></i> TypeOfFoods</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $typeOfFood->id }}</li>
    @endif
@stop

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if( $isNew )
        <form action="{!! action('Admin\TypeOfFoodController@store') !!}" method="POST" enctype="multipart/form-data">
    @else
        <form action="{!! action('Admin\TypeOfFoodController@update', [$typeOfFood->id]) !!}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
    @endif
            {!! csrf_field() !!}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">

                    </h3>
                </div>
                <div class="box-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('type_name')) has-error @endif">
                                <label for="type_name">@lang('admin.pages.type-of-foods.columns.type_name')</label>
                                <input type="text" class="form-control" id="type_name" name="type_name" value="{{ old('type_name') ? old('type_name') : $typeOfFood->type_name }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('slug')) has-error @endif">
                                <label for="slug">@lang('admin.pages.type-of-foods.columns.slug')</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') ? old('slug') : $typeOfFood->slug }}">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('admin.pages.common.buttons.save')</button>
                </div>
            </div>
        </form>
@stop
