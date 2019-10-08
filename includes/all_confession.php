<?php 

if(isset($_SESSION['uid']) =="" && isset($_SESSION['fname']) =="" && isset($_SESSION['batch']) =="")
{
	header("Location:../index.php");
}
?>


<div id="doc_result_div">
<?php		
	$rec_limit = 100;
	
	 /* Get total number of records */
         $sql = "SELECT count(doc_id) FROM doc_details";
         $retval = mysql_query( $sql);
         
         if(! $retval )
         {
            die('Could not get data: ' . mysql_error());
         }
         $row = mysql_fetch_array($retval, MYSQL_NUM );
         $rec_count = $row[0];
         
         if( isset($_GET{'page'} ) )
         {
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
         }
         else
         {
            $page = 0;
            $offset = 0;
         }
         $left_rec = $rec_count - ($page * $rec_limit);
?>	
	<div style="margin:5px;  word-wrap: break-word;">

<?php 

	
    $conf_sql = "SELECT conf_content,conf_date FROM anony_confession ORDER BY conf_id DESC LIMIT $offset, $rec_limit";
	$conf_retval = mysql_query($conf_sql);
	if(! $conf_retval )
	{
		die('Could not get data: ' . mysql_error());
	}
   
	while($conf_row = mysql_fetch_array($conf_retval, MYSQL_ASSOC))
	{
		$conf_content = $conf_row['conf_content'];
		
		$conf_timestamp = strtotime($conf_row['conf_date'] .'+12hour30min');
		
		$post_time=  date("g:iA d-m-Y", $conf_timestamp);
	
?>
				
			<span style=" font-family:'Comic Sans MS', cursive, sans-serif; word-wrap: break-word;" >
				<span style="color:gray; font-size:12px;"> <?php echo $post_time; ?>:</span>
				<span style="word-wrap: break-word;">
				<?php echo $conf_content;?>
				</span>		
			</span>
			<hr style="margin:5px; border:1px solid #4682b4 ;"/>
				
<?php } ?>				
</div>
   
	
<?php   
	

		if( $page > 0 )
         {
            $last = $page - 2;
		?>
		<ul class="pager">
			<li class="previous"><a href="home.php?midcol=all_confession&page=<?php echo $last; ?>">&larr; Previous</a></li> 
			<li class="next"><a href="home.php?midcol=all_confession&page=<?php echo $page; ?>">Next &rarr;</a></li>
		</ul>
		
        <?php 
         }
         
         else if( $page == 0 )
         {	
		 ?>
			<ul class="pager">
				<li class="next"><a href="home.php?midcol=all_confession&page=<?php echo $page; ?>">Next &rarr;</a></li>
			</ul>
		<?php
		}
			
         else if( $left_rec < $rec_limit )
         {
            $last = $page - 2;
		?>
            <li class="previous"><a href="home.php?midcol=all_confession&page=<?php echo $last; ?>">&larr; Previous</a></li> 
        <?php }
         
        
      ?>
	</div>