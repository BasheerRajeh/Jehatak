<?php

/**
 * Class Home
 */
class Home extends Controller
{
	/**
     * PAGE: home_page
     */
    public function index()
    {
		session_start();
		$page = "homepage";
		
        // load views
        require 'application/views/templates/header.php';
        require 'application/views/home/index.php';
        require 'application/views/templates/footer.php';
    }
	
	/**
     * PAGE: sign_up
	 * This method handles what happens when you move to http://myproject/home/signup
     */
	public function signUp($page, $email_error=null)
    {
		if($email_error == 1)
			$email_error = "الإيميل موجود سابقا.";
		else
			$email_error = null;
		
        // load view
        require 'application/views/home/sign_up.php';
    }
	
	/**
     * PAGE: login
	 * This method handles what happens when you move to http://myproject/home/login
     */
    public function login($page, $email_error=null, $password_error=null)
    {
		if($email_error == 1)
			$email_error = "الإيميل غير موجود.";
		else
			$email_error = null;
		if($password_error == 1)
			$password_error = "كلمة المرور خاطئة.";
		else
			$password_error = null;
		
        // load view
        require 'application/views/home/login.php';
    }
	
	/**
     * PAGE: profile
     * This method handles what happens when you move to http://myproject/home/profile/{user_id}
     */
    public function profile($page, $user_id=0, $image_url_error=null, $email_error=null)
    {
		session_start();
		if($user_id <= 0){
			header('location: ' . URL);
			return;
		}
		
		// Error
		if($image_url_error == 1)
			$image_url_error = "الملف ليس صورة.";
		elseif($image_url_error == 2)
			$image_url_error = "الملف موجود سابقا.";
		elseif($image_url_error == 3)
			$image_url_error = "الملف كبير.";
		elseif($image_url_error == 4)
			$image_url_error = "ملفات الصور فقط مقبولة.";
		elseif($image_url_error == 5)
			$image_url_error = "حصل خطأ أثناء رفع الملف.";
		elseif($image_url_error == 0)
			$image_url_error = null;
		if($email_error == 1)
			$email_error = "الإيميل موجود سابقا.";
		elseif($email_error == 0)
			$email_error = null;
		
		// load a model, perform an action, pass the returned data to a variable
        $users_model = $this->loadModel('UsersModel');
		$user = $users_model->getUser($user_id);

		if(!isset($user->name)){
			header('location: ' . URL);
			return;
		}

		if ($user->role_id == 3) { // 3 mean Student
			$students_model = $this->loadModel('StudentsModel');
			$student = $students_model->getStudent($user_id);
			if (isset($student->training_company_id)) {
				$companies_model = $this->loadModel('CompaniesModel');
				$company = $companies_model->getCompany($student->training_company_id);
			}
		}

		if ($user->role_id == 2) { // 2 mean Supervisor
			$supervisors_model = $this->loadModel('SupervisorsModel');
			$supervisor = $supervisors_model->getSupervisor($user_id);
			$students = $supervisors_model->getSupervisorStudents($user->id);
		}

		if($user->role_id == 4){ // 4 mean Company
		    $companies_model = $this->loadModel('CompaniesModel');
		    $studentsInfo = $companies_model->getCompanyStudents($user->id);
		    $supervisorsInfo = $companies_model->getSupervisorsInfo($user->id);
			$isCompany = true;
			$students_model = $this->loadModel('StudentsModel');
            if ($_SESSION['role_name'] == 'طالب') {
                $request = $students_model->checkRequest($_SESSION['id'])->status??"Rejected";
                $hasRequest = $request == "Accepted" || $request == "Pending" ? true : false;
            }
        }

		// load a model, perform an action, pass the returned data to a variable
        $specialities_model = $this->loadModel('SpecialitiesModel');
		$specialities = $specialities_model->getAllSpecialities();

		// load views
		require 'application/views/templates/header.php';
        require 'application/views/home/profile.php';
        require 'application/views/templates/footer.php';
    }
	
