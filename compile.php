<?php
    include 'path.php';
	$CC="g++";
	$out="a.exe";
	$code=rawurldecode($_POST["code"]);
	$input=rawurldecode($_POST["input"]); // we use raw decoding in order to save our plus signs, which would be converted to spaces with usual decoding
	$filename_code="main.cpp";
	$filename_in="input.txt";
	$filename_error="error.txt";
	$executable="a.exe";
	$command=$CC." -lm ".$filename_code;	
	$command_error=$command." 2>".$filename_error;
	
	$file_code=fopen($filename_code,"w+");
	fwrite($file_code,$code);
	fclose($file_code);
	$file_in=fopen($filename_in,"w+");
	fwrite($file_in,$input);
	fclose($file_in);
	exec("cacls  $executable /g everyone:f"); 
	exec("cacls  $filename_error /g everyone:f");	

	shell_exec($command_error);
	$error=file_get_contents($filename_error);

	if(trim($error)=="")
	{
		if(trim($input)=="")
		{
			$output=shell_exec($out);
		}
		else
		{
			$out=$out." < ".$filename_in;
			$output=shell_exec($out);
		}

		echo "$output";
	}
	else if(!strpos($error,"error"))
	{
		echo "<pre>$error</pre>";
		if(trim($input) == "")
		{
			$output = shell_exec($out);
		}
		else
		{
			$out = $out." < ".$filename_in;
			$output = shell_exec($out);
		}
		echo "$output";
	}
	else
	{
		echo "<pre>$error</pre>";
	}
	exec("del $filename_code");
	exec("del *.o");
	exec("del *.txt");
	exec("del $executable");
?>