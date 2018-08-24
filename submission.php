<!DOCTYPE HTML>
<html>
	<head>
		<title>எம்.ஐ.டி. தமிழ் மன்றம்</title>
		<link rel="icon" type="image/png" href="../images/logo_icon.jpg"/>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	</head>
	<body class="is-preload">
		<div id="page-wrapper">

    <!-- Header -->
    <header id="header" class="alt" style="background-color: #646464;">
        <h1><a href="index.html">எம்.ஐ.டி. தமிழ் மன்றம்</a></h1>
		<nav id="nav">
			<ul>
				<li><a href="index.html">முகப்பு</a></li>
				<li>
					<a href="#" class="icon fa-angle-down">பட்டியல்</a>
					<ul>
		            	<li><a href="goal.html">குறிக்கோள்</a></li>
				    	<li><a href="field.html">களங்கள்</a></li>
				    	<li><a href="team.html">குழுக்கள்</a></li>
				     	<li><a href="gallery.html">காட்சியகம்</a></li>
			    	</ul>
				</li>
			</ul>
		</nav>
	</header>

            <!-- Main -->
            
			<section id="main" class="container">
				<header>
					<h2>தங்கள் படைப்புகளை சமர்ப்பிக்கவும்</h2>
				</header>
				<div class="box">
                    <center>
                        <form enctype="multipart/form-data" action="submission.php" method="POST" name="sub">
                            <input type="text" name="student_name" placeholder="பெயர்" required="yes"><br>
                            <input type="text" name="student_number" placeholder="பதிவு எண்" required="yes" title="பதிவு எண்"><br>
                            <input type="file" name="uploaded_file" style="margin-left:auto; margin-right:auto" required="yes"><br>
                            <h2>  </h2>
                            <input type="submit" value="பதிவேற்று"/>
                        </form>
                    </center>
                    <p>
                        <span style="color: red;">*</span>&thinsp;ஆவணங்களின் கோப்பு பெயராக பதிவு எண்ணை பயன்படுத்தவும்.<br>
                        <span style="color: red;">*</span>&thinsp;ஆதரிக்கப்படும் கோப்பு வடிவங்கள் - jpg, jpeg, png, pdf, doc, docx<br>
                        <span style="color: red;">*</span>&thinsp;அதிகபட்ச கோப்பு அளவு - 1Mb
                    </p>
                </div>
			</section>

			<!-- Footer -->
			<footer id="footer">
				<ul class="copyright">
					<li><a href="https://facebook.com/Mittamizhmandram" class="icon fa-facebook"><span class="label">Facebook</span>&emsp;mittamizhmandram</a></li>
					<li><a href="mailto:mittamilmandram@gmail.com" class="icon fa-envelope-o">&emsp;mittamilmandram@gmail.com</a></li>
					<li><a href="https://maps.google.com/?q=madras+institute+of+technology" target="_blank"><i class="icon fa-map-marker">&emsp;Madras Institute of Technology, Anna University, Chromepet, Chennai-600044</i></a></li>
					<li>&copy; எம்.ஐ.டி. தமிழ் மன்றம்</li>
				</ul>
			</footer>
		
		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>

<?php
if(!empty($_FILES['uploaded_file']))
  {
    $path = "uploads/";
    $path = $path . basename( $_FILES['uploaded_file']['name']);
    $imageFileType = strtolower(pathinfo($path,PATHINFO_EXTENSION));
    $fileName = pathinfo($_FILES['uploaded_file']['name'],PATHINFO_FILENAME);
    $size = $_FILES['uploaded_file']['size'];
    if ($fileName != $_REQUEST['student_number']) {
      # code...
      echo '<script>alert("File name should be same as register number");</script>';
    }
    elseif(($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "doc" || $imageFileType == "pdf" ||$imageFileType == "jpeg" || $imageFileType == "docx" || $imageFileType == "txt") && $size<1000000 )
    {
      if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
        //echo "The file ".  basename( $_FILES['uploaded_file']['name'])." has been uploaded";
        echo '<script>alert("Done");</script>';
      } else{
          echo '<script> alert("There was an error uploading the file, please try again!";</script>';
      }
    }
    elseif ($size > 1000000) {
      # code...
      echo '<script>alert("File size should not exceed 1Mb");</script>';
    }
  else {
    echo '<script>alert("Unsupported File Format");</script>';
  }
  
}
?>
<?php
    error_reporting(0);
    $name = $_REQUEST["student_name"]; //You have to get the form data
    $no = $_REQUEST["student_number"];
    $path = "uploads/";
    $file = fopen($path.'upload.txt', 'a+'); //Open your .txt file
    $content = file_get_contents($file,'1');
    //ftruncate($file, 0); //Clear hte file to 0bit
    $new_content = $name. ",".$no. "," .date("h:i:sa").",".date("Y-m-d") .PHP_EOL;
    $content.=$new_content;
    $status = fwrite($file , $content); //Now lets write it in there
    //file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
    fclose($file ); //Finally close our .txt
    //die(header("Location: ".$_SERVER["HTTP_REFERER"]));
?>