	/**
     * PAGE: control
     * This method handles what happens when you move to http://myproject/home/control
     */
    public function control($page)
    {
		session_start();
		if($_SESSION['role_name'] != 'مدير'){
			header('location: ' . URL);
			return;
		}

		// load another model, perform an action, pass the returned data to a variable
        $students_model = $this->loadModel('StudentsModel');
        $students = $students_model->getAcceptedStudents();

		// load another model, perform an action, pass the returned data to a variable
        $supervisors_model = $this->loadModel('SupervisorsModel');
        $supervisors = $supervisors_model->getAllSupervisors();

        // load views
        require 'application/views/templates/header.php';
        require 'application/views/home/control.php';
        require 'application/views/templates/footer.php';
    }

	/**
     * PAGE: companies
     * This method handles what happens when you move to http://myproject/home/companies
     */
    public function companies($page)
    {
		session_start();

		// load another model, perform an action, pass the returned data to a variable
        $companies_model = $this->loadModel('CompaniesModel');
        $companies = $companies_model->getAllCompanies();

        // load views
        require 'application/views/templates/header.php';
        require 'application/views/home/companies.php';
        require 'application/views/templates/footer.php';
    }

	/**
     * PAGE: students
     * This method handles what happens when you move to http://myproject/home/students
     */
    public function students($page)
    {
		session_start();

		// load another model, perform an action, pass the returned data to a variable
        $students_model = $this->loadModel('StudentsModel');
        $students = $students_model->getAllStudents();

        // load views
        require 'application/views/templates/header.php';
        require 'application/views/home/students.php';
        require 'application/views/templates/footer.php';
    }

	/**
     * PAGE: supervisors
     * This method handles what happens when you move to http://myproject/home/supervisors
     */
    public function supervisors($page)
    {
		session_start();

		// load another model, perform an action, pass the returned data to a variable
        $supervisors_model = $this->loadModel('SupervisorsModel');
        $supervisors = $supervisors_model->getAllSupervisors();

        // load views
        require 'application/views/templates/header.php';
        require 'application/views/home/supervisors.php';
        require 'application/views/templates/footer.php';
    }

	/**
     * ACTION: userAction
     * This method handles what happens when you move to http://myproject/home/useraction
     * IMPORTANT: This is not a normal page, it's an ACTION.
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     */
    public function userAction($action, $event)
    {
        if (isset($_POST["email"]) && $event=='login') {
			$users_model = $this->loadModel('UsersModel');
			$users = $users_model->getAllUsers();
			foreach ($users as $user) {
				if (isset($user->id)) {
					if($user->email == $_POST["email"]) {
						if(password_verify($_POST["password"], $user->password)) {
							$roles_model = $this->loadModel('RolesModel');
							$role = $roles_model->getRole($user->role_id);
							
							session_start();
							$_SESSION['id']=$user->id;
							$_SESSION['email']=$user->email;
							$_SESSION['name']=$user->name;
							$_SESSION['image_url']=$user->image_url;
							$_SESSION['role_name']=$role->name;
							if($role->name == 'مدير')
								header('location: ' . URL . 'home/control');
							else
								header('location: ' . URL);
							return;
						}
						else {
							$email_error = 0;
							$password_error = 1;
							header('location: ' . URL . 'home/login/' . $email_error . '/' . $password_error);
							return;
						}
					}
				}
			}
			$email_error = 1;
			header('location: ' . URL . 'home/login/' . $email_error);
			return;
        }
		if ($event == 'logout') {
			session_start();
			session_destroy();
			header('location: ' . URL);
		}
    }
	
