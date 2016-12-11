<?php 

	// 打印变量  调试
function D() {echo '<pre>'; print_r( func_get_args() ); echo '</pre>'; echo "<hr />"; }


// 连接数据库
// 如果是提交表单过来的数据，就进行修改后者添加
if(!empty($_POST))
{
	if(!empty($_POST['username']))
	{
		$connect  = mysqli_connect( 'localhost', 'root', '', 'demo', '3306' );
		// 检测用户账户是否存在，存在就不插入
		$username = $_POST['username'];
		$query = "SELECT * FROM demo.user where username= '{$username}' ";
		$result   = mysqli_query($connect, $query);
		$detail     = mysqli_fetch_assoc($result);
		if(!empty($detail))
		{
			echo "<script type='text/javascript'> alert('账户已经存在了');  </script>";
		}
		else
		{
			$password = md5($_POST['password']);
			$avatar = '';
			if(!empty($_FILES['avatar']) && $_FILES['avatar']['error'] == 0 )
			{
				$avatar = $_FILES['avatar'];
				$imagePath = './images/' .$avatar['name'];

				$move = move_uploaded_file( $avatar['tmp_name'], $imagePath );
				if($move === true)
				{
					$avatar = "http://localhost/demo/web/images/{$avatar['name']}";
				}
				// D($move);
				// D($imagePath);
				// D($avatar);
				// exit;
			}

			$sqlupdate = " INSERT INTO `demo`.`user` (`name`, `avatar`, `username`, `password`) VALUES ('{$_POST['name']}', '{$avatar}', '{$_POST['username']}', '{$password}'); ";
			
			// 执行修改或者添加
			$result = mysqli_query($connect, $sqlupdate);
			// 返回受影响的函数
			$rows   = mysqli_affected_rows($connect);

			$info = "受影响行数{$rows}";
			
			// D($sqlupdate, $_POST, $rows, $_FILES);
			// exit;

			// 保证操作成功了，就跳转
			if($rows > 0 )
			{
				$info .= '注册成功';
				echo "<script type='text/javascript'> alert('{$info}');  window.location.href='login.php' </script>";
			}
			else
			{
				$info .= ' 注册失败';
				echo "<script type='text/javascript'> alert('{$info}'); </script>";
			}

		}
	}
	else
	{
		echo "<script type='text/javascript'> alert('账户不能为空');  </script>";
	}
	
}


// D($_POST);

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
					<input type="text" name="password" >
				</td>
			</tr>
			<tr>
				<td>头像</td>
				<td>
					<input type="file" name="avatar" >
				</td>
			</tr>
			<tr>
				<td>姓名</td>
				<td>
					<input type="text" name="name" >
				</td>
			</tr>
			<tr>
				<td>
					<a href="login.php">去登录</a>
				</td>
				<td>
					<button>注册</button>
				</td>
			</tr>
		</table>


	</form>


</body>
</html>