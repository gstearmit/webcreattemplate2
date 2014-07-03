<?php
class AppError extends ErrorHandler 
{
// 	function missingController ( $params )
// 	{
// 		extract ( $params , EXTR_OVERWRITE );
	
// 		$this -> controller -> redirect ( '/' );
// 	}
	
// 	function error404($params) {
// 		$this->controller->redirect(array('controller'=>'introflash', 'action'=>'index'));
// 		parent::error404($params);
// 	}
	
	function error404($params) 
	{
		// redirect to homepage
		$this->controller->redirect('/');
	}
	
	function cannotWriteFile($params) {
		$this->controller->set('file', $params['file']);
		$this->_outputMessage('cannot_write_file');
	}
	
}
?>