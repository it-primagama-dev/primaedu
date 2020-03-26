<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter XML Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/xml_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('xml_convert'))
{
	/**
	 * Convert Reserved XML characters to Entities
	 *
	 * @param	string
	 * @param	bool
	 * @return	string
	 */
	function xml_convert($str, $protect_all = FALSE)
	{
		$temp = '__TEMP_AMPERSANDS__';

		// Replace entities to temporary markers so that
		// ampersands won't get messed up
		$str = preg_replace('/&#(\d+);/', $temp.'\\1;', $str);

		if ($protect_all === TRUE)
		{
			$str = preg_replace('/&(\w+);/', $temp.'\\1;', $str);
		}

		$str = str_replace(
			array('&', '<', '>', '"', "'", '-'),
			array('&amp;', '&lt;', '&gt;', '&quot;', '&apos;', '&#45;'),
			$str
		);

		// Decode the temp markers back to entities
		$str = preg_replace('/'.$temp.'(\d+);/', '&#\\1;', $str);

		if ($protect_all === TRUE)
		{
			return preg_replace('/'.$temp.'(\w+);/', '&\\1;', $str);
		}

		return $str;
	}
}

if ( ! function_exists('xml_dom'))
{
	function xml_dom()
	{
		return new DOMDocument('1.0', 'UTF-8');
	}
}

if ( ! function_exists('xml_add_child'))
{
	function xml_add_child($parent, $name, $value = NULL, $cdata = FALSE)
	{
		if($parent->ownerDocument != "")
		{
			$dom = $parent->ownerDocument;			
		}
		else
		{
			$dom = $parent;
		}
		
		$child = $dom->createElement($name);		
		$parent->appendChild($child);
		
		if($value != NULL)
		{
			if ($cdata)
			{
				$child->appendChild($dom->createCdataSection($value));
			}
			else
			{
				$child->appendChild($dom->createTextNode($value));
			}
		}
		
		return $child;		
	}
}


if ( ! function_exists('xml_add_attribute'))
{
	function xml_add_attribute($node, $name, $value = NULL)
	{
		$dom = $node->ownerDocument;			
		
		$attribute = $dom->createAttribute($name);
		$node->appendChild($attribute);
		
		if($value != NULL)
		{
			$attribute_value = $dom->createTextNode($value);
			$attribute->appendChild($attribute_value);
		}
		
		return $node;
	}
}


if ( ! function_exists('xml_print'))
{
	function xml_print($dom, $return = FALSE)
	{
		$dom->formatOutput = TRUE;
		$xml = $dom->saveXML();
		if ($return)
		{
			return $xml;
		}
		else
		{
			echo $xml;
		}
	}
}