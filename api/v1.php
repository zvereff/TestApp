<?php 

	// Content Type JSON
	header("Content-type: application/json");

	// Database connection
	$conn = new mysqli("mysql", "root", "tiger", "docker");
	if ($conn->connect_error) {
		die("Database connection failed!");
	}
	$res = array('error' => false);


	// Read data from database
	$action = 'read';

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	}

	if ($action == 'read') {
		$result = $conn->query("SELECT * FROM `users`");
		$users  = array();

		while ($row = $result->fetch_assoc()) {
			array_push($users, $row);
		}
		$res['users'] = $users;
	}

	// Read bill history from database
	if ($action == 'readhist') {
		$result = $conn->query("SELECT * FROM `bill`");
		$bill = array();

		while ($row = $result->fetch_assoc()) {
			array_push($bill, $row);
		}
		$res['bill'] = $bill;
	}


	// Insert data into database
	if ($action == 'create') {
		$fio = $_POST['fio'];
		//$datecreate    = $_POST['datecreate'];
		$datecreate = date("Y-m-d H:i:s"); // Mysql date format
		$type   = $_POST['type'];

		$result = $conn->query("INSERT INTO `users` (`fio`, `datecreate`, `type`) VALUES('$fio', '$datecreate', '$type')");

		if ($result) {
			$res['message'] = "Запись успешно добавлена!";
		} else {
			$res['error']   = true;
			$res['message'] = "Ошибка добавления!";
		}
	}


	// Update data

	if ($action == 'update') {
		$id       = $_POST['id'];
		$fio = $_POST['fio'];
		$datecreate    = $_POST['datecreate'];
		$type   = $_POST['type'];


		$result = $conn->query("UPDATE `users` SET `fio`='$fio', `datecreate`='$datecreate', `type`='$type' WHERE `id`='$id'");

		if ($result) {
			$res['message'] = "Запись успешно обновлена!";
		} else {
			$res['error']   = true;
			$res['message'] = "Ошибка обновления записи!";
 		}
	}


	// Delete data

	if ($action == 'delete') {
		$id       = $_POST['id'];
		$fio = $_POST['fio'];
		$datecreate    = $_POST['datecreate'];
		$type   = $_POST['type'];

		$result = $conn->query("DELETE FROM `users` WHERE `id`='$id'");

		if ($result) {
			$res['message'] = "Запись успешно удалена!";
		} else {
			$res['error']   = true;
			$res['message'] = "Ошибка удаления записи!";
		}
	}


	// Close database connection
	$conn->close();

	// print json encoded data
	echo json_encode($res);
	die();

?>
