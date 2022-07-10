<?php /**
 * Template Name: product_a
 */
  ?>

<?php get_template_part( 'page-content/product/product.header' ); ?>

<section id="product">
	<div class="content">
		<div class="left-side__menu">			
			<!-- accordion -->
			<div class="accordion accordion-flush" id="leftMenuAccordion">
				<div class="accordion-item">
					<h2 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-category">
							カテゴリ
						</button>
					</h2>
					<div id="accordion-item-category" class="accordion-collapse collapse">
						<ul class="accordion-body">
							<?php 
								$term = "";
								if(isset($_GET["brand"]))	$term = $_GET["brand"];
								if(isset($_GET["category"])) $term = $_GET["category"];

								$orderByPrice = $_GET["orderByPrice"] ?? "";

								$orderByPriceASCQuery = http_build_query( array_merge( $_GET, array( 'orderByPrice' => 'ASC' ) ) );
								$orderByPriceDESCQuery = http_build_query( array_merge( $_GET, array( 'orderByPrice' => 'DESC' ) ) );
							?>
							<li>
								<a href="/lpb/item" class = <?php if($term === "") echo "active"; ?> >  
									ALL
								</a>
							</li>
							<?php 
								$categories = get_terms( [
									'taxonomy'     => "product_category",
									'order'        => 'ASC',
								] );
								foreach($categories as $cat){
							?>
								<li>
									<a href="<?php echo '?category='.$cat->slug; ?>" 
										class = "<?php if(strcmp($term, $cat->slug) == 0) echo "active"; ?>" >  
											<?php echo $cat->name ?> 
									</a>
								</li>
							<? } ?>
						</ul>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-brand">
							ブランド
						</button>
					</h2>
					<div id="accordion-item-brand" class="accordion-collapse collapse">
						<ul class="accordion-body">
							<?php 
								$brands = get_terms( [
									'taxonomy'     => "product_brand",
									'order'        => 'ASC',
								] );
								foreach($brands as $brand){
							?>
								<li>
									<a href="<?php echo '?brand='.$brand->slug; ?>" 
										class = "<?php if(strcmp($term, $brand->slug) == 0) echo "active"; ?>" >  
											<?php echo $brand->name ?> 
									</a>
								</li>
							<? } ?>
						</ul>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-order">
							金額順
						</button>
					</h2>
					<div id="accordion-item-order" class="accordion-collapse collapse show">
						<ul class="accordion-body d-flex">
							<li style="margin-right: 15px">
								<a 	href=<?php echo "?".$orderByPriceDESCQuery?>
									class=<?php if(strcmp($_GET['orderByPrice'], "DESC") == 0) echo 'active'; ?>
								>安い順
								</a>
							</li>
							<li>
								<a  href=<?php echo "?".$orderByPriceASCQuery?>
								 	class=<?php if(strcmp($_GET['orderByPrice'], "ASC") == 0) echo 'active'; ?>
								>高い順</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- end accordion -->
		</div>
		

		<?php
			if($term === ''){
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => -1,
					'order' => 'DESC',
				);
			} else {
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => -1,
					'tax_query' => array(
						'relation' => 'OR',
						array(
							'taxonomy' => 'product_category',
							'terms' => $term,
							'field' => 'slug',
							'operator' => 'IN'
						),
						array(
							'taxonomy' => 'product_brand',
							'terms' => $term,
							'field' => 'slug',
							'operator' => 'IN'
						),
					)
				);
			}

			if($orderByPrice != '') {
				$args['orderby'] = 'meta_value_num';
				$args['order'] = $orderByPrice;
				$args['meta_key'] = 'price';
			}
		?>

		<?php $i = 0; ?>
		<?php $wp_query = new WP_Query( $args ); ?>
		<?php if( $wp_query->have_posts() ) : ?>
			<div class="product__list p-slider">
				<?php $loopcounter = -1; while ($wp_query->have_posts()) : $wp_query->the_post(); $loopcounter ++; ?>
					<div class="position-relative d-none">
						<a	href="#<?php echo get_post_field('post_name', get_post())?>"
							class="product__card"
							onclick="SelectProduct('#<?php echo get_post_field('post_name', get_post())?>')"
						>
							<div class="product__item" id=<? echo 'item'.$loopcounter ?>>
								<?php
									$arr = post_custom('Image');
									foreach ((array)$arr as $img) {
										$imgs = wp_get_attachment_image_src($img,'full');
										break;
									}
								?>
								<div class="product__image">
									<?php if($i < ((is_mobile())? 6 : 9)): ?>
									<div class="img" style="background-image:url(<?php echo $imgs[0]; ?>);"></div>
									<?php else: ?>
									<div class="img lazybg" data-lazybg="<?php echo $imgs[0]; ?>" style="background-image:url(http://tryterior.com/wp-content/uploads/2022/06/logo.png)"></div>
									<?php endif; ?>
								</div>
								<div class="product__desp">
									<p class="brand"><?php echo getProductBrand(); ?></p>
									<h3 class="name"><?php the_title(); ?></h3>
									<p class="price"><?php echo getProductPrice('Price'); ?></p>
								</div>
							</div>
						</a>
						<div class="chbox">
							<input type="checkbox" 
								id=<? echo 'chbox'.$loopcounter; ?> 
								onchange="ChangeCartStatus(<?echo $loopcounter?>, 'chbox')"
							/>
						</div>
					</div>
					<?php $i++; ?>
				<?php endwhile; ?>
			</div>

		<?php else: ?>
		<?php endif; ?>

	</div>
