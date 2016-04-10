<?php
App::uses('Comment', 'Model');
class Comment extends AppModel {
    // 全てのコメントはPostに帰属するという指定
    public $belongsTo = 'Post';
}