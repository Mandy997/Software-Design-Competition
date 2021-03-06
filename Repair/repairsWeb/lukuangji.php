<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>路况统计</title>
<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
<script src="lib/jquery-1.11.1.min.js" type="text/javascript"></script>
<!-- 引导程序，字体，主题界面-->
</head>

<body>

<?php
//在表格中显示表的数据
    function ShowTable(){
       	  	include "tool/conn.php";
				//在这里添加、更换数据表
        // $res=mysql_query($sql,$conn);
        $rows=mysql_affected_rows($conn);//获取行数
		 $sql="select * from lukuang";	
		$pagesize=10;  //设计每个页要显示的记录
	      $totalpages;
		  if($rows%$pagesize==0)
		   {  
		    $totalpages=(int)($rows/$pagesize); 	//正好几页
			}
			else { 
			  $totalpages=(int)($rows/$pagesize)+1;		//多一页
			   }  //看用户是选择了哪个
			   
			   
			    if(isset($_GET['page']))
			    {  
				 $p=(int)$_GET['page']; 
				 } else 
				 {  $p=1; }  //计算出起始记
				 //计算记录偏移量
				  $start=$pagesize*($p-1); 
				  $queryj=mysql_query("$sql limit $start,$pagesize"); 
				  
				  
      	echo "<table class='table'><thead><tr>";
		echo "
		<th>序号</th>
		<th>流水号</th>
		<th>故障地点</th>
		<th>障碍车</th>
		<th>路灯1</th>
		<th>交通障碍</th>
		<th>天气温度</th>
		<th>时间</th>
		";
		echo "<th style=' width='3.5em''></th></tr></thead>";
		echo "<tbody>";
		$serial=1;
        while($row=mysql_fetch_array($queryj)){  
            echo "<tr>
			<td>".$serial++."</td>
			<td>".$row['Id']."</td>
			<td>".$row['address']."</td>
			<td>".$row['zhangai']."</td>
			<td>".$row['ludeng']."</td>
			<td>".$row['jiaotong']."</td>
			<td>".$row['wendu']."</td>
			<td>".$row['data']."</td>";
			
			$id=$row[0];					//php mysql 编辑一条信息 源码

            echo "</tr>";
        }
        echo "</tbody></table>";
		
			//分页按钮
		echo "<ul class='pagination'>";
if($totalpages>1){
		for($x=1;$x<= $totalpages;$x++){
				echo "<li><a href='?page=$x'>$x</a></li>";	
					}
	echo "<li><a href='?page=$x'>第 $p 页</a></li>";
				echo "</ul>";
		
		}
		
		}
    ShowTable();
?>

<div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">确认删除</h3>
      </div>
      <div class="modal-body">
        <p class="error-text"><i class="fa fa-warning modal-icon"></i>你确定要删除这条评价吗？<br>
          这无法恢复！</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">取消</button>
        <button class="btn btn-danger" data-dismiss="modal">删除</button>
      </div>
    </div>
  </div>
</div>

 <script src="lib/bootstrap/js/bootstrap.js"></script>
 
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>


</body>
</html>