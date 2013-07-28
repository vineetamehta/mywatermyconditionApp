<?php include "connect.php";?>
<?php
session_start();
// store session data

?>
<?php 
 $B=$_POST['st'];
?>
<?php
$result=mysql_query("SELECT distinct state from `2009`");
$flag='0';
while ($d=mysql_fetch_array($result))
{
  if( $d['state'] == $B )
  {$flag='1';   break;}
  
}

?>
<?php    
               
           if(!$flag)
             {
 		$data = mysql_query("SELECT DISTINCT quality, state, district from `2009` having district='$B'")  or die(mysql_error()); 
	        $num = mysql_num_rows($data);
		$C = $num;
		//echo $D_[$num];
		while($num > '0')
		{	$info = mysql_fetch_array( $data );
 		     	$D[$num]=$info['quality'];
			$num=$num-'1';
 		$state = $info['state'] ;
                $district = $info['district'] ;
		 
		}
	     }
   if($flag)
             {
 		 $_SESSION['statename']=$B;
		include "test.php";
	      
	     }
?>

<!doctype html>
<html>
<head>
 <title>Water save it! </title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<!added for bootstrap>

 <link rel="stylesheet" type="text/css" media="all" href="styles/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" media="all" href="styles/styles.css">
<link rel="stylesheet" href="styles/bootstrap.css" media="screen" /><!--added for bootstrap-->
<link rel="stylesheet" href="styles/style.css" media="screen" />
<link rel="stylesheet" href="styles/media-queries.css" />
<link rel="stylesheet" href="styles/bootstrap-responsive.css" media="screen" />
<link href="styles/tipsy.css" rel="stylesheet" type="text/css" media="screen" />


<script type="text/javascript" src="./scripts/jquery-1.7.1.min.js"></script>
 <script type="text/javascript"  src="./scripts/jquery-1.9.1.min.js"></script>
 <script type="text/javascript"  src="./scripts/bootstrap.min.js"></script>
 <script type="text/javascript"  src="./scripts/customtabs.js"></script>

<script src="scripts/jquery.knob.js" type="text/javascript"></script>
<script type="text/javascript" src="./scripts/jquery.isotope.min.js"></script>
<script type="text/javascript" src="./scripts/jquery.smooth-scroll.min.js"></script>
<script type="text/javascript" src="./scripts/waypoints.min.js"></script>
<script type="text/javascript" src="./scripts/setup.js"></script>
</head>
<body>
<div id="wrap"> 
  <!-- wrapper -->
  <div id="sidebar"> 
    <!-- the  sidebar --> 
    <!-- logo --> 
    <a href="#" id="logo"> <img src="./images/q.png" alt="hello" /></a> 
    <!-- navigation menu -->
    <ul id="navigation">
      <li><a href="index.html">Home</a></li>
		<?php 
		  $i='1';
		 while ( $i <= $C )
		{ if($i=='1')
    		  echo "<li><a href='#".$i."' class='active'>".$D[$i]."</a></li>";
		  else
		  echo "<li><a href='#".$i."'>".$D[$i]."</a></li>";
		$i = $i+'1';
		}?>
     
    </ul>
  </div>
	<?php if(!$flag)
		{echo '<div id="container"> 
       		 <div class="page">
   		<h3 class="page_title"> Condition in my area </h3>
		</div>
		</div>';}?>
<?php 
$i='1';
while($i<=$C)
 {   


	$sql=mysql_fetch_array(mysql_query(" SELECT * from `qualitysheet` where QUALITY= '$D[$i]' ")) or die(mysql_error());
		
 echo ' <div id="container"> 
       <div class="page" id="'.$i.'"> 
      <!-- page cause-->
     
      <div class="page_content">

	<h3 align="center">';
 echo $state."<br>".$district."<br>".$D[$i];
 echo '</h3> 

	
    <!--<div class="row">
      <div class="span12">-->
       
       
        <ul class="nav nav-tabs">
          <li class="active"><a href="#cause'.$i.'" data-toggle="tab">CAUSE</a></li>
          <li><a href="#impact'.$i.'" data-toggle="tab">IMPACT</a></li>
          <li><a href="#remedies'.$i.'" data-toggle="tab">REMEDIES</a></li>
        </ul>
            
        <div class="tab-content">
          <div class="tab-pane active" id="cause'.$i.'">
            
            <p>';
       echo $sql['CAUSE'];
       echo '</p>
            
          </div><!-- @end #cause -->
          
          <div class="tab-pane" id="impact'.$i.'">
           
            
            <p>';
        echo $sql['IMPACT'];
        echo '</p>
          </div><!-- @end #impact-->
          
          <div class="tab-pane" id="remedies'.$i.'">
          
            <p>';
	 echo $sql['REMEDIES'];
	echo '</p>
           </div><!-- @end #remedies-->
       
        </div><!-- @end .tab-content -->
        
   <!--   </div>- @end .span12 -->
  <!--  </div> @end .row -->
  <div class="clear"> </div>
 </div><!--page content-->
 </div><!--page-->

 </div><!--container-->
 ';

$i=$i+'1';
}
?>
</div><!--wrap-->
 <div class="clear"> </div> <div class="clear"> </div><div class="clear"> </div>
</body>
</html>      
