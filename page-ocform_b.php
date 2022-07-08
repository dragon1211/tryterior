<?php /**
* Template Name: ocform_b
 */
?>


<?php get_template_part( 'page-content/product/product.header' ); ?>

<section id="product-contact">
	<?php echo do_shortcode('[contact-form-7 id="4872"]') ?>
	<div id="wpcf7-f4871-o1"></div>
	<div class="purchase-contact-confirm">
		<dl class="username">
			<dt>氏名：</dt>
			<dd class="value"></dd>
		</dl>
		<dl class="your-email">
			<dt>メールアドレス：</dt>
			<dd class="value"></dd>
		</dl>
		<dl class="plan-date">
			<dt>オンライン相談希望日：</dt>
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
	$('.wpcf7-form textarea#consult-content').prop('disabled', true);
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
	
	
	$('.wpcf7-form #product-name').val(name);
	} 
	catch (err){
	alert("選択した商品はありません。");
	return;
	}
	
	
	
	// Form validation
	if ( 
	$('.wpcf7-form .username input').val() != '' &&
	$('.wpcf7-form .your-email input').val() != '' &&
	$('.wpcf7-form .date-start1 input').val() != ''
	) {
	$('.purchase-contact-confirm .username dd.value').text($('.wpcf7-form .username input').val()); 
	$('.purchase-contact-confirm .your-email dd.value').text($('.wpcf7-form .your-email input').val());
	
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
	$('.wpcf7-form').submit();
	});
	
	});
</script>

<?php get_template_part( 'page-content/product/product.footer' ); ?>