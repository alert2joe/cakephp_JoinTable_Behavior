<?php
App::uses('AppModel', 'Model');

class Comment extends AppModel {

     function TTjoinLists(){
        return array(
            'Post'=> array( 
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Post.id = Comment.post_id',
                        )
                    )
        );

     }
    

}
           