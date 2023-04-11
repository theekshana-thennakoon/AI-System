<?php
session_start();
?>
<?php
//include('database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AI System</title>

    <!-- custom css file link  -->
	
	<link href="assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="wrapstyle.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    
    <style>
    .header-1 img{width:30%;}
    .inputBox select , .inputBox input{
	  padding:1rem;font-size: 1.7rem;background:#f7f7f7;text-transform: none;
	  margin:1rem 0;border:.1rem solid rgba(0,0,0,.3);width: 49%;
    }
    .copyright{position:fixed;bottom:20px;right:10px;border:1px solid #ccc;padding:0.5%;z-index: 2;}
	textarea{
        width: 100%;
        resize: none;
        height: 59px;
        outline: none;
        padding: 15px;
        font-size: 16px;
        margin-top: 20px;
        border-radius: 5px;
        max-height: 330px;
        caret-color: #4671EA;
        border: 1px solid #bfbfbf;
    }
    textarea::placeholder{
    color: #b3b3b3;
    }
    textarea:is(:focus, :valid){
    padding: 14px;
    border: 2px solid #4671EA;
    }
    textarea::-webkit-scrollbar{
    width: 0px;
    }
    @media (max-width: 739px) {
        .contact{
            display: flex;min-height: 80%;align-items: center;justify-content: center;
        }
	    .header-1 img{width:80%;}
    } 
    </style>
</head>
<body>
<!-- header section starts  -->

<header>

    <div class="header-1">
        <center><a href="#" class="logo" style = 'color:#fe2121;'><img src = 'logo1.png'></a></center>
    </div>

    

</header>
<!-- Pickup section starts  -->

<section class="contact">
	<form action='' method = 'post'>
		<div class='inputBox'>
            <input type = 'text' name = 'discription' placeholder='Enter Question' style = 'width:100%;' spellcheck="false" required>
        </div>
        <input type='submit' name = 'addrem' value='Search' class='btn' style = 'background:#fe2121;display:none;'>
    </form>

    
	<div class="wrapper">
      <div class="content">
        <ul class="menu">
          <li class="item share">
            <ul class="share-menu"></ul>
          </li>
          <li class="item">
            <i class="uil uil-ban"></i>
          </li>
          <li class="item">
            <span>Right Click Disabled</span>
          </li>
        </ul>
      </div>
    </div>
</section>
<div class="copyright"><h5>Developed by<br>Thisula Development<h5></div>
<!-- Pickup section ends -->
<br><br>
<!-- custom js file link  -->
<script src="script.js"></script>
<?php

if(isset($_POST['discription'])){
    $description = $_POST['discription'];
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    $postdata = array(
        "model"=> "text-davinci-001",
        "prompt"=> $description,
        "temperature"=> 0.4,
        "max_tokens"=> 1400,
        "top_p"=> 1,
        "frequency_penalty"=> 0,
        "presence_penalty"=> 0
      );
    $postdata = json_encode($postdata);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer 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';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    $result = json_decode($result,true);
    echo "
    <section class='contact'>
	<form action='' method = 'post'>
		<div class='inputBox'>
        <textarea style = 'width:100%;' readonly>";
                print_r($result['choices'][0]['text']);
            echo "</textarea>
        </div>
        </form>";
}

?>   
    <script>
      const textarea = document.querySelector("textarea");
      textarea.addEventListener("keyup", e =>{
        textarea.style.height = "63px";
        let scHeight = e.target.scrollHeight;
        textarea.style.height = `${scHeight}px`;
      });
    </script>
<script src="scripts.js"></script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>