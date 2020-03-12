<?php

class FileUpload extends AppModel {

    private $allowed_extension = array(
//        "doc",
//        "docx",
//        "pdf",
//        "xls",
//        "xlsx",
        "csv"
    );
    
    public function checkFileType($file){
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if(in_array($file_extension,$this->allowed_extension)) {
            move_uploaded_file($file['tmp_name'], WWW_ROOT . 'files/' . $file['name']);
            return true;
        } else {
            return false;
        }
    }
    
}