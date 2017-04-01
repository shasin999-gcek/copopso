@extends('layouts.base')


@section('content')

    <form action="{{url('/upload')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
        
    	<br>
    	</br>
    	<br>
    	</br>
        <div class="form-group">
           
            <input type="file" name="upload-file" class="form-control">
        </div>
        <br>
    	</br>
    	
        <input class="btn btn-success" type="submit" value="Upload" name="submit">
    </form>

@endsection