@extends('layouts.app')
    @section('main_content')
		<h3>CO-PO Mapping Matrix</h3><br>
		<!--Second form starts here ...form type the action to be done on form of CO-PO mapping Outcome-->

		<form role="form" data-toggle="validator" method="post" action="#">
         <div class="form-group">
         
            <input type="text" class="form-control" required>
         </div>
          <button class="btn btn-success" type="submit">vv</button>
      </form>



		<form data-toggle="validator" role="form">
		<table class="table">
		  <thead class="thead-inverse">
			<tr>
				<th></th>
				<th colspan="12">General PO</th>
				<th colspan="3">Dept PSO</th>
			</tr>
		   </thead>
		   <thead class="thead-inverse">
			<tr>
				<th>CO</th>
				<th>PO 1</th>
				<th>PO 2</th>
				<th>PO 3</th>
				<th>PO 4</th>
				<th>PO 5</th>
				<th>PO 6</th>
				<th>PO 7</th>
				<th>PO 8</th>
				<th>PO 9</th>
				<th>PO 10</th>
				<th>PO 11</th>
				<th>PO 12</th>
				<th>PSO 1</th>
				<th>PSO 2</th>
				<th>PSO 3</th>
			</tr>
			</thead>
			<tr>
				<th>2k16...1 </th>
				<td><div class="form-group"><input class="form-control" type="text" name="co1po1" size="5" required></div></td>
				<td><input type="text" name="co1po2" size="5"></td>
				<td><input type="text" name="co1po3" size="5"></td>
				<td><input type="text" name="co1po4" size="5"></td>
				<td><input type="text" name="co1po5" size="5"></td>
				<td><input type="text" name="co1po6" size="5"></td>
				<td><input type="text" name="co1po7" size="5"></td>
				<td><input type="text" name="co1po8" size="5"></td>
				<td><input type="text" name="co1po9" size="5"></td>
				<td><input type="text" name="co1po10" size="5"></td>
				<td><input type="text" name="co1po11" size="5"></td>
				<td><input type="text" name="co1po12" size="5"></td>
				<td><input type="text" name="co1pso1" size="5"></td>
				<td><input type="text" name="co1pso2" size="5"></td>
				<td><input type="text" name="co1pso3" size="5"></td>
			</tr>
			<tr>
				<th>2k16...2 </th>
				<td><input type="text" name="co2po1" size="5"></td>
				<td><input type="text" name="co2po2" size="5"></td>
				<td><input type="text" name="co2po3" size="5"></td>
				<td><input type="text" name="co2po4" size="5"></td>
				<td><input type="text" name="co2po5" size="5"></td>
				<td><input type="text" name="co2po6" size="5"></td>
				<td><input type="text" name="co2po7" size="5"></td>
				<td><input type="text" name="co2po8" size="5"></td>
				<td><input type="text" name="co2po9" size="5"></td>
				<td><input type="text" name="co2po10" size="5"></td>
				<td><input type="text" name="co2po11" size="5"></td>
				<td><input type="text" name="co2po12" size="5"></td>
				<td><input type="text" name="co2pso1" size="5"></td>
				<td><input type="text" name="co2pso2" size="5"></td>
				<td><input type="text" name="co2pso3" size="5"></td>
			</tr>
			<tr>
				<th>2k16...3 </th>
				<td><input type="text" name="co3po1" size="5"></td>
				<td><input type="text" name="co3po2" size="5"></td>
				<td><input type="text" name="co3po3" size="5"></td>
				<td><input type="text" name="co3po4" size="5"></td>
				<td><input type="text" name="co3po5" size="5"></td>
				<td><input type="text" name="co3po6" size="5"></td>
				<td><input type="text" name="co3po7" size="5"></td>
				<td><input type="text" name="co3po8" size="5"></td>
				<td><input type="text" name="co3po9" size="5"></td>
				<td><input type="text" name="co3po10" size="5"></td>
				<td><input type="text" name="co3po11" size="5"></td>
				<td><input type="text" name="co3po12" size="5"></td>
				<td><input type="text" name="co3pso1" size="5"></td>
				<td><input type="text" name="co3pso2" size="5"></td>
				<td><input type="text" name="co3pso3" size="5"></td>
			</tr>
				<tr>
				<th>2k16...4 </th>
				<td><input type="text" name="co4po1" size="5"></td>
				<td><input type="text" name="co4po2" size="5"></td>
				<td><input type="text" name="co4po3" size="5"></td>
				<td><input type="text" name="co4po4" size="5"></td>
				<td><input type="text" name="co4po5" size="5"></td>
				<td><input type="text" name="co4po6" size="5"></td>
				<td><input type="text" name="co4po7" size="5"></td>
				<td><input type="text" name="co4po8" size="5"></td>
				<td><input type="text" name="co4po9" size="5"></td>
				<td><input type="text" name="co4po10" size="5"></td>
				<td><input type="text" name="co4po11" size="5"></td>
				<td><input type="text" name="co4po12" size="5"></td>
				<td><input type="text" name="co4pso1" size="5"></td>
				<td><input type="text" name="co4pso2" size="5"></td>
				<td><input type="text" name="co4pso3" size="5"></td>
			</tr>
			<tr>
				<th>2k16...5 </th>
				<td><input type="text" name="co5po1" size="5"></td>
				<td><input type="text" name="co5po2" size="5"></td>
				<td><input type="text" name="co5po3" size="5"></td>
				<td><input type="text" name="co5po4" size="5"></td>
				<td><input type="text" name="co5po5" size="5"></td>
				<td><input type="text" name="co5po6" size="5"></td>
				<td><input type="text" name="co5po7" size="5"></td>
				<td><input type="text" name="co5po8" size="5"></td>
				<td><input type="text" name="co5po9" size="5"></td>
				<td><input type="text" name="co5po10" size="5"></td>
				<td><input type="text" name="co5po11" size="5"></td>
				<td><input type="text" name="co5po12" size="5"></td>
				<td><input type="text" name="co5pso1" size="5"></td>
				<td><input type="text" name="co5pso2" size="5"></td>
				<td><input type="text" name="co5pso3" size="5"></td>
			</tr>
			<tr>
				<th>2k16...6 </th>
				<td><input type="text" name="co6po1" size="5"></td>
				<td><input type="text" name="co6po2" size="5"></td>
				<td><input type="text" name="co6po3" size="5"></td>
				<td><input type="text" name="co6po4" size="5"></td>
				<td><input type="text" name="co6po5" size="5"></td>
				<td><input type="text" name="co6po6" size="5"></td>
				<td><input type="text" name="co6po7" size="5"></td>
				<td><input type="text" name="co6po8" size="5"></td>
				<td><input type="text" name="co6po9" size="5"></td>
				<td><input type="text" name="co6po10" size="5"></td>
				<td><input type="text" name="co6po11" size="5"></td>
				<td><input type="text" name="co6po12" size="5"></td>
				<td><input type="text" name="co6pso1" size="5"></td>
				<td><input type="text" name="co6pso2" size="5"></td>
				<td><input type="text" name="co6pso3" size="5"></td>
			</tr>
		</table>
		<input type="submit" value="SAVE">
		
		</form>
	@endsection	