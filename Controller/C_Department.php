<?php
    include_once("../Model/M_Department.php");
    class Ctrl_Department {
        public function invoke() {
            // get up từ afterLogin.htm
            if(isset($_GET['up'])) {
                $modelDepartment = new Model_Department();
                $departmentList = $modelDepartment->getAllDepartment();
                include_once("../View/UpdateDepartment.htm");
            }
             // post UpdateDepartmentForm.htm
            else if(isset($_POST['insert'])) {
                $IDPB = $_REQUEST['txtIDPB'];
                $Tenpb = $_REQUEST['txtTenpb'];
                $Mota = $_REQUEST['txtMota'];
                $modelDepartment = new Model_Department();
                $modelDepartment->insertDepartment($IDPB, $Tenpb, $Mota);
                header("Location: C_Department.php?");
            }
            // post UpdateDepartmentForm.htm
            else if(isset($_POST['update'])) {
                $IDPB = $_REQUEST['txtIDPB'];
                $Tenpb = $_REQUEST['txtTenpb'];
                $Mota = $_REQUEST['txtMota'];
                $modelDepartment = new Model_Department();
                $modelDepartment->updateDepartment($IDPB, $Tenpb, $Mota);
            }
            // get detailDepartment từ DepartmentList.htm
            else if(isset($_GET['detailDepartment'])) {
                $modelDepartment = new Model_Department();
                $departmentDetail = $modelDepartment->getDepartmentDetailWithStaff($_GET['detailDepartment']);
                include_once("../View/DepartmentDetail.htm");
            }
             // get insertForm từ DepartmentList.htm
            else if(isset($_GET['insertForm'])) {
                include_once("../View/InsertDepartment.htm");
            }
             // get updateForm từ UpdateDepartment.htm
            else if(isset($_GET['updateForm'])) {
                $modelDepartment = new Model_Department();
                $departmentDetail = $modelDepartment->getDepartmentDetail($_GET['updateForm']);
                include_once("../View/UpdateDepartmentForm.htm");
            }
            else {
                $modelDepartment = new Model_Department();
                $departmentList = $modelDepartment->getAllDepartment();
                include_once("../View/DepartmentList.htm");
            }
        }
    };
    $C_Department = new Ctrl_Department();
    $C_Department->invoke();
?>