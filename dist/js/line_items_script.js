function addRow(tableID) 
{
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 250)
	{							// limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i<colCount; i++) 
		{
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
			//alert(table.rows[0].cells[i].innerHTML);
		}
	}
	else
	{
		 alert("Maximum Products Per Order is 250");
	}
}

function deleteRow(tableID) 
{
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	for(var i=0; i<rowCount-1; i++) 
	{
		table.deleteRow(rowCount);
		break;
	}
}

function deletethisrow(tableID,e)
{
var table = document.getElementById(tableID);
var rowCount = table.rows.length;	

if (rowCount < 2)
	{
		//alert("can't delete the last row");
		return;
	}
else
	{
	var rowindex = e.parentNode.parentNode.rowIndex;
	table.deleteRow(rowindex);
	}
}

function EditaddRow(tableID) 
{
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 250)
	{	
		// limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i<colCount; i++) 
		{
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
			if (i < colCount -1)
			{
/* 				if (newcell.innerHTML.indexOf('textarea') > 0)
				{
					alert("here");
				result = newcell.innerHTML.replace(/">[\s\S]*<\/t/gi,"\"></t");
				alert(result);
				}
				else
				{
					alert("elsehere"); */
					if (newcell.innerHTML.match(/<option/gi))
					{
						//alert("option found");
					result =  newcell.innerHTML;
					}
					else {
					result = newcell.innerHTML.replace(/value="[\s\S]*"/gi,"");
					//alert(newcell.innerHTML);
					//alert(result);
					}
				/* } */
			newcell.innerHTML = result;
			}
		}
	}
	else
	{
		 alert("Maximum Products Per Order is 250");
	}
}

function Editdeletethisrow(tableID,e)
{
var table = document.getElementById(tableID);
var rowCount = table.rows.length;	
if (rowCount < 2)
	{
		//alert("can't delete the last row");
		return;
	}
else
	{
	var rowindex = e.parentNode.parentNode.rowIndex;
	table.deleteRow(rowindex);
	}
}
