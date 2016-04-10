<?php echo($this->Form->create()); ?>
<div class='password'>
<?php
echo($this->Form->label('User.password', 'パスワード: '));
echo($this->Form->text('User.password'));
echo($this->Form->error('User.password'));
?>
</div>

<div class='password-confirm'>
<?php
echo($this->Form->label('User.password_confirm', '確認: '));
echo($this->Form->text('User.password_confirm'));
?>
</div>

<?php echo($this->Form->end('送信')); ?>