<?php
namespace Craft;

class HtmlAttributesPlugin extends BasePlugin
{
    function getName()
    {
        return 'HTML Attributes';
    }

    function getVersion()
    {
        return '1.0';
    }

    function getDeveloper()
    {
        return 'Fusionary';
    }

    function getDeveloperUrl()
    {
        return 'http://fusionary.com';
    }

    public function addTwigExtension()
    {
        Craft::import('plugins.htmlattributes.twigextensions.HtmlAttributesTwigExtension');
        return new HtmlAttributesTwigExtension();
    }
}
