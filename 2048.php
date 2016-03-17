<html>
<head>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style>
		html,body{
			font-family: "Lucida Console", Times, serif!important;
		}
		td,table {
			border: 1px solid #bbada0 !important;
			border-radius: 6px!important;
			font-family: "Lucida Console", Times, serif!important;
			border-spacing: 8px;
			border-collapse: separate !important;
			
		}
		span{
			font-size: 27px!important;
			font-weight: 900!important;
		}
		h1.title {
			font-size: 72px;
			font-weight: bold;
			margin: 0;
			display: block;
			color:#776e65;
		}
		h4.title {
			font-size: 28px;
			font-weight: bold;
			margin: 0;
			display: block;
			color:red;
		}
		.gameover_dis {
			position: relative;
			width: 400px;
			margin: 0 auto;
		}
		
		.gameover_pos {
			position: absolute;
			top: 140px;
			left: 128px;
			text-align: center;
			z-index: 9999;
		}
		.hide{
			display: none;
		}
		.opacity{
			opacity: 0.1;
		}
		.animate{
			font-size: 38px!important;
			}
		.btn-color{
			background: #776e65!important;
			color: white!important;
		}
		.error{
			color: red;
		}
	</style>
</head>
<body>
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="heading">
			
		  <h1 class="title">2048</h1>
		  <!-- <h4 class="text-right">SCORE</h4>
		 <h4 class="text-right" id="score1">0</h4>-->
			<p>
			  <span class="text-right" style="float: right;">SCORE</span><br/>
			  <span class="text-right" id="score1" style="float: right;margin: 18px -61px;">0</span>
			  <button class="btn input-sm btn-color" style="float: right;margin: 60px -25px;" onclick="undo()">UNDO</button>
			  <button class="btn input-sm btn-color" style="float: right;margin: 60px -106px;" onclick="reset()">RESET</button>
			</p>
		</div>
		<div class="gameover_dis">
			<div class="gameover_pos">
				<h4 class="title">GAME OVER</h4>
				<button class="btn btn-color" onclick="submit_score()">SUBMIT</button>
			</div>
		<table align="center">
			<tr align="center">
				<td width="100" height="100" ><span class="cell_1"></span><input type="hidden" class="cell_1" /> </td>
				<td width="100" height="100"><span class="cell_2"></span><input type="hidden" class="cell_2" /></td>
				<td width="100" height="100"><span class="cell_3"></span><input type="hidden" class="cell_3" /></td>
			</tr>
			<tr align="center">
				<td width="100" height="100"><span class="cell_4"></span><input type="hidden" class="cell_4" /></td>
				<td width="100" height="100"><span class="cell_5"></span><input type="hidden" class="cell_5" /></td>
				<td width="100" height="100"><span class="cell_6"></span><input type="hidden" class="cell_6" /></td>
			</tr>
			<tr align="center">
				<td width="100" height="100"><span class="cell_7"></span><input type="hidden" class="cell_7" /></td>
				<td width="100" height="100"><span class="cell_8"></span><input type="hidden" class="cell_8" /></td>
				<td width="100" height="100"><span class="cell_9"></span><input type="hidden" class="cell_9" /></td>
			</tr>
		</table>
		</div>
	</div>
	<div class="col-md-3"></div>
	
	<!-- Submit Popup -->
	<div id="submit" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<form id="register">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Register / Login</h4>
			  </div>
			  <div class="modal-body">
				<h5 id="error" class="error"> </h5>
				<div class="form-group">
					<input type="email" class="form-control" id="email" placeholder="Enter Email id Here" />
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="submit" class="btn btn-color">Submit</button>
			  </div>
			</div>
		</form>
	  </div>
	</div>
