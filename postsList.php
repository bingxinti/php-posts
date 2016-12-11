<?php


// 打印变量  调试
function D() {echo '<pre>'; print_r( func_get_args() ); echo '</pre>'; echo "<hr />"; }

// 连接数据库
$connect = mysqli_connect( 'localhost', 'root', '', 'demo', '3306' );

// 默认查询列表
$querySql = ' SELECT * FROM demo.posts order by id desc; ';
$result = mysqli_query($connect, $querySql);

// 查看贴子列表
$listInfo = array();
while($rows = mysqli_fetch_assoc($result))
{
	$listInfo[] = $rows;
}

// 关联出来用户信息
foreach ($listInfo as $key => $value) 
{
	$userSql = " SELECT * FROM demo.user where id = {$value['userID']}; ";
	$result = mysqli_query($connect, $userSql);
	$userInfo = mysqli_fetch_assoc($result);
	$listInfo[$key]['userInfo'] = $userInfo;
	// D($userSql);
	// D($userInfo);

}
// D($listInfo);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table  align="center" >
		<thead>
			<tr>
				<th>发帖人</th>
				<th>发布时间</th>
				<th>浏览次数</th>
				<th>标题</th>
			</tr>
		</thead>
		<tbody>
			<!-- 列表循环展示 -->
			<?php foreach ($listInfo as $key => $value): ?>
			<tr>
				<td> <?php  echo $value['userInfo']['name'];?> </td>
				<td> <?php  echo $value['createTime'];?> </td>
				<td> <?php  echo $value['viewCount'];?> </td>
				<td> 
					<a href="postsDetail.php?id=<?php  echo $value['id'];?>">
						<?php  echo $value['title'];?>
					</a>
				 </td>
			</tr>
			<?php endforeach ?>
			<tr>
				<td>
					<a target="_blank"  href="postsAdd.php">发帖</a>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>