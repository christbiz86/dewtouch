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
                $insertData = array();
                while (($row = fgetcsv($file, 1000, " ")) !== FALSE) {
                    $splitResult = preg_split('/\s+/', $row[0]);
                    array_shift($splitResult);
                    foreach($splitResult as $data){
                        $splitData = explode(",",$data);
                        array_push($insertData,array(
                            'name' => $splitData[0],
                            'email' => $splitData[1],
                            'valid' => date("Y-m-d H:i:s"),
                            'created' => date("Y-m-d H:i:s"),
                            'modified' => date("Y-m-d H:i:s")
                        ));
                    }
                }
                fclose($file);
                $this->FileUpload->saveAll($insertData);
            }
        } else {
            $error = "";
        }
        $this->set('title', __('File Upload Answer'));
        $file_uploads = $this->FileUpload->find('all');
        $this->set(compact('file_uploads','error'));
    }
    
}