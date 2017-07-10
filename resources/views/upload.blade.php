@extends('layouts.master')


@section('main_content') 

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
    	
        <input type="submit" class="btn btn-success" name="submit" value="Upload" disabled>
    </form>

@endsection

@section('add-script')

    <script>
            $('input[type=file]').change(function(){
                if($('input[type=file]').val()==''){
                    $('input').attr('disabled',true)
                } 
                else{
                $('input').attr('disabled',false);
                }
            })
    </script>

@endsection