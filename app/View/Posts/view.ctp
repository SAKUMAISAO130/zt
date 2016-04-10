<?php echo '<div class="post_info">'; ?>
<h2><?php echo h($post['Post']['title']); ?></h2>
<?php echo '</div>'; ?>
<?php echo '<div class="post_body">'; ?>
<p><?php echo h($post['Post']['body']); ?></p>
<?php echo '</div>'; ?>

<?php foreach ($post['Comment'] as $comment): ?>
    <li class="comment_block">
      <?php echo '<div class="comment_info">'; ?>
      <?php echo h($comment['created']); ?>
      <?php echo ' - '; ?>
      <?php echo h($comment['commenter']); ?>
      <?php echo '</div>'; ?>
      <?php echo '<div class="comment_body">'; ?>
      <?php echo h($comment['body']); ?>
      <?php echo '</div>'; ?>
      <?php echo '<br>'; ?>
      <?php
      echo $this->Form->postLink('削除', array('action'=>'delete', $post['Post']['id']),array('confirm'=>'sure?'));
      ?>
    </li>
<?php endforeach; ?>

<div class="text-center">
<?php
echo $this->Form->create('Comment', array('action'=>'add'));
echo $this->Form->input('commenter');
echo $this->Form->input('body', array('rows'=>3));
echo $this->Form->input('Comment.post_id', array('type'=>'hidden', 'value'=>$post['Post']['id']));
echo $this->Form->end('コメントを書き込む');
?>
</div>

