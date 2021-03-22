<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\Query;
use App\Models\Utility;
use CodeIgniter\Controller;

class BaseController extends Controller
{

	protected $helpers = ['form', 'session', 'text'];

	public $email, $validation, $model, $query, $utility;

	public function __construct()
	{
		$this->email = \Config\Services::email();
		$this->validation = \Config\Services::validation();
		$this->model = new CrudModel();
		$this->query = new Query();
		$this->utility = new Utility();
	}

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		session();
		parent::initController($request, $response, $logger);
	}
}
