<?php

 
         $sql ="SELECT * FROM fish_items";
         $result = mysqli_query($conn,$sql);
         $chart_data="";
         while ($row = mysqli_fetch_array($result)) { 
 
            $productname[]  = $row['item_name']  ;
            $stock[] = $row['stock'];
        }
 
?>