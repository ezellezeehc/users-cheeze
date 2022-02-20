<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('users_model');
		//include modal.php in views
		$this->inc['modal'] = $this->load->view('modal', '', true);
	}
	public function index(){
		$this->load->view('show', $this->inc);
	}

	public function show(){
		$data = $this->users_model->show();
		$output = array();
		foreach($data as $row){
			?>
			<tr>
				<td><?php echo $row->id; ?></td>			
				<td><?php echo $row->first_name; ?></td>
				<td><?php echo $row->last_name; ?></td>
				<td><?php echo $row->position; ?></td>
				<td><?php echo $row->create_date; ?></td>
				<td>
					<button class="btn btn-edit edit" data-id="<?php echo $row->id; ?>"><span class=""></span> Edit</button> || 
					<button class="btn btn-danger delete" data-id="<?php echo $row->id; ?>"><span class=""></span> Delete</button>
				</td>
			</tr>
			<?php
		}
	}

	public function insert(){
		
		$user['first_name'] = $_POST['first_name'];
		$user['last_name'] = $_POST['last_name'];
		$user['position'] = $_POST['position'];
		$user['create_date'] = date("y-m-d h:i:s");
		
		$query = $this->users_model->insert($user);
	}

	public function getuser(){
		$id = $_POST['id'];
		$data = $this->users_model->getuser($id);
		echo json_encode($data);
	}

	public function update(){
		$id = $_POST['id'];		
		$user['first_name'] = $_POST['first_name'];
		$user['last_name'] = $_POST['last_name'];
		$user['position'] = $_POST['position'];

		$query = $this->users_model->updateuser($user, $id);
	}

	public function delete(){
		$id = $_POST['id'];
		$query = $this->users_model->delete($id);
	}

}
