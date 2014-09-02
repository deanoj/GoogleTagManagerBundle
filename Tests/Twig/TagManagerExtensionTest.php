<?php
/**
 * Created by PhpStorm.
 * User: deanoj
 * Date: 30/08/2014
 * Time: 12:21
 */

namespace Deanoj\GoogleTagManagerBundle\Tests\Twig;

use Deanoj\GoogleTagManagerBundle\Twig\TagManagerExtension;
use Deanoj\GoogleTagManagerBundle\DataLayer;

class TagManagerExtensionTest extends \PHPUnit_Framework_TestCase {

    private $tagManagerCode = 'GTM-XXXXXX';

    public function testTagFunction()
    {
        $loader = new \Twig_Loader_Filesystem(dirname(__FILE__).'/../../Resources/views/Default');
        $twig = new \Twig_Environment($loader);

        $dataLayer = new DataLayer();
        $tag = new TagManagerExtension($dataLayer);
        $tag->initRuntime($twig);
        $tag->setTagTemplate('tag.html.twig'); // override template name

        $expected = <<<EOT
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-XXXXXX"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-XXXXXX');</script>
<!-- End Google Tag Manager -->
EOT;

        $this->assertEquals($expected, $tag->tagFunction($this->tagManagerCode));
    }

    public function testDataLayerFunction()
    {
        $loader = new \Twig_Loader_Filesystem(dirname(__FILE__).'/../../Resources/views/Default');
        $twig = new \Twig_Environment($loader);

        $dataLayer = new DataLayer();
        $dataLayer->addItems(array('foo' => 'bar', 'apple' => 'green'));
        $tag = new TagManagerExtension($dataLayer);
        $tag->initRuntime($twig);

        $tag->setDataLayerTemplate('data_layer.html.twig'); // override template name

        $expected = <<<EOT
<script>
    var dataLayer = [];
    dataLayer.push({"foo":"bar","apple":"green"});
</script>
EOT;

        $this->assertEquals($expected, $tag->dataLayerFunction());
    }

    public function testDataLayerFunctionWithExtraParams()
    {
        $loader = new \Twig_Loader_Filesystem(dirname(__FILE__).'/../../Resources/views/Default');
        $twig = new \Twig_Environment($loader);

        $dataLayer = new DataLayer();
        $dataLayer->addItems(array('foo' => 'bar', 'apple' => 'green'));
        $tag = new TagManagerExtension($dataLayer);
        $tag->initRuntime($twig);

        $tag->setDataLayerTemplate('data_layer.html.twig'); // override template name

        $expected = <<<EOT
<script>
    var dataLayer = [];
    dataLayer.push({"foo":"bar","apple":"green","banana":"yellow"});
</script>
EOT;

        $this->assertEquals($expected, $tag->dataLayerFunction(array('banana' => 'yellow')));
    }
} 