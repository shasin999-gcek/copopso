@extends('layouts.master')


@section('main_content') 

    <form id="upload-form" action="{{url('/upload')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
        
    	<style type="text/css">
            
            table
            {
                border: 1px solid black;
            }
            
            table th
            {
                background-color: #F7F7F7;
                color: #333;
                font-weight: bold;
            }
            
            table th, table td
            {
                border: 1px solid black;
                height: 50px;
                vertical-align: bottom;
                text-align: left;
                padding: 15px;
                border-color: #ccc;
            }
        
        </style>
        
        <div style="height: auto;width: auto"; id="upload-file-div" class="form-group">
            <br></br>
            <input type="file"  id="upload-file" name="upload-file" class="form-control">
        </div>
    	
        <div id='upload-btn-div'>
            <input type="button" class="btn btn-success" id="upload" value="Upload">
            <br></br>
        </div>
        
        <div id="blank" class="alert alert-danger" style="display: none;"></div>
        
        <div align="center" id="dvCSV"></div>
        
        <div id="post-btns" style="text-align: center; padding: 15px; display: none;"></div>
    
    </form>
    
    @if (Session::has('danger'))
        <div id="danger" class="alert alert-danger">{{ Session::get('danger') }}</div>
    @endif

    @if (Session::has('success'))
        <div id="success" class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

@endsection

@section('add-script')

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    
    window.onload = function(){
        var message = sessionStorage.getItem('message');
        if(message!==null){
            document.getElementById('blank').style.display='';
            $("#blank").append("<strong>INVALID CSV FILE!</strong> "+message);
            sessionStorage.removeItem('message');
        }
    }
    $(function () {
        $("#upload").bind("click", function () {
            if($("#danger").length>0)
                $("#danger").remove();
            if($("#success").length>0)
                $("#success").remove();
            $("#blank").css('display','none');

<<<<<<< Updated upstream
            var regex = /^([a-zA-Z0-9\s_\\.\-:\()])+(.csv|.txt)$/;
            if (regex.test($("#upload-file").val().toLowerCase())) {
=======
            var negregex = /^([a-zA-Z0-9\s_\\.\-:\()])+(.csv|.txt)$/;
            var regex = /^([a-zA-Z0-9\s_\\.\-:\()])+(.csv|.txt)$/;
            if (alert(regex.test($("#upload-file").val().toLowerCase()))) {
>>>>>>> Stashed changes
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var table = $("<table />");
                        var rows = e.target.result.split("\n");
                        for (var i = 0; i < rows.length; i++) {
                            var row = $("<tr />");
                            var cells = rows[i].split(",");
                            if(cells.length!=8){
                                continue;
                            }
                            for (var j = 0; j < cells.length; j++) {
                                var cell = $("<td />");
                                if (i>=2 && cells[j]=='') {

                                    window.onbeforeunload = function(){
                                        var message = "BLANK FIELD AT ("+(i+1).toString()+","+(j+1).toString()+") .";
                                        sessionStorage.setItem('message',message);
                                    }
                                    location.reload();
                                    return false;
                                }
                                else{
                                    cell.html(cells[j]);
                                    row.append(cell);
                                }
                            
                            }
                            table.append(row);
                        }
                        $("#upload-file-div").css('display','none');
                        $("#upload-btn-div").css('display','none');                 
                        $("#dvCSV").html('<h2 style="text-align: center;">UPLOADED CSV FILE</h2>');
                        $("#dvCSV").append(table);
                        $("#post-btns").css('display','');
                        $("#post-btns").append('<input class="btn btn-success btn-lg" style="margin-right: 32px;" value="SAVE" name="save" type="submit">');
                        $("#post-btns").append('<input class="btn btn-success btn-lg" style="margin-left: 40px;" value="DISCARD" name="discard" type="submit">');
                    
                    }
                    reader.readAsText($("#upload-file")[0].files[0]);
                } 
                else {
                alert("This browser does not support HTML5.");
                }
            } 
        else {
            document.getElementById("upload-form").submit();
        }
        });
    });
</script>

@endsection
