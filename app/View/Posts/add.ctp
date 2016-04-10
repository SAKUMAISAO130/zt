<?php
echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows'=>3));  // 第二引数にhtmlの属性を入れることも
echo $this->Form->end('Save Post');
?>