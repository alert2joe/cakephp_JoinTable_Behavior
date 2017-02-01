<?php
App::uses('AppModel', 'Model');

class Comment extends AppModel {

     function TTjoinLists(){
        $database = ConnectionManager::getDataSource($this->useDbConfig)->config['database'];
        return array(
            'Post'=> array( 'table' => $database.'.'.$this->useTable,
                        'alias' => $this->alias,
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Post.id = Comment.post_id',
                        )
                    )
        );

     }
    

}
           