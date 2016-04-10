<?php
App::uses('AppController', 'Controller');
class PostsController extends AppController {
    // helper関数の有効化
    public $helpers = array('Html', 'Form');
    public function index() {
        // ->set()で、viewに渡した時に、postsという変数名を使うことができる
        // 変数の中身をPost->find('all')で指定できる。※ここでは記事を全て引っ張ってくる
        $this->set('posts', $this->Post->find('all'));
    }

    public function view($id = null) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());
    }
    

    public function add() {
        if($this->request->is('post')) {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('new post create');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }

    public function edit($id = null) {
        $this->Post->id = $id;
        if($this->request->is('get')) {
            $this->request->data = $this->Post->read();
        } else {
            if($this->Post->save($this->request->data)) {
                $this->Session->setFlash('post edit');
                $this->redirect(array('action'=>'index'));
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
        if ($this->Post->delete($id)) {
            $this->Session->setFlash('Deleted!');
            $this->redirect(array('action'=>'index'));
        }
    }



}