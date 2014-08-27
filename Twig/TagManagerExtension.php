<?php
/**
 * Created by PhpStorm.
 * User: deanoj
 * Date: 25/08/2014
 * Time: 22:29
 */

namespace Deanoj\GoogleTagManagerBundle\Twig;

class TagManagerExtension  extends \Twig_Extension
{
    private $environment;

    private $dataLayer;

    private $tagManagerCode;

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function __construct($dataLayerService, $tagManagerCode)
    {
        $this->dataLayer = $dataLayerService;
        $this->tagManagerCode = $tagManagerCode;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('gtm_tag', array($this, 'tagFunction'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('gtm_data_layer', array($this, 'dataLayerFunction'), array('is_safe' => array('html'))),
        );
    }

    public function tagFunction()
    {
        return $this->environment->render('DeanojGoogleTagManagerBundle:Default:tag.html.twig', array(
            'tag_manager_code' => $this->tagManagerCode
        ));
    }

    public function dataLayerFunction($values = array())
    {
        $dataLayer = $this->dataLayer->getItems();

        return $this->environment->render('DeanojGoogleTagManagerBundle:Default:data_layer.html.twig', array(
            'data_layer' => json_encode(array_merge($dataLayer, $values), JSON_FORCE_OBJECT)
        ));
    }

    public function getName()
    {
        return 'deanoj_google_tag_manager_extension';
    }
}
