<?php  // *** DO NOT EDIT THIS FILE, CREATE A COPY !!

/**
 * (Popup) Gallery layout  --  Photoswipe
 *
 * This layout supports inline_info, pretext, posttext
 */

if ($is_ingroup)
{
	$field->{$prop}[] = 'Usage of this gallery inside field-group not possible, outer container can not be added';

	return;
}


// ***
// *** Values loop
// ***

$i = -1;
foreach ($values as $n => $value)
{
	// Include common layout code for preparing values, but you may copy here to customize
	$result = include( JPATH_ROOT . '/plugins/flexicontent_fields/image/tmpl_common/prepare_value_display.php' );
	if ($result === _FC_CONTINUE_) continue;
	if ($result === _FC_BREAK_) break;

	$group_str = $group_name ? 'rel="['.$group_name.']"' : '';
	$field->{$prop}[] = $pretext.
		'<a style="'.$style.'" href="'.JUri::root(true).'/'.$srcl.'" '.$group_str.' class="fc_image_thumb">
			'.$img_legend.'
		</a>'
		.$inline_info.$posttext;
}



// ***
// *** Add per field custom JS
// ***

if ( !isset(static::$js_added[$field->id][__FILE__]) )
{
	flexicontent_html::loadFramework('photoswipe');

	$js = '';

	if ($js) JFactory::getDocument()->addScriptDeclaration($js);

	static::$js_added[$field->id][__FILE__] = true;
}



/**
 * Include common layout code before finalize values
 */

$result = include( JPATH_ROOT . '/plugins/flexicontent_fields/image/tmpl_common/before_values_finalize.php' );
if ($result !== _FC_RETURN_)
{
	// ***
	// *** Add container HTML (if required by current layout) and add value separator (if supported by current layout), then finally apply open/close tags
	// ***

	// *** Add container HTML
	$field->{$prop} = '
	<span class="photoswipe_fccontainer" >
		'. implode($separatorf, $field->{$prop}) .'
	</span>
	';

	// Apply open/close tags
	$field->{$prop}  = $opentag . $field->{$prop} . $closetag;
}