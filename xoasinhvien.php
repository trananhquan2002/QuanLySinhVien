<!DOCTYPE html>
<?php 
include_once("ketnoi.php");
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Xóa hàng hóa</title>
</head>
<body>
	<?php 
	$masv=$_GET['masv'];
	$sql="Delete from SinhVien where MaSV='$masv'";
	$result=mysqli_query($conn,$sql);
	echo "<script>window.location.href='index.php?page=danhsachsinhvien'</script>";
	?>
</body>
</html>