<?php
	class FormatController extends AppController{
		
		public function q1(){
			
			$this->setFlash('Question: Please change Pop Up to mouse over (soft click)');
				
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
		public function q1_detail(){

			$this->setFlash('Question: Please change Pop Up to mouse over (soft click)');
				
			
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}

		public function result(){
            if ($this->request->is('post')) {
                if($this->request->data["Type"]["type"]=="Type2"){
                    $this->set('result', __('2'));
                } else {
                    $this->set('result', __('1'));
                }
            }
        }
		
	}