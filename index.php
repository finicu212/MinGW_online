<!DOCTYPE html>
<html lang="en">
<head>
	<title>Online C++ Compiler</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>

<div class="wrap">
	<header class="navbar navbar-expand navbar-dark bg-dark">
		<a class="navbar-brand mr-0" href="#">MinGW Online</a>
		
		<div class="collapse navbar-collapse">
			<a class="ml-2 nav-item nav-link active" id="sendCode" href="#"><img src="images/run.png" class="runImg mx-2" alt="">Run</a>
		</div>

		<button id="expandInput" class="btn btn-secondary">
			< Input
		</button>
		<textarea name="input" id="input" cols="30" rows="10"></textarea>
		
	</header>


	<pre id="editor">
/*
	Online compiler, FILS 2020
	IWP Project
*/

#include &ltiostream&gt

using namespace std;

int main()
{
	cout << "Hello world, from the web \n";
	return 0;
}
	</pre>

	<div class="resultContainer">
		<div class="leftBorder"></div>
		<textarea id="result" class="col form-control text-white" cols="30" rows="10">Result here</textarea>
	</div>

	<footer class="bg-dark text-white page-footer font-small pt-4 text-center">
		© 2020 Copyright: <a href="#">filsCPP.com</a>		
	</footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.11/ace.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.11/ext-language_tools.min.js"></script>
<script>
	//ace.require("ace/ext/language_tools");
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/twilight");
    editor.session.setMode("ace/mode/c_cpp");
    editor.setOptions({
	    enableBasicAutocompletion: true,
    	enableSnippets: true,
    	enableLiveAutocompletion: true
	});
    editor.resize();
</script>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script type="text/javascript"> 
	var expand = document.getElementById("expandInput");

	expand.addEventListener("click", function() {
	    var content = document.getElementById("input");
		if (content.style.display === "block") 
		{
			content.style.display = "none";
			expand.innerHTML = "< Input";
		} 
		else 
		{
			content.style.display = "block";
			expand.innerHTML = "> Input";
		}
	});
	
	// code & input handling:
	const xhr = new XMLHttpRequest();

	xhr.onload = function()
	{
		const serverResponse = document.getElementById("result");
		serverResponse.innerHTML = this.responseText;
	}

	document.getElementById("sendCode").addEventListener("click", function()
	{
		xhr.open("POST", "compile.php");
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var inTextArea = document.getElementById("input");
		xhr.send("code=" + encodeURIComponent(editor.getValue()) + "&input=" + encodeURIComponent(inTextArea.value));
	});

</script>

</html>