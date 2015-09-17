<?php
	session_start();
?>
<html>
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="http://localhost:8000/socket.io/socket.io.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<style>
		#chart{
			width: 300px;
			height: 500px;
			border: 1px solid #000;
		}
	</style>
  </head>
  <body>
    <script>
      var socket = io.connect('http://localhost:8000');
	  
	  socket.on('chatMsg', function(data) {
		var nowContent = $('#chart').html();
		$('#chart').html(nowContent+data.msg)
      });
	  
		socket.on('conn', function (data) {

			var postdata = {

				'uid': '<?php echo $_SESSION["uid"]; ?>',     //用户id

				'userName' : '<?php echo $_SESSION["userName"]; ?>'   //用户昵称

			}

			socket.emit('login', postdata,function(result){});

		});
	  
	  function send(){
		socket.emit('chatMsg', {'msg':$('#text').val(),'name':'<?php echo $_SESSION["userName"]; ?>'});
		$('#text').val('');
	  }
    </script>
    <div id="date"></div>
	<div id="chart"></div>
	姓名:
	<span><?php echo $_SESSION["userName"]; ?></span><br/>
	內容:<br/>
    <textarea id="text" width="200" height="300"></textarea>
	<input type="button" value="Send" onclick="send()" />
  </body>
</html>