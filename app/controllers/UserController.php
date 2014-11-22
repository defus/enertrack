<?php
/**
 * UserController 
 * {File description}
 * 
 * @author defus
 * @created Nov 13, 2014
 * 
 */

class UserController extends \BaseController {
    private $_userModel;
    public function __construct() {
        
        $this->beforeFilter('auth', array('except' => 'login'));
        $this->beforeFilter('csrf', array('on' => 'post'));
        
        $this->_userModel = new \User();
    }
    public function index() {
        return \View::make('admin.user.index', array(
                    'users' => \UserModel::all()
        ));
    }
    public function add() {
        return \View::make('admin.user.add', array());
    }
    public function edit($id) {
        return \View::make('admin.user.edit', array(
                    'user' => $user
        ));
    }
    public function delete($id) {
        return \Redirect::to('admin/users')
                        ->with('message', 'Item deleted');
    }
    public function login() {
        $input = \Input::all();
        if (!empty($input)) {
            $add = $this->_userModel->login(\Input::all());
            if (TRUE === $add) {
                return \Redirect::to('');
            } else {
                return \Redirect::to(\Request::url())
                                ->withErrors($add)
                                ->withInput();
            }
        }
        return \View::make('user.login');
    }
    
    public function logout(){
        \Auth::logout();
        return \Redirect::to( '/login' );
    }
}