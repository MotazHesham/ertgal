@extends('layouts.app')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Designer Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('designers.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">

                @include('admin.partials.error_message')
                
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" id="name" name="name" class="form-control" required value="{{old('name')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="email">{{__('Email')}}</label>
                    <div class="col-sm-9">
                        <input type="text" id="email" name="email" class="form-control" required value="{{old('email')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="phone">{{__('Phone')}}</label>
                    <div class="col-sm-9">
                        <input type="text"id="phone" name="phone" class="form-control" required value="{{old('phone')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="store_name">{{__('Store Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text"id="store_name" name="store_name" class="form-control" required value="{{old('store_name')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="address">{{__('Address')}}</label>
                    <div class="col-sm-9">
                        <input type="text"id="address" name="address" class="form-control" required value="{{old('address')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="password">{{__('Password')}}</label>
                    <div class="col-sm-9">
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="password_confirmation">{{__('Confirm Password')}}</label>
                    <div class="col-sm-9">
                        <input type="password"  id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection
