<?php

namespace App\Controllers;

$session = \Config\Services::session($config);

use CodeIgniter\Controller;
use App\Models\Formvalid;

/**
 * @property IncomingRequest $request 
 */

class Form extends Controller
{
  public function index()
  {
    echo "Session: " . $_SESSION["username"];
    if (!empty($_SESSION['username'])) {
      return view('templates/navbar') . view('formfile/welcome', $_SESSION) . view('templates/footer');
    } else {
      return view('templates/navbar') . view('formfile/form') . view('templates/footer');
    }
  }

  public function login()
  {
    $rules = [
      'log_name' => 'required',
      'log_pass' => 'required',
    ];

    if ($this->validate($rules)) {
      $model = model(Formvalid::class);
      $data['uname'] = $this->request->getVar('log_name');
      $data['pass'] = $this->request->getVar('log_pass');

      $data['user'] = $model->getUser($data['uname']);
      $data['hashpass'] = $data['user']['password'];

      if (!empty($data['user'])) {
        if (password_verify($data['pass'], $data['hashpass'])) {

          $_SESSION['username'] = $data['user']['username'];
          $_SESSION['isLogdIn'] = true;

          return view('templates/navbar') . view('formfile/welcome', $data) . view('templates/footer');
        } else {
          $data['text'] = "Password Unmatched!!";
          return view('templates/notfound', $data);
        }
      } else {
        $data['text'] = "No Such User Found!!";
        return view('templates/notfound', $data);
      }
    }
  }

  public function register()
  {

    $rules = [
      'reg_name' => 'required|min_length[3]|max_length[50]',
      'reg_pass' => 'required|min_length[6]',
    ];

    if ($this->validate($rules)) {
      $model = model(Formvalid::class);
      $data['uname'] = $this->request->getVar('reg_name');
      $data['user'] = $model->getUser($data['uname']);

      if (empty($data['user'])) {
        $data = [
          'username' => $this->request->getVar('reg_name'),
          'password' => password_hash($this->request->getVar('reg_pass'), PASSWORD_DEFAULT),
        ];
        $model->save($data);

        $_SESSION['username'] = $data['username'];
        $_SESSION['isLogdIn'] = true;

        return view('templates/navbar') . view('formfile/welcome', $data) . view('templates/footer');
      } else {
        $data['text'] = "Username Already Exists!!";
        return view('templates/notfound', $data);
      }
    } else {
      $data['text'] = "Please! Enter valid details.";
      return view('templates/notfound', $data);
    }
  }

  public function logout()
  {
    session_destroy();
    return redirect()->to('/');
  }
}
