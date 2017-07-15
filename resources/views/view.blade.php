      	<!--

	      <table class='table'>
	      <thead class="thead-inverse">
	      <tr>
	      		<th colspan="3"> CO </th>
	      		<th colspan="12"> Definition </th>
	      		
	      	</tr>
	      </thead>
	      	 @foreach($cos as $co)
		       <tr>
		       	<td>{{$co->name }}</td>
		           <td>{{$co->description }}</td>
		       </tr>
	   		 @endforeach 
	   	  </table>  

      @endif

    
      @if ($status == 1)
	    <h3 class="text-primary">Relate CO-PO-PSO</h3>

      	<a href="/co/popso/create/{{$coursedata->id}}" class="btn btn-success btn-panel">Define Matrix</a>

      @endif
	  @if ($status == 2)
		  <h3 class="text-primary">Relate CO-PO-PSO</h3>
		  <div>
		  	<p>Matrix to be displayed here </p>
		  	

		  </div>

		  <h3 class="text-primary">Justify POs</h3>
		  <a href="/co/po/{{$coursedata->id}}/1" class="btn btn-success btn-panel">Justify POs</a>

      @endif

      @if ($status>2 && $status<18)
		  <h3 class="text-primary">Justify POs</h3>
		  
		  <a href="/co/po/{{$coursedata->id}}/{{$po_id}}" class="btn btn-success btn-panel">Justify POs</a>

      @endif

      @if ($status == 18)

      <h3 class="text-primary">Distribute Weightage for CO</h3>
      	
      <a href="/co/{{$coursedata->id}}/weightage" class="btn btn-success btn-panel">Complete</a>

      @endif


      @if ($status == 19)
      <h3 class="text-primary">Upload Marksheet</h3>
      	
      <a href="/upload" class="btn btn-success btn-panel">Upload</a>

      @endif

      -->