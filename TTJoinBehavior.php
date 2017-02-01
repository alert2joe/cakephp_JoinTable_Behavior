<?php
class TTJoinBehavior extends ModelBehavior {
    private $lists = array();

    private function __TTjoin( Model $model, $joinKey, $arg=null) {
     
        $joinKeys = explode(".",$joinKey);
    
         $joinModel = ClassRegistry::init($joinKeys[0]);
         $j = $joinModel->TTjoinLists();
         $data = $j[$joinKeys[1]];

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



}
