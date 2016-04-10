<?php

#######################################
#会員登録のコントローラー処理
#######################################

#親クラスの使用
App::uses('AppController', 'Controller');
#CAKEのEmailクラスの使用
App::uses('CakeEmail', 'Network/Email');

#######################################
#会員登録のコントローラー処理の流れ
#######################################
class SignupController extends AppController {

  #アサイン変数
  public $name = 'Signup';
  public $uses = array('User');
  #Auth機能を使えるようにする
  public $components = array('Auth');
  
  #前段階処理
  public function beforeFilter(){
    #子コントローラーではコレを書かないと常に処理をしてくれない
    parent::beforeFilter();
    #前提条件として、非ログイン状態であることを確認する
    $this->Auth->allow();
  }
  
#######################################
#仮登録メール送信処理
#######################################
  #初期画面（index.ctp）を表示させる時の条件
  public function index(){
    #POSTされてきたデータがない時
    if (! $this->request->data){
      #indexページをレンダーする
      $this->render();
      return;
    }
    #フォームに入力がありサブミットを押されたときのModel処理前のバリデーション
    $this->User->validate = array(
      'email' => array(
        array(
          'rule' => 'notEmpty', 
          'message' => 'メールアドレスを入力してください'
        ), 
        array(
          'rule' => array('custom', '/^.+@.+$/'), 
          'message' => 'メールアドレスの形式が正しくありません。', 
        ), 
        array(
          'rule' => 'confirm', 
          'message' => 'メールアドレスが一致していません。', 
        ), 
        array(
          'rule' => 'isUniqueAndActive', 
          'message' => 'このメールアドレスは使用されています。', 
        )
      )
    );
    #バリデーションをクリアし、サブミット後の仮登録処理
    #DBに仮ユーザーを作成してメールを送信
    #まず、POSTデータの受け取り
    $this->User->set($this->request->data);
    #登録処理。POSTデータのバリデーションに問題ない場合。
    if (! $this->User->invalidFields()){
      #送信用Emailアドレス取得
      $email = $this->request->data['User']['email'];
      #アクティベーションコード生成
      $activation_code = md5($email.time());
      #DB登録用のデータ($user)を作成する
      $user = $this->User->find('first', array('conditions' => array('email' => $email, 'is_active' => false)));
      if (! $user){
        $this->User->create();
        $user = array('User' => $this->request->data['User']);
      }
      $user['User']['is_active'] = false;
      $user['User']['activation_code'] = $activation_code;
      $user['User']['ip_address'] = $this->request->clientIp(false);

      #######################################
      #DB仮登録
      #######################################
      $this->User->save($user);
      
      #メール送信処理
      $cakeemail = new CakeEmail('default');
      $cakeemail->to($email);
      $cakeemail->subject('【仮登録完了】ZeroThreadの本登録にお進みください');
      $cakeemail->send(sprintf('http://colorfullweb.sakura.ne.jp/zero_thread/signup/activate/%s', $activation_code));

      #メール送信完了画面をレンダー
      $this->render('email_sent');
    }
  }
  
#######################################
#本登録（アクティベーション）処理
#######################################
  public function activate($activation_code){
    #DBからアクティベーションされていない、さらにURLと一致するユーザーを検索して格納
    $user = $this->User->find('first', array('conditions' => array('activation_code' => $activation_code, 'is_active' => false)));
    #一致しなければ、初期の仮登録画面に飛ばす
    if (! $user){ $this->redirect('/signup/index'); }
    
    #POSTのデータが入っていなければ、通常通りパスワード入力が面をレンダー
    if (! $this->request->data){
      $this->render();
      return;
    }

    #フォームに入力がありサブミットを押されたときのModel処理前のバリデーション
    $this->User->validate = array(
      'password' => array(
        array(
          'rule' => 'notEmpty', 
          'message' => 'パスワードを入力してください。'
        ), 
        array(
          'rule' => array('custom', '/^[a-zA-Z0-9]+$/'), 
          'message' => '半角英数字で入力してください。', 
        ), 
        array(
          'rule' => 'confirm', 
          'message' => 'パスワードが一致していません。', 
        ), 
      ), 
    );
    #現在の登録情報にパスワードをセットする
    $this->User->set($this->request->data);
    #バリデーションを通っていたら登録処理開始
    if (! $this->User->invalidFields()){
      #ユーザーデータにパスワードを追加していき
      $user['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
      unset($user['User']['password_confirm']);
      #アクティベーションをtrueに変更
      $user['User']['is_active'] = true;
      
      $this->User->validate = array();
      #######################################
      #DB本登録
      #######################################
      $this->User->save($user);
      
      #完了したらAuth機能でログイン処理
      $this->Auth->login($user);
      #完了したら設定したリダイレクトURLに飛ばす
      $this->redirect($this->Auth->redirectUrl());
    }
  }
  
}
