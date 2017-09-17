@extends('layout.app')
@section('title') {{ucwords($name)}} @stop
@section('others')

@stop
@section('pageHeader') {{ucwords('edit ' . $name)}} @stop
@section('pageAction')
    <form action="{{route('category.delete', $name)}}" method="post">
        {{method_field('delete')}}
        {{csrf_field()}}
        <button class="btn btn-danger form-control">DELETE {{strtoupper($name)}}</button>
    </form>
@stop
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
            <form action="{{route('category.update', $name)}}" method="post">
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
                                   placeholder="Category Name"
                                   value="{{ !is_null(old('name')) ? old('name') : $name  }}"/>
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
                                   placeholder="Category Description"
                                   value="{{ !is_null(old('title')) ? old('title') : $title }}"/>
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
                                   placeholder="CSS Class of the icon"
                                   value="{{ !is_null(old('icon')) ? old('icon') : $icon }}"/>
                            <p class="help-block clearfix">Enter the CSS class name of the icon to be used.</p>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                        <input type="submit" class="form-control btn btn-primary" value="Update">
                    </div>

                </div>
                <!--The Left Panel Option-->
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
@stop