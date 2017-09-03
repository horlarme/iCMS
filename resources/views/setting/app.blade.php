@extends('layout.app')
@section('title') Setting | {{ucwords($setting->name) }} @stop
@section('others')
    <link rel='stylesheet' href="{{ asset('fancybox/dist/jquery.fancybox.min.css')}}">
    <script type="text/javascript" src="{{ asset('tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{ asset('fancybox/dist/jquery.fancybox.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/settings.js')}}"></script>
@stop
@section('pageTitle') {{ ucwords($setting->value) }}
<hr/> @stop
@section('content')
    <div class="row">
        <div class="container">
            <p class="text-info">Every Setting of this page is updated automatically when the user leave the box.</p>

            <form action="{{route('save.setting', $setting->name)}}" class="setting">
                @php($settingValues = new \App\Http\Controllers\AppSettingController)

                <div class="clearfix">
                    <h4><strong>Web Site Information</strong></h4>
                    <hr/>

                    <div class="form-group">
                        <label class="col-md-2">Name:</label>
                        <div class="col-md-10">
                            <input type="text" name="name" class="update form-control"
                                   value="{{ $settingValues->setting('name', $setting) }}"/>
                            <p class="help-block">This will be the name the website displays.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2">Description:</label>
                        <div class="col-md-10">
                            <textarea name="description" class="update form-control"
                                      rows="3">{{ $settingValues->setting('description', $setting) }}</textarea>
                            <p class="help-block">This describe the website for search engines. It is advised to be kept
                                at maximum of 250 characters.</p>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2">Keywords:</label>
                        <div class="col-md-10">
                            <input type="text" name="keywords" class="update form-control"
                                   value="{{ $settingValues->setting('keywords', $setting) }}"/>
                            <p class="help-block">Each keyword should be comma separated and should.</p>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <h4><strong>User</strong></h4>
                    <hr/>

                    <div class="form-group">
                        <label class="col-md-2">Registration:</label>
                        <div class="col-md-10">
                            <select name="user.register" class="update form-control">
                                <option value="true" {{$settingValues->setting('user.register', $setting) === 'true' ? 'selected' : ''}}>
                                    Yes
                                </option>
                                <option value="false" {{$settingValues->setting('user.register', $setting) === 'true' ? '' : 'selected'}}>
                                    No
                                </option>
                            </select>
                            <p class="help-block">If this option is enabled, it means anybody can use
                                the {{route('register')}} to create an account as an author.</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <h4><strong>Search Engines</strong></h4>
                    <hr/>
                    <label class="col-md-2">Make your application not visible to search engines</label>
                    <div class="col-md-10">
                        <select name="search" class="update form-control">
                            <option value="true" {{$settingValues->setting('search', $setting) === 'true' ? 'selected' : ''}}>
                                Yes
                            </option>
                            <option value="false" {{$settingValues->setting('search', $setting) === 'true' ? '' : 'selected'}}>
                                No
                            </option>
                        </select>

                        <p class="help-block">This will make your website not to show on Google Search and other search
                            engines.</p>
                    </div>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
    </div>
@stop