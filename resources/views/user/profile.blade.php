@extends('layout.app')
@section('title') My Profile @stop
@section('pageHeader') My Profile Page @stop
@section('pageAction')
    <a href="{{route('profile.edit')}}" class="btn btn-success col-xs-12">
        <i class="fa fa-edit"></i> Edit Profile</a>
@stop
@section('pageText') My personal profile page, the information on this page describe the user.  @stop
@section('content')
    <h1>Profile Page</h1>
@stop