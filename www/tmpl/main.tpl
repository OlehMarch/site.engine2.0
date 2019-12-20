<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>%title%</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="%meta_desc%" />
	<meta name="keywords" content="%meta_key%" />
	<link rel="stylesheet" href="%address%css/main.css" type="text/css" />
</head>
<body>
	<div id="content">
		<div id="header">
			<!--<h2>Шапка сайта</h2>-->
			<div class="imgInHeader">
				<img src="images/header_img.jpg" width="200px" height="30px" alt="Шапка сайта">
			</div>
			<p>PHP handbook</p>
		</div>
	</div>
	<hr class="hr" />
	<div id="main_content">
		<div id="left">
			<h2>Меню</h2>
			<ul>%menu%</ul>
			%auth_user%
		</div>
		<div id="right">
			<form name="search" action="%address%" method="get">
				<p class="label">Suggestions: <span id="txtHint" class="label"></span></p> 
				<p class="label">
					Поиск: <input type="text" name="words" onkeyup="showHint(this.value)" />
				</p>
				
				<script type="text/javascript">
					function showHint(str) {
					  var xhttp;
					  if (str.length == 0) { 
						document.getElementById("txtHint").innerHTML = "";
						return;
					  }
					  xhttp = new XMLHttpRequest();
					  xhttp.onreadystatechange = function() {
						if (xhttp.readyState == 4 && xhttp.status == 200) {
						  document.getElementById("txtHint").innerHTML = xhttp.responseText;
						}
					  };
					  xhttp.open("GET", "gethint.php?q="+str, true);
					  xhttp.send();   
					}
				</script>
				
				<p>
					<input type="hidden" name="view" value="search" />
					<input type="submit" name="search" value="Искать" />
				</p>
			</form>
			<h2>Реклама</h2>
			%banners%
			%poll%
		</div>
		<div id="center">
			%top%
			%middle%
			%bottom%
		</div>
		<div class="clear"></div>
		<hr class="hr" />
		<div id="footer">
			<p>Все права защищены &copy; 2014</p>
		</div>
		<hr class="hr" />
	</div>
</body>
</html>