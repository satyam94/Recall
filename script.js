var num_sendform=0;
var num_deletedata=0;
var num_totaldelete=0;

function keypres(form,index,indexdone)
{
  if(window.event.keyCode==13)
  {
    var m=sendform(form,index,indexdone);
    return m;
  }
}

function sendform(form,index,indexdone)
{
  var newtodo=form.todo.value;
  var length=newtodo.length;
  
  var xhr=new XMLHttpRequest();
  xhr.open("GET","index.php?todo="+newtodo,true);

  xhr.send();
  
  var str=$("#11").html();
  
  var div_start="<div class = 'container'><div class = 'type'>"
  var edit="<input type='button' value='e' onclick='editdata(" + length + "," + index + "," + indexdone + ")' class='cross' id='edit" + index + "'>";
  var cross="<input type='button' value='x' onclick='deletedata(" + length + "," + index + "," + indexdone + ")' class='cross' id='input" + index + "'>";
  var div_end="</div></div>";
  var hr="<hr class = 'horizontal-ruler' id='hor" + index + "'>";
  
  $("#11").html(div_start + newtodo + cross + edit + div_end + hr + str);  

  index++;

  var formhtml1='<form class="form">Newer Todo List<br>';
  var formhtml2='<input type="text" name="todo" placeholder=" Add you Task here..." autofocus="true" class="text_area" id="inputfield" onkeydown="return keypres(this.form,' + index +","+indexdone+ ')">';
  var formhtml3='<input type="submit" value="Submit" id="button" onclick="return sendform(this.form,' + index +","+indexdone+ ')"></form>';

  $("#10").html(formhtml1+formhtml2+formhtml3);

  num_sendform++;

  return false;
}

function deletedata(length,index,indexdone)
{
  indexdone+=num_deletedata;

  var xhr=new XMLHttpRequest();
  
  xhr.open("GET","index.php?index="+index+"&delete=true",true);
  xhr.send();

  $("#input"+index).parent().parent().slideUp(1000);
  $("#hor"+index).delay(800).hide(200);

  var str=$("#12").html();
  var newdone=$("#input"+index).parent().html();

  newdone=newdone.substr(0,length);

  var div_start="<div class = 'container'><div class = 'type'>"
  var input='<input type="button" value="x" onclick="totaldelete('+indexdone+')" class="cross" id="output'+indexdone+'">';
  var div_end="</div></div>";
  var hr="<hr class = 'horizontal-ruler' id='hor_out"+indexdone+"'>";
  
  $("#12").html(div_start + newdone + input + div_end + hr + str);  
  
  num_deletedata++;

}

function totaldelete(index)
{
  var xhr = new XMLHttpRequest;

  xhr.open("GET","index.php?index="+index+"&totaldelete=true",true);
  xhr.send();

  $("#output"+index).parent().parent().slideUp(1000);
  $("#hor_out"+index).delay(800).hide(200);

  num_totaldelete++;
}

function editdata(length,index,indexdone)
{
  var tosub=$("#input"+index).parent().html();
  var str=tosub.substr(0,length);
  console.log(length);

  var x="<form><input type='text' name='edit' value=" + str + " class='edit_box' onkeydown='return keypres1(this.form," + index + "," + indexdone + ")'>";
  var sub="<input type='button' value='t' class='cross' onclick='return editvalue(this.form," + index + "," + indexdone + ")'>";
  console.log(str);
  var rev="<input type='button' value='r' class='cross' onclick='return revert(" + str + "," + length + "," + index + "," + indexdone + ")'></form>";
  $("#input"+index).parent().html(x+sub+rev);
}

function keypres1(form,index,indexdone)
{
  if(window.event.keyCode==13)
  {
    //alert("Something to alert");
    var n=editvalue(form,index,indexdone);
    return n;
  }
}

function editvalue(form,index,indexdone)
{
  var xhr = new XMLHttpRequest;
  toedit=form.edit.value;

  xhr.open("GET","index.php?edit=" + toedit + "&index=" + index,true);

  xhr.send();

  var length = toedit.length;

  revert(toedit,length,index,indexdone);

  return false;
}

function revert(str,length,index,indexdone)
{
  str+="\n";
  console.log(str);
  console.log(length);
  var edit="<input type='button' value='e' onclick='editdata(" + length + "," + index + "," + indexdone + ")' class='cross' id='edit" + index + "'>";
  var cross="<input type='button' value='x' onclick='deletedata(" + length + "," + index + "," + indexdone + ")' class='cross' id='input" + index + "'>";
  
  $("#div"+index).html(str + cross + edit);

  return false;
}