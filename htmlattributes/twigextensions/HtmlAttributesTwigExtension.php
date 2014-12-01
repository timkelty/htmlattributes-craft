<?php

namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class HtmlAttributesTwigExtension extends \Twig_Extension
{

    public function getName()
    {
        return 'HTML Attributes';
    }

    public function getFilters()
    {
        $attrs = new Twig_Filter_Method($this, 'hashToHtmlAttributes');

        return array(
            'htmlAttributes' => $attrs,
            'htmlAttrs' => $attrs
        );
    }

    public function hashToHtmlAttributes($attrs)
    {
        $str = trim(implode(' ', array_map(function($attrName) use ($attrs) {
            $attrVal = $attrs[$attrName];
            $quote = '"';

            if (is_null($attrVal) || $attrVal === true) {
                return $attrName;
            } elseif($attrVal === false) {
                return '';
            } elseif(is_array($attrVal)) {
                switch ($attrName) {
                    case 'class':
                        $attrVal = implode(' ', $attrVal);
                        break;

                    case 'style':
                        array_walk($attrVal, function(&$val, $key) {
                            $val = $key . ': ' . $val;
                        });
                        $attrVal = implode('; ', $attrVal) . ';';
                        break;

                    // Default to json, for data-* attributes
                    default:
                        $quote = '\'';
                        $attrVal = json_encode($attrVal);
                        break;
                }
            } else {
                return $attrName . '="' . $attrVal . '"';
            }

            return $attrName . '=' . $quote . $attrVal . $quote;

        }, array_keys($attrs))));

        return TemplateHelper::getRaw($str);
    }
}
