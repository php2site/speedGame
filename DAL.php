<?php


// get connection to the database:
function dbConnect() {
	
	// פתיחת קו תקשורת עם מסד הנתונים
	// localhost = שם השרת
	// root = username
	// "" = password
	// factory = database name
	$con = mysqli_connect("localhost", "root", "", "game");
	
	// אם קיימת שגיאה - הפסקת זרימת התוכנית
	if(mysqli_connect_errno($con)) {
		die("Failed to connect to mySql: " . mysqli_connect_error());
	}
	
	// החזרת הקישור
	return $con;
}	

// perform insert / update / delete (dml):
function dml($sql) {
	
	// השגת הקישור למסד הנתונים:
	$con = dbConnect();
	
	// ביצוע הפקודה - הוספה או עדכון או מחיקה:
	mysqli_query($con, $sql);
	
	// קבלת המספר האוטומטי שהתווסף למסד הנתונים במקרה של הוספה
	$id = mysqli_insert_id($con);
	
	// סגירת הקישור
	mysqli_close($con);
	
	// החזרת הקוד שהתווסף:
	return $id;
}

// selecting data from the database:
function select($sql) {

	// השגת הקישור למסד הנתונים:
	$con = dbConnect();
	
	// החזרת כל הטבלה ממסד הנתונים:
	$table = mysqli_query($con, $sql);
	
	// הגדרת מערך לשמירת המידע:
	$arr = array();
	
	// הפיכת כל שורה בטבלה לאובייקט והוספת האובייקט למערך:
	while($obj = mysqli_fetch_object($table)) { // והלולאה תפסיק null אם אין יותר שורות להביא, יוחזר
		$arr[] = $obj; // הוספת האובייקט למערך
	}
	
	// סגירת הקישור
	mysqli_close($con);

	// החזרת המערך עם כל האובייקטים:
	return $arr;
}