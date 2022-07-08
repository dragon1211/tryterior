<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php if ( is_search() || is_404()) { ?>
	  <?php } ?>
	  <?php if(is_page('item')) { ?>
      <?php wp_title('商品一覧 | トライテリア'); ?>
	  <?php } ?>
	 <?php  if(is_page('contact')) { ?>
      <?php wp_title('お問合せフォーム | トライテリア'); ?>
	  <?php } ?></title>
      <?php wp_deregister_script( 'jquery' ); ?>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/function.js"></script>
    <script type="text/javascript" src="/js/ofi.min.js"></script>
    <script type="text/javascript" src="/js/custom.js"></script>
    <script>
      $(function(){
        objectFitImages('.ofi');
      });
    </script>

<style type="text/css">
.header {
  padding: 0 3rem;
  min-height: 0rem;
  position: relative;
  width: 100%;
  top: 0;
  left: 0;
  z-index: 99;
  background: #fff;
}
.header-logo {
  width: 32.4rem;
}

.memo {
  font-size: 2rem;
   text-align: center;
   margin-top: 6rem;
}

@media screen and (max-width: 750px) {
  .header {
    padding: 0 1.7rem;
    min-height: 11.4rem;
  }
  .header-logo {
    width: 25.4rem;
  }

.memo {
  font-size: 2.7rem;
   text-align: left;
   margin-top: 6rem;
   margin-left: 2.5rem;
   margin-right: 2.5rem;
}

}



</style>

    <link rel="stylesheet" type="text/css" href="/css/common.css">
    <?php if (is_mobile()): ?><link rel="stylesheet" href="/css/sp_common.css" /><?php endif; ?>
    <link rel="stylesheet" type="text/css" href="/css/caselink.css">
    <script type="text/javascript" src="/js/common_new.js"></script>

    
    <!-- NEW PAGE - PRODUCT -->
    <?php if(
      is_post_type_archive('product') || 
      is_singular('product') || 
      is_tax('product_category') || 
      is_tax('product_brand') ||
      is_page('lpa') || is_page('lpb') || is_page('dev') || 
      is_page('contact') || is_page('item') || is_page('ocform') || is_page('ocform_new')
      ):  ?>
    <link rel="stylesheet" href="/css/case.css" />
    <?php if (is_mobile()) { ?><link rel="stylesheet" href="/css/sp_case.css" /><?php } ?>
    <link rel="stylesheet" href="/css/purchase-contact.css" />
    <link rel="stylesheet" href="/css/product.css" />
    <?php endif; ?>

    <?php /* Font */ ?>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
    <?php /* Slick */ ?>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>    
    
    <?php if(!empty(get_field('cf_google_search'))): ?>
    <?php $cf_google_search = get_field('cf_google_search'); ?>
    <?php if( $cf_google_search && in_array('yes', $cf_google_search )): ?>
    <meta name="robots" content="noindex,nofollow,noarchive">
    <meta name="googlebot" content="noindex,nofollow,noarchive">
    <?php endif; ?>
    <?php endif; ?>

  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5C3LQQB');</script>
<!-- End Google Tag Manager -->

  </head>
  <body>
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5C3LQQB"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="page-top js-pageTop"><span></span></div>
<header>
  <div class="header flex">
    <div class="header__l">
      <h1><img src="https://tryterior.com/lpa/img/logo.png" class="header-logo" alt="トライテリア TRY-TERIOR"></h1>
    </div>
  </div>
</header>