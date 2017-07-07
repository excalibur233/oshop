@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Register</div>
          <div class="panel-body">
            <register-form
                action="{!! route('register') !!}"
                csrf-token='{!! csrf_token() !!}'
                :errors='{!! $errors->toJson() !!}'
                :old='{!! json_encode(old()) !!}'>
            </register-form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
