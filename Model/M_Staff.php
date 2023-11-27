<?php
    include_once("E_Staff.php");
    class Model_Staff {
        public function __construct() {}
    
        public function login($user, $pw) {
            $link = mysqli_connect("localhost", "root", "") or die('Could not connet MYSQL');
            mysqli_select_db($link,"DULIEU");
            $sql = "SELECT * FROM admin WHERE username = '$user' and password= '$pw'";
            $rs = mysqli_query($link, $sql);
            if(mysqli_num_rows($rs) == 0) header("Location: C_Staff.php?mod1");
            else {
                echo '
            <script>
                parent.frames["f2"].location.href = "../View/afterLogin.htm";
            </script>';
            }
        }

    // Hiển thị danh sách sv
        public function getAllStaff() {
            $link = mysqli_connect("localhost", "root", "") or die('Could not connet MYSQL');
            mysqli_select_db($link,"DULIEU");
            $sql = "SELECT * FROM nhanvien";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $staffs = array();
            while($row = mysqli_fetch_assoc($result)) {
                $idnv = $row['IDNV'];
                $hoten = $row['Hoten'];
                $idpb = $row['IDPB'];
                $diachi = $row['Diachi'];
                $staffs[] = new Entity_Staff($idnv, $hoten, $idpb, $diachi);
            }
            return $staffs;
        }

    // Hiển thị thông tin chi tiết nv thông qua stid
        public function getStaffDetail($stid) { 
            $allStaff = $this->getAllStaff();
            return $allStaff[$stid];
        }

    // Xử lí chèn nv
        public function insertStaff($IDNV, $Hoten, $IDPB, $Diachi) {
            $link = mysqli_connect("localhost", "root", "") or die('Could not connet MYSQL');
            mysqli_select_db($link,"DULIEU");
            // lấy mã nhân viên đã tồn tại từ bảng nhân viên
            $checkIDNV = "SELECT IDNV FROM nhanvien WHERE IDNV = '$IDNV'";
            $resultNV = mysqli_query($link, $checkIDNV);

            // lấy mã phòng ban đã tồn tại từ bảng phòng ban
            $checkIDPB = "SELECT IDPB FROM phongban WHERE IDPB = '$IDPB'";
            $resultPB = mysqli_query($link, $checkIDPB);

            // kiểm tra mã nv và mã pb đã tồn tại hay chưa
            if (mysqli_num_rows($resultNV) > 0 || mysqli_num_rows($resultPB) == 0) {
                header("Location: C_Staff.php?insertForm");
                exit; 
            }else {
                $sql = "INSERT INTO nhanvien(IDNV, Hoten, IDPB, Diachi) VALUES ('$IDNV','$Hoten','$IDPB','$Diachi')";
                $rs = mysqli_query($link, $sql);
            }
        }

    // Xử lí cập nhật nv
        // public function updateStaff($IDNV, $Hoten, $IDPB, $Diachi) {
        //     $link = mysqli_connect("localhost", "root", "") or die('Could not connet MYSQL');
        //     mysqli_select_db($link,"DULIEU");
        //     $sql = "UPDATE nhanvien SET Name ='$Name', Age ='$Age', University ='$University' WHERE ID = '$ID'";
        //     $rs = mysqli_query($link, $sql);
        // }
    
    // Xử lí xóa 1 nv
        public function deleteStaff($IDNV) {
            $link = mysqli_connect("localhost", "root", "") or die('Could not connect to MySQL');
            mysqli_select_db($link, "DULIEU");
            $sql = "DELETE FROM nhanvien WHERE IDNV = '$IDNV'";
            $rs = mysqli_query($link, $sql);
            header("Location: C_Staff.php?delStaff");
        }

     // Xử lí xóa nhiều nv
        public function deleteStaffs($IDNV) {
            $link = mysqli_connect("localhost", "root", "") or die('Could not connect to MySQL');
            mysqli_select_db($link, "DULIEU");
            $sql = "SELECT IDNV FROM nhanvien";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_array($result)) {
                $IDNV = $_REQUEST[$row['IDNV']];
                $delQuery = "DELETE FROM nhanvien WHERE IDNV = '$IDNV'";
                $stmt = mysqli_prepare($link, $delQuery);
                mysqli_stmt_execute($stmt);
            }
            header("Location: C_Staff.php?delStaffs");
        }

    // Xử lí tìm kiếm sv
        public function findStaff($Infor, $IDNV, $Hoten, $Diachi) {
            $link = mysqli_connect("localhost", "root", "") or die('Could not connect to MySQL');
            mysqli_select_db($link, "DULIEU");
            $sql = "SELECT * FROM nhanvien ";
            // kiểm tra cả 3 trường có checked
            if($IDNV != null || $Hoten != null || $Diachi != null) { 
                $sql .= " WHERE ";
            }
            // IDNV và Hoten khác rỗng 
            if($IDNV != null) {
                $sql .= " $IDNV LIKE '%$Infor%' ";
                if($Hoten != null) $sql .= " OR ";
            }
            // Hoten và DiaChi khác rỗng
            if($Hoten != null) {
                $sql .= " $Hoten LIKE '%$Infor%' ";
                if($Diachi != null) $sql .= " OR ";
            }
            // Diachi khác rỗng
            if($Diachi != null) {
                $sql .= " $Diachi LIKE '%$Infor%' ";
            }
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) === 0) {
                header("Location: ../View/FindStaff.htm"); 
            } else {
                $staffs = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $idnv = $row['IDNV'];
                    $hoten = $row['Hoten'];
                    $idpb = $row['IDPB'];
                    $diachi = $row['Diachi'];
                    $staffs[] = new Entity_Staff($idnv, $hoten, $idpb, $diachi);
                }
                return $staffs;
            }
        }
    }
?>