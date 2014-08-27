# README

This bundle exposes a service that makes it easy to add data layer values from any controller. Twig functions make
it easy to output the HTML in your templates.

[![Build Status](https://travis-ci.org/deanoj/GoogleTagManagerBundle.svg?branch=master)](https://travis-ci.org/deanoj/GoogleTagManagerBundle)

## Installation via Composer

Add the following to the repositories section of your composer.json

	{
		"type" : "vcs",
		"url" : "https://github.com/deanoj/googletagmanagerbundle.git"
	}
	
Add the following the require section

	"deanoj/googletagmanagerbundle": "dev-master"
	
## Add the bundle to your kernel

	use Symfony\Component\HttpKernel\Kernel;

	class AppKernel extends Kernel
	{
		public function registerBundles()
		{
			$bundles = array(
				// ...
				new Deanoj\GoogleTagManagerBundle\DeanojGoogleTagManagerBundle(),
				// ...
			);
			
			return $bundles;
		}
		// ...
	}

## Update your parameters file

Specify the tag manager tracking code in your parameters.yml file.

	google_tag_manager_code:	GTM-XXXXXX

## Usage

Output the tag in your template. The data layer must always be placed before the main tag in the template

    {{ gtm_data_layer() }}
    {{ gtm_tag() }}

Add data layer variables from the template layer. This will ensure they are present on every page.

    {{ gtm_data_layer({ua_tracking_code:'UA-XXXXXXX-X'}) }}

Use the data layer service to add items from your controller

    public function someAction()
    {
        // ...

        $dataLayer = $this->get('deanoj.google_tag_manager.data_layer');

        // add a single item by key and value
        $dataLayer->addItem('foo2', 'bar2');

        // add an array of items
        $dataLayer->addItems(array('key' => 'value'));

        // ...
    }

## Author

Dean McGill

## License

The MIT License (MIT)

Copyright (c) 2014

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
