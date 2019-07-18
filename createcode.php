<?php

@session_start();

if(!empty($_POST['nooffields']) && !empty($_POST['fname']))
{
	$rootdir="forms";


	$nooffields=$_POST['nooffields'];
	$fname=$_POST['fname'];
	    $upperhtml = "\n<html>\n<head>\n<title>form</title>\n<link rel='stylesheet' type='text/css' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>\n<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>\n</head>\n<body>";
    $lowerhtml = "\n</body>\n</html>";
    $formdata = '';
     if(!file_exists($rootdir)){
      mkdir($rootdir);
  }

  $filename = $rootdir."/".$fname.".php";


    for($i=1;$i<=$nooffields;$i++)
    {
    	$type=$_POST["fieldtype".$i];
    	$name=$_POST["fieldname".$i];
    	$label=$_POST["fieldlabel".$i];
    	if($type=='text' || $type=='password')
    	{
    		$req=$_POST["req".$i];

    		$minlength=$_POST["minlength".$i];
    		$maxlength=$_POST["maxlength".$i];
    		$pattern=$_POST["pattern".$i];
    		if($req=='required'){
    			$formdata=$formdata."\n<div class='row'><div class='col'>&nbsp;</div><div class='col'><b>".$label."</b>\n<input type='".$type."' required='".$req."' pattern='".$pattern."' maxlength='".$maxlength."' minlength='".$minlength."' class='form-control' name='".$name."' /></div><div class='col'>&nbsp;</div></div><br>";
       

    		}
    		if($req='')
    		{
    			$formdata=$formdata."\n<div class='row'><div class='col'>&nbsp;</div><div class='col'><b>".$label."</b>\n<input type='".$type."' pattern='".$pattern."' maxlength='".$maxlength."' minlength='".$minlength."' class='form-control' name='".$name."' /></div><div class='col'>&nbsp;</div></div><br>";
       
    		}
    		
    	 }


    	 if($type=='email' || $type=='date')
    	{
    		$req=$_POST["req".$i];

    		
    		if($req=='required'){
    			$formdata=$formdata."\n<div class='row'><div class='col'>&nbsp;</div><div class='col'><b>".$label."</b>\n<input type='".$type."' required='".$req."' class='form-control' name='".$name."' /></div><div class='col'>&nbsp;</div></div><br>";
       

    		}
    		if($req='')
    		{
    			$formdata=$formdata."\n<div class='row'><div class='col'>&nbsp;</div><div class='col'><b>".$label."</b>\n<input type='".$type."' class='form-control' name='".$name."' /></div><div class='col'>&nbsp;</div></div><br>";
       
    		}
    		
    	 }

    	 if($type=='radio')
    	 {
    	 	$req=$_POST["req".$i];
    	 	$noofoptions=$_POST["options".$i];

    	 	if($req=='required'){
    	 		$radiodata='';
    	 		for($k=1;$k<=$noofoptions;$k++)
    	 		{
    	 			$option=$_POST["field".$i."option".$k];
    	 			$radiodata=$radiodata."\n<input type='".$type."' required='".$req."' value='".$option."' class='form-control' name='".$name."' />".$option;
    	 		}

    			$formdata=$formdata."\n<div class='row'><div class='col'>&nbsp;</div><div class='col'><b>".$label."</b>\n".$radiodata."</div><div class='col'>&nbsp;</div></div><br>";
       

    		}
    		if($req='')
    		{

    			$radiodata='';
    	 		for($k=1;$k<=$noofoptions;$k++)
    	 		{
    	 			$option=$_POST["field".$i."option".$k];
    	 			$radiodata=$radiodata."\n<input type='".$type."' value='".$option."' class='form-control' name='".$name."' />".$option;
    	 		}

    			$formdata=$formdata."\n<div class='row'><div class='col'>&nbsp;</div><div class='col'><b>".$label."</b>\n".$radiodata."</div><div class='col'>&nbsp;</div></div><br>";
       
    			      
    		}
    		


    	 }



    	  if($type=='select')
    	 {
    	 	$req=$_POST["req".$i];
    	 	$noofoptions=$_POST["options".$i];

    	 	if($req=='required'){
    	 		$selectdata="\n<select name='".$name."' required class='form-control'>";
    	 		$optionsdata='';
    	 		for($k=1;$k<=$noofoptions;$k++)
    	 		{
    	 			$option=$_POST["field".$i."option".$k];
    	 			$optionsdata=$optionsdata."\n<option value='".$option."' />".$option."</option>";
    	 		}

    			$formdata=$formdata."\n<div class='row'><div class='col'>&nbsp;</div><div class='col'><b>".$label."</b>\n".$selectdata.$optionsdata."</select></div><div class='col'>&nbsp;</div></div><br>";
       

    		}
    		if($req='')
    		{

    			$selectdata="\n<select name='".$name."' class='form-control'";
    	 		$optionsdata='';
    	 		for($k=1;$k<=$noofoptions;$k++)
    	 		{
    	 			$option=$_POST["field".$i."option".$k];
    	 			$optionsdata=$optionsdata."\n<option value='".$option."' />".$option."</option>";
    	 		}

    			$formdata=$formdata."\n<div class='row'><div class='col'>&nbsp;</div><div class='col'><b>".$label."</b>\n".$selectdata.$optionsdata."\n</select></div><div class='col'>&nbsp;</div></div><br>";
       
    			      
    		}
    		


    	 }




    }
    $data=$upperhtml."\n<form>\n".$formdata."\n</form>\n".$lowerhtml;
    file_put_contents($filename,$data,FILE_APPEND);
    echo "form created";
    header("Location: ".$filename);

}
else
{
	echo "kkkk";
}




 ?>