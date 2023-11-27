<?php
    class Entity_Staff {
        public $IDNV;
        public $Hoten;
        public $IDPB;
        public $Diachi;

        public function __construct($_IDNV, $_Hoten, $_IDPB, $_Diachi) {
            $this->IDNV = $_IDNV;
            $this->Hoten = $_Hoten;
            $this->IDPB = $_IDPB;
            $this->Diachi = $_Diachi;
        }
    }
?>