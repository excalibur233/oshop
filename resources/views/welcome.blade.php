@extends('layouts.app')

@section('content')
  <example :user='{!! \OShop\User::find(1)->toJson() !!}'></example>
@endsection
