<?php
    include_once("E_Department.php");
    class Model_Department {
        public function __construct() {}
    
    // Hiển thị danh sách pb
        public function getAllDepartment() {
            $link = mysqli_connect("localhost", "root", "") or die('Could not connet MYSQL');
            mysqli_select_db($link,"DULIEU");
            $sql = "SELECT * FROM phongban";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $departments = array();
            while($row = mysqli_fetch_assoc($result)) {
                $idpb = $row['IDPB'];
                $tenpb = $row['Tenpb'];
                $mota = $row['Mota'];
                $departments[] = new Entity_Department($idpb, $tenpb, $mota);
            }
            return $departments;
        }

    // Hiển thị thông tin pb thông qua dpid
    public function getDepartmentDetail($dpid) { 
        $allDepartment = $this->getAllDepartment();
        
        foreach ($allDepartment as $department) {
            if ($department->IDPB == $dpid) {
                return $department;
            }
        }
        return null;
    }
    
    // Hiển thị thông tin chi tiết của từng phòng ban
    public function getDepartmentDetailWithStaff($IDPB) {
        $link = mysqli_connect("localhost", "root", "") or die('Could not connet MYSQL');
        mysqli_select_db($link,"DULIEU");
        $sql = "SELECT IDNV, Hoten, Diachi FROM phongban JOIN nhanvien ON phongban.IDPB = nhanvien.IDPB WHERE phongban.IDPB = '$IDPB'";
        $rs = mysqli_query($link, $sql);
        $result = array(); 
        while ($row = mysqli_fetch_assoc($rs)) {
            $result[] = $row; 
        }
        if($result == null) echo 'Không có nhân viên ở ', $IDPB;
        else return $result; 
        mysqli_close($link);
    }

    //Xử lí chèn pb
        public function insertDepartment($IDPB, $Tenpb, $Mota) {
            $link = mysqli_connect("localhost", "root", "") or die('Could not connet MYSQL');
            mysqli_select_db($link,"DULIEU");
        
            // lấy mã phòng ban đã tồn tại từ bảng phòng ban
            $checkIDPB = "SELECT IDPB FROM phongban WHERE IDPB = '$IDPB'";
            $resultPB = mysqli_query($link, $checkIDPB);
        
            // kiểm tra mã pb đã tồn tại hay chưa
            if (mysqli_num_rows($resultPB) > 0) {
                header("Location: C_Department.php?insertForm");
                exit; 
            }else {
                $sql = "INSERT INTO phongban(IDPB, Tenpb, Mota) VALUES ('$IDPB','$Tenpb','$Mota')";
                $rs = mysqli_query($link, $sql);
            }
        }

    // Xử lí cập nhật pb
        public function updateDepartment($IDPB, $Tenpb, $Mota) {
            $link = mysqli_connect("localhost", "root", "") or die('Could not connet MYSQL');
            mysqli_select_db($link,"DULIEU");
            $sql = "UPDATE phongban SET Tenpb = '$Tenpb', Mota ='$Mota' WHERE IDPB = '$IDPB'";
            $rs = mysqli_query($link, $sql);
            header("Location: C_Department.php?up");
        }
    }
?>