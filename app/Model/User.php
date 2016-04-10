<?php

#モデルクラス読み込み
App::uses('AppModel', 'Model');

#AppModelを継承して、Userモデルクラスの設定start
class User extends AppModel {

#######################################
# データベース接続時に使うアサイン変数
#######################################

  #モデル名設定
  public $name = 'User';

#######################################
# データベース接続時に使うアサイン関数
#######################################

  #登録済み（アクティブ）なのか、emailが登録済みかチェックする関数
  public function isUniqueAndActive($check){
    foreach ($check as $key => $value){
      #検索データをfindして$countに格納
      $count = $this->find('count', array(
        #検索条件設定
        'conditions' => array(
          $key => $value, 
          'is_active' => true, 
        ), 
        #検索範囲設定（全件）
        'recursive' => -1
      ));
      #見つかればfalseを返す
      if ($count != 0){ return false; }
    }
    #見つかなければtrueを返す
    return true;
  }
  
  #確認画面を通しているか確認する関数
  #formタグ内にpassword_confirm、email_confirmがあるかどうかチェックする
  public function confirm($check){
    foreach ($check as $key => $value){
      if (! isset($this->data[$this->name][$key.'_confirm'])){
        return false;
      }
      if ($value !== $this->data[$this->name][$key.'_confirm']){
        return false;
      }
    }
    #入っていればtrueを返す
    return true;
  }


}
