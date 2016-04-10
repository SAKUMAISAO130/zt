<?php
App::uses('Post', 'Model');
class Post extends AppModel {
  public $hasMany = "Comment";
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
            'message' => '空はダメ'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
}