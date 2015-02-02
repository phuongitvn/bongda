<?php
class ShareWidget extends CWidget
{
    /**
     * Site Name
     * @var string
     * defaults to Yii::app()->name
     */
    public $siteName = '';
 
    /**
     * Site Administrator's Facebook ID
     * @var string
     */
    public $fbSiteAdmin = '100009052266524';
 
    /**
     * URL of the page
     * @var string
     * defaults to the current page URL
     */
    public $pageUrl = '';
 
    /**
     * Title of the page
     * @var string
     */
    public $pageTitle = '';
 
    /**
     * Type of the Page : eg. website, article, ... etc.
     * @var string
     * defaults to 'article'
     */
    public $pageType = '';
 
    /**
     * Description of the page
     * @var string
     */
    public $pageDescription = '';
 
    /**
     * Image(s) of the page
     * @var mixed
     * can be a single string or array of strings
     * defaults $this->defaultPageImage
     */
    public $pageImages = '';
 
    /**
     * Default image of the page
     * @var string
     */
    public $defaultPageImage = '/images/fb/site-logo.jpg';
 
    /**
     * Show Comments
     * @var boolean
     * defaults to true
     */
    public $showComments = false;
 
    /**
     * Minimum IE version required
     * @var string
     */
    public $minimumIEVersion = '8';
 
    /**
     * Initialization
     * @see CWidget::init()
     */
    public function init()
    {
        parent::init();
 
        // Site Name
        if ($this->siteName == '') {
            $this->siteName = Yii::app()->name;
        }
 
        // base URL
        $baseUrl = Yii::app()->request->hostInfo . Yii::app()->request->baseUrl;
        // URL of the page
        if ($this->pageUrl == '') {
            $this->pageUrl = $baseUrl . '/' . Yii::app()->request->pathInfo;
        }
 
        // Type of the page
        if ($this->pageType == '') {
            $this->pageType = 'article';
        }
 
        // Set opengraph meta tags
        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerMetaTag($this->siteName, NULL, NULL, array('property'=>'og:site_name'));
        $cs->registerMetaTag($this->fbSiteAdmin, NULL, NULL, array('property'=>'fb:admins'));
        $cs->registerMetaTag($this->pageUrl, NULL, NULL, array('property' =>'og:url'));
        $cs->registerMetaTag($this->pageTitle, NULL, NULL, array('property'=>'og:title'));
        $cs->registerMetaTag($this->pageType, NULL, NULL, array('property'=>'og:type'));
        // Description of the page
        if ($this->pageDescription != "") {
            $cs->registerMetaTag($this->pageDescription, NULL, NULL, array('property'=>'og:description'));
        }
        // Image(s) of the page
        if (is_array($this->pageImages)) {
            if (count($this->pageImages) == 0) {
                $this->pageImages = $this->defaultPageImage;
            }
            foreach($this->pageImages as $image) {
                $cs->registerMetaTag($baseUrl . $image, NULL, NULL, array('property'=> 'og:image'));
            }
        } else {
            if ($this->pageImages == "") {
                $this->pageImages = $this->defaultPageImage;
            }
            $cs->registerMetaTag($baseUrl . $this->pageImages, NULL, NULL, array('property'=> 'og:image'));
        }
 
    }
 
    /**
     * Display the widget
     * @see CWidget::run()
     */
    public function run()
    {
    	$baseUrl = Yii::app()->request->hostInfo . Yii::app()->request->baseUrl;
    	echo '<a title="'.$this->pageTitle.'" href="http://www.facebook.com/sharer.php?u='.urlencode($baseUrl . '/' . Yii::app()->request->pathInfo).'&amp;t='.urlencode($this->pageTitle).'" target="_blank">
			     <img src="/images/share-fb.gif"/>
			  </a>';
		echo '<a title="'.$this->pageTitle.'" href="https://plus.google.com/share?url='.urlencode($baseUrl . '/' . Yii::app()->request->pathInfo).'&amp;t='.urlencode($this->pageTitle).'" target="_blank">
			     <img src="/images/share-gg.gif"/>
		      </a>';
    }
}