$(document).ready(function(){
    var next = 1;
    var que = 1;
    var Que = 1;
    var t1 = 1;
    var t2 = 1;
    $(".submit").click(function(e){
      var assignment = JSON.stringify($("#ASSIGNMENT").serializeArray());
      var test1 = JSON.stringify($("#TEST1").serializeArray());
      var test2 = JSON.stringify($("#TEST2").serializeArray());
        $.ajax({
            type : "POST",
            url: "data.php",
            data: {'assignment' : assignment,
                    'test1' : test1,
                    'test2' : test2
                  },
            //dataType: "json",
        });
    });

    $(".add-more").click(function(e){
        var addto = "#add" + next;
        var addRemove = "#addd" + (next+1);
        next = next + 1;
        var newIn = '<tr class="noBorder" id="add' + next + '" name="add' + next + '" > <td>' + (next-1) + '</td>';
        for (var i = 0; i < 6; i++) {
              newIn+='<td><input type="text" name="CO' + (i+1)+ '"class="form-control" size="5" required  /></td>';
            }
        newIn+='<td id="addd'+(next-1)+'"></td></tr>';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next-1) + '" class="btn remove-me" >-</button>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).append(removeButton)
        $("#add" + next).attr('data-source',$(addto).attr('data-source'));
        //$("#count").val(next);
        $('.remove-me').click(function(e){
            e.preventDefault();
            var fieldNum = this.id.charAt(this.id.length-1);
            var fieldID = "#add" + fieldNum + 1;
            $(this).remove();
            $(fieldID).remove();
        });
    });

    $(".addq").click(function(e){
        var addto = "#ques" + que;
        que = que + 1;
        var newIn = '<tr class="noBorder" id="ques' + que + '" name="ques' + que + '" > <td>' + (que - 1) + '</td>' + '<td>Max. Weightage</td><td><input type="text" class="form-control" size="5" required  /></td>';
        newIn+='<td><select>';
        newIn+='<option disabled selected value style="display:none;"> Select CO </option>';
        for (var i = 1; i <= 6; i++) {
            newIn+='<option>CO '+i+'</option>'
        }
        newIn+='</select></td></tr>';
        var newInput = $(newIn);
        $(addto).after(newInput);

    });

    $(".addqq").click(function(e){
        var addto = "#Ques" + Que;
        Que = Que + 1;
        var newIn = '<tr class="noBorder" id="Ques' + Que + '" name="ques' + Que + '" > <td>' + (Que - 1) + '</td>' + '<td>Max. Weightage</td><td><input type="text" class="form-control" size="5" required  /></td>';
        newIn+='<td><select>';
        newIn+='<option disabled selected value style="display:none;"> Select CO </option>';
        for (var i = 1; i <= 6; i++) {
            newIn+='<option>CO '+i+'</option>'
        }
        newIn+='</select></td></tr>';
        var newInput = $(newIn);
        $(addto).after(newInput);

    });

    $(".next").click(function(e){
        var test = "#"+$(this).closest('table').attr('id');
        $(test).hide();
        var table = test[0] + test.charAt(1).toUpperCase() + test.slice(2);
        $(table).show();

    });

    $(".test").click(function(e){
        var addto;
        var newIn;
        if($(this).attr("id")=="t1")
        {
            addto = "#test1add" + t1;
            t1 = t1 + 1;
            newIn = '<tr class="noBorder" id="test1add' + t1 + '" name="add' + t1 + '" > <td>' + (t1-1) + '</td>';
            for (var i = 0; i < 6; i++) {
                  newIn+='<td><input type="text" name="' + (i+1)+ '"class="form-control" size="5" required  /></td>';
            }
        }
        else
        {
            addto = "#test2add" + t2;
            t2+=1;
            newIn = '<tr class="noBorder" id="test2add' + t2 + '" name="add' + t2 + '" > <td>' + (t2-1) + '</td>';
            for (var i = 0; i < 6; i++) {
                  newIn+='<td><input type="text" name="' + (i+1)+ '"class="form-control" size="5" required  /></td>';
            }
        }
        //var addRemove = "#addd" + (t1+1);

        //var removeBtn = '<button id="remove' + (t1-1) + '" class="btn remove-me" >-</button>';
        //var removeButton = $(removeBtn);
        var newInput = $(newIn);
        $(addto).after(newInput);
        //$(addRemove).append(removeButton)
        //$("#add" + next).attr('data-source',$(addto).attr('data-source'));
        //$("#count").val(next);
        /*$('.remove-me').click(function(e){
            e.preventDefault();
            var fieldNum = this.id.charAt(this.id.length-1);
            var fieldID = "#add" + fieldNum + 1;
            $(this).remove();
            $(fieldID).remove();
        });*/
    });

});
