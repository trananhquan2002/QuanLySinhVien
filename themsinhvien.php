<!DOCTYPE html>
<html lang="en">
<?php 
	include_once('ketnoi.php');
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Thêm mới Sinh Viên</title>
</head>
<style>
	caption {
		text-align: center;
		color: red;
		font-size: 20px;
	}
</style>
<body>
	<center>
		<form action="" method="post" enctype="multipart/form-data">
			<table align="center">
				<caption>THÊM MỚI Sinh Viên</caption>
				<tr>
					<td>Mã Sinh Viên</td>
					<td><input type="text" name="txtMaSV"></td>
				</tr>
				<tr>
					<td>Tên Sinh Viên</td>
					<td><input type="text" name="txtTenSV"></td>
				</tr>
				<tr>
					<td>Ngày Sinh</td>
					<td><input type="text" name="txtNgaysinh"></td>
				</tr>
				<tr>
					<td>Giới Tính</td>
					<td><input type="text" name="txtGioitinh"></td>
				</tr>
				<tr>
					<td>Quê Quán</td>
					<td><input type="text" name="txtQuequan"></td>
				</tr>
				<tr>
					<td>Điện thoại</td>
					<td><input type="text" name="txtDienthoai"></td>
				</tr>
				<tr>
					<td>Ảnh</td>
					<td><input type="file" name="txtAnh"></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="submit" value="Thêm mới">
						<input type="reset" name="" value="Nhập lại">
					</td>
				</tr>
				<tr>
					<td colspan="2"><p id="loi" style="color: red;"></p></td>
				</tr>
			</table>
		</form>
	</center>
	<?php 
	if (isset($_POST['submit'])) {
		$masv=$_POST['txtMaSV'];
		$tensv=$_POST['txtTenSV'];
		$ngaysinh=$_POST['txtNgaysinh'];
		$gioitinh=$_POST['txtGioitinh'];
		$quequan=$_POST['txtQuequan'];
		$dienthoai=$_POST['txtDienthoai'];
		$anh=$_FILES['txtAnh']['name'];
		$duongdan=$_FILES['txtAnh']['tmp_name'];
		move_uploaded_file($duongdan, "img/$anh");
		$sql="Select * from SinhVien where MaSV='$masv'";
		$result=mysqli_query($conn,$sql);
		if (mysqli_num_rows($result) > 0) {
			echo "Mã sinh viên đã tồn tại!!!Mời bạn nhập lại!";
		} else {
			$sql="INSERT INTO SinhVien VALUES ('$masv','$tensv','$ngaysinh','$gioitinh','$quequan','$dienthoai','$anh')";
			$result=mysqli_query($conn,$sql);
			if ($result) {
				echo "<script>window.location.href='index.php?page=danhsachsinhvien'</script>";
			} else {
				?>
				<script type="text/javascript">
					document.getElementById("loi").innerHTML="Lỗi! Mời kiểm tra lại dữu liệu!";
				</script>
				<?php
			}
		}
	}
	?>
</body>
</html>