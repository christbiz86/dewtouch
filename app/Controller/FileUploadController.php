<?php
    
class FileUploadController extends AppController {
        
    public function index() {
        if ($this->request->is('post')) {
            if(!empty($this->data['FileUpload']['file']['name'])){
                $checkFileType = $this->FileUpload->checkFileType($this->data['FileUpload']['file']);
                if(!$checkFileType){
                    $error = "Only support csv files !!!";
                } else {
                    $error = "";
                }
                
                $file = fopen(WWW_ROOT . 'files/' . $this->data['FileUpload']['file']['name'], "r");
                while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
                    var_dump($getData);
                }
                fclose($file);
                exit();
           }    
        } else {
            $error = "";
        }
        $this->set('title', __('File Upload Answer'));
        $file_uploads = $this->FileUpload->find('all');
        $this->set(compact('file_uploads','error'));
    }
    
}