	/**
     * ACTION: addUser
     * This method handles what happens when you move to http://myproject/home/adduser
     * IMPORTANT: This is not a normal page, it's an ACTION.
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to home_page via the last line: header(...)
     */
    public function addUser($action)
    {
		// if we have POST data to create a new user entry
        if (isset($_POST["email"])) {
            // load model, perform an action on the model
            $users_model = $this->loadModel('UsersModel');
			$users = $users_model->getAllUsers();
			foreach ($users as $user) {
				if($user->email == $_POST["email"]) {
					$email_error = 1;
					header('location: ' . URL . 'home/signup/' . $email_error);
					return;
				}
			}
			$hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
			$image_url = "user.jpeg";
            $users_model->addUser($_POST["email"], $hash, $_POST["name"], $image_url, 3); // 3 mean (role = Student)
			$students_model = $this->loadModel('StudentsModel');
			$students_model->addStudent($users_model->getLastInsertId());

			session_start();
			$_SESSION['id'] = $users_model->getLastInsertId();
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['name'] = $_POST['name'];
			$_SESSION['image_url'] = $image_url;
			$_SESSION['role_name'] = 'طالب';
        }

        header('location: ' . URL);
    }

	/**
     * ACTION: addSupervisor
     * This method handles what happens when you move to http://myproject/home/addsupervisor
     * IMPORTANT: This is not a normal page, it's an ACTION.
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     */
	public function addSupervisor($action)
    {
		session_start();
		if($_SESSION['role_name'] != 'مدير'){
			header('location: ' . URL);
			return;
		}

		$image_url = 'user.jpeg';
		$image_url_error = 0;
		if(basename($_FILES["image"]["name"]) != '') { //upload image
			$target_dir = "public/images/users/";
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Check if image file is a actual image or fake image
			if($_FILES["image"]["tmp_name"]!=''){
				$check = getimagesize($_FILES["image"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$image_url_error = 1;
					$uploadOk = 0;
				}
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				$image_url_error = 2;
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["image"]["size"] > 500000) {
				$image_url_error = 3;
				$uploadOk = 0;
			}
			// If everything is ok, try to upload file
			if ($uploadOk == 1) {
				if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
					$image_url = basename($_FILES["image"]["name"]);
				}
			}
		}

		// if we have POST data to create a new user entry
        if (isset($_POST["email"])) {
			$hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
			$users_model = $this->loadModel('UsersModel');
            $users_model->addUser($_POST["email"], $hash, $_POST["name"], $image_url, 2); // 2 mean (role = Supervisor)
			$supervisors_model = $this->loadModel('SupervisorsModel');
			$supervisors_model->addSupervisor($users_model->getLastInsertId(), $_POST["n_id"]);
        }

        header('location: ' . URL . 'home/control');
    }

	/**
     * ACTION: addcompany
     * This method handles what happens when you move to http://myproject/home/addcompany
     * IMPORTANT: This is not a normal page, it's an ACTION.
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     */
	public function addCompany($action)
    {
		session_start();
		if($_SESSION['role_name'] != 'مدير'){
			header('location: ' . URL);
			return;
		}

		$image_url = 'default.jpg';
		$image_url_error = 0;
		if(basename($_FILES["image"]["name"]) != '') { //upload image
			$target_dir = "public/images/companies/";
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Check if image file is a actual image or fake image
			if($_FILES["image"]["tmp_name"]!=''){
				$check = getimagesize($_FILES["image"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$image_url_error = 1;
					$uploadOk = 0;
				}
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				$image_url_error = 2;
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["image"]["size"] > 500000) {
				$image_url_error = 3;
				$uploadOk = 0;
			}
			// If everything is ok, try to upload file
			if ($uploadOk == 1) {
				if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
					$image_url = basename($_FILES["image"]["name"]);
				}
			}
		}

		// if we have POST data to create a new user entry
        if (isset($_POST["email"])) {
			$hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
			$users_model = $this->loadModel('UsersModel');
            $users_model->addUser($_POST["email"], $hash, $_POST["name"], $image_url, 4); // 4 mean (role = Company)
			$companies_model = $this->loadModel('CompaniesModel');
			$companies_model->addCompany($users_model->getLastInsertId(), $_POST["name"]);
        }

        header('location: ' . URL . 'home/control');
    }

