<?php
class TTJoinBehavior extends ModelBehavior {
    private $lists = array();

    private function __TTjoin( Model $model, $method, $arg=null) {
     
        $methods = explode(".",$method);
    
         $joinModel = ClassRegistry::init($methods[0]);
         $j = $joinModel->TTJoinLists;
         $data = $j[$methods[1]];
   
         if($arg){
            $data = Hash::merge($data , $arg);
         }

         $this->lists[] = $data ;
   
        return $model;

    }

    private function __TTRun(){
        return $this->lists;
    }


    public function TTJoin(Model $model,$method = array()){
        $this->lists = [];
        foreach($method as $k=>$v){
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
/*
//post model
case 01 : //quick use
            array(
             'joins' => $this->TTJoin(array('Comment.Post')),
             );

case 02 : 
      array(
             'joins' => $this->TTJoin(array('Comment.Post','modelName.TTKEY')),
             );

case 03 ://over write default value
         array(
             'joins' => $this->TTJoin(array(
                            'Comment.Post'=>array(
                                                'type'=>'INNER'
                                                )
                                        ),
             );
case 04 // no model join
        'joins' => $this->TT(array('NoModel'=>array(
                        'table' => 'comment',
                        'alias' => 'Comment',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Post.id = Comment.post_id',
                        )
                    ))



//comment model
// set default config

     public $TTJoinLists = array(
        'Post'=> array( 'table' => 'comment',
                        'alias' => 'Comment',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Post.id = Comment.post_id',
                        )
                    )
     );
     

     */