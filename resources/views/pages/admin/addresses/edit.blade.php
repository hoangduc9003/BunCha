@extends('layouts.admin.application', ['menu' => 'addresses'] )

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

<script>

    function addCityList(country, city, city_id){
        var url = '{{url("admin/getCityList/")}}';
        $.ajax({
            url: url +'/' + country ,
            type: "GET",
            dataType : "json",
        }).done(function (data) {
            $('#'+city_id)
                .html('<option value="">'+ "Select city" +'</option>');
            $('#'+city_id).removeAttr('disabled');
            for(var i = 0; i <= data.length - 1; i++){
                if(city === "" || city !== data[i]){
                    $('#'+city_id)
                        .append($("<option></option>")
                            .attr("value",data[i])
                            .text(data[i]));
                }else if(city===data[i]){
                    $('#'+city_id)
                        .append($("<option></option>")
                            .attr({
                                value : data[i],
                                selected : "selected"
                            })
                            .text(data[i]));
                }

            }
        });
    }
    @if($isNew)
        function showCities(country_id, city_id){
            var country = $('#'+country_id+' option:selected').text();
            addCityList(country, "", city_id);
        }
//        $('select[name="country"]').change(function(){
//            var country = $('select[name="country"] option:selected').text();
//            addCityList(country, "");
//        });
    @else
        function showCities(country_id, city_id) {
            var country_edit = $('#' + country_id + ' option:selected').text();
            var city_edit = '{!! $address->city !!}';
            if (country_edit !== "") {
                addCityList(country_edit, city_edit === "" ? "" : city_edit, city_id);
            } else {
                var country = $('#' + country_id + ' option:selected').text();
                addCityList(country, "", city_id);
            }
        }
        $( window ).on( "load", showCities('country_1', 'city_1') );
    @endif


</script>

    <script>
//        Add more address script
        var num = 1;

        function replaceStr(oldStr, newStr, str) {
            var regExp = new RegExp(oldStr, "g");
            str = str.replace(regExp, newStr);
            return str;
        }

        function btnAddNewAddressesClick(str, header){
            if(num === 1){
                var temp = replaceStr("numeric", num + "", $('#' + str).html());
                var id = $(".add-address").first().attr('id');
                $("#" + id).after(temp);
                hideDeleteAddress();
            }else{
                var temp = replaceStr("numeric", num + "", $('#' + str).html());
                header = header.replace("numeric", num -1);
                if($('.add-address').length === 2){
                    var id = $(".add-address").first().attr('id');
                    $("#" + id).after(temp);
                    hideDeleteAddress();
                }else{
                    $("#" + header).after(temp);
                    hideDeleteAddress();
                }

            }
            var country_id = 'country_a_' + num;
            var city_id = 'city_a_' + num;
            function showCities(country_id, city_id){
                var country = $('#'+country_id+' option:selected').text();
                addCityList(country, "", city_id);
            }
            num++;
        }

        function btnRemoveAddress(id, str, header) {
            id = id.replace("btnRemove_address_", "header_address_");
            $("#" + id).remove();
            hideDeleteAddress();
        }

        function hideDeleteAddress(){
            if($('.btnRemoveAddress').length >= 3){
                var id = $('.btnRemoveAddress').first().attr('id');
                $("#"+id).show();
            }else{
                var id = $('.btnRemoveAddress').first().attr('id');
                $("#"+id).hide();
            }
        }

        $(function(){
            hideDeleteAddress();
        });
    </script>
@stop

@section('title')
@stop

@section('header')
Addresses
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\AddressController@index') !!}"><i class="fa fa-files-o"></i> Addresses</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $address->id }}</li>
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
        <form action="{!! action('Admin\AddressController@store') !!}" method="POST" enctype="multipart/form-data">
    @else
        <form action="{!! action('Admin\AddressController@update', [$address->id]) !!}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
    @endif
            {!! csrf_field() !!}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        @if($isNew)
                            <div id="header_steps">
                                <a class="btnAddMore add-new" style="font-weight: 300; cursor: pointer"
                                   id="btnAddMore_address"
                                   onclick=" btnAddNewAddressesClick('addresses_template', 'header_address_a_numeric') ">
                                   <i style="font-size: 36px; color: #46b8da" class="fa fa-plus-square "> More Address</i>
                                </a>
                            </div>
                            @endif
                    </h3>
                </div>
                <div class="box-body">
                    {{--Start a Panel Address--}}
                    <div class="col-lg-4 add-address" id="header_address_first">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span>Address</span>
                                <a style="cursor: pointer"
                                   id="btnRemove_address_first"
                                   class="btnRemoveAddress pull-right" title="Delete"
                                   onclick="btnRemoveAddress('btnRemove_address_first')">
                                    <i class="fa fa-trash" aria-hidden="true"></i> </a>

                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group @if ($errors->has('address_detail')) has-error @endif">
                                            <label for="address_detail">@lang('admin.pages.addresses.columns.address_detail')</label>
                                            <textarea cols="4" rows="4" class="form-control" id="address_detail_1" name="address_detail[]"
                                                      value="{{ old('address_detail') ? old('address_detail') : $address->address_detail }}">{{ old('address_detail') ? old('address_detail') : $address->address_detail }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group @if ($errors->has('country')) has-error @endif ">
                                            <label for="country">@lang('admin.pages.addresses.columns.country')</label>

                                            <select name="country[]" class="form-control" id="country_1" onchange="showCities('country_1', 'city_1')">
                                                @if($isNew)
                                                <option value="">Select country</option>
                                                @foreach($countries as $key=>$value)
                                                    @if($key !== '_empty_')
                                                        <option value="{!! $key !!}">{!! $key !!}</option>
                                                    @endif
                                                @endforeach
                                                @else
                                                    <option value="">Select country</option>
                                                    @foreach($countries as $key=>$value)
                                                        @if($key !== '_empty_')
                                                            <option value="{!! $key !!}" @if($address->country === $key) selected="selected" @endif>{!! $key !!}</option>
                                                        @endif
                                                    @endforeach

                                            @endif
                                            </select>

                                            {{--<select name="country[]" class="form-control" id="country_1" onchange="showCities('country_1', 'city_1')">--}}


                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group @if ($errors->has('city')) has-error @endif">
                                            <label for="city">@lang('admin.pages.addresses.columns.city')</label>
                                            <select name="city[]" class="form-control" id="city_1" size="1" disabled="disabled">
                                                <option value="">Select city</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group @if ($errors->has('district')) has-error @endif">
                                            <label for="district">@lang('admin.pages.addresses.columns.district')</label>
                                            <input type="text" class="form-control" id="district_1" name="district[]" value="{{ old('district') ? old('district') : $address->district }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--End a Panel Address--}}
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('admin.pages.common.buttons.save')</button>
                </div>
            </div>
        </form>


        @include('pages.admin.addresses.partial.address_template')



@stop
