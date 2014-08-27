# README

This bundle exposes a service that makes it easy to add data layer values from any controller. Twig functions make
it easy to output the HTML in your templates.

## Installation

## Usage

Output the tag in a template. The data layer must always be placed before the main tag in the template

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