<?php
echo($this->Form->create());
echo($this->Form->label('User.email'));
echo($this->Form->text('User.email'));
echo($this->Form->label('User.password'));
echo($this->Form->password('User.password'));
echo($this->Form->end('ログイン'));
?>

<?php if (count($errors)){ ?>
<ul>
  <?php foreach ($errors as $error){ ?>
  <li><?php echo $error ?></li>
  <?php } ?>
</ul>
<?php }