	/**
     * ACTION: assignSupervisor
     * This method handles what happens when you move to http://myproject/home/assignsupervisor
     * IMPORTANT: This is not a normal page, it's an ACTION.
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     */
    public function assignSupervisor($action, $student_id)
    {
		session_start();
		if($_SESSION['role_name'] != 'مدير'){
			header('location: ' . URL);
			return;
		}

		if(isset($_POST['supervisors'])){
			
			$supervisor_id = $_POST['supervisors'];

			// load another model, perform an action, pass the returned data to a variable
			$students_model = $this->loadModel('StudentsModel');
			$students_model->assignSupervisor($student_id, $supervisor_id);
		}

        header('location: ' . URL . 'home/control');
    }

	/**
     * ACTION: editUserProfile
     * This method handles what happens when you move to http://myproject/home/edituserprofile
     * IMPORTANT: This is not a normal page, it's an ACTION.
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to home/profile via the last line: header(...)
     */
    public function editUserProfile($action)
    {
		session_start();
		$image_url = null;
		$image_url_error = 0;
		$email_error = 0;
		$hash = null;
		
		// if we have POST data to edit a exist user entry
        if (isset($_POST["email"])) {
			if($_POST["password"] != '')
				$hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
			else
				$hash = $_SESSION['password'];
			if(basename($_FILES["image"]["name"]) == '')
				$image_url = $_SESSION['image_url'];
			else { // upload image
				if ($_SESSION['role_name'] == 'شركة')
					$target_dir = "public/images/companies/";
				else
					$target_dir = "public/images/users/";
				$target_file = $target_dir . basename($_FILES["image"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
				if(isset($_POST["email"])) {
					if($_FILES["image"]["tmp_name"]!=''){
						$check = getimagesize($_FILES["image"]["tmp_name"]);
						if($check !== false) {
							$uploadOk = 1;
						} else {
							$image_url_error = 1;
							$uploadOk = 0;
						}
					}
				}
				// Check if file already exists
				if (file_exists($target_file)) {
					$image_url_error = 2;
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["image"]["size"] > 5000000) {
					$image_url_error = 3;
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
					$image_url_error = 4;
					$uploadOk = 0;
				}
				// If everything is ok, try to upload file
				if ($uploadOk == 1) {
					if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
						$image_url = basename($_FILES["image"]["name"]);
					}
					else {
						$image_url = $_SESSION['image_url'];
						$image_url_error = 5;
					}
				}
				elseif ($uploadOk == 0) {
					$image_url = $_SESSION['image_url'];
				}
			}
			
            // load models, perform an action on them
            $users_model = $this->loadModel('UsersModel');
			$students_model = $this->loadModel('StudentsModel');
			$supervisors_model = $this->loadModel('SupervisorsModel');
			$companies_model = $this->loadModel('CompaniesModel');

			$users = $users_model->getAllUsers();
			foreach ($users as $user) {
				if (isset($user->id)) {
					if(($user->email==$_POST["email"])&&($_SESSION['id']!=$user->id)) {
						$email_error = 1;
						header('location: ' . URL . 'home/profile/' . $_SESSION['id'] . '/' . $image_url_error . '/' . $email_error);
						return;
					}
				}
			}
            $users_model->editUserProfile($_SESSION['id'], $_SESSION["name"], $_POST["email"], $hash, $image_url);
			if ($_SESSION['role_name'] == 'طالب')
				$students_model->editStudentProfile($_SESSION['id'], $_POST["u_id"], $_POST["n_id"], $_POST["rate"], $_POST["spec"]);
			if ($_SESSION['role_name'] == 'مشرف')
				$supervisors_model->editSupervisorProfile($_SESSION['id'], $_POST["n_id"]);
			if ($_SESSION['role_name'] == 'شركة')
				$companies_model->editCompanyProfile($_SESSION['id'], $_POST["name"]);

			$_SESSION['email'] = $_POST['email'];
			$_SESSION['name'] = $_POST['name'];
			$_SESSION['image_url'] = $image_url;
        }

        // where to go after user has been edited
        header('location: ' . URL . 'home/profile/' . $_SESSION['id'] . '/' . $image_url_error . '/' . $email_error);
    }

	/**
     * ACTION: acceptRequest
     * This method handles what happens when you move to http://myproject/home/acceptrequest
     * IMPORTANT: This is not a normal page, it's an ACTION.
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     */
	public function acceptRequest($action, $request_id)
    {
		session_start();
		if($_SESSION['role_name'] != 'شركة'){
			header('location: ' . URL);
			return;
		}

		// load another model, perform an action, pass the returned data to a variable
		$requests_model = $this->loadModel('RequestsModel');
		$requests_model->acceptRequest($request_id);
		
		// load another model, perform an action, pass the returned data to a variable
		$companies_model = $this->loadModel('CompaniesModel');
		$company_id = $companies_model->getCompanyId($_SESSION['id'])->id;

		$student_id = $requests_model->getStudentId($request_id)->student_user_id;

		// load another model, perform an action, pass the returned data to a variable
		$students_model = $this->loadModel('StudentsModel');
		$students_model->assignTrainingCompany($student_id, $company_id);

        header('location: ' . URL . 'home/profile/' . $_SESSION['id']);
    }

	/**
     * ACTION: rejectRequest
     * This method handles what happens when you move to http://myproject/home/rejectrequest
     * IMPORTANT: This is not a normal page, it's an ACTION.
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     */
	public function rejectRequest($action, $request_id)
    {
		session_start();
		if($_SESSION['role_name'] != 'شركة'){
			header('location: ' . URL);
			return;
		}

		// load another model, perform an action, pass the returned data to a variable
		$requests_model = $this->loadModel('RequestsModel');
		$requests_model->rejectRequest($request_id);

        header('location: ' . URL . 'home/profile/' . $_SESSION['id']);
    }

	/**
     * ACTION: addRequest
     * This method handles what happens when you move to http://myproject/home/addrequest
     * IMPORTANT: This is not a normal page, it's an ACTION.
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     */
    public function addRequest($action)
    {
        if (isset($_POST['message']) && isset($_POST['student_id']) && isset($_POST['training_id'])) {
            if (!empty($_POST['message'])) {

                $companies_model = $this->loadModel('CompaniesModel');

                $company_id = $companies_model->getCompanyId($_POST['training_id'])->id;

                $requests_model = $this->loadModel('RequestsModel');

                $requests_model->addRequest('Pending', $_POST['message'], $_POST['student_id'], $company_id);

            }
            header('location: ' . URL . 'home/profile/' . $_POST['training_id']);
        } else
            header('location: ' . URL);
    }

	/**
     * ACTION: sendCompanyMessage
     * This method handles what happens when you move to http://myproject/home/sendcompanymessage
     * IMPORTANT: This is not a normal page, it's an ACTION.
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     */
    public function sendCompanyMessage($action)
    {
		session_start();
		if($_SESSION['role_name'] != 'مشرف'){
			header('location: ' . URL);
			return;
		}

        if (isset($_POST['company']) && isset($_POST['from']) && isset($_POST['to']) && isset($_POST['names'])) {

            $message_model = $this->loadModel('MessagesModel');

            $company_model = $this->loadModel('CompaniesModel');

            $company = $company_model->getCompanyName($_POST['company']);

            $message = "
التدريب فى شركة : " .$company->name. "

تحية طيبة وبعد ...
بألاشارة إلى خطاب سيادتكم الوارد الينا بتاريخ ".date("Y/m/d")." بأمكانية قبول تدريب
الطلاب التالية أسمائهم :
".$_POST['names']."
خلال الفترة
من ".$_POST['from']."
إلى ".$_POST['to']."
الرجاء العلم بأنه تم قبول تدريب الطلاب
خلال هذه الفترة
و يرجى العلم بأن إدارة الكلية غير مسئوله عن دفع أى تكاليف أو تحمل أى نفقات خاصة
بكم لدى الطالب
الرجاء إرسال الخطة التدريبية الخاصة بالطلاب حتى نستطيع متابعته فى الحضور لديكم .

وتفضلوا بقبول وافر الإحترام

مشرف وحدة التدريب في الكلية
            ";

            $message_model->addMessage(addslashes($message),$_POST['company']);

        }
		header('location: ' . URL . 'home/profile/' . $_SESSION['id']);
    }
}
