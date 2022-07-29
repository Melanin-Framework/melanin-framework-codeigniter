<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Libraries\MF_PasswordHasher;


class Admin extends ResourceController {
    /**
     * @var $adminModel AdminModel instance of the AdminModel class
     */
    protected $adminModel;

    /**
     * @var $PasswordHasher MF_PasswordHasher instance of the PasswordHasher class
     */
    protected $passwordHasher;

    public function __construct() {
        $this->adminModel = new AdminModel();
        $this->passwordHasher = new MF_PasswordHasher();
    }

    /**
     * Main function for this controller class.
     * @return mixed returns a RESTful response
     */
    public function index() {
        if ($this->request->getMethod() == 'post') {
            $clauses = [
                "admin_email" => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
                "admin_passkey" => $this->
                                        passwordHasher->
                                            hashPassword(
                                                $this->request->
                                                    getVar('password', FILTER_SANITIZE_STRING)
                                            ),
            ];

            $adminData = $this->adminModel->authenticateLogin($clauses);

            if($adminData){
                return $this->respond($adminData);
            } else {
                return $this->failNotFound();
            }
        }
        return $this->respond(["message" => "Admin Login"]);
    }
}