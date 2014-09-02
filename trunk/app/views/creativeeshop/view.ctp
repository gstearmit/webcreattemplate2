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
    <div class="col-md-3 column">
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a src="<?php echo DOMAIN ?>creativemarket/categories.html"><span class="glyphicon glyphicon-chevron-right"></span> Home</a></li>
        <li><a src="<?php echo DOMAIN ?>creativemarket/categories.html"><span class="glyphicon glyphicon-chevron-right"></span> Catergory 1</a></li>
        <li><a src="<?php echo DOMAIN ?>creativemarket/categories.html" class="active2"><span class="glyphicon glyphicon-chevron-right"></span> Catergory 2</a></li>
        <li><a src="<?php echo DOMAIN ?>creativemarket/categories.html"><span class="glyphicon glyphicon-chevron-right"></span> Catergory 3</a></li>
		
		<li class="submenu"><a src="<?php echo DOMAIN ?>creativemarket/categories.html"><span class="glyphicon glyphicon-plus"></span> Sub Catergory </a><a src="<?php echo DOMAIN ?>creativemarket/categories.html"><span class="glyphicon glyphicon-plus"></span> Sub Catergory </a><a src="<?php echo DOMAIN ?>creativemarket/categories.html"><span class="glyphicon glyphicon-plus"></span> Sub Catergory</a></li>
        <li><a src="<?php echo DOMAIN ?>creativemarket/categories.html"><span class="glyphicon glyphicon-chevron-right"></span> Catergory 4</a></li>
        <li><a src="<?php echo DOMAIN ?>creativemarket/categories.html"><span class="glyphicon glyphicon-chevron-right"></span> Catergory 5</a> </li>
      </ul>
    
	  
	
									<div class="feature">	
										<img src="<?php echo DOMAIN ?>creativemarket/img/world.png" class="img-responsive" alt="" />
										<h4>WORLDWIDE <strong>DELIVERY</strong></h4>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>									
									</div><div class="feature">	
										<img src="<?php echo DOMAIN ?>creativemarket/img/fast.png" class="img-responsive" alt="" />
										<h4>FAST <strong>SERVICE</strong></h4>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>									
									</div>
							
	   </div>
    <div class="col-md-9 column">
      <ol class="breadcrumb">
        <li><a src="<?php echo DOMAIN.$shopname ?>"><i class="glyphicon glyphicon-home"></i></a></li>
        <li><a src="<?php echo DOMAIN ?>">Category</a></li>
        <li><a src="<?php echo DOMAIN.$shopname ?>/view/">Product</a></li>
      </ol>
      <div class="col-md-12 column productboxmain">
        <div class="row clearfix">
          <div class="col-md-8 column"> <a src="<?php echo DOMAIN ?>creativemarket/img/product1w.jpg" data-toggle="lightbox" data-title="Product Image"><img src="<?php echo DOMAIN ?>creativemarket/img/product1w.jpg" class="img-responsive" alt="Alt Text"></a>
            <div class="col-md-2 column productboxthumb"> <a src="<?php echo DOMAIN ?>creativemarket/img/product1.jpg" data-toggle="lightbox" data-title="Product Image"><img src="<?php echo DOMAIN ?>creativemarket/img/product1.jpg" class="img-responsive" alt="Alt Text"></a> </div>
            <div class="col-md-2 column productboxthumb"> <a src="<?php echo DOMAIN ?>creativemarket/img/product2.jpg" data-toggle="lightbox" data-title="Product Image"><img src="<?php echo DOMAIN ?>creativemarket/img/product2.jpg" class="img-responsive" alt="Alt Text"></a> </div>
            <div class="col-md-2 column productboxthumb"> <a src="<?php echo DOMAIN ?>creativemarket/img/product3.jpg" data-toggle="lightbox" data-title="Product Image"><img src="<?php echo DOMAIN ?>creativemarket/img/product3.jpg" class="img-responsive" alt="Alt Text"></a> </div>
          </div>
          <div class="col-md-4 column">
            <h1>Product Name</h1>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br>
            <b>Rating:</b> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
            <div class="price">$104.72 <span class="smallprice">was <span class="strike">$200.00</span></span></div>
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
              <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-shopping-cart"></span> ADD TO BASKET</button>
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
                <div class="tabcontent">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sagittis volutpat eros eu faucibus. Curabitur facilisis, ante id consectetur sodales, tortor erat mollis ligula, vitae semper tortor diam id nulla. Aliquam sit amet odio congue, sagittis tortor eget, convallis nisi. Suspendisse in erat pharetra, posuere dolor non, congue metus. Nullam dapibus ligula nec sem condimentum, ac ultricies dio cursus. Proin imperdiet fermentum metus in elementum. Nam eu nisl sit amet diam lacinia fermentum eu ut nisl. Quisque ut dui sit amet dui fermentum rutrum. Quisque quis cursus orci. Duis interdum fermentum nisi, sit amet lobortis metus dictum in.<br>
                  <br>
                  Maecenas purus ipsum, scelerisque vel velit at, ullamcorper imperdiet tortor. Morbi orci libero, dapibus vel feugiat ultricies, accumsan sed lorem. Curabitur neque urna, congue in arcu luctus, gravida ultrices risus. Fusce vel mi lorem. Maecenas hendrerit, urna nec vehicula dictum, metus libero blandit velit, a dapibus tortor turpis eu quam. Fusce volutpat ac orci eu egestas. Mauris vel odio nec diam semper pretium eget id turpis.<br>
                  <br>
                  Fusce sollicitudin vehicula sapien, ut ullamcorper orci euismod eu. Mauris non nisi eu massa gravida vestibulum quis non libero. Vestibulum pellentesque lobortis lorem, at sagittis quam laoreet non. Integer sed velit tellus. Nunc a feugiat arcu, id consectetur ipsum. Vestibulum ut porttitor massa, quis placerat ligula. Donec euismod est sit amet eros auctor interdum. Vivamus faucibus, risus vitae sodales volutpat, metus nisl fringilla erat, vitae viverra libero sem eget elit.</div>
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
