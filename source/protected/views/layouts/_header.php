<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>.::Tin Bóng Đá::.</title>
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/css/jquery.mobile-1.4.5.min.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/css/style.css">
	<!--<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/js/scroll/jquery.mobile.iscrollview-pull.css">-->
	<script src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.mobile-1.4.5.min.js"></script>
    <!--<script src="<?php echo Yii::app()->request->baseUrl;?>/js/scroll/iscroll.js"></script>-->
    <!--<script src="<?php echo Yii::app()->request->baseUrl;?>/js/scroll/jquery.mobile.iscrollview.js"></script>-->
    <!--<script src="<?php echo Yii::app()->request->baseUrl;?>/js/scroll/pull-example.js"></script>-->
	<script>
	
$(document).on('pageinit', '#main-content', function(){
var $page = $(this);
$page.find('#loadmore').on('click', function(e) {
        var page = parseInt($("#page").val());
		$.ajax({
			url: '<?php echo Yii::app()->createUrl('/post/loadMore', array('url_key'=>'bong-da-anh'))?>',
			data: {page:page},
			success: function(data){
				$("#data-list").append(data);
				$("#page").attr("value",page+1);
			}
		})
    }); 
});
	</script>
    <style>
    .ui-listview>li.ui-li-has-thumb>a.ui-btn>img:first-child{
    	#position: absolute;
		#left: 5px;
		#top: 5px;
		#bottom: 5px;
    }
    .ui-listview>li.ui-li-has-thumb>a.ui-btn{
    	#min-height: 68px!important;
    	#max-height: 68px!important;
    	padding-left: 92px!important;
    	padding-right: 0!important
    }
    .iscroll-content{
    	padding: 0 16px!important;
    }
    .ui-content .ui-listview{
    	border-radius: 0!important;
    }
    .ui-listview>li h3{
    font-size: 0.9em!important;
    	margin: 2px 0;
    	white-space: normal!important;
    	font-weight: bold!important;
    	color: #116AB5;
    }
    .ui-listview>li p{
    	white-space: normal!important;
    	margin: 0!important;
    }
    .ui-btn-icon-left:after, .ui-btn-icon-right:after, .ui-btn-icon-top:after, .ui-btn-icon-bottom:after, .ui-btn-icon-notext:after{
    	background-color: #108040;
    }
    .ui-listview>li.ui-li-has-thumb>a.ui-btn:after{
    	content:none!important;
    }
    .smenu li a.ui-btn-active{
    	#background-color: #B2412D!important;
    	#border-color: #B2412D!important;
    	background-color: #ededed!important;
    	border-color: #ededed!important;
    	color: #333!important;
    }
    @media (max-width: 500px){
	    #postview img{
	    	width: 100%!important;
			height: auto!important;
	    }
    }
    </style>
</head>
<body>