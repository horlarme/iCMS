@extends('layout.app')
@section('title') Create New Category @stop
@section('others')

@stop
@section('pageHeader') Create New Post Category @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
                <h4 class="{{session()->get('message.type')}}">{{session()->get('message.content')}}</h4>
                @endif
            @if($errors->any())
                <ul class="alert alert-danger">
                    <h4>Please go through the following errors:</h4>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{route('category.create')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-xs-12 form-group form-horizontal">
                    <!-- Title-->
                    <div class="col-xs-12 nopadding <?php echo ($errors->has('name')) ? 'has-error' : ""?>">
                        <div class="col-xs-3 nopadding">
                            <input type="button" value="Name:" disabled="" class="btn btntotext align-right"/>
                        </div>
                        <div class="col-xs-9 nopadding">
                            <input type="text" name="name"
                                   class="form-control"
                                   placeholder="Category Name" value="{{ old('name') }}"/>
                            <p class="help-block clearfix">This will be the name that the category will bear.</p>
                        </div>
                    </div>

                    <!-- Title-->
                    <div class="col-xs-12 nopadding <?php echo ($errors->has('description')) ? 'has-error' : ""?>">
                        <div class="col-xs-3 nopadding">
                            <input type="button" value="Description:" disabled="" class="btn btntotext align-right"/>
                        </div>
                        <div class="col-xs-9 nopadding">
                            <input type="text" name="description"
                                   class="form-control"
                                   placeholder="Category Description" value="{{ old('description') }}"/>
                            <p class="help-block clearfix">This will be the description shown when the user hover the
                                category item</p>
                        </div>
                    </div>

                    <!-- Title-->
                    <div class="col-xs-12 nopadding <?php echo ($errors->has('icon')) ? 'has-error' : ""?>">
                        <div class="col-xs-3 nopadding">
                            <input type="button" value="Icon:" disabled="" class="btn btntotext align-right"/>
                        </div>
                        <div class="col-xs-9 nopadding">
                            <input type="text" name="icon" class="form-control"
                                   placeholder="CSS Class of the icon" value="{{ old('icon') }}"/>
                            <p class="help-block clearfix">Enter the CSS class name of the icon to be used.</p>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                        <input type="submit" class="form-control btn btn-primary" value="Create">
                    </div>

                </div>
                <!--The Left Panel Option-->
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
@stop