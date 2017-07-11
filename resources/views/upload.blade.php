@extends('layouts.master')


@section('main_content') 

    <form action="{{url('/upload')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
        
    	<br>
    	</br>
        <div class="form-group">
           
            <input type="file" name="upload-file" class="form-control">
        </div>
    	
        <input type="submit" class="btn btn-success" name="submit" value="Upload">
        <br>
        </br>
    </form>
    
    @if (Session::has('danger'))
        <div class="alert alert-danger">{{ Session::get('danger') }}</div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

@endsection