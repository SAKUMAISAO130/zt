<?php
class CommentsController extends AppController {
    // helper関数の有効化
    public $helpers = array('Html', 'Form');


    public function add() {
        if($this->request->is('post')) {
            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash('new Comment create');
//                $this->redirect(array('action'=>'index'));
                // $this->Commentに変えるのも忘れずに
                // add()内
                $this->redirect(array('controller'=>'posts', 'action'=>'view', $this->data['Comment']['post_id']));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }



    public function delete($id) {
        // 直接URLでアクセスされた時の例外処理を入れる
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Comment->delete($id)) {
            $this->Session->setFlash('Deleted!');
//            $this->redirect(array('action'=>'index'));
            // $this->Commentに変えるのも忘れずに
            // delete()内
            $this->redirect(array('controller'=>'posts', 'action'=>'index'));
        }
    }



}