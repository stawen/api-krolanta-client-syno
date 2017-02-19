<?php
/*****************************************************
* Projet : krolanta - Supervision chaudiere OeKofen
* Auteur : Stawen Dronek
* Utilisation commerciale interdite sans mon accord
******************************************************/

include_once 'config.php';

function isAjax() {
  //return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
  return true;
}

function isValid(){
  //return ( strcmp(session::getInstance()->getVar('sid'),$_GET['sid']) == 0 )?true:false;
  //return ( strcmp(TOKEN,getVar('token')) == 0 )?true:false;
  return true;
}

function getVar($var){
	return isset($_GET[$var])?$_GET[$var]:'';
}

function isExist($var){
	return isset($_GET[$var]);
}

if (isAjax() && isValid()) {

	$a = new syno();
	switch (getVar('action')){
		
		case 'addFile':
			$a->addFile( getVar('path') );
			break;
		case 'listDlFile':
			$a->listDlFile();
			break;
		case 'deleteFileQueue':
			$a->deleteFileQueue( getVar('id') );
			break;
		default:
			echo "Nothing here";
			
	}
	
}else{
    if(!isAjax()){
        echo '<pre>Xmlhttprequest needed ! </pre>';
    }
    if(!isValid()){
        header("Content-type: text/json; charset=utf-8");
		echo '{"response": false,"apiToken": "invalid"}';
    }
}

?>
