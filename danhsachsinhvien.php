<!DOCTYPE html>
<?php 
include_once('ketnoi.php');
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Danh sách quản lý sinh viên</title>
</head>
<body>
	<?php
	$sql = "Select * from SinhVien";
	$result = mysqli_query($conn,$sql);
	$tenSV = "";
	if (isset($_POST['submit'])) {
		$tenSV = $_POST['txtTenSV'];
		if ($tenSV == "") {
			$sql = "Select * from SinhVien";
			$result = mysqli_query($conn,$sql);
		} else {
			$sql = "Select * from SinhVien where Hoten like '%$tenSV%'";
			$result = mysqli_query($conn,$sql);
		}
	}
	?>
	<center>
		<form method="post">
			<table border="1" cellpadding="3" cellspacing="0" align="center">
				<caption>DANH SÁCH SINH VIÊN</caption>
				<tr>
					<td colspan="9">
						<center>
							<form action="" method="post">
								<input type="text" name="txtTenSV" placeholder="Nhập sinh viên cần tìm" value="<?php echo $tenSV?>">
								<input type="submit" name="submit" value="Tìm kiếm">
							</form>
						</center>
					</td>
				</tr>
				<tr>
					<th>Mã SV</th>
					<th>Họ tên</th>
					<th>Ngày sinh</th>
					<th>Giới tính</th>
					<th>Quê Quán</th>
					<th>Điện thoại</th>
					<th>Ảnh</th>
					<th>Sửa</th>
					<th>Xóa</th>
				</tr>
				<?php 
				// PHẦN XỬ LÝ PHP
				$sql = "select count(MaSV) as total from sinhvien";
				$result = mysqli_query($conn,$sql);
				$row = mysqli_fetch_assoc($result);
				$total_records = $row['total'];
				$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
				$limit = 3;
				$total_page = ceil($total_records / $limit);
				if ($current_page > $total_page) {
					$current_page = $total_page;
				}else if ($current_page < 1) {
					$current_page = 1;
				}
				$start = ($current_page - 1) * $limit;
				$result = mysqli_query($conn, "SELECT * FROM sinhvien LIMIT $start, $limit")
        		?>
        		<div>
					<?php
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
							$masv = $row["MaSV"];
							echo "<td>".$row["MaSV"]."</td>";
							echo "<td>".$row["Hoten"]."</td>";
							echo "<td>".$row["Ngaysinh"]."</td>";
							echo "<td>".$row["Gioitinh"]."</td>";
							echo "<td>".$row["Quequan"]."</td>";
							echo "<td>".$row["Dienthoai"]."</td>";
							echo "<td><img src='img/".$row["Anh"]."' width='100px' height='100px'></td>";
							echo "<td><a href='suasinhvien.php?masv=$masv'><img src='img/sua.png' width='30px' height='30px'></a></td>";
							echo "<td><a href='xoasinhvien.php?masv=$masv' onclick='return Checkdelete()'><img src='img/xoa.jpg' width='30px' height='30px'></a></td>";
						echo "</tr>";
					}
					?>
				</div>
				<div class="pagination">
					<?php 
					// PHẦN HIỂN THỊ PHÂN TRANG
					// nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
					if ($current_page > 1 && $total_page > 1){
						echo '<a href="index.php?page='.($current_page-1).'">Prev</a> | ';
					}
					// Lặp khoảng giữa
					for ($i = 1; $i <= $total_page; $i++){
						// Nếu là trang hiện tại thì hiển thị thẻ span
						// ngược lại hiển thị thẻ a
						if ($i == $current_page){
							echo '<span>'.$i.'</span> | ';
						}
						else{
							echo '<a href="index.php?page='.$i.'">'.$i.'</a> | ';
						}
					}
					// nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
					if ($current_page < $total_page && $total_page > 1) {
						echo '<a href="index.php?page='.($current_page+1).'">Next</a> | ';
					}
					?>
				</div>
			</table>
		</form>
	</center>
</body>
</html>
<script>
	function Checkdelete() {
		return confirm("Bạn có muốn xóa sinh viên này không ?");
	}
</script>