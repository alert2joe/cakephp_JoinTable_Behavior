# cakephp_JoinTable_Behavior
```
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
        'Post'=> array( 'table' => $this->$useDbConfig.'.'.$this->useTable,
                        'alias' => $this->alias,
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Post.id = Comment.post_id',
                        )
                    )
     );
```
