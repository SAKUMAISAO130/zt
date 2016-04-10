<?php echo($this->Form->create()); ?>

<div class='email'>
<?php
echo($this->Form->label('User.email', 'メールアドレス: '));
echo($this->Form->text('User.email'));
echo($this->Form->error('User.email'));
?>
</div>

<div class='email-confirm'>
<?php
echo($this->Form->label('User.email_confirm', '確認: '));
echo($this->Form->text('User.email_confirm'));
?>
</div>

<?php echo($this->Form->end('送信')); ?>