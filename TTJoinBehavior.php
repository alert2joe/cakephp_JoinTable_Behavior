<?php
class TTJoinBehavior extends ModelBehavior {
    private $lists = array();

    private function __TTjoin( Model $model, $joinKey, $arg=null) {
     
         $joinKeys = explode(".",$joinKey);
         $modelName = $joinKeys[0];
         $TTkey = $joinKeys[1];

         $callFunctionName = $this->settings[$model->alias]['callFunctionName'];
         
         $joinModel = ClassRegistry::init($modelName);
         $j = $joinModel->$callFunctionName();
         $data = $j[$TTkey];
        
        $database = ConnectionManager::getDataSource($joinModel->useDbConfig)->config['database'];
       
         $data['table'] = $database.'.'.$joinModel->useTable;
         $data['alias'] = $joinModel->alias;

         if(isset($joinKeys[2])){
             $data['type'] = $joinKeys[2];
         }

         if($arg){
            $data = Hash::merge($data , $arg);
         }

         $this->lists[] = $data ;
   
        return $model;

    }

    private function __TTRun(){
        
        return $this->lists;
    }


    public function TTJoin(Model $model,$arg = array()){
        $this->lists = [];
        foreach($arg as $k=>$v){
            if(is_numeric($k)){
                $this->__TTjoin($model,$v);
            }else{
                if($k == 'NoModel'){
                    $this->lists[] = $v;
                }else{
                    $this->__TTjoin($model,$k,$v);
                } 
            }
        }
         return $this->__TTRun();
        
    }

    public function setup(Model $Model, $settings = array()) {
    if (!isset($this->settings[$Model->alias])) {
        $this->settings[$Model->alias] = array(
            'callFunctionName' => 'TTjoinLists',
         
        );
    }
        $this->settings[$Model->alias] = array_merge(
        $this->settings[$Model->alias], (array)$settings);
    }



}
