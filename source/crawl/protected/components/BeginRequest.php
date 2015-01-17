<?php

/**
 * Description of BeginRequest
 *
 * @author esteban
 */

class BeginRequest extends CBehavior {

  // The attachEventHandler() mathod attaches an event handler to an event. 
  // So: onBeginRequest, the handleBeginRequest() method will be called.
  public function attach($owner) {
    $owner->attachEventHandler('onBeginRequest', array($this, 'handleBeginRequest'));
  }

  public function handleBeginRequest($event) {
    $app = Yii::app();
    $user = $app->user;
    $gemi = Yii::app()->getModule('gemi');
	
    if (isset($_POST['_idioma']))
      $lng = $_POST['_idioma'];
    else if ($app->user->hasState('_idioma'))
      $lng = $app->user->getState('_idioma');
    else if (isset(Yii::app()->request->cookies['_idioma']))
      $lng = Yii::app()->request->cookies['_idioma']->value;
    else
      $lng = Yii::app()->language;
	
    if (!$gemi->IdiomaEstaDisponible($lng) && 
        !$gemi->mostrarInactivos)
      $lng = $gemi->IdiomaEstaDisponible('en') ? 'en' : $gemi->idiomaPorDefecto;

    if (isset($_POST['_idioma'])) {
      $app->user->setState('_idioma', $lng);
      $cookie = new CHttpCookie('_idioma', $lng);
      $cookie->expire = time() + (60 * 60 * 24 * 365); // (1 year)
      Yii::app()->request->cookies['_idioma'] = $cookie;
    }
    $app->language = $lng;
  }

}

?>
