<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'ZeroThread');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<?php echo "\n"; ?>
	<title>
		<?php echo $cakeDescription ?>:<?php echo $this->fetch('title'); ?>
	<?php echo "\n"; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo "\n";
		echo $this->fetch('meta');
		echo "\n";
		echo $this->fetch('css');
		echo "\n";
		echo $this->Html->css('forms');
		echo "\n";
		echo $this->Html->css('bootstrap.min');
		echo "\n";
		echo $this->Html->css('cake.generic');
		echo "\n";
		echo $this->fetch('script');
		echo "\n";
		echo $this->Html->script('jquery-1.12.3.min');
		echo "\n";
		echo $this->Html->script('bootstrap.min');
		echo "\n";
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			  <nav class="navbar">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#patern05">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
						<h1><?php echo $this->Html->link($cakeDescription, '/'); ?></h1>

			    </div>

			    <div id="patern05" class="collapse navbar-collapse">
			      <ul class="nav navbar-nav navbar-right">
			        <li><?php echo $this->Html->link('スレッド一覧', array('controller'=>'posts', 'action'=>'index')); ?></li>
			        <li><a href="">人気ランキング</a></li>
							<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">アカウント<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="#">マイページ</a></li>
									<li><a href="#">アカウント設定</a></li>
									<li><?php echo $this->Html->link('ログイン', array('controller'=>'users', 'action'=>'login')); ?></li>
									<li><?php echo $this->Html->link('サインアップ', array('controller'=>'signup', 'action'=>'index')); ?></li>
								</ul>
							</li>
			      </ul>
			    </div>
			  </nav>

		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer" class="text-center">
			<?php 
			echo $this->Html->link('©ZeroThread', '/');
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
