<div class="container margintop20">
  <div class="row clearfix">
    <!-- menu -->
    <?php echo $this->element('themeshop\creativemarket\left')?>
    <div class="col-md-9 column">
      <ol class="breadcrumb">
        <li><a href="index.html"><i class="glyphicon glyphicon-home"></i></a></li>
        <li><a href="categories.html">Category</a></li>
       <li><a href="#">Product Listing</a></li>
      </ol>
      <div class="well well-sm">
        <div class="pull-right">
          <form class="form-inline" role="form">
            <div class="form-group">
              <select class="form-control">
                <option>--- sort ---</option>
                <!-- 
                <option>Price: Ascending</option>
                <option>Price: Descending</option>
                <option>Rating: Ascending</option>
                <option>Rating: Descending</option>
                 -->
              </select>
            </div>
          </form>
        </div>
        <strong>Category View</strong>
        <div class="btn-group"> 
        <!--  
        <a href="productlist-long.html" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"> </span> List</a> 
        <a href="productlist.html" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span> Grid</a>
          -->
         </div>
      
      </div>
      
     
       <?php foreach($products as $pr){?>
      
      <div class="col-md-4 column productbox"> 
        <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>" title="<?php echo $pr['Estore_products']['title']?>">
            <?php if($pr['Estore_products']['images'] !='') {?> <img style="width: 265px; height:320px;" class="img-responsive" alt="Product Image" src="<?php echo DOMAINADESTORE.$pr['Estore_products']['images']?>" alt="<?php echo $pr['Estore_products']['title']?>" /><?php }?>
            <?php if($pr['Estore_products']['images'] =='') {?> <img style="width: 265px; height:320px;" class="img-responsive" alt="Product Image" src="<?php echo DOMAIN ?>creativemarket/img/product_noimg.jpg" alt="<?php echo $pr['Estore_products']['title']?>" /><?php }?>
            
	   </a>   
        <div class="producttitle"><?php echo $pr['Estore_products']['title']?></div> 
        <div class="action"> <b>Rating:</b> <i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> </div>
        <div class="productprice">
          <div class="pull-right" >
	          <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>" class="btn btn btn-sm wishlist" role="button" data-toggle="tooltip" data-original-title="Add to Wishlist"><span class="glyphicon glyphicon-heart"></span></a>
	          <a href="<?php echo DOMAIN?><?php echo $shopname ;?>/addshopingcart/<?php  echo $pr['Estore_products']['id'];?>" class="btn btn-danger btn-sm" role="button" >
	          <span class="glyphicon glyphicon-shopping-cart"></span> BUY</a>
          </div>
          <div class="pricetext">$<?php echo $pr['Estore_products']['price']?></div>
        </div>
      </div>
	  <?php }?> 
	  
	 
      <div class="col-md-12 column ">
        <ul class="pagination">
         <?php if($paginator->numbers()!=null){?>
          <li><a href="#">&laquo;</a></li>
          <li><a href="#"> <?php $paginator->options(array('url' => $this->passedArgs)); echo $paginator->numbers(); ?></a></li>
          <li><a href="#">&raquo;</a></li>
          <?php }?> 
        </ul>
      </div>
    </div>
  </div>
</div>
