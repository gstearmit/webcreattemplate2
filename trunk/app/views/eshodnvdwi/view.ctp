<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
?>

  <div class="container margintop20">
  <div class="row clearfix">
    <!-- menu -->
    <?php echo $this->element('themeshop\creativemarket\left')?>
    <div class="col-md-9 column">
      <ol class="breadcrumb">
        <li><a src="<?php echo DOMAIN.$shopname ?>"><i class="glyphicon glyphicon-home"></i></a></li>
        <li><a src="<?php echo DOMAIN ?>">Category</a></li>
        <li><a src="<?php echo DOMAIN.$shopname ?>/view/">Product</a></li>
      </ol>
      <div class="col-md-12 column productboxmain">
        <div class="row clearfix">
          <div class="col-md-8 column"> 
          <a src="<?php echo DOMAIN ?>creativemarket/img/product1w.jpg" data-toggle="lightbox" data-title="Product Image">
            <?php if($views['Estore_products']['images']!=''){?> <img src="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images'];?>"  class="img-responsive" alt="Alt Text"><?php }?>
            <?php if($views['Estore_products']['images']===''){?> <img src="<?php echo DOMAIN ?>creativemarket/img/product_noimg.jpg" class="img-responsive" alt="Alt Text"><?php }?>
          </a>
            <div class="col-md-2 column productboxthumb"> <a src="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images'];?>" data-toggle="lightbox" data-title="Product Image"> <?php if($views['Estore_products']['images']!=''){?>  <img src="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images'];?>" class="img-responsive" alt="<?php echo $views['Estore_products']['title'];?>"/><?php }?></a> </div>
            <div class="col-md-2 column productboxthumb"> <a src="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images1'];?>" data-toggle="lightbox" data-title="Product Image"><?php if($views['Estore_products']['images1']!=''){?>  <img src="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images1'];?>" class="img-responsive" alt="<?php echo $views['Estore_products']['title'];?>"><?php }?></a> </div>
            <div class="col-md-2 column productboxthumb"> <a src="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images2'];?>" data-toggle="lightbox" data-title="Product Image"><?php if($views['Estore_products']['images2']!=''){?>  <img src="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images1'];?>" class="img-responsive" alt="<?php echo $views['Estore_products']['title'];?>"><?php }?></a> </div>
          </div>
          <?php //pr($views);?>
          <div class="col-md-4 column">
            <h1><?php echo $views['Estore_products']['title']; ?></h1>
            <?php echo $views['Estore_products']['content']; ?><br>
            <b>Rating:</b> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
            <div class="price">$ <?php echo $views['Estore_products']['price']; ?><span class="smallprice">was <span class="strike">$<?php echo $views['Estore_products']['price']; ?></span></span></div>
            <form role="form">
              <div class="form-group">
                <label >Select Size</label>
                <select class="form-control">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <a href="<?php echo DOMAIN?><?php echo $shopname ;?>/addshopingcart/<?php  echo $views['Estore_products']['id'];?>"  class="btn btn-danger"><span class="glyphicon glyphicon-shopping-cart"></span> ADD TO CART</a>
            </form>
            <ul class="fa-ul margintop10">
              <li><i class="fa-li fa fa-truck"></i>Free Delivery</li>
              <li><i class="fa-li fa fa-check-square"></i>Next day shipping</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-12 column productbox">
        <div class="row clearfix">
          <div class="col-md-12 column">
            <ul class="nav nav-tabs">
              <li class="active"><a src="<?php echo DOMAIN ?>creativemarket/# description" data-toggle="tab">Description</a></li>
              <li><a src="<?php echo DOMAIN ?>creativemarket/# specification" data-toggle="tab">Specification</a></li>
              <li><a src="<?php echo DOMAIN ?>creativemarket/# reviews" data-toggle="tab"><span class="glyphicon glyphicon-comment"></span> Reviews</a></li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane active" id="description">
                <div class="tabcontent"><?php echo $views['Estore_products']['content']; ?> <br>
                </div>
              </div>
              <div class="tab-pane" id="specification">
                <table class="table table-condensed table-hover">
                  <thead>
                    <tr>
                      <th>Key</th>
                      <th>This Product</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Length</td>
                      <td>3m</td>
                    </tr>
                    <tr>
                      <td>Width</td>
                      <td>5m</td>
                    </tr>
                    <tr>
                      <td>Height</td>
                      <td>1m</td>
                    </tr>
                    <tr>
                      <td>Weight</td>
                      <td>20Kg</td>
                    </tr>
                    <tr>
                      <td>Material</td>
                      <td>Leather</td>
                    </tr>
                
                   
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="reviews">
                <div class="panel widget">
                  <div class="panel-body">
                    <ul class="list-group">
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-xs-2 col-md-2"> <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                          <div class="col-xs-10 col-md-10">
                            <div> <a src="<?php echo DOMAIN ?>creativemarket/"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit</a>
                              <div class="mic-info"> By: <a src="<?php echo DOMAIN ?>creativemarket/# ">Jon Harding</a> on 19 Oct 2013 </div>
                            </div>
                            <div class="comment-text"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit </div>
                            <div class="action"> <b>Rating:</b> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-xs-2 col-md-2"> <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                          <div class="col-xs-10 col-md-10">
                            <div> <a src="<?php echo DOMAIN ?>creativemarket/#  ">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</a>
                              <div class="mic-info"> By: <a src="<?php echo DOMAIN ?>creativemarket/# ">Jon Harding</a> on 19 Oct 2013 </div>
                            </div>
                            <div class="comment-text"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                              euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim </div>
                            <div class="action"> <b>Rating:</b> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-xs-2 col-md-2"> <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                          <div class="col-xs-10 col-md-10">
                            <div> <a src="<?php echo DOMAIN ?>creativemarket/">Lorem ipsum dolor sit amet</a>
                              <div class="mic-info"> By: <a src="<?php echo DOMAIN ?>creativemarket/# ">Jon Harding</a> on 19 Oct 2013 </div>
                            </div>
                            <div class="comment-text"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                              euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim </div>
                            <div class="action"> <b>Rating:</b> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                    <a src="<?php echo DOMAIN ?>creativemarket/# " class="btn btn-primary btn-sm btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> More</a> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
