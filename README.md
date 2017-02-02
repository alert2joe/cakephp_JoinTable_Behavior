# cakephp_JoinTable_Behavior

##Usage

Use inside your model
```
public $actsAs = array('TTJoin');

```

post.php 

```

//post model
case 01 : //quick use
            array(
             'joins' => $this->TTJoin(array('Comment.Post')),
             );

case 02 : //join 2 table
      array(
             'joins' => $this->TTJoin(array('Comment.Post','modelName.TTKEY')),
             );

case 01 : //quick over write default type
            array(
             'joins' => $this->TTJoin(array('Comment.Post.LEFT')),
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
        'joins' => $this->TTJoin(array('NoModel'=>array(
                        'table' => 'comment',
                        'alias' => 'Comment',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Post.id = Comment.post_id',
                        )
                    ))
```

in Comment.php
```
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
```