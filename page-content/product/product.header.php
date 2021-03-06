<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php if ( is_search() || is_404()) { ?>
      <?php } else { ?>
      <?php wp_title(' | ', true, 'right'); ?>
      <?php } ?>
      <?php bloginfo('name'); ?></title>
      <?php wp_deregister_script( 'jquery' ); ?>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/function.js"></script>
    <script type="text/javascript" src="/js/ofi.min.js"></script>
    <script>
      $(function(){
        objectFitImages('.ofi');
      });
    </script>

    <link rel="stylesheet" type="text/css" href="/css/common.css">
    <?php if (is_mobile()): ?><link rel="stylesheet" href="/css/sp_common.css" /><?php endif; ?>
    <link rel="stylesheet" type="text/css" href="/css/caselink.css">
    <script type="text/javascript" src="/js/common_new.js"></script>

    
    <!-- NEW PAGE - PRODUCT -->
    <?php if(
      is_post_type_archive('product') || 
      is_singular('product') || 
      is_tax('product_category') || 
      is_page('contact') || 
      is_page('lpa') || 
      is_page('item') ):  ?>
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

  </head>
  <body>