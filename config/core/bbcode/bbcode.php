<?php

/**
 * Unify line breaks of different operating systems
 * 
 * @param string text Text to convert
 *
 * @return mixed
 * @author Christian Seiler
 **/
function convertLineBreaks($text)
{
	return preg_replace("/\015\012|\015|\012/", "\n", $text);
}

/**
 * Remove everything but the newline character
 * 
 * @param string text Text to change
 *
 * @return mixed
 * @author Christian Seiler
 **/
function BBCodeStripContents($text)
{
	return preg_replace ("/[^\n]/", '', $text);
}

/**
 * Fonctions de CallBack pour les liens
 * 
 * @param action
 * 
 * @param array attributes Attributes in the bbcode
 * 
 * @param string content Content inside the block
 * 
 * @param params
 * 
 * @param node_object
 *
 * @return string
 * @author Christian Seiler
 **/
function do_bbcode_url($action, $attributes, $content, $params, $node_object)
{
    if (isset($attributes['default']))
    {
    	$url = $attributes['default'];
        $url = str_replace('&quot;', '', $url);
        $text = $content;
    }
    else if(isset($attributes['url']))
    {
    	$url = $attributes['url'];
        $url = str_replace('&quot;', '', $url);
        $text = $attributes['url'];
    }
    else
    {
    	$url = $content;
        $text = $content;
    }
    if(isset ($attributes['title']))
    {
    	$attributes['title'] = str_replace('&quot;', '', $attributes['title']);
    	$title=' title="'.$attributes['title'].'"';
    }
    else
    {
    	$title='';
    }
    if ($action == 'validate')
    {
        if (substr($url, 0, 5) == 'data:' || substr($url, 0, 5) == 'file:'
          || substr($url, 0, 11) == 'javascript:' || substr($url, 0, 4) == 'jar:')
        {
			return false;
        }
        return true;
    }
    return '<a href="'.$url.'"'.$title.'>'.htmlspecialchars($text).'</a>';
}

/**
 * Fonctions de CallBack pour les images
 * 
 * @param action
 * 
 * @param array attributes Attributes in the bbcode
 * 
 * @param string content Content inside the block
 * 
 * @param params
 * 
 * @param node_object
 *
 * @return string
 * @author Christian Seiler
 **/
function do_bbcode_img($action, $attributes, $content, $params, $node_object)
{
	if (!isset($attributes['src']))
	{
		$src=$content;
		$alt="";
	}
	else
	{
		$src=$attributes['src'];
		$src=str_replace('&quot;', '', $src);
		$alt=$content;
	}
    if ($action == 'validate') {
        if (substr($content, 0, 5) == 'data:' || substr($content, 0, 5) == 'file:'
          || substr($content, 0, 11) == 'javascript:' || substr($content, 0, 4) == 'jar:')
        {
            return false;
        }
        return true;
    }
    return '<img src="'.htmlspecialchars($src).'" alt="'.htmlspecialchars($alt).'">';
}

/**
 * Fonctions de CallBack pour les "align"
 * 
 * @param action
 * 
 * @param array attributes Attributes in the bbcode
 * 
 * @param string content Content inside the block
 * 
 * @param params
 * 
 * @param node_object
 *
 * @return string
 * @author gugus2000
 **/
function do_bbcode_align($action, $attributes, $content, $params, $node_object)
{
	if (isset($attributes['align']))
	{
		$text=$content;
		$align=$attributes['align'];
		$align=str_replace('&quot;', '', $align);
	}
	else if (isset($attributes['default']))
	{
		$text=$content;
		$align=$attributes['default'];
		$align=str_replace('&quot;', '', $align);
	}
	else
	{
		$text=$content;
		$align="center";
	}
    if ($action == 'validate') {
        if (substr($content, 0, 5) == 'data:' || substr($content, 0, 5) == 'file:'
          || substr($content, 0, 11) == 'javascript:' || substr($content, 0, 4) == 'jar:')
        {
            return false;
        }
        return true;
    }
    return '<div class="bbcode align '.htmlspecialchars($align).'">'.$text.'</div>';
}

