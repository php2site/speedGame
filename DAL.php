<?php


// get connection to the database:
function dbConnect() {
	
	// ����� �� ������ �� ��� �������
	// localhost = �� ����
	// root = username
	// "" = password
	// factory = database name
	$con = mysqli_connect("localhost", "root", "", "game");
	
	// �� ����� ����� - ����� ����� �������
	if(mysqli_connect_errno($con)) {
		die("Failed to connect to mySql: " . mysqli_connect_error());
	}
	
	// ����� ������
	return $con;
}	

// perform insert / update / delete (dml):
function dml($sql) {
	
	// ���� ������ ���� �������:
	$con = dbConnect();
	
	// ����� ������ - ����� �� ����� �� �����:
	mysqli_query($con, $sql);
	
	// ���� ����� �������� ������� ���� ������� ����� �� �����
	$id = mysqli_insert_id($con);
	
	// ����� ������
	mysqli_close($con);
	
	// ����� ���� �������:
	return $id;
}

// selecting data from the database:
function select($sql) {

	// ���� ������ ���� �������:
	$con = dbConnect();
	
	// ����� �� ����� ���� �������:
	$table = mysqli_query($con, $sql);
	
	// ����� ���� ������ �����:
	$arr = array();
	
	// ����� �� ���� ����� �������� ������ �������� �����:
	while($obj = mysqli_fetch_object($table)) { // ������� ����� null �� ��� ���� ����� �����, �����
		$arr[] = $obj; // ����� �������� �����
	}
	
	// ����� ������
	mysqli_close($con);

	// ����� ����� �� �� ����������:
	return $arr;
}