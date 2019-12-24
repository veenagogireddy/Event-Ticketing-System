
<?php
   session_start();
   require_once("sitecommon2.php");
   displayPageHeader('Contact Us');
        
$output = <<<ABC
   <article> 
    <dl>
       <dt>For information, queries or any technical issues</dt>
        <dd>
          Please email us at <a href="mailto:info@colotix.com">info@colotix.com</a> or Call us at <a href="tel:9706898409">970-689-8409</a>   
          <br/><br/><br/><br/><br/><br/><br/>
        </dd>    
    </dl>      
        
ABC;
  echo $output;
    
        displayPageFooter();
  ?>

