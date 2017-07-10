@extends('layouts.master')


@section('main_content')

    <form action="{{url('/upload')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
        
        <div>
            <h3 style="text-align: center;">UPLOADED CSV FILE</h4>
            @php
                
                $filePath = $id;
                $file=fopen($filePath, 'r');
                echo '<table style="border:1px solid black;" align = "center">';
                echo "<div style='text-align:center'>";
                while(($line = fgetcsv($file))!==false){
                        echo "<tr>";
                        foreach ($line as $cell) {
                                echo '<td style="border:1px solid black; 
                                                 height:50px; 
                                                 vertical-align: bottom; 
                                                 text-align: left;
                                                 padding: 15px;">';

                                echo htmlspecialchars($cell) . '<td>';
                        }
                        echo "</tr>\n\n\n";
                }
                fclose($file);
                echo "\n";
                echo '</table>';
                unlink($filePath);

            @endphp
        </div>
    	<br>
        </br>

        <div style="text-align: center; padding: 15px;">
                <input class="btn btn-success btn-lg" style="margin-right: 32px;" value="SAVE" name="save" type="submit">
                <input class="btn btn-success btn-lg" style="margin-left: 40px;" value="DISCARD" name="discard" type="submit">

        </div>
        
    </form>

@endsection