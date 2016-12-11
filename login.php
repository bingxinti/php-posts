<?php 

session_start();



if(!empty($_GET['quit']))
{
	unset($_SESSION['userInfo']);
}
// D($_SESSION);
	// 打印变量  调试
function D() {echo '<pre>'; print_r( func_get_args() ); echo '</pre>'; echo "<hr />"; }

// D($_COOKIE);


if(!empty($_POST))
{
	if(!empty($_POST['username']) &&  !empty($_POST['password']))
	{
		$connect  = mysqli_connect( 'localhost', 'root', '', 'demo', '3306' );
		$username = $_POST['username'];
		$query = "SELECT * FROM demo.user where username= '{$username}' ";
		$result   = mysqli_query($connect, $query);
		$userInfo     = mysqli_fetch_assoc($result);
		if(!empty($userInfo['password']))
		{
			$password = md5($_POST['password']);
			if($userInfo['password'] === $password)
			{
				$_SESSION['userInfo'] = $userInfo;
				echo "<script type='text/javascript'> alert('登录成功');  window.location.href='userInfo.php' </script>";
			}
			else
			{
				echo "<script type='text/javascript'> alert('账户或者密码错误');  </script>";
			}
		}
		else
		{
			echo "<script type='text/javascript'> alert('账户不存在');  </script>";
		}
		// D($query);
		// D($userInfo);
		// D($_POST);
	}
	else
	{
		echo "<script type='text/javascript'> alert('账户密码必须填写哦');  </script>";
	}
}
// D($_SESSION);

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
			    width: 880px;
			    margin: 2% auto;
			    line-height: 52px;
		}
		input
		{
			line-height: 30px;
			min-height: 30px;
		}
		</style>
	<form action="" method="post" enctype="multipart/form-data" >
		<table>
			<tr>
				<td>账户</td>
				<td>
					<input type="text" name="username" placeholder="请输入账户">
				</td>
			</tr>
			<tr>
				<td>密码</td>
				<td>
					<input type="password" name="password" >
				</td>
			</tr>
			<tr>
				<td>
				<a href="register.php">去注册</a>
				</td>
				<td>
					<button>登录</button>
				</td>
			</tr>
		</table>


	</form>



	
</body>
</html>