<script>
$(document).ready(function(){
	$('.gameover_dis').find('.gameover_pos').hide()
	for(var t = 1; t <=9; t++){
		if($('.cell_'+t).val() == ''){
			$('.cell_'+t).parent().css("background-color","rgba(238, 228, 218, 0.35)");
		}
		if($('.cell_'+t).val() == '2'){
			$('.cell_'+t).parent().css("background-color","#eee4da");
		}
		if($('.cell_'+t).val() == '4'){
			$('.cell_'+t).parent().css("background-color","#ede0c8");
		}			
	}
});

	var val,val2;
	var up, right, down, left, score = 0;
	getRandomNumber();
	function getRandomNumber(){
		val = Math.floor((Math.random() * 9) + 1);
		val2 = Math.floor((Math.random() * 9) + 1);		
			
		writeInitialValue();
	}
	function writeInitialValue(){
		if(val == val2)
			getRandomNumber();
		else{
			
			$('.cell_'+val).html('2');
			$('.cell_'+val2).html('2');
			
			$('.cell_'+val).val('2');
			$('.cell_'+val2).val('2');
			
			
			/*$('.cell_9').html('2');
			$('.cell_6').html('2');
			$('.cell_3').html('2');
			
			$('.cell_9').val('2');
			$('.cell_6').val('2');
			$('.cell_3').val('2');*/
		}
	}
	

	
	function row(a,b,c){
	var d,e;
		if($('.cell_'+c).val() || $('.cell_'+b).val() || $('.cell_'+a).val()){
				if($('.cell_'+c).val() != '' && $('.cell_'+b).val() != '' && $('.cell_'+a).val() != ''){					
					if($('.cell_'+c).val() == $('.cell_'+b).val()){
						//Store Undo Values
						localStorageValue();
						
						var val = parseInt($('.cell_'+c).val()) + parseInt($('.cell_'+b).val());
						score = score + val;
						$('.cell_'+c).html(val);
						$('.cell_'+c).val(val);
						
						$('.cell_'+c).addClass('animate');
						setTimeout(function(){
							$('.cell_'+c).removeClass('animate');
						},500);
						
						$('.cell_'+b).html($('.cell_'+a).val());
						$('.cell_'+b).val($('.cell_'+a).val());
						
						$('.cell_'+a).html('');
						$('.cell_'+a).val('');
						
						
						d = "entered";
					}else if($('.cell_'+b).val() == $('.cell_'+a).val()){
						//Store Undo Values
						localStorageValue();
						
						var val2 = parseInt($('.cell_'+b).val()) + parseInt($('.cell_'+a).val());
						score = score + val2;
						//alert(val2);
						$('.cell_'+b).html(val2);
						$('.cell_'+b).val(val2);
						
						$('.cell_'+b).addClass('animate');
						setTimeout(function(){
							$('.cell_'+b).removeClass('animate');
						},500);
						
						$('.cell_'+a).html('');
						$('.cell_'+a).val('');
						
						d = "entered";
					}else{
						e = "gameover"
					}
				}else if($('.cell_'+c).val() == '' && ($('.cell_'+b).val() != '' && $('.cell_'+a).val() != '')){			
					if($('.cell_'+a).val() == $('.cell_'+b).val()){
					
						//Store Undo Values
						localStorageValue();
						
						var val = parseInt($('.cell_'+a).val()) + parseInt($('.cell_'+b).val());
						score = score + val;
						//alert(val);
						$('.cell_'+c).html(val);
						$('.cell_'+c).val(val);
						
						$('.cell_'+c).addClass('animate');
						setTimeout(function(){
							$('.cell_'+c).removeClass('animate');
						},500);
						
						$('.cell_'+a).html('');
						$('.cell_'+a).val('');
						
						$('.cell_'+b).html('');
						$('.cell_'+b).val('');
						
						d = "entered";
						//checkTableValues();
					}else{
						//Store Undo Values
						localStorageValue();
						
						$('.cell_'+c).html($('.cell_'+b).val());
						$('.cell_'+b).html($('.cell_'+a).val());
						
						$('.cell_'+c).val($('.cell_'+b).val());
						$('.cell_'+b).val($('.cell_'+a).val());
						
						$('.cell_'+a).html('');
						$('.cell_'+a).val('');
						
						d = "entered";
						//checkTableValues();
					}
				}else if($('.cell_'+b).val() == '' && ($('.cell_'+c).val() != '' && $('.cell_'+a).val() != '')){			
					if($('.cell_'+a).val() == $('.cell_'+c).val()){
						//Store Undo Values
						localStorageValue();
						
						var val = parseInt($('.cell_'+a).val()) + parseInt($('.cell_'+c).val());
						score = score + val;
						$('.cell_'+c).html(val);
						$('.cell_'+c).val(val);
						
						$('.cell_'+c).addClass('animate');
						setTimeout(function(){
							$('.cell_'+c).removeClass('animate');
						},500);
						
						$('.cell_'+a).html('');
						$('.cell_'+a).val('');
						
						$('.cell_'+b).html('');
						$('.cell_'+b).val('');
						
						d = "entered";
						//checkTableValues();
					}else{
						//Store Undo Values
						localStorageValue();
						
						$('.cell_'+b).html($('.cell_'+a).val());
						$('.cell_'+a).html('');
						
						$('.cell_'+b).val($('.cell_'+a).val());
						$('.cell_'+a).val('');
						
						d = "entered";
						//checkTableValues();
					}
				}else if($('.cell_'+a).val() == '' && ($('.cell_'+c).val() != '' && $('.cell_'+b).val() != '')){			
					if($('.cell_'+b).val() == $('.cell_'+c).val()){	
						//Store Undo Values
						localStorageValue();
						
						var val = parseInt($('.cell_'+b).val()) + parseInt($('.cell_'+c).val());
						score = score + val;
						//alert(val);
						$('.cell_'+c).html(val);
						$('.cell_'+c).val(val);
						
						$('.cell_'+c).addClass('animate');
						setTimeout(function(){
							$('.cell_'+c).removeClass('animate');
						},500);
						
						$('.cell_'+a).html('');
						$('.cell_'+a).val('');
						
						$('.cell_'+b).html('');
						$('.cell_'+b).val('');
						
						d = "entered";
						//checkTableValues();
					}else{						
						//checkTableValues();
					}
				}else if($('.cell_'+a).val() != '' && ($('.cell_'+c).val() == '' && $('.cell_'+b).val() == '')){
					//Store Undo Values
						localStorageValue();
						
					$('.cell_'+c).html($('.cell_'+a).val());
					$('.cell_'+c).val($('.cell_'+a).val());
					
					$('.cell_'+a).html('');
					$('.cell_'+a).val('');
					
					d = "entered";
				}else if($('.cell_'+b).val() != '' && ($('.cell_'+c).val() == '' && $('.cell_'+a).val() == '')){
					//Store Undo Values
						localStorageValue();
						
					$('.cell_'+c).html($('.cell_'+b).val());
					$('.cell_'+c).val($('.cell_'+b).val());
					
					$('.cell_'+b).html('');
					$('.cell_'+b).val('');
					
					d = "entered";
				}
			
		}
		changeColor();
		if( d == "entered")
			return d;
		else if(e == "gameover")
			return e;
	}
		$(document).keydown(function(e) {
			var a = gameOver();
			
			if(a != '111'){
				$('.input-sm').removeClass('hide');
				if(e.which == 38) {
					//UP
					var up_1 = row(7,4,1);
					var up_2 = row(8,5,2);
					var up_3 = row(9,6,3);
					//score
					document.getElementById('score1').innerHTML = score;
					if( up_1 == "entered" ||  up_2 == "entered" ||  up_3 == "entered" ){
						up = 1;
						checkTableValues()
					}else if(up_1 == "gameover" &&  up_2 == "gameover" &&  up_3 == "gameover"){
						up = 0;
					}
				}else if(e.which == 39){
					//  RIGHT
					right = 1;
					var right_1 = row(1,2,3);
					var right_2 = row(4,5,6);
					var right_3 = row(7,8,9);
					
					document.getElementById('score1').innerHTML = score;			
					if( right_1 == "entered" ||  right_2 == "entered" ||  right_3 == "entered" ){
						right = 1;
						checkTableValues();
					}else if(right_1 == "gameover" &&  right_2 == "gameover" &&  right_3 == "gameover"){
						right = 0;
					}
				}else if(e.which == 40){
					//DOWN
					
					var down_1 = row(3,6,9);
					var down_2 = row(2,5,8);
					var down_3 = row(1,4,7);
					
					document.getElementById('score1').innerHTML = score;
					if( down_1 == "entered" ||  down_2 == "entered" ||  down_3 == "entered" ){
						down = 1;
						checkTableValues();
					}else if(down_1 == "gameover" &&  down_2 == "gameover" &&  down_3 == "gameover"){				
						down = 0;
					}
				}else if(e.which == 37){
					// LEFT
					var left_1 = row(3,2,1);
					var left_2 = row(6,5,4);
					var left_3 = row(9,8,7);
					
					document.getElementById('score1').innerHTML = score;
					if( left_1 == "entered" ||  left_2 == "entered" ||  left_3 == "entered" ){
						left = 1;
						checkTableValues();
					}else if(left_1 == "gameover" &&  left_2 == "gameover" &&  left_3 == "gameover"){				
						left = 0;
					}
				}		
				changeColor();
			}else{
				$('.gameover_pos').slideDown('slow');
				$('table').addClass('opacity');
			}
		
	});
	
	function checkTableValues(){
		var emptyCell = [];
		for(var t = 1; t <=9; t++){
			if($('.cell_'+t).val() == ''){
				emptyCell.push(t);
			}
		}
		//console.log(Math.floor(Math.random() * emptyCell.length));
		var rand = emptyCell[Math.floor(Math.random() * emptyCell.length)];
		$('.cell_'+rand).html('2');
		$('.cell_'+rand).val('2');
		changeColor();
		
		
		var a = gameOver();
		if(a == '111'){
			$('.gameover_pos').slideDown('slow');
			$('table').addClass('opacity');
		}
	}
	
	function changeColor(){
		/*if(up == 0 && right == 0 && down == 0 && left == 0){
			$('.title').removeClass('hide');
			$('table').addClass('opacity');
		} */
		for(var t = 1; t <=9; t++){
			if($('.cell_'+t).val() == ''){
				$('.cell_'+t).parent().css("background-color","rgba(238, 228, 218, 0.35)");
			}else if($('.cell_'+t).val() == '2'){
				$('.cell_'+t).css("color","#000000");
				$('.cell_'+t).parent().css("background-color","#eee4da");
			}else if($('.cell_'+t).val() == '4'){
				$('.cell_'+t).css("color","#000000");
				$('.cell_'+t).parent().css("background-color","#ede0c8");
			}else if($('.cell_'+t).val() == '8'){
				$('.cell_'+t).parent().css("background-color","#f2b179");
				$('.cell_'+t).css("color","#f9f6f2");
			}else if($('.cell_'+t).val() == '16'){
				$('.cell_'+t).parent().css("background-color","#f59563");
				$('.cell_'+t).css("color","#f9f6f2");
			}else if($('.cell_'+t).val() == '32'){
				$('.cell_'+t).parent().css("background-color","#f67c5f");
				$('.cell_'+t).css("color","#f9f6f2");
			}else if($('.cell_'+t).val() == '64'){
				$('.cell_'+t).parent().css("background-color","#f65e3b");
				$('.cell_'+t).css("color","#f9f6f2");
			}else if($('.cell_'+t).val() == '128'){
				$('.cell_'+t).parent().css("background-color","#edcf72");
				$('.cell_'+t).css("color","#f9f6f2");
			}else if($('.cell_'+t).val() == '256'){
				$('.cell_'+t).parent().css("background-color","#edcc61");
				$('.cell_'+t).css("color","#f9f6f2");
			}else if($('.cell_'+t).val() == '512'){
				$('.cell_'+t).parent().css("background-color","#e6b619");
				$('.cell_'+t).css("color","#f9f6f2");
			}else if($('.cell_'+t).val() == '1024'){
				$('.cell_'+t).parent().css("background-color","#00cc66");
				$('.cell_'+t).css("color","#f9f6f2");
			}else if($('.cell_'+t).val() == '2048'){
				$('.cell_'+t).parent().css("background-color","#00994d");
				$('.cell_'+t).css("color","#f9f6f2");
			}
		}
	}
	
	function undo(){
		for(var i = 1; i<=9;i++){
			var val = localStorage.getItem('cell_'+i);
			$('.cell_'+i).val('');
			$('.cell_'+i).html('');
			
			$('.cell_'+i).val(val);
			$('.cell_'+i).html(val);
		}
		//localStorage.getItem(score)
		document.getElementById('score1').innerHTML = localStorage.getItem('score');
		score = parseInt(localStorage.getItem('score'));
		changeColor();
		$('.gameover_dis').find('.gameover_pos').hide();		
		$('.gameover_dis').find('table').removeClass('opacity');
	}
	
	function reset(){		
		localStorage.clear();
		for(var i = 1; i<=9;i++){
			$('.cell_'+i).val('');
			$('.cell_'+i).html('');
		}	
		writeInitialValue();
		changeColor();
		score = 0;
		document.getElementById('score1').innerHTML = 0;
		$('.gameover_dis').find('.gameover_pos').hide();		
		$('.gameover_dis').find('table').removeClass('opacity');
		$('.input-sm').addClass('hide');
	}
	function gameOver(){
		if($('.cell_1').val() != '' && $('.cell_2').val() != '' && $('.cell_3').val() != '' && $('.cell_4').val() != '' && $('.cell_5').val() != '' && $('.cell_6').val() != '' && $('.cell_7').val() != '' && $('.cell_8').val() != '' && $('.cell_9').val() != ''){
			if( ($('.cell_2').val() != $('.cell_1').val()) && ($('.cell_2').val() != $('.cell_3').val()) && ($('.cell_2').val() != $('.cell_5').val()) && ($('.cell_6').val() != $('.cell_3').val()) && ($('.cell_6').val() != $('.cell_5').val()) && ($('.cell_6').val() != $('.cell_9').val()) && ($('.cell_8').val() != $('.cell_9').val()) && ($('.cell_8').val() != $('.cell_7').val()) && ($('.cell_8').val() != $('.cell_5').val()) && ($('.cell_4').val() != $('.cell_7').val()) && ($('.cell_4').val() != $('.cell_1').val()) && ($('.cell_4').val() != $('.cell_5').val())){
			
				return '111';
			}
		} 
	}
	
	function localStorageValue(){
		localStorage.setItem("cell_1", $('.cell_1').val());
		localStorage.setItem("cell_2", $('.cell_2').val());
		localStorage.setItem("cell_3", $('.cell_3').val());
		localStorage.setItem("cell_4", $('.cell_4').val());
		localStorage.setItem("cell_5", $('.cell_5').val());
		localStorage.setItem("cell_6", $('.cell_6').val());
		localStorage.setItem("cell_7", $('.cell_7').val());
		localStorage.setItem("cell_8", $('.cell_8').val());
		localStorage.setItem("cell_9", $('.cell_9').val());
		localStorage.setItem("score", score);			
	}
	
	function submit_score(){
		$('#submit').modal('show');		
	}
	
	$( "#register" ).submit(function( event ) {
		var mail = $('#email').val();
		event.preventDefault();
		if(mail != ''){
			$.ajax({
				type: 'POST',
				url: 'ajax/submit.php',
				data:{
					'mailid': mail,
					'score' : score
				},
				success:function(response){
					if(response == 1){
						location.reload();
					}
				}
			});
		}else{
			document.getElementById('error').innerHTML = 'Enter your Mail Id.';
			event.preventDefault();
		}			
	});
</script>
</body>
</html>
