<!--<!DOCTYPE html>-->
<?php
// put your code here
function displayPageHeader($pageTitle)
{
   $output = <<<ABC
<!DOCTYPE html>
 <html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="stylecommon.css" type="text/css" />   
        <title>ColoTIX</title>
    </head>
    <body>
     <header>
        <a href="HomePage.php"> <img src="logo.jpg" alt="ColoTIX" /></a>
        <a href="HomePage.php">ColoTiX</a>
        <h2> $pageTitle</h2>
     </header>
        <nav>
            <ul>
                <li><a href="HomePage.php">Home</a></li>
                <li> <a href="AboutUs.php">About Us</a></li>
                <li><a href="ContactUs.php">Contact Us</a></li>
ABC;


$logStatus = (isset($_SESSION['userInfo']));
$adminStatus = (isset($_SESSION['adminInfo']));
$usertype = $_SESSION['userInfo']['usertype'];
$userid = $_SESSION['userInfo']['userid'];

    if ($logStatus)
    {
         switch ($usertype) 
        {
    case '2':
      $output .=  '<li><a href="UserHomePage.php">View User Account</a></li>';
    break;
    case '3':
         $output .=  '<li><a href="HostHomePage.php">View Host Account</a></li>';
            $output .=  '<li><a href="HostPurchasedEvents.php">My Purchased Events</a></li>';
         $output .=  '<li><a href="HostCreateEventPage.php">Create Events</a></li>';
    break;
    }
     $output .= '<li><a href="Logout.php">Log Out</a></li>';
       
    }
    
    else if($adminStatus)
    {
     
       
          $output .= '<li><a href="AdminHomePage.php">Admin Home Page</a></li>';
           $output .= '<li><a href="Logout.php">Log Out</a></li>';
    }

    else
    {
        $output .= '<li><a href="Login.php">Log In/Sign Up</a></li>';
    }
    
    $output .= "</ul></nav>";

   echo $output;
}
   
function displayPageFooter()
{
   
   $output = <<<ABC
                <footer class="footer-basic-centered">

			<p class="footer-links">
				<a href="HomePage.php">Home</a>
				·
				<a href="AboutUs.php">About Us</a>
				·
				<a href="ContactUs.php">Contact</a>
			</p>

			<p class="footer-company-name">ColoTix &copy; 2019</p>

		</footer>
           </body>
           </html>

ABC;
   echo $output;
}
?>
