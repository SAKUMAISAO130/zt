  <table class="table table-striped">
    <tbody>


    <?php foreach($posts as $post) : ?>


    <tr>
      <th scope="row"><?php echo $this->Html->link($post['Post']['title'], '/posts/view/'.$post['Post']['id']); ?></th>
        <td><?php echo h($post['Post']['body']); ?></td>
        <td><?php echo $this->Html->link('編集', array('action'=>'edit', $post['Post']['id'])); ?></td>
        <td><?php echo $this->Form->postLink('削除', array('action'=>'delete', $post['Post']['id']),array('confirm'=>'sure?')); ?></td>
    </tr>


    <?php endforeach; ?>


        </tbody>
      </table>


<?php echo $this->Html->link('新規スレッド作成', array('controller'=>'posts', 'action'=>'add')); ?>
