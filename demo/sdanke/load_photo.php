<?

require_once("struc_src/check_session.php");

include('_sys/pic_funcs.php');
include('_sys/dir_file_funcs.php');


if($_SESSION['auth'] == true)
{
	if(isset($_FILES['pic']) )
	{
		
		$path='user/';
		$path .= $_SESSION['U_PATH'];
		$f = $_FILES['pic']['tmp_name'];
		
		if(isset($_POST['frank']))
		{
			$path.='/frank/';
		}else
			$path.='/reg/';
		
		$file=c_u_file($path, 'jpg');

		if(resizeImage($_FILES['pic']['tmp_name'], $path.$file, 800, 800, 100))
		{
			chmod($path.$file, 0777);
		}
		else
		{
			setcookie('mess','Произошла ошибка загрузки файла, попробуйте позже. '.$path.$file);
			setcookie('mess_name','Ошибка');
			header('Location: mess');
			exit;
		}
		
		
		if(cutImage($_FILES['pic']['tmp_name'], $path.'small/'.$file, 105, 140, 100))
		{
			chmod($path.'small/'.$file, 0777);
		}

		
		Header('Location: changeuser&mn=photos');
		exit;
	}
	header('Location: changeuser');

}
header('Location: changeuser');
//*/

?>