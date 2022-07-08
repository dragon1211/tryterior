<?php get_template_part( 'page-content/product/product.header' ); ?>
<?php the_post(); ?>

<section id="product-detail">
    <!-- product detail -->
    <div class="detail-view">
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
            <dd><?php echo get_product_brand(); ?></dd>
          </dl>
          <h3 id="cased21"><?php the_title(); ?></h3>
          <dl id="cased22">
            <dt>サイズ</dt>
            <dd><?php echo post_custom('Size'); ?></dd>
            <dt>素材</dt>
            <dd><?php echo post_custom('Material'); ?></dd>
            <dt>価格</dt>
            <dd><i><strong><?php echo post_custom('Price'); ?></strong></i></dd>
            <dt>商品説明</dt>
            <dd style="white-space: break-spaces"><?php echo post_custom('Description'); ?></dd>
          </dl>
        </div>
      </div>	
    </div>
    <!-- end -->

    <div id="cased4" style="margin-top: 100px">
      <a href="">商品一覧</a>
    </div>
</section>

<script>
  $(document).ready(function(){
    $(function() {
      $('#cased11').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '#cased11_thumbnail' //サムネイルのクラス名
      });
      $('#cased11_thumbnail').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '#cased11', //スライダー本体のクラス名
        focusOnSelect: true,
        prevArrow: '<div id="cased1l"></div>',
        nextArrow: '<div id="cased1r"></div>'
      });
    });
  });
</script>

<?php get_template_part( 'page-content/product/product.footer' ); ?>