/**
 * Fonctions de CallBack pour les "float"
 *
 * @param action
 * 
 * @param array attributes Attributes in the bbcode
 * 
 * @param string content Content inside the block
 * 
 * @param params
 * 
 * @param node_object
 *
 * @return string
 * @author gugus2000
 **/
function do_bbcode_float($action, $attributes, $content, $params, $node_object)
{
	if (isset($attributes['float']))
	{
		$text=$content;
		$float=$attributes['float'];
		$float=str_replace('&quot;', '', $float);
	}
	else if (isset($attributes['default']))
	{
		$text=$content;
		$float=$attributes['default'];
		$float=str_replace('&quot;', '', $float);
	}
	else
	{
		$text=$content;
		$float="left";
	}
    if ($action == 'validate') {
        if (substr($content, 0, 5) == 'data:' || substr($content, 0, 5) == 'file:'
          || substr($content, 0, 11) == 'javascript:' || substr($content, 0, 4) == 'jar:')
        {
            return false;
        }
        return true;
    }
    return '<div class="bbcode float '.htmlspecialchars($float).'">'.$text.'</div>';
}

/**
 * Ajoute un élément au BBCode
 * 
 * @param StringParser_BBCode bbcode BBCode object
 * 
 * @param array bbcode_element_list Array which contains all the bbcode elements
 * 
 * @return void
 * @author gugus2000
 **/
function BBCodeAddElement(&$bbcode,$bbcode_elements_list)
{
	foreach ($bbcode_elements_list as $name => $element)
	{
		$bbcode->addCode($element['code'], $element['type'],$element['callback'], $element['params'], $element['content_type'], $element['allowed_in'], $element['not_allowed_in']);
	}
}

/**
 * Crée un bbcode avec les éléments déjà définis
 *
 * @return StringParserBBCode
 * @author gugus2000
 **/
