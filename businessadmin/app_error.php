<?php
class AppError extends ErrorHandler 
{
	
// 	function error404($params) 
// 	{
// 		// redirect to homepage
// 		//$this->controller->redirect('/');
// 	}
	
	function cannotWriteFile($params) {
		$this->controller->set('file', $params['file']);
		$this->_outputMessage('cannot_write_file');
	}
	
}
?>