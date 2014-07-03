<?php
class CommentController extends AppController {

	var $name = 'Comment';
	var $uses=array('Category','Categoryshop','News','Setting','Slideshow','Partner','Catproduct','Product','Tem','Productshop','Helps','Gallery','Video','City','Classifiedss','Shop','Newshop','Banner','Background','Userscm','Order');
	
	function tintucnoibat(){
		mysql_query("SET names utf8");
		return $this->News->find('all',array('conditions'=>array('News.status'=>1,'News.category_id'=>201),'order'=>'News.id DESC','limit'=>5));
	}
	function showroom(){
		return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>4));
	}
	//tin tuc
	function advleft(){
		return $this->Gallery->find('all',array('order'=>'Gallery.id DESC'));
	}
	function advright(){
		return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1,'Gallery.display'=>2),'order'=>'Gallery.id DESC','limit'=>1));
	}
	function catproduct(){
		mysql_query("SET names utf8");
		return $this->Catproduct->find('all',array('conditions'=>array('Catproduct.status'=>1),'order'=>'Catproduct.char ASC'));
	}
	function submenuproduct($id=null){
		return $this->Catproduct-> find('all',array('conditions'=>array('Catproduct.parent_id '=>$id),'order'=>'Catproduct.id DESC'));
	}
	
	function sanphammoi(){
		mysql_query("SET names utf8");
		return $this->Product->find('all',array('conditions'=>array('Product.status'=>1,'Product.newsproduct'=>'1'),'order'=>'Product.id DESC','limit'=>10));
	}
	
	
	function phongmau(){
		mysql_query("SET names utf8");
		return $this->Catproduct->find('all',array('conditions'=>array('Catproduct.status'=>1,'Catproduct.parent_id'=>'8'),'order'=>'Catproduct.char DESC'));
	}