function CreateBBcode()
{
	$BBCodeElements=array(
		'b' => array(
			'code'     => 'b',
			'type'     => 'simple_replace',
			'callback' => null,
			'params'   => array(
				'start_tag' => '<span class="bbcode b">',
				'end_tag'   => '</span>',
			),
			'content_type' => 'inline',
			'allowed_in'   => array(
				'block',
				'inline',
				'link',
				'listitem',
			),
			'not_allowed_in' => array(),
		),
		'i' => array(
			'code'           => 'i',
			'type'           => 'simple_replace',
			'callback'       => null,
			'params'         => array(
				'start_tag' => '<span class="bbcode i">',
				'end_tag'   => '</span>',
			),
			'content_type'   => 'inline',
			'allowed_in'     => array(
				'block',
				'inline',
				'link',
				'listitem',
			),
			'not_allowed_in' => array(),
		),
		'u' => array(
			'code'           => 'u',
			'type'           => 'simple_replace',
			'callback'       => null,
			'params'         => array(
				'start_tag' => '<span class="bbcode u">',
				'end_tag'   => '</span>',
			),
			'content_type'   => 'inline',
			'allowed_in'     => array(
				'block',
				'inline',
				'link',
				'listitem',
			),
			'not_allowed_in' => array(),
		),
		's' => array(
			'code'           => 's',
			'type'           => 'simple_replace',
			'callback'       => null,
			'params'         => array(
				'start_tag'  => '<span class="bbcode s">',
				'end_tag'    => '</span>',
			),
			'content_type'   => 'inline',
			'allowed_in'     => array(
				'block',
				'inline',
				'link',
				'listitem',
			),
			'not_allowed_in' => array(),
		),
		'url' => array(
			'code'           => 'url',
			'type'           => 'usecontent?',
			'callback'       => 'do_bbcode_url',
			'params'         => array(
				'usecontent_param' => 'default',
			),
			'content_type'   => 'link',
			'allowed_in'     => array(
				'block',
				'inline',
				'listitem',
			),
			'not_allowed_in' => array(
				'link',
			),
		),
		'link' => array(
			'code'           => 'link',
			'type'           => 'callback_replace_single',
			'callback'       => 'do_bbcode_url',
			'params'         => array(),
			'content_type'   => 'link',
			'allowed_in'     => array(
				'block',
				'inline',
				'listitem',
			),
			'not_allowed_in' => array(
				'link',
			),
		),
		'img' => array(
			'code'           => 'img',
			'type'           => 'usecontent',
			'callback'       => 'do_bbcode_img',
			'params'         => array(),
			'content_type'   => 'image',
			'allowed_in'     => array(
				'block',
				'inline',
			),
			'not_allowed_in' => array(),
		),
		'list' => array(
			'code'           => 'list',
			'type'           => 'simple_replace',
			'callback'       => null,
			'params'         => array(
				'start_tag' => '<ul class="bbcode">',
				'end_tag'   => '</ul>',
			),
			'content_type'   => 'list',
			'allowed_in'     => array(
				'block',
				'listitem',
			),
			'not_allowed_in' => array(),
		),
		'*' => array(
			'code'           => '*',
			'type'           => 'simple_replace',
			'callback'       => null,
			'params'         => array(
				'start_tag' => '<li>',
				'end_tag'   => '</li>'
			),
			'content_type'   =>'listitem',
			'allowed_in'     => array(
				'list',
			),
			'not_allowed_in' => array(),
		),
		'align' => array(
			'code'           => 'align',
			'type'           => 'callback_replace',
			'callback'       => 'do_bbcode_align',
			'params'         => array(),
			'content_type'   => 'block',
			'allowed_in'     => array(
				'block',
			),
			'not_allowed_in' => array(
				'list',
				'listitem',
				'inline',
				'link',
				'listitem',
			),
		),
		'float' => array(
			'code'         => 'float',
			'type'         => 'callback_replace',
			'callback'     => 'do_bbcode_float',
			'params'       => array(),
			'content_type' => 'block',
			'allowed_in'   => array(
				'block',
			),
			'not_allowed_in' => array(
				'list',
				'listitem',
				'inline',
				'link',
				'listitem',
			),
		),
		'ligne' => array(
			'code'         => 'ligne',
			'type'         => 'simple_replace',
			'callback'     => null,
			'params'       => array(
				'start_tag' => '<div class="ligne">',
				'end_tag'   => '</div>',
			),
			'content_type' => 'block',
			'allowed_in'   => array(
				'block',
			),
			'not_allowed_in' => array(
				'list',
				'listitem',
				'inline',
				'link',
				'listitem',
			),
		),
		'colonne' => array(
			'code'         => 'colonne',
			'type'         => 'simple_replace',
			'callback'     => null,
			'params'       => array(
				'start_tag' => '<div class="colonne">',
				'end_tag'   => '</div>',
			),
			'content_type' => 'block',
			'allowed_in'   => array(
				'block',
			),
			'not_allowed_in' => array(
				'list',
				'listitem',
				'inline',
				'link',
				'listitem',
			),
		),
	);
	require_once 'classe/lib/StringParser_BBCode.class.php';
	$StringParser_BBcode=new \StringParser_BBcode;
	$StringParser_BBcode->addFilter(STRINGPARSER_FILTER_PRE, 'convertLineBreaks');
	$StringParser_BBcode->addParser(array ('block', 'inline', 'link', 'listitem'), 'htmlspecialchars');
	$StringParser_BBcode->addParser(array ('block', 'inline', 'link', 'listitem'), 'nl2br');
	$StringParser_BBcode->addParser('list', 'BBCodeStripContents');
	BBCodeAddElement($StringParser_BBcode, $BBCodeElements);
	$StringParser_BBcode->setCodeFlag('link', 'paragraph_type', BBCODE_PARAGRAPH_ALLOW_INSIDE);
	$StringParser_BBcode->setCodeFlag('list', 'paragraph_type', BBCODE_PARAGRAPH_BLOCK_ELEMENT);
	$StringParser_BBcode->setCodeFlag('list', 'opentag.before.newline', BBCODE_NEWLINE_DROP);
	$StringParser_BBcode->setCodeFlag('list', 'closetag.before.newline', BBCODE_NEWLINE_DROP);
	$StringParser_BBcode->setRootParagraphHandling(false);
	return $StringParser_BBcode;
}

?>