function edit_row(no)
{
 document.getElementById("edit_button"+no).style.display="none";
 document.getElementById("save_button"+no).style.display="block";

 var empid=document.getElementById("empid_row"+no);
 var empname=document.getElementById("empname_row"+no);
 var empjob=document.getElementById("empjob_row"+no);

 var empid_data=empid.innerHTML;
 var empname_data=empname.innerHTML;
 var empjob_data=empjob.innerHTML;

 empid.innerHTML="<select class='form-control' id='empid_text"+no+"' required> <option>1</option><option>2</option><option>3</option></select>";
 document.getElementById("empid_text"+no).value = empid_data;
 empname.innerHTML="<input type='text' id='empname_text"+no+"' value='"+empname_data+"' class='form-control has-feedback-left' readonly>";
 empjob.innerHTML="<input type='text' id='empjob_text"+no+"' value='"+empjob_data+"' class='form-control has-feedback-left' readonly>";
}

function save_row(no)
{
 var name_val=document.getElementById("empid_text"+no).value;
 var country_val=document.getElementById("empname_text"+no).value;
 var age_val=document.getElementById("empjob_text"+no).value;

 document.getElementById("empid_row"+no).innerHTML=name_val;
 document.getElementById("empname_row"+no).innerHTML=country_val;
 document.getElementById("empjob_row"+no).innerHTML=age_val;

 document.getElementById("edit_button"+no).style.display="block";
 document.getElementById("save_button"+no).style.display="none";
}

function delete_row(no)
{
 document.getElementById("row"+no+"").outerHTML="";
}

function add_row()
{
 var new_empid=document.getElementById("new_empid").value;
 var new_empname=document.getElementById("new_empname").value;
 var new_empjob=document.getElementById("new_empjob").value;

 var table=document.getElementById("data_table");
 var table_len=(table.rows.length)-1;
 var row = table.insertRow(table_len).outerHTML="<tr id='row"+table_len+"'><td id='empid_row"+table_len+"' >"+new_empid+"</td><td id='empname_row"+table_len+"'>"+new_empname+"</td><td id='empjob_row"+table_len+"'>"+new_empjob+"</td><td><a id='edit_button"+table_len+"' class='btn btn-primary' onclick='edit_row("+table_len+")' style='width:100%;'> Edit</a> <a type='button' id='save_button"+table_len+"' class='btn btn-success' onclick='save_row("+table_len+")' style='width:100%;'>Save</a> <a class='btn btn-danger' onclick='delete_row("+table_len+")' style='width:100%;'>Delete</a></td></tr>";

 document.getElementById("edit_button"+table_len).style.display="block";
 document.getElementById("save_button"+table_len).style.display="none";

 document.getElementById("new_empid").value="";
 document.getElementById("new_empname").value="";
 document.getElementById("new_empjob").value="";
}
