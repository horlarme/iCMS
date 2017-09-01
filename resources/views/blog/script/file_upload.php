<?php
/**
---------------------------------------------
----Script Name
-File Upload
----Author
-Lawal OLadipupo lawboi4love@gmail.com
----Description
-This script uploads any file type to the website directory
----Version
-1.0
----Features
-Save files based on their upload month and year
-save files with their upload name
-Allow user to set the min and max upload limit
---------------------------------------------
*/

function uploadFile($filename,$min,$max){

	//Variables to be used by this script
	//defined as a constant (cannot be re-edit)
	define('FILENAME', basename($filename["name"])); //The name of the file to be uploaded
	define('FILEUPLOAD_TEMP', $filename['tmp_name']); //Temporary file name
	define('FILEUPLOADLIMIT_MIN', $min); //The minimum file upload limit
	define('FILEUPLOADLIMIT_MAX', $max); //The maximum file upload limit
	define('FILEUPLOADDATE_YEAR', "20" . date("y")); //Year which file is being uploaded, this will be used when storing the file to its right folder
	define('FILEUPLOADDATE_MONTH', date("M")); //Month which file is being uploaded
	define('FILEUPLOAD_FOLDER', "uploads/" . FILEUPLOADDATE_YEAR . "/" . FILEUPLOADDATE_MONTH . "/"); //Folder where the file will be uploaded to
	define('FILEUPLOAD_SIZE', ($filename['size'] * 1000)); //Getting the size of the uploading file

}

function typeChecker($filename){
	//This function is used to check the type of the file and return it's extension
	$filename = pathinfo($filename, PATHINFO_EXTENSION);

	switch ($filename) {
		case 'jpg':
			$type = 'image';
			break;
		
		case 'png':
			$type = 'image';
			break;
		
		case 'jpeg':
			$type = 'image';
			break;
		
		case 'pdf':
			$type = 'Adobe Acrobat Document';
			break;
		
		case 'doc' || 'docx':
			$type = 'Microsoft Word Document';
			break;
		
		case 'ppt' || 'pptx':
			$type = 'Microsoft Power Point Document';
			break;
		
		case 'jpg':
			$type = 'image';
			break;
		
		default:
			# code...
			break;
	}
}

?>