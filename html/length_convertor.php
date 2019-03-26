<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";?>
	<!--Including Login Session-->

	<head>
	<!--Including Bootstrap CSS links-->
	<?php include "../extra/header.html";?>
	<!--Including Bootstrap CSS links-->

	<style>
	#calc{width:300px;height:250px;}
	#btn{width:100%;height:40px;font-size:20px;}
	</style>
	
	<script>
	/* When the input field receives input, convert the value from feet to other units */
	function feet_to_others(valNum) 
	{
		document.getElementById("ui_meters").value=valNum/3.2808;
		document.getElementById("ui_inches").value=valNum*12;
		document.getElementById("ui_cm").value=valNum/0.032808;
		document.getElementById("ui_mm").value=valNum*304.8;
	}


	/* When the input field receives input, convert the value from meters to other units */
	function meters_to_others(valNum) 
	{
		document.getElementById("ui_feet").value=valNum*3.2808;
		document.getElementById("ui_inches").value=valNum*39.370;
		document.getElementById("ui_cm").value=valNum/0.01;
		document.getElementById("ui_mm").value=valNum/0.0010000;
	}


	/* When the input field receives input, convert the value from inches to other units */
	function inches_to_others(valNum) 
	{
		document.getElementById("ui_meters").value=valNum/39.370;
		document.getElementById("ui_feet").value=valNum*0.083333;
		document.getElementById("ui_cm").value=valNum/0.39370;
		document.getElementById("ui_mm").value=valNum*25.4;
	}

	/* When the input field receives input, convert the value from cm to other units */
	function cm_to_others(valNum) 
	{
		document.getElementById("ui_meters").value=valNum/100;
		document.getElementById("ui_feet").value=valNum*0.032808;
		document.getElementById("ui_inches").value=valNum*0.39370;
		document.getElementById("ui_mm").value=valNum*10;
	}

	/* When the input field receives input, convert the value from mm to other units */
	function mm_to_others(valNum) 
	{
		document.getElementById("ui_meters").value=valNum/1000.0;
		document.getElementById("ui_feet").value=valNum/304.8;
		document.getElementById("ui_inches").value=valNum/ 25.4;
		document.getElementById("ui_cm").value=valNum/10;
	}

	function sqft_to_others(valNum)
	{
		document.getElementById("ui_sqmt").value=valNum/10.764;
	}	

	function sqmt_to_others(valNum)
	{
		document.getElementById("ui_sqft").value=valNum*10.764;
	}

	$(document).ready(function()
	{
		// Handler for .ready() called.
		$("#li_misc").addClass("active");
		$("#li_length_convertor").addClass("active");
	});
	</script>

	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

			<!--Including Topbar-->
			<?php include "../extra/topbar.php";?>
			<!--Including Topbar-->

			<!-- Left Side Panel Which Contains Navigation Menu -->
			<?php include "../extra/left_nav_bar.php";?>
			<!-- Left Side Panel Which Contains Navigation Menu -->

			<div class="content-wrapper">
				<section class="content-header">
					<h1>Length Conversion</h1>
				</section>

				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header with-border">
								</div>
								<div class="box-body pad">

									<!--Feet-->
									<div class="form-group col-md-2">
										<label>Feet</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calculator"></i></span>
											<input type="number" class="form-control" id="ui_feet" name="ui_feet" onkeydown="if(value.length>5)value=value.slice(0,5)" oninput="feet_to_others(this.value)" onchange="feet_to_others(this.value)"/>
										</div>
									</div>
									<!--Feet-->

									<!--Meter-->
									<div class="form-group col-md-2">
										<label>Meters</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calculator"></i></span>
											<input type="number" class="form-control" id="ui_meters" onkeydown="if(value.length>5)value=value.slice(0,5)" name="ui_meters" oninput="meters_to_others(this.value)" onchange="meters_to_others(this.value)"/>
										</div>
									</div>
									<!--Meter-->

									<!--Inches-->
									<div class="form-group col-md-2">
										<label>Inches</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calculator"></i></span>
											<input type="number" class="form-control" id="ui_inches" onkeydown="if(value.length>5)value=value.slice(0,5)" name="ui_meter" oninput="inches_to_others(this.value)" onchange="inches_to_others(this.value)"/>
										</div>
									</div>
									<!--Inches-->

									<!--cm-->
									<div class="form-group col-md-2">
										<label>cm</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calculator"></i></span>
											<input type="number" class="form-control" id="ui_cm" onkeydown="if(value.length>5)value=value.slice(0,5)" name="ui_cm" oninput="cm_to_others(this.value)" onchange="cm_to_others(this.value)"/>
										</div>
									</div>
									<!--cm-->

									<!--mm-->
									<div class="form-group col-md-2">
										<label>mm</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calculator"></i></span>
											<input type="number" class="form-control" id="ui_mm" onkeydown="if(value.length>5)value=value.slice(0,5)" name="ui_mm" oninput="mm_to_others(this.value)" onchange="mm_to_others(this.value)"/>
										</div>
									</div>
									<!--mm-->

									<!--Square Feet-->
									<div class="form-group col-md-6">
										<label>Square Feet</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calculator"></i></span>
											<input type="number" class="form-control" id="ui_sqft" onkeydown="if(value.length>5)value=value.slice(0,5)" name="ui_sqft" oninput="sqft_to_others(this.value)" onchange="sqft_to_others(this.value)"/>
										</div>
									</div>
									<!--Square Feet-->

									<!--Square Meter-->
									<div class="form-group col-md-6">
										<label>Square Meter</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calculator"></i></span>
											<input type="number" class="form-control" id="ui_sqmt" onkeydown="if(value.length>5)value=value.slice(0,5)" name="ui_sqmt" oninput="sqmt_to_others(this.value)" onchange="sqmt_to_others(this.value)"/>
										</div>
									</div>
									<!--Square Meter-->

									<div class="form-group col-md-12">
										<form Name="calc">
											<table id="calc" border=2>
												<tr>
													<td colspan=5><input id="btn" name="display" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text"></td>
													<td style="display:none"><input name="M" type="number"></td>
												</tr>
												<tr>
													<td><input id="btn" type=button value="MC" OnClick="calc.M.value=''"></td>
													<td><input id="btn" type=button value="0" OnClick="calc.display.value+='0'"></td>
													<td><input id="btn" type=button value="1" OnClick="calc.display.value+='1'"></td>
													<td><input id="btn" type=button value="2" OnClick="calc.display.value+='2'"></td>
													<td><input id="btn" type=button value="+" OnClick="calc.display.value+='+'"></td>
												</tr>
												<tr>
													<td><input id="btn" type=button value="MS" OnClick="calc.M.value=calc.display.value"></td>
													<td><input id="btn" type=button value="3" OnClick="calc.display.value+='3'"></td>
													<td><input id="btn" type=button value="4" OnClick="calc.display.value+='4'"></td>
													<td><input id="btn" type=button value="5" OnClick="calc.display.value+='5'"></td>
													<td><input id="btn" type=button value="-" OnClick="calc.display.value+='-'"></td>
												</tr>
												<tr>
													<td><input id="btn" type=button value="MR" OnClick="calc.display.value=calc.M.value"></td>
													<td><input id="btn" type=button value="6" OnClick="calc.display.value+='6'"></td>
													<td><input id="btn" type=button value="7" OnClick="calc.display.value+='7'"></td>
													<td><input id="btn" type=button value="8" OnClick="calc.display.value+='8'"></td>
													<td><input id="btn" type=button value="x" OnClick="calc.display.value+='*'"></td>
												</tr>
												<tr>
													<td><input id="btn" type=button value="M+" OnClick="calc.M.value=(Number(calc.M.value))+(Number(calc.display.value))"></td>
													<td><input id="btn" type=button value="9" OnClick="calc.display.value+='9'"></td>
													<td><input id="btn" type=button value="±" OnClick="calc.display.value=(calc.display.value==Math.abs(calc.display.value)?-(calc.display.value):Math.abs(calc.display.value))">
													</td>
													<td><input id="btn" type=button value="=" OnClick="calc.display.value=eval(calc.display.value)"></td>
													<td><input id="btn" type=button value="/" OnClick="calc.display.value+='/'"></td>
												</tr>
												<tr>
													<td><input id="btn" type=button value="1/x" OnClick="calc.display.value=1/calc.display.value"></td>
													<td><input id="btn" type=button value="." OnClick="calc.display.value+='.'"></td>
													<td><input id="btn" type=button value="x2" OnClick="calc.display.value=Math.pow(calc.display.value,2)"></td>
													<td><input id="btn" type=button value="√" OnClick="calc.display.value=Math.sqrt(calc.display.value)"></td>
													<td><input id="btn" type=button value="C" OnClick="calc.display.value=''"></td>
												</tr>
											</table>
										</form>
									</div>   
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
				</div>				
			</footer>
			<!-- Main Footer -->

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->
			
			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
	</body>
</html>