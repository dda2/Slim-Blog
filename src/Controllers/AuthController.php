<?php

namespace Pamit\Controllers;

use Pamit\Core\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Valitron\Validator;

class AuthController extends Controller
{
    public function getSignup(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'admin/auth/signup.twig');
    }

    public function postSignup(Request $request, Response $response, $args)
    {

        $req = $request->getParsedBody();
        $val = new Validator($req);
        $val->rule('required', ['username', 'email', 'password']);
        // $this->validator->rule('required', ['username', 'email', 'password']);
        $this->validator->labels([
            'username'  => 'username',
            'password'  => 'password',
            'email'     => 'email'
            ]);

        $new_password = password_hash($req['password'], PASSWORD_DEFAULT);

        if ($this->validator->validate()) {
            $query = 'INSERT INTO users (username, password, email) VALUES (:username, :password, :email)';

            $result = $this->db->prepare($query);

            $result->bindParam(':username', $req['username']);
            // $result->bindParam(':password', $new_password);
            $result->bindParam(':password', $new_password);
            $result->bindParam(':email', $req['email']);
            // $result->binParam(':first_name', $first_name);
            // $result->binParam(':last_name', $last_name);
            $result->execute();

        } else {
                foreach ($this->validator->errors() as $key => $error) {
                    $this->flash->addMessage('error', $error[0]);
                    // echo $error[0];
                }

        }
        // $this->flash->addMessage('success', 'Tes Flashing Message');
        // $this->view->redirect('signup');
        return $this->view->redirect($response, 'admin/auth/signup.twig');
    }

    public function getSignin(Request $request, Response $response, $args)
    {

        return $this->view->render($response, 'admin/auth/signin.twig');
    }

    public function doSignin(Request $request, Response $response, $args)
    {

        $req = $request->getParsedBody();

        // $query = ('SELECT  FROM users WHERE email = :email, password = :password');
    }
}