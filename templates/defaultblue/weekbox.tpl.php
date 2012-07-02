<table border="1" cellpadding="4" cellspacing="0" class="table" width="100%">
		<tr>
			<td class="theader">
				<center>
					Week of <?php echo "$firstdate-$lastdate $monthname ($year)" ?>
				</center>
			</td>
		</tr>
	
	<table>
	
	
	<center>
	<table border="0" height="35">
	<tr>
		<td class="tablebody" valign="center">
		
		<font class="littletext"><b>Quick Jump to:</b></font>&nbsp;&nbsp;
		<a href="#sun" class="smalllink"><b><?php echo $_DATE_TRANS['Sun'] ?></b></a> 
		<font class="smalltext">&nbsp;&nbsp;</font>
		<a href="#mon" class="smalllink"><b><?php echo $_DATE_TRANS['Mon'] ?></b></a> 
		<font class="smalltext">&nbsp;&nbsp;</font>
		<a href="#tue" class="smalllink"><b><?php echo $_DATE_TRANS['Tue'] ?></b></a> 
		<font class="smalltext">&nbsp;&nbsp;</font>
		<a href="#wed" class="smalllink"><b><?php echo $_DATE_TRANS['Wed'] ?></b></a> 
		<font class="smalltext">&nbsp;&nbsp;</font>
		<a href="#thu" class="smalllink"><b><?php echo $_DATE_TRANS['Thu'] ?></b></a> 
		<font class="smalltext">&nbsp;&nbsp;</font>
		<a href="#fri" class="smalllink"><b><?php echo $_DATE_TRANS['Fri'] ?></b></a> 
		<font class="smalltext">&nbsp;&nbsp;</font>
		<a href="#sat" class="smalllink"><b><?php echo $_DATE_TRANS['Sat'] ?></b></a>
	
		</td>
	</tr>
	</table>
	</center>
	
	
<table width="100%" cellpadding="2" cellspacing="0" class="table">
	
<?php	
		//iterate through available dates
				
		for($i=$firstkey; $i<=$lastkey; $i++) {
			

			$day = $the_array[$i];
			$eventlist = $eventset[$i];
			
			
			//print_r($eventlist);
						
			$weekpointer = weekdaypointer($i);
?>
		
		<tr>
			<td class="eventheader" height="25">
				<a name="<?php echo $weekpointer ?>"></a>
				&nbsp;&nbsp;<font class="eventheadertext"><b><?php echo strtr(date($_CONF[day_format], mktime(0, 0, 0, $month, $day, $year)), $_DATE_TRANS) ?></b></font>
			</td>
			
			<td class="eventheader" height="25" align="right">
				<?php if(isset($sessiondata['username'])) { ?>
					<a href="myevents/eventform.php?<?php echo "cid=$cid&catid=$catid&d=$day&m=$month&y=$year" ?>" class="eventaddlink" title="Click to add an event to this date">Add Events</a>&nbsp;
				<?php } ?>
			</td>
		</tr>
		
		<tr>
		<td class="tevents1" height="40" colspan="2">
		
		
			<?php
				
				$found = 0;
				
				$eventlist = arrange_events($eventlist);

				for ($j=0; $j<=count($eventlist); $j++) {
										
					if($eventdata = $eventlist[$j]) {

						//print_r($eventdata);
			?>
			
			
			<table border="0" cellpadding="0" cellspacing="8" width="100%">
			<tr>
				<td align="center" width="5%">
					
					<?php if($_CONF['show_calicon'] && $eventdata['calendar_icon']) { ?>
						
					<img src="<?php echo $eventdata['calendar_icon'] ?>">
					
					<?php } ?>
					
				</td>
					
				
				<td height="45">
					
					<a href="javascript:open_window('<?php echo "eventdetails.php?cid=$eventdata[calendar_id]&catid=$catid&eid=$eventdata[event_id]&d=$day&m=$month&y=$year&s=$subcal" ?>');" class="basiclink"><?php echo $eventdata['event_title'] ?></a><br />
					
					<?php if($_CONF['show_calname']) { ?> 
					
					<font class="littletext">( Calendar: <a href="<?php echo $_SERVER[PHP_SELF] . "?cid=$eventdata[calendar_id]&catid=$catid&d=$day&m=$month&y=$year&s=$subcal" ?>" class="smalllink"><?php echo $eventdata['calendar_name'] ?></a> )</font>
					
					<?php } ?>
					
					
					<?php if($_CONF['show_location']) { ?> 
					
					<font class="littletext">&nbsp;&nbsp;Location: <a href="javascript:open_window('<?php echo "locationdetails.php?cid=$eventdata[calendar_id]&lid=$eventdata[location_id]&catid=$catid&d=$day&m=$month&y=$year&s=$subcal" ?>')" class="smalllink"><?php echo $eventdata['location_title'] ?></a>
					
					<?php } ?>
					
					 					
					
					<?php if(($eventdata['start_time']!= NULL ) && $_CONF['show_time']) { ?> 
					
						&nbsp;&nbsp;-&nbsp;&nbsp;<font class="littletext">Time: <?php echo displaytime($eventdata['start_time']) . " - " .  displaytime($eventdata['stop_time']) ?></font> 
					  
					<?php } ?>
					
					<?php if($eventdata['text_time'] && $_CONF['show_time']) { ?> 
					
						&nbsp;&nbsp;<font class="littletext"> <?php echo $eventdata['text_time'] ?></font> 
					
					<?php } ?>
				
					
					<?php if($sessiondata['user_id'] == $eventdata[12]) { ?>
					
						&nbsp;<a href="myevents/eventdetails.php?<?php echo "eid=$eventdata[event_id]" ?>" class="editlink" title="Click to edit this event">[Edit]</a>
						&nbsp;<a href="myevents/eventdelete.php?<?php echo "eid=$eventdata[event_id]" ?>" class="editlink" onclick="return confirm('Are you sure you want to delete the selected event?')" title="Click to edit this event">[Delete]</a>
					
					<?php } ?>
					
				</td>
			</tr>
					
			</table>
						
			
			
			<?php	
					$found++;
					}
				
				}
					
					if(!$found) {
			?>		
					
			
			<table border="0" cellpadding="0" cellspacing="8" width="100%">
			<tr>
				<td align="center" width="5%"></td><td height="45">
					<font class="basictext">There are no events scheduled for this day</font>
				</td>
			</tr>
			</table>
				
			
			<?php		
				}	
			?>
		
			
		</td>
	</tr>
	
	<?php		
		}	
	?>		
			
</table>