function binhchon(){
		mysql_query("SET names utf8");
			return $this->Poll->find('all',array('conditions'=>array('Poll.status'=>1),'order'=>'Poll.id DESC'));	
		//return $this->Categorypro->find('all');
	}
	
	function banner(){
		return $this->Banner->find('all',array('conditions'=>array('Banner.status'=>1),'order'=>'Banner.id DESC'));
	}
	
	function setting(){
		return $this->Setting->find('all',array('conditions'=>array(),'order'=>'Setting.id DESC'));
	}
	function adv(){
		//return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
		return $this->Banner->find('all',array('conditions'=>array('Banner.status'=>1),'order'=>'Banner.id DESC','limit'=>2));
	}
	
	function linkwebsite(){
		//return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
		return $this->Advertisement->find('all',array('conditions'=>array('Advertisement.status'=>1),'order'=>'Advertisement.id DESC'));
	}
	
	function doitac(){
		//return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
		return $this->Partner->find('all',array('conditions'=>array('Partner.status'=>1),'order'=>'Partner.id DESC'));
	}
	
	//cong trinh
	function vanbanphapluat(){
		mysql_query("SET names utf8");
		return $this->Category->find('all',array('conditions'=>array('Category.status'=>1,'Category.parent_id'=>'196'),'order'=>'Category.tt DESC'));
	}
	
	
	function menu_active(){
		return $this->Category2->find('all',array('conditions'=>array('Category2.parent_id'=>145),'order'=>'Category2.id ASC'));
	}
	function helpsonline(){
	
	return $this->Helps->find('all',array('conditions'=>array('Helps.status'=>1),'order'=>'Helps.id DESC','limit'=>2));
	}
	function id_product($catproduct_id){
	return $this->Product->read(null,$catproduct_id);
	//pr($this->Product->read(null,$id));die;
	}
	function manshoes(){
		mysql_query("SET names utf8");
			return $this->Category->find('all',array('conditions'=>array('Category.status'=>1,'Category.parent_id'=>'143'),'order'=>'Category.id ASC'));	
		//	pr($this->Category->find('all',array('conditions'=>array('Category.status'=>1,'Category.parent_id'=>'143'),'order'=>'Category.id ASC')));die;
	}
	function mensandals (){
		mysql_query("SET names utf8");
			return $this->Category->find('all',array('conditions'=>array('Category.status'=>1,'Category.parent_id'=>'142'),'order'=>'Category.id ASC'));	
	}
	function getinfo($cat=null){
	return $this->News->find('all',array('conditions'=>array('News.status'=>1,'News.category_id'=>$cat),'order'=>'News.id DESC','limit'=>3));	
	}
	function news_codong($cat=null){
	return $this->News->find('all',array('conditions'=>array('News.status'=>1,'News.category_id'=>$cat),'order'=>'News.id DESC','limit'=>10));	
	}
	
	function videos(){
		mysql_query("SET names utf8");
		return $this->Video->find('all',array('conditions'=>array('Video.status'=>1),'order'=>'Video.id DESC','limit'=>1));
	}
	
	function slideshow(){
		mysql_query("SET names utf8");
		return $this->Slideshow->find('all',array('conditions'=>array('Slideshow.status'=>1),'order'=>'Slideshow.id DESC'));
	}
	
	function about(){
		return $this->About->find('all',array('conditions'=>array('About.status'=>'1'),'order' => 'About.char ASC'));
		
		
	}
	
	
	
	function tinmoi(){
		mysql_query("SET names utf8");
		return $this->News->find('all',array('order'=>'News.id DESC','limit'=>3));
		
		
	}
	
	function category(){
		mysql_query("SET names utf8");
		return $this->Category->find('all',array('order'=>'Category.tt ASC'));
		
	}
	
	function product($catproduct_id=null){
		
		mysql_query("SET names utf8");
		$this->paginate = array('conditions'=>array('Product.catproduct_id'=>$catproduct_id,'Product.status'=>1),'limit' => 2,'order' => 'Product.created DESC');
		return $this->paginate('Product',array());
	}
	
	
	
	function get_name_catproduct($id){
		
		return  $this->Catproduct->find('all',array('conditions'=>array('Catproduct.id'=>$id, 'Catproduct.status'=>1)));
		
	}
	
	
	function gallery($id){
	
		return  $this->Gallery->find('all',array('conditions'=>array('Gallery.product_id'=>$id, 'Gallery.status'=>1)));
	
	}
	
	function city($id=null)
	{
		return  $this->City->find('all',array('conditions'=>array('City.status'=>1,'City.id'=>$id),'order'=>'City.char ASC'));
		
		
	}
	
	function city2($id=null)
	{
		return  $this->City->find('all',array('conditions'=>array('City.status'=>1,'City.id <>'=>$id),'order'=>'City.char ASC'));
	
	
	}
	function sp_conban()
	{
	return $this->Product->find('all', array('conditions'=>array('Product.conlai > 0'),'limit'=>4,'order' => 'Product.created DESC'));
	}
	
	function categorygianhang($id=null){
		mysql_query("SET names utf8");
		return $this->Categoryshop->find('all',array('conditions'=>array('Categoryshop.status'=>1, 'Categoryshop.parent_id'=>NULL,'Categoryshop.shop_id'=>$id),'order'=>'Categoryshop.order ASC'));
	}
	
	 function categorygianhang1(){
		mysql_query("SET names utf8");
		return $this->Categoryshop->find('all',array('conditions'=>array('Categoryshop.status'=>1, 'Categoryshop.parent_id'=>NULL),'order'=>'Categoryshop.id ASC'));
	}
    
    function categorygianhangchild1($id=null){
		mysql_query("SET names utf8");
		return $this->Categoryshop->find('all',array('conditions'=>array('Categoryshop.status'=>1, 'Categoryshop.parent_id'=>$id),'order'=>'Categoryshop.id ASC'));
	}
	
	
	function categorygianhangchild($id=null){
		mysql_query("SET names utf8");
	
		return $this->Categoryshop->find('all',array('conditions'=>array('Categoryshop.status'=>1, 'Categoryshop.parent_id'=>$id),'order'=>'Categoryshop.order ASC'));
	}
	//--------------------------------
	function cities(){
		mysql_query("SET names utf8");
		return $this->Cities->find('all',array('conditions'=>array('Cities.status'=>1),'order'=>'Cities.id ASC'));
	}
	function categoryproductchildfull(){
		mysql_query("SET names utf8");
		
		
		return $this->Catproduct->find('all',array('conditions'=>array('Catproduct.status'=>1, 'Catproduct.parent_id' > 1),'order'=>'Catproduct.id ASC'));
	}
	function classifiedss($id=null){
		mysql_query("SET names utf8");
		return $this->Classifiedss->find('all',array('conditions'=>array('Classifiedss.status'=>1, 'Classifiedss.scop_id' => $id),'order'=>'Classifiedss.id ASC'));
	}
	
	function newsraovat_userid(){
		mysql_query("SET names utf8");
		
		$user = $this->Session->read('id');
		
		return $this->Classifiedss->find('all',array('conditions'=>array('Classifiedss.status'=>1,'Classifiedss.user_id' =>$user),'order'=>'Classifiedss.id ASC'));
	}
	
	function newsraovatother(){
		mysql_query("SET names utf8");
		return $this->Classifiedss->find('all',array('conditions'=>array('Classifiedss.status'=>1),'limit'=>6,'order'=>'Classifiedss.id ASC'));
	}
	
	function shops(){
		 $user = $this->Session->read('id');
		return $this->Shop->find('all',array('conditions'=>array('Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
	}
	
	function categoryshop(){

		return $this->Categoryshop->find('all',array('conditions'=>array('Categoryshop.status'=>1,'Categoryshop.parent_id'=>null),'order'=>'Categoryshop.order ASC'));
	}
	
	function categoryshop_child($parent_id=null){

		return $this->Categoryshop->find('all',array('conditions'=>array('Categoryshop.parent_id'=>$parent_id,'Categoryshop.status'=>1),'order'=>'Categoryshop.order ASC'));
	}
	
	
	
		function productshop($id=null){

		return $this->Productshop->find('all',array('conditions'=>array('Productshop.categoryshop_id'=>$id),'order'=>'Productshop.id DESC'));
	}
	
	function tinkhuyenmai($shop_id=null){
	
		if ($shop_id==null)
	return $this->Newshop->find('all',array('conditions'=>array('Newshop.categorynewsshop_id'=>220,'Newshop.status'=>1),'order'=>'Newshop.created DESC'));

		return $this->Newshop->find('all',array('conditions'=>array('Newshop.shop_id'=>$shop_id,'Newshop.categorynewsshop_id'=>220,'Newshop.status'=>1),'order'=>'Newshop.created DESC'));
	}
	
	 function getnameproduct($id=null){
		mysql_query("SET names utf8");
		return $this->Catproduct->find('all',array('conditions'=>array('Catproduct.status'=>1, 'Catproduct.id'=>$id),'order'=>'Catproduct.id ASC'));
	} 
	
	 function categoryproduct(){
		mysql_query("SET names utf8");
		return $this->Catproduct->find('all',array('conditions'=>array('Catproduct.status'=>1, 'Catproduct.parent_id'=>NULL),'order'=>'Catproduct.id ASC'));
	}
    
    function categoryproductchild($id=null){
		mysql_query("SET names utf8");
		return $this->Catproduct->find('all',array('conditions'=>array('Catproduct.status'=>1, 'Catproduct.parent_id'=>$id),'order'=>'Catproduct.id ASC'));
	}
	function get_shop_id($name){
		return $this->Shop->find('list',array('conditions'=>array('Shop.name'=>$name,'Shop.status'=>1),'fields'=>array('id','created')));
	}
	
	function raovat($shop_id=null){

	if($shop_id==null)
		return $this->Newshop->find('all',array('conditions'=>array('Newshop.categorynewsshop_id'=>221,'Newshop.status'=>1), 'order'=>'Newshop.id DESC'));
	
		return $this->Newshop->find('all',array('conditions'=>array('Newshop.shop_id'=>$shop_id,'Newshop.categorynewsshop_id'=>221,'Newshop.status'=>1),'limit'=>3, 'order'=>'Newshop.id DESC'));
	
	}
	
	function get_user_id($shop_id)
	{
	return $this->Shop->find('all',array('conditions'=>array('Shop.id'=>$shop_id,'Shop.status'=>1)));
	
	}
	
  function get_banner($user_id=null)
    {
	return $this->Banner->find('all',array('conditions'=>array('Banner.user_id'=>$user_id),'limit'=>1,'order'=>'Banner.id DESC'));
	}
	
	function get_tem($user_id=null){
	return $this->Tem->find('all',array('conditions'=>array('Tem.user_id'=>$user_id),'limit'=>1));
	
	}
	
	function gianhang_nb()
	{
	return $this->Shop->find('all',array('conditions'=>array('Shop.loai'=>1),'order'=>'Shop.created DESC'));
	
	}
	
	function sp_gianhang_nb($shop_id=null){
	
	return $this->Productshop->find('all',array('conditions'=>array('Productshop.shop_id'=>$shop_id),'limit'=>1,'order'=>'Productshop.created'));
	
	}
	
	function kt_shop($id=null){
	
	$this->Shop->find('all',array('conditions'=>array('Shop.id'=>$id,'Shop.status'=>1,'Shop.loai'=>1,),'limit'=>1));
	return $this->Shop->getNumrows();
	}
	
	function get_name_shop($id=null){
	
	return $this->Shop->find('list',array('conditions'=>array('Shop.id'=>$id,'Shop.status'=>1),'limit'=>1,'fields'=>array('name')));
	
	}
	
	function get_shop_theo_ten($name)
	{
		return $this->Shop->find('all',array('conditions'=>array('Shop.name'=>$name,'Shop.status'=>1)));

	}
	function gianhangnoibat()
	{
			return $this->Shop->find('all',array('conditions'=>array('Shop.loai'=>1,'Shop.status'=>1),'limit'=>10));

	}
	
	function get_product( $id=null)
	{
	return $this->Product->findById($id);
	}
	function get_user($name=null)
	{
	return $this->Userscm->findByShopname($name);
	}
	
	
	function giohang($name=null)
	{
	return count($this->Order->find('all',array('conditions'=>array('Order.nameuser'=>$name))));
	}
	
	function check_shop($user){
	 //pr($this->Shop->findByUser_id($user)); die;
	 $a=$this->Shop->find('all',array('conditions'=>array('Shop.user_id'=>$user)));
		if(count($a)==0) 
		return 0;
		return 1;
	}
	
}

?>
