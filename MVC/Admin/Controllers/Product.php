<?php 
class Product extends ViewModel{
    public function __construct(){
        if (empty($_SESSION['USER_SESSION'])){
			header('Location:'.BASE_URL.'Login/Index');
		}
    }
    public function Index(){
        $product = $this->getModel('ProductDAL');
        $productCate = $this->getModel('ProductCategoryDAL');
        $listProductJSON = json_decode($product->getListProduct(),true);
        $listProductCateJSON = json_decode($productCate->getListCate(),true);
        $this->loadView('Shared','Layout',[
            'title'=>'Products',
            'page'=>'Product/Index',
            'listProduct'=>$listProductJSON,
            'listProductCate'=>$listProductCateJSON,
            'countUser'=>$_SESSION['COUNT_USERS_SESSION'],
			'countAdmin'=>$_SESSION['COUNT_ADMINS_SESSION'],
			'countProduct'=>$_SESSION['COUNT_PRODUCTS_SESSION'],
			'countContact'=>$_SESSION['COUNT_FEEDBACKS_SESSION'],
			'countUnRead'=>$_SESSION['COUNT_UNREADS_SESSION'],
            'listUnRead'=>$_SESSION['LIST_UNREADS_SESSION']
        ],1);
    }
    public function Categories(){
        $productCate = $this->getModel('ProductCategoryDAL');
        $listCateJSON = json_decode($productCate->getListCate(),true);
        $this->loadView('Shared','Layout',[
            'title'=>'Categories',
            'page'=>'Product/Categories',
            'listCate'=>$listCateJSON,
            'countUser'=>$_SESSION['COUNT_USERS_SESSION'],
			'countAdmin'=>$_SESSION['COUNT_ADMINS_SESSION'],
			'countProduct'=>$_SESSION['COUNT_PRODUCTS_SESSION'],
			'countContact'=>$_SESSION['COUNT_FEEDBACKS_SESSION'],
			'countUnRead'=>$_SESSION['COUNT_UNREADS_SESSION'],
            'listUnRead'=>$_SESSION['LIST_UNREADS_SESSION']
        ],1);
    }
}
?>