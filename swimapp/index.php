<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nccu cs Wang test system</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<span>帳號</span><input type="text" class="id"><br>
	<span>密碼</span><input type="password" class="pwd"><br>
	<button class="submit">送出</button>

	<script >
		$(".submit").click(function () {
			let data={};
			data.id=$('.id').val();
			data.pwd=$('.pwd').val();
			// console.log(data);
			$.ajax({url: "login.php",
				type:'POST',
				async:false,
				data:data,
			 	success: function(result){
        			console.log(result);
    		}});
		});
	</script>
</body>
</html>