</section>


<section id="product-detail">
	<?php $wp_query = new WP_Query( $args ); ?>
		<?php if( $wp_query->have_posts() ) : ?>
			<?php $loopcounter = -1; while ($wp_query->have_posts()) : $wp_query->the_post(); $loopcounter ++;?> 
			<!-- Modal -->
			<div class="modal fade" id=<?php echo get_post_field('post_name',get_post())?> data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">商品詳細</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- product detail -->
							<div class="detail-view" id=<?php echo get_post_field('post_name',get_post())?>>
								<div class="case-wrap">
									<div id="cased1">
										<div id="cased11"><?php echo pickUpImages('Image'); ?></div>
										<div id="cased11_thumbnail">
											<?php echo pickUpThumbnailImages('Image'); ?>
										</div>
									</div>
									<div id="cased2">
										<dl class="brand">
											<dt>ブランド名</dt>
											<dd><?php echo getProductBrand(); ?></dd>
										</dl>
										<h3 id="cased21"><?php the_title(); ?></h3>
										<dl id="cased22">
											<dt>サイズ</dt>
											<dd><?php echo getProductSize('Size'); ?></dd>
											<dt>素材</dt>
											<dd><?php echo post_custom('Material'); ?></dd>
											<dt>価格</dt>
											<dd><i><strong><?php echo getProductPrice('Price'); ?></strong></i></dd>
											<dt>商品説明</dt>
											<dd style="white-space: break-spaces"><?php echo post_custom('Description'); ?></dd>
										</dl>
										<div class="cart-btn">
											<input type="checkbox" 
												id=<?echo 'cart'.$loopcounter;?> 
												onchange="ChangeCartStatus(<?echo $loopcounter?>, 'cart')"
											/>
											<label for=<?echo 'cart'.$loopcounter;?> >お試し商品に追加</label>&nbsp;&nbsp;<br>
											<p>※1点まで追加できます。</p>
										</div>
									</div>
								</div>	
							</div>
						<!-- end -->
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		<?php else: ?>
	<?php endif; ?>

	<div id="cased4" style="margin-top: 100px">
      <a onclick="GotoForm()">申込みフォー厶へ</a>
    </div>
</section>



<script>
	const breakPoint = 768;
	const slider = $('.product__list.p-slider');
	let isMobile;

	function SlickProduct(isMobile){
		slider.slick({
			rows: 3,
			slidesPerRow: (isMobile) ? 2 : 3,
			dots: true
		});
	}

	function SelectProduct(id){
		if($(`#product-detail .detail-view${id} #cased11`).hasClass("slick-slider") == false){
			$(`.detail-view${id} #cased11`).slick({
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: `.detail-view${id} #cased11_thumbnail` //サムネイルのクラス名
			});
			$(`.detail-view${id} #cased11_thumbnail`).slick({
				infinite: true,
				slidesToShow: 3,
				slidesToScroll: 1,
				asNavFor: `.detail-view${id} #cased11`, //スライダー本体のクラス名
				focusOnSelect: true,
				prevArrow: '<div id="cased1l"></div>',
				nextArrow: '<div id="cased1r"></div>'
			});
		}
		var modal = new bootstrap.Modal($(`.modal${id}`), {
			keyboard: false
		})
		modal.show();
		$(`.modal${id}`).on('shown.bs.modal', (e) => {
			$(`.detail-view${id} #cased11`).slick('setPosition');
			$(`.detail-view${id} #cased11_thumbnail`).slick('setPosition');
			$(`.detail-view${id} #cased1`).addClass('open');
		})
	}

	function GotoForm(){
		var chboxes = $(`.slick-slide:not(.slick-cloned) input[type="checkbox"]`);
		let query = [];
		let count = 0;
		for(let i = 0; i < chboxes.length; i ++){
			if(chboxes[i].checked){
				count ++;
				let url = $('.product__item#item'+ i + ' .product__image .img').css('background-image');
				let name = $('.product__item#item'+ i + ' .product__desp .name').html();
				url = url.replace('url(','').replace(')','').replace(/\"/gi, "");
				query.push({img: url, name: name});
			}
		}
		if(count == 0){
			alert("選択した商品はありません。");
			return;
		}
		window.location.href = "/lpb/contact?products=" + encodeURIComponent(JSON.stringify(query));
	}

	function ChangeCartStatus(index, flag) {
		let chbox = `.slick-slide:not(.slick-cloned) input[type="checkbox"]#chbox${index}`;
		let cart = `#cart${index}`;
		if(flag == 'chbox'){
			$(cart).prop('checked', $(chbox).prop('checked'))
		} else {
			$(chbox).prop('checked', $(cart).prop('checked'))
		}
	}

	$(function(){
		// ------------------- initial  slider  ------------------ //
		const ua = navigator.userAgent;
		isMobile = window.innerWidth <= breakPoint || ua.indexOf('iPhone') > -1 || ua.indexOf('Android') > -1 || ua.indexOf('Mobile') > -1 || ua.indexOf('iPad') > -1
		SlickProduct(isMobile);
		$('.position-relative').removeClass('d-none');

		$(window).on('orientationchange resize',function(){
			if( window.innerWidth <= breakPoint){
				if(!isMobile) {
					slider.slick('unslick')
					SlickProduct(true);
					isMobile != isMobile;
				}
			} else {
				if(isMobile) {
					slider.slick('unslick')
					SlickProduct(false);
					isMobile != isMobile;
				}
			}
		});

		if(window.location.hash) {
			SelectProduct(window.location.hash);
		}
	});
	let lazyObjectObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                let lazyObject = entry.target;
                if(!(lazyObject.dataset.lazybg == '')){
                    bgsrc = lazyObject.dataset.lazybg;
                    lazyObject.style.backgroundImage = 'url('+bgsrc+')';
                    lazyObject.classList.remove("lazybg");
                    lazyObject.dataset.lazybg = '';
                    lazyObjectObserver.unobserve(lazyObject);
                }
            }
        });
    },{ rootMargin: "0px 0px 0px 0px" });
	document.addEventListener("DOMContentLoaded", function() {
		let lazyObjects = [].slice.call(document.querySelectorAll(".lazybg"));
		lazyObjects.forEach(function(lazyObject) {
				lazyObjectObserver.observe(lazyObject);
		});
	});
</script>

<?php get_template_part( 'page-content/product/product.footer' ); ?>