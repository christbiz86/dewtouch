<?php
	class OrderReportController extends AppController{

		public function index(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));
			// debug($orders);exit;

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
			// debug($portions);exit;


			// To Do - write your own array in this format

            $order_reports = array();
            foreach ($orders as $order) {
                $order_reports[$order['Order']['name']] = array();
                foreach ($order['OrderDetail'] as $order_detail) {
                    foreach ($portions as $portion) {
                        if ($portion['Item']['id'] == $order_detail['Item']['id']) {
                            foreach ($portion['PortionDetail'] as $portion_detail) {
                                if (!isset($order_reports[$order['Order']['name']][$portion_detail['Part']['name']]))
                                    $order_reports[$order['Order']['name']][$portion_detail['Part']['name']] = 0;
                                    $order_reports[$order['Order']['name']][$portion_detail['Part']['name']] += ($portion_detail['value'] * $order_detail['quantity']);
                            }
                        }
                    }
                }
                ksort($order_reports[$order['Order']['name']]);
            }

//			$order_reports = array('Order 1' => array(
//										'Ingredient A' => 1,
//										'Ingredient B' => 12,
//										'Ingredient C' => 3,
//										'Ingredient G' => 5,
//										'Ingredient H' => 24,
//										'Ingredient J' => 22,
//										'Ingredient F' => 9,
//									),
//								  'Order 2' => array(
//								  		'Ingredient A' => 13,
//								  		'Ingredient B' => 2,
//								  		'Ingredient G' => 14,
//								  		'Ingredient I' => 2,
//								  		'Ingredient D' => 6,
//								  	),
//								);

			// ...

			$this->set('order_reports',$order_reports);

			$this->set('title',__('Orders Report'));
		}

		public function Question(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));

			// debug($orders);exit;

			$this->set('orders',$orders);

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
				
			// debug($portions);exit;

			$this->set('portions',$portions);

			$this->set('title',__('Question - Orders Report'));
		}

	}