<?php
// del zip file

unlink("group.zip"); 
// empty the existing output folderr
$files = glob('output/*'); //get all file names
foreach($files as $file){
    if(is_file($file))
    unlink($file); //delete file
}


// to get the data of the uploaded file
$target_dir = "";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$name1= substr( basename($_FILES["fileToUpload"]["name"]),0,-4);

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "txt"  ) {
  echo "Sorry, only .txt files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.".'<br';
  } else {
    echo "Sorry, there was an error uploading your file.".'<br>';
  }
}
// running python code
$command= escapeshellcmd("analyze.py ".basename($_FILES["fileToUpload"]["name"]));
$output= shell_exec($command);
echo $output;
//displaying the images
// $imagesDirectory = "output/";
 
// if(is_dir($imagesDirectory))
// {
// 	$opendirectory = opendir($imagesDirectory);
  
//     while (($image = readdir($opendirectory)) !== false)
// 	{
// 		if(($image == '.') || ($image == '..'))
// 		{
// 			continue;
// 		}
		
// 		$imgFileType = pathinfo($image,PATHINFO_EXTENSION);
		
// 		if(($imgFileType == 'jpg') || ($imgFileType == 'png'))
// 		{
// 			echo "<img src='output/".$image."' width='800px' height='600px'> ";
// 		}
//     }
	
//     closedir($opendirectory);
 
// }
$file_pointer = basename($_FILES["fileToUpload"]["name"]);  
   
//  to delete a chat file  

 unlink($file_pointer); 

//image to display
$my_images_arr=scandir("output");
$img_string="";
foreach($my_images_arr as $image_name ){
	if((strlen($image_name)>3) && ( pathinfo($image_name,PATHINFO_EXTENSION)=="png")){
  $img_string .='<img src="output/'.$image_name.'">';
  
 
}
else continue;
}
$pathdir="output/";
$nameArchive="group.zip";
$zip =new ZipArchive;
if($zip -> open($nameArchive, ZipArchive:: CREATE)=== TRUE){
  $dir=opendir($pathdir);
  while($file=readdir($dir)){
    if(is_file($pathdir.$file)){
      $zip -> addFile($pathdir.$file,$file);
    }
  }
  $zip -> close();
//  echo "archivated";
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>gallery</title>
    <link rel="stylesheet" href="html\css\style.css">

    <link rel="icon" href="assets\Picture1.png">
    
  </head>
  <body>
  <div style="background-color: #086972;height:180px">
    <a href="index.html"><img src="assets\grouplysis logo(3).jpg" alt="logo" style="height: 100px;width: 250px; margin-top: 20px; margin-bottom: 20px;float:left;margin-right:20px; brightness:100% ">
    </a><span>  <a href="group.zip" download="group.zip"><img src="assets\icons8-download-50.png" alt="download zip file"  title="download zip file"style="float:right;margin-left:50px;margin-top:40px;height:50px;width:50px;text-align:left"></a>
</span>
</div>
  <div class="body">
 <!-- <a href="group.zip" download="group.zip"><img src="download1.png" alt="download zip file" title="download zip file"style="height:50px;width:50px;"></a>
  <section class ="download">
  <a href="output/<?php echo $name1?>-date_activity.png" download><img src="download.png" class="down"alt="<?php echo $name1?>-date_activity.png" style="height:30px;width:30px;" namespace="graph1"></a>
  <a href="output/<?php echo $name1?>-person_activity.png" download><img src="download.png" class="down" alt="<?php echo $name1?>-person_activity.png"style="height:30px;width:30px;"></a>
  <a href="output/<?php echo $name1?>-time_activity.png" download><img src="download.png" class="down"  alt="<?php echo $name1?>-time_activity.png"style="height:30px;width:30px;"></a>
  <a href="output/<?php echo $name1?>-word_frequency.png" download><img src="download.png" class="down" alt="<?php echo $name1?>-word_frequency.png"style="height:30px;width:30px;"></a>
  </section>
-->
    <h1>Graph of <?php echo $name1?> group </h1>
    <div class="gallery">
    <div class=img1 style="height:200px;width=300px">
    
    <?php
  echo $img_string;
 ?>
	</div>
	</div>
    </div>
  </body>
</html>