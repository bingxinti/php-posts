<?php 
	
	// 打印变量  调试
function D() {echo '<pre>'; print_r( func_get_args() ); echo '</pre>'; echo "<hr />"; }
session_start();
if(empty($_SESSION['userInfo']))
{
	echo "<script type='text/javascript'> alert('请先去登录哦');  window.location.href='login.php' </script>";
}
else
{
	$userInfo = $_SESSION['userInfo'];
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>


<style>
	table
	{
		    text-align: center;
    width: 980px;
    margin: 0 auto;
	}
	tr,td
	{
		line-height: 40px;
		border: 1px solid #dddddd;
	}

</style>
	<table>
		<tr>
			<td> 操作 </td>
			<td> 
				<a  target="_blank" href="postsAdd.php">发布帖子</a>
			 </td>
		</tr>
		<tr>
			<td> 操作 </td>
			<td> 
				<a href="login.php?quit=1">退出</a>
				<a href="userUpdate.php">修改资料</a>
			 </td>
		</tr>
		<tr>
			<td> 账户 </td>
			<td> 
				<?php echo $userInfo['username']; ?>
			 </td>
		</tr>
		<tr>
			<td> 姓名 </td>
			<td> 
				<?php echo $userInfo['name']; ?>
			 </td>
		</tr>
		<tr>
			<td> 头像 </td>
			<td> 
				<img src="<?php echo $userInfo['avatar']; ?>" alt="" width="230px">
			 </td>
		</tr>
		
	</table>
</body>
</html>