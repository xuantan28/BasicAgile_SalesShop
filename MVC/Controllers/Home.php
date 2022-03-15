<?php  
class Home extends ViewModel{
	public $product;
	function __construct(){
		$this->product = $this->getModel('ProductDAL');
	}
	public function Index(){
		$listHotJSON = json_decode($this->product->getTopHot(8),true);
		$listNewJSON = json_decode($this->product->getTopNew(8),true);
		$listViewJSON = json_decode($this->product->getTopView(8),true);
		$this->loadView('Shared','Layout',[
			'title'=>'Home',
			'page'=>'Home/Index',
			'listHot'=>$listHotJSON,
			'listNew'=>$listNewJSON,
			'listView'=>$listViewJSON
		]);
	}
	public function Searching(){
		$productSearchingJSON = '';
		if (isset($_POST['searchProduct'])){
			if (isset($_POST['advancedCheck'])){
				$cate = $_POST['selectBox']=='All'?0:($_POST['selectBox']=='Mobiles'?1:($_POST['selectBox']=='Tablets'?2:($_POST['selectBox']=='Cameras'?3:4)));
				$priceFrom = str_replace('0.', '0', $_POST['priceFrom']);
				$priceTo = str_replace('0.', '0', $_POST['priceTo']);
				$productSearchingJSON = json_decode($this->product->advancedSearch($_POST['searchName'],$cate,$priceFrom,$priceTo),true);
			}
			else{
				$productSearchingJSON = json_decode($this->product->basicSearch($_POST['searchName']),true);
			}
		}
		$this->loadView('Shared','Layout',[
			'title'=>'Search',
			'page'=>'Home/Searching',
			'listSearch'=>$productSearchingJSON
		]);
	}
}
?>