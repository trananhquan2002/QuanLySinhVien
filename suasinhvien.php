<!DOCTYPE html>
<?php 
	include "ketnoi.php";
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sửa hàng hóa</title>
</head>
<body>
	<?php 
	$masv=$_GET["masv"];
	$sql="Select * from SinhVien where MaSV='$masv'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	if (isset($_POST['submit'])) {
		$tensv=$_POST['txtTenSV'];
		$ngaysinh=$_POST['txtNgaysinh'];
		$gioitinh=$_POST['txtGioitinh'];
		$quequan=$_POST['txtQuequan'];
		$dienthoai=$_POST['txtDienthoai'];
		$anh="";
		if (isset($_FILES['txtAnh'])) {
			$anh=$_FILES['txtAnh']["name"];
			$duongdan=$_FILES['txtAnh']['tmp_name'];
			move_uploaded_file($duongdan, "img/$anh");
		}
		if ($anh=="") {
			$sql="update SinhVien set Hoten='$tensv', Ngaysinh=$ngaysinh, Gioitinh=$gioitinh, Quequan='$quequan', Dienthoai='$dienthoai' where MaSV='$masv'";
		} else {
			$sql = "update SinhVien set Hoten='$tensv', Ngaysinh=$ngaysinh, Gioitinh=$gioitinh, Quequan='$quequan', Dienthoai='$dienthoai', Anh='$anh' where MaSV='$masv'";
		}
		mysqli_query($conn,$sql);
		echo "<script>window.location.href='index.php?page=danhsachsinhvien'</script>";
	}
	?>
	<form method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Mã Sinh Viên</td>
				<td>
					<input type="text" name="txtMaSV" value="<?php echo $row['MaSV']; ?>" readonly="true">
				</td>
				<td rowspan="6"><img src="img/<?php echo $row['Anh'];?>" width='200px' height='200px' alt="" name="imgSV"></td>
			</tr>
			<tr>
				<td>Tên Sinh viên</td>
				<td>
					<input type="text" name="txtTenSV" value="<?php echo $row['Hoten']; ?>">
				</td>
			</tr>
			<tr>
				<td>Ngày sinh</td>
				<td>
					<input type="text" name="txtNgaysinh" value="<?php echo $row['Ngaysinh']; ?>">
				</td>
			</tr>
			<tr>
				<td>Giới tính</td>
				<td>
					<input type="text" name="txtGioitinh" value="<?php echo $row['Gioitinh']; ?>">
				</td>
			</tr>
			<tr>
				<td>Quê Quán</td>
				<td>
					<input type="text" name="txtQuequan" value="<?php echo $row['Quequan']; ?>">
				</td>
			</tr>
			<tr>
				<td>Điện thoại</td>
				<td>
					<input type="text" name="txtDienthoai" value="<?php echo $row['Dienthoai']; ?>">
				</td>
			</tr>
			<tr>
				<td>Ảnh</td>
				<td>
					<input type="file" name="txtAnh" value="<?php echo $row['Anh']; ?>" onchange="change_img();">
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit" value="Sửa">
					<input type="reset" name="reset" value="Làm lại">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
<script>
	function change_img() {
		var Element=document.getElementsByName("txtAnh")[0];
		var img=document.getElementsByName('imgSV')[0];
		var url=URL.createObjectURL(Element.files[0]);
		img.src=url;
	}
</script>