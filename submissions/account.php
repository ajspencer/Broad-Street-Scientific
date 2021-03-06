<?php
include "connect.php";
include "errors.php";
include "dateconvert.php";
session_start();

if(!isset($_SESSION["userEmail"])){
	header("Location: upload.php");
}

$link = dbConnect("Research");
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Submissions | Broad Street Scientific</title>
        <link rel="stylesheet" href="../css/style.css"/>
        <link href='http://fonts.googleapis.com/css?family=Raleway:200,400,800' rel='stylesheet' type='text/css'>
        <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body class="content-page">
        <div class="mobile-nav" id="mobile-nav">
            <ul>
                <li><a href="../index.html">Home</a></li>
                <li><a href="index.html">Submissions</a></li>
                <li><a href="../contest/index.html">Essay Contest</a></li>
                <li><a href="../archive/index.html">Archive</a></li>
                <li><a href="../staff/index.html">Join the Staff</a></li>
                <li><a href="../contact/index.html">Contact</a></li>
            </ul>
        </div>
        <nav>
            <div class="container">
                <ul>
                    <li>
                        <!-- TITLE ITEM -->
                        <a href="../index.html">Broad Street Scientific</a>
                    </li>
                    <!-- OTHER ITEMS - PLACE IN REVERSE ORDER
                    FROM LEFT TO RIGHT - THEY ARE FLOATED RIGHT
                    SO THIS IS NECESSARY -->
                    <li><a href="../contact/index.html" class="menu-item">Contact</a></li>
                    <li><a href="../staff/index.html" class="menu-item">Join The Staff</a></li>
                    <li><a href="../archive/index.html" class="menu-item">Archive</a></li>
                    <li><a href="../contest/index.html" class="menu-item">Essay Contest</a></li>
                    <li><a href="index.html" class="menu-item active">Submissions</a></li>
                </ul>
            </div>
        </nav>
        <span class="nav-trigger" id="nav-trigger">&#9776;</span>
        <main>
            <section>
                <div class="container">
                    <div class="title">
                        <h2>Account</h2>
                    </div>
                    <div class="content">
                        <p>You're logged in as <?php echo($_SESSION["userEmail"]); ?></p>
						
						<?php
							if($_SESSION["editor"]){
								echo("<p>Click <a href='editor.php'>here</a/> to access the editor page, you lucky duck!</p>");
							}
								?>
								
						
						<?php
							$userEmail = $_SESSION["userEmail"];
							$sql = "SELECT * FROM papers WHERE 
							author = '$userEmail'";
							$result = mysqli_query($link, $sql);
							if (!$result) {
								error('A database error occurred in processing your ' . 'submission.\nIf this error persists, please ' . 'contact spencer16a@ncssm.edu');
							}
							//var_dump($result);
							maketable($result, ["filename", "subject", "timestamp"]);
							$num_papers = mysqli_num_rows($result);
							//var_dump($rows);
							
							echo("<p> You've submitted $num_papers paper(s)");
						?>
						
						<p>Submit more <a href="upload.php">here</a></p>
						<a href="logout.php">Logout?</a>
						
						
                    </div>
                </div>
            </section>
        </main>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../js/mobile-nav.js"></script>
    </body>
</html>


