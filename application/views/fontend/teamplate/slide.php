<div class="slideshow">
	<div class="container">
		<div class="row">
			<div class="col-md-3">

			</div>

			<div class="col-md-9 ">
				<script src="<?php echo public_url() ?>/app/services/moduleServices.js"></script>
				<script src="<?php echo public_url() ?>/app/controllers/moduleController.js"></script>
				<!--Begin-->
				<link href="<?php echo public_url() ?>/Scripts/flexSlider/flexslider.css" rel="stylesheet" type="text/css" />
				<script src="<?php echo public_url() ?>/Scripts/flexSlider/jquery.flexslider-min.js" type="text/javascript"></script>
				<div class="flexslider slideshow-content" id="bannerheaderhome" ng-controller="moduleController" ng-init="initSlideshowController('Slideshows')">
					<ul class="slides">
						<li ng-repeat="item in Slideshows">
							<a title="{{item.Name}}" href="{{item.Link}}">
								<img alt="{{item.Name}}" src="{{item.Image}}" />
							</a>
						</li>
					</ul>
				</div>
				<script type="text/javascript">
					$(document).ready(function () {
						$('#bannerheaderhome').flexslider({
							directionNav: true,
							controlNav: false,
							animation: "slide",
							itemHeigh: 250,
							itemMargin: 0,
							animationSpeed: 700,
							slideshowSpeed: 3000
						});
					});
				</script>
				<!--End-->
				<script type="text/javascript">
					window.Slideshows = [
						<?php foreach($slide as $val): ?>

						{"Id":714,"ShopId":151,"Name":"<?php echo $val->name ?>","Image":"<?php echo base_url(); ?>upload/shop151/images/slider/<?php echo $val->image_link ?>","Link":"<?php echo $val->link ?>","Index":2,"Inactive":false,"Timestamp":"AAAAAAASXH4="},
						<?php endforeach;?>
					];
				</script>

			</div>
		</div>
	</div>
</div>
