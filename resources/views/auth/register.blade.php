@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Register</div>
          <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
              {{ csrf_field() }}

              <phone-input :errors='{!! $errors->toJson() !!}' old='{!! old('phone') !!}'></phone-input>
              <password-input :errors='{!! $errors->toJson() !!}'></password-input>
              <password-confirmation-input></password-confirmation-input>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    注册
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
