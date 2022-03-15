<?php  
class ViewModel{
	protected function getModel($model) {
		require_once('./MVC/Models/'.$model.'.php');
		return new $model;
	}
	protected function loadView($controller,$action,$model=[],$type=0){
		$link = './MVC/Views/';
		if ($type == 1){
			$link = './MVC/Admin/Views/';
		}
		if (file_exists($link.$controller.'/'.$action.'.php')) {
			require_once($link.$controller.'/'.$action.'.php');
		}
		else {
			require_once($link.'Shared/404.php');
		}
	}
}
?>