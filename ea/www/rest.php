<?php
die;
/**
 * Write data to log file.
 *
 * @param mixed $data
 * @param string $title
 *
 * @return bool
 */
function writeToLog($data, $title = '') {
 $log = "\n------------------------\n";
 $log .= date("Y.m.d G:i:s") . "\n";
 $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
 $log .= print_r($data, 1);
 $log .= "\n------------------------\n";
 file_put_contents(getcwd() . '/hook.log', $log, FILE_APPEND);
 return true;
}

//$defaults = array('first_name' => '', 'last_name' => '', 'phone' => '', 'email' => '');

//if (array_key_exists('saved', $_REQUEST)) {
 //$defaults = $_REQUEST;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
	 writeToLog($_POST, 'webform');

	 $email = '';

	 $queryUrl = 'https://b24-fe6j1a.bitrix24.ua/rest/5/4qd2oan5zeh89oq7/crm.lead.add.json';
	 $queryData = http_build_query(array(
		 'fields' => array(
			 "TITLE" => 'contactform ' . $_POST['email'], 
			 "EMAIL" => array(array("VALUE" => $_POST['email'], "VALUE_TYPE" => "WORK" )),
			 'COMMENTS' => $_POST['message']
		    )
		 ));

	 $curl = curl_init();
	 curl_setopt_array($curl, array(
	 CURLOPT_SSL_VERIFYPEER => 0,
	 CURLOPT_POST => 1,
	 CURLOPT_HEADER => 0,
	 CURLOPT_RETURNTRANSFER => 1,
	 CURLOPT_URL => $queryUrl,
	 CURLOPT_POSTFIELDS => $queryData,
	 ));

	 $result = curl_exec($curl);
	 curl_close($curl);

	 $result = json_decode($result, 1);
	 writeToLog($result, 'webform result');

	 if (array_key_exists('error', $result)) echo "Ошибка при сохранении лида: ".$result['error_description']."<br/>";
}
//}

?>