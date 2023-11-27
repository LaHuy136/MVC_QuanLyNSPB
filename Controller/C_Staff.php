<?php
    include_once("../Model/M_Staff.php");
    class Ctrl_Staff {
        public function invoke() {
            if(isset($_POST['login'])) {
                $user = $_REQUEST['username'];
                $pw = $_REQUEST['password'];
                $modelStaff = new Model_Staff();
                $modelStaff->login($user, $pw);
            }
            else if(isset($_POST['insert'])) {
                $IDNV = $_REQUEST['txtIDNV'];
                $Hoten = $_REQUEST['txtNV'];
                $IDPB = $_REQUEST['txtIDPB'];
                $Diachi = $_REQUEST['txtDiachi'];
                $modelStaff = new Model_Staff();
                $staffList = $modelStaff->insertStaff($IDNV, $Hoten, $IDPB, $Diachi);
                header("Location: C_Staff.php?");
            }
            else if(isset($_GET['del'])) {
                $modelStaff = new Model_Staff();
                $modelStaff->deleteStaff($_GET['del']);
            }
            else if(isset($_GET['delAll'])) {
                $IDNV = @($_REQUEST['IDNV']);
                $modelStaff = new Model_Staff();
                $modelStaff->deleteStaffs($IDNV);
            }
            else if(isset($_POST['find'])) {
                $Infor = $_REQUEST['Infor'];
                $IDNV = @($_REQUEST['IDNV']);
                $Hoten = @($_REQUEST['Hoten']);
                $Diachi = @($_REQUEST['Diachi']);
                $modelStaff = new Model_Staff();
                $staffList = $modelStaff->findStaff($Infor, $IDNV, $Hoten, $Diachi);
                include_once("../View/ResultFind.htm");
            }
            else if(isset($_GET['delStaff'])) {
                $modelStaff = new Model_Staff();
                $staffList = $modelStaff->getAllStaff();
                include_once("../View/DeleteStaff.htm");
            }
            else if(isset($_GET['delStaffs'])) {
                $modelStaff = new Model_Staff();
                $staffList = $modelStaff->getAllStaff();
                include_once("../View/DeleteStaffs.htm");
            }
            else if(isset($_GET['mod1'])) {
                include_once("../View/Login.htm");
            }
            else if(isset($_GET['mod2'])) {
                include_once("../View/FindStaff.htm");
            }
            else if(isset($_GET['insertForm'])) {
                include_once("../View/InsertStaff.htm");
            }
            else {
                $modelStaff = new Model_Staff();
                $staffList = $modelStaff->getAllStaff();
                include_once("../View/StaffList.htm");
            }
        }
    };
    $C_Staff = new Ctrl_Staff();
    $C_Staff->invoke();
?>