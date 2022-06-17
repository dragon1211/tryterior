<?php /**
* Template Name: contact_b
 */
 ?>


<?php get_template_part( 'page-content/product/product.header' ); ?>

<section id="product-contact">
	<?php echo do_shortcode('[contact-form-7 id="4902"]') ?>
	<div id="wpcf7-f4902-o1"></div>
	<div class="purchase-contact-confirm">
		<dl class="username">
			<dt>氏名：</dt>
			<dd class="value"></dd>
		</dl>
		<dl class="address">
			<dt>配送先住所：</dt>
			<dd class="value"></dd>
		</dl>
		<dl class="phone">
			<dt>電話番号：</dt>
			<dd class="value"></dd>
		</dl>
		<dl class="your-email">
			<dt>メールアドレス：</dt>
			<dd class="value"></dd>
		</dl>
		<dl class="plan-date">
			<dt>配送希望日：</dt>
			<dd class="value"></dd>
		</dl>
		<dl class="products">
			<dt>選択中商品：</dt>
			<dd class="value"></dd>
		</dl>
		<dl class="consult-content">
			<dt>相談内容：</dt>
			<dd class="value"></dd>
		</dl>

		<div class="btn-group">
			<button class="back">戻る</button>
			<button class="submit">送信</button>
		</div>
	</div>
</section>


<script>
	$(function(){
		$('.purchase-contact-confirm').hide();
		$('.wpcf7-form textarea#consult-content').val(null);
		
		
		$('.wpcf7-form input[type="submit"]').click( e => {
			e.preventDefault();
			try{
				var query = new URLSearchParams(window.location.search);
				var products = JSON.parse(query.get("products"));
				var name = '';

				$('.purchase-contact-confirm .products .value').empty();
				
				for(let i in products){
					$('.purchase-contact-confirm .products .value').append('<div><img src="' + products[i].img + '" /><p>' + products[i].name +'</p></div>');
					name += `・${products[i].name} \n`;
				}

				if(products.length == 0){
					alert("選択した商品はありません。");
					return;
				}

				$('.wpcf7-form #product-name').val(name);
			} 
			catch (err){
				alert("選択した商品はありません。");
				return;
			}


			
			// Form validation
			if ( 
				$('.wpcf7-form .username input').val() != '' &&
				$('.wpcf7-form .address input').val() != '' &&
				$('.wpcf7-form .phone input').val() != '' &&
				$('.wpcf7-form .your-email input').val() != '' &&
				$('.wpcf7-form .date-start1 input').val() != ''
			) {
				$('.purchase-contact-confirm .username dd.value').text($('.wpcf7-form .username input').val()); 
				$('.purchase-contact-confirm .address dd.value').text($('.wpcf7-form .address input').val());
				$('.purchase-contact-confirm .phone dd.value').text($('.wpcf7-form .phone input').val());
				$('.purchase-contact-confirm .your-email dd.value').text($('.wpcf7-form .your-email input').val());
				$('.purchase-contact-confirm .consult-content dd.value').text($('.wpcf7-form textarea#consult-content').val() || "なし");

				var plan_date = '';
				plan_date += $('.wpcf7-form .date-start1 input').val() + '　' + $('.wpcf7-form .date-start-time1 select').val() + '<br/>';
				if ($('.wpcf7-form .date-start2 input').val() != '' && $('.wpcf7-form .date-start-time2 select').val() != '')
				plan_date += $('.wpcf7-form .date-start2 input').val() + '　' + $('.wpcf7-form .date-start-time2 select').val() + '<br/>';
				if ($('.wpcf7-form .date-start3 input').val() != '' && $('.wpcf7-form .date-start-time3 select').val() != '')
				plan_date += $('.wpcf7-form .date-start3 input').val() + '　' + $('.wpcf7-form .date-start-time3 select').val() + '<br/>';
				$('.purchase-contact-confirm .plan-date dd.value').html(plan_date);


				$('.wpcf7').hide();
				$('.purchase-contact-confirm').show();
			} 
			else {
				alert("必須項目を入力してください。");
				return;
			}
		});

		$('.purchase-contact-confirm .back').click(function(){
			$('.purchase-contact-confirm').hide();
			$('.wpcf7').show();
		});
		
		$('.purchase-contact-confirm .submit').click(function(){
			if( $('.wpcf7-form textarea#consult-content').val() == null || $('.wpcf7-form textarea#consult-content').val() == "" ) {
				$('.wpcf7-form textarea#consult-content').val("なし");
			}
			$('.wpcf7-form').submit();
		});


	});
</script>

<?php get_template_part( 'page-content/product/product.footer' ); ?>