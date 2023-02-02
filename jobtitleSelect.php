<?php  

require 'db.php'; $output = ''; 

 $sql = "SELECT * FROM setting_joptitle ";  
 $result = mysqli_query($con, $sql);  
 $output .= '  
      <div class="table-responsive"style="border-radius: 6px; background-color: #fff;">  
           <table class="table table-bordered">  
                <tr>  
                     <th width="40%">Job Title id</th>  
                     <th width="40%">Job Title Name</th>  
                     <th width="10%"></th>  
                </tr>';  
 $rows = mysqli_num_rows($result);
 if($rows > 0)  
 {  
	  if($rows > 10)
	  {
		  $delete_records = $rows - 10;
		  $delete_sql = "DELETE FROM setting_joptitle LIMIT $delete_records";
		  mysqli_query($con, $delete_sql);
	  }
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td class="jopTitle_id" data-id1="'.$row["jopTitle_id"].'" contenteditable>'.$row["jopTitle_id"].'</td>  
                     <td class="jopTitle_name" data-id2="'.$row["jopTitle_id"].'" contenteditable>'.$row["jopTitle_name"].'</td>  
                    
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>  
                <td id="jopTitle_id" contenteditable></td>  
                <td id="jopTitle_name" contenteditable></td>  
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button></td>  
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '
				<tr>   
					<td id="jopTitle_id" contenteditable></td>  
                         <td id="jopTitle_name" contenteditable></td>  
                         <td><button type="button" name="btn_add" id="btn_add" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button></td>   
			   </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>