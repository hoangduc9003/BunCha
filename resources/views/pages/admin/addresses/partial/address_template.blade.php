<div style="display: none">
    <div id="addresses_template">

        {{--Start a Panel Address--}}
        <div class="col-lg-4 add-address" id="header_address_a_numeric">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="pull-left">Address</span>

                    <a style="cursor: pointer"
                       id="btnRemove_address_a_numeric"
                       class="btnRemoveAddress pull-right" title="Delete"
                       onclick="btnRemoveAddress('btnRemove_address_a_numeric', 'addresses_template', 'header_address_a_numeric')">
                        <i class="fa fa-trash" aria-hidden="true"></i> </a>

                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('address_detail')) has-error @endif">
                                <label for="address_detail">@lang('admin.pages.addresses.columns.address_detail')</label>
                                <textarea cols="4" rows="4" class="form-control" id="address_detail_a_numeric" name="address_detail[]"
                                          value="{{ old('address_detail') ? old('address_detail') : $address->address_detail }}">{{ old('address_detail') ? old('address_detail') : $address->address_detail }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('country')) has-error @endif ">
                                <label for="country">@lang('admin.pages.addresses.columns.country')</label>
                                <select name="country[]" class="form-control" id="country_a_numeric" onchange="showCities('country_a_numeric', 'city_a_numeric')">
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

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('city')) has-error @endif">
                                <label for="city">@lang('admin.pages.addresses.columns.city')</label>
                                <select name="city[]" class="form-control" id="city_a_numeric" size="1" disabled="disabled">
                                    <option value="">Select city</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('district')) has-error @endif">
                                <label for="district">@lang('admin.pages.addresses.columns.district')</label>
                                <input type="text" class="form-control" id="district_a_numeric" name="district[]" value="{{ old('district') ? old('district') : $address->district }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>