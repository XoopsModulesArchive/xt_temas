<?php
function Bloco_Temas ($options)
{
global $xoopsConfig, $xoopsUser, $HTTP_POST_VARS;
$bloco = array();
$bloco['title'] = _XT_TE_BLOCO;
$bloco['content'] = '';
$theme_options = '';
$bloco['content'] .= '<div style="text-align: center;"><form action='.$_SERVER["PHP_SELF"].' method="post">';
foreach ($xoopsConfig['theme_set_allowed'] as $theme) {
$theme_options .= '<option value="'.$theme.'"';
if ($theme == $xoopsConfig['theme_set']) {
$theme_options .= ' selected="selected"';
}
$theme_options .= '>'.$theme.'</option>';
}
if ($options[2] == 1){
$bloco['content'] .= "<img vspace=\"2\" id=\"xoops_theme_img\" src=\"".XOOPS_THEME_URL."/".$xoopsConfig['theme_set']."/shot.gif\" alt=\"screenshot\" width=\"".intval($options[3])."\" /><br />";
$change = "onchange=\"showImgSelected('xoops_theme_img', 'xoops_theme_select', 'themes', '/shot.gif', '".XOOPS_URL."');\"";
}else{
$change = '';
}
$bloco['content'] .= '<select id="xoops_theme_select" name="xoops_theme_select" size="'.$options[0].'" '.$change.'>'.$theme_options.'</select>';
if (is_object($xoopsUser)) {
if ($xoopsUser->getVar('theme') == $xoopsConfig['theme_set']){
$checado = "checked";
}else{
$checado = '';
}
$bloco['content'] .= '<br><input name="meutema" type="checkbox" value="1" '.$checado.'> '._XT_TE_SEMPRE;
}
$bloco['content'] .= '<br><input type="submit" value="'._GO.'"></form>';
if($options[1] == 1){
$bloco['content'] .= '('.sprintf(_XT_TE_TEMAS, '<b>'.count($xoopsConfig['theme_set_allowed']).'</b>').')';
}
$bloco['content'] .= '</div>';
if ($HTTP_POST_VARS){
if (isset($HTTP_POST_VARS['meutema'])){
$otema = $HTTP_POST_VARS['xoops_theme_select'];
$uid = $xoopsUser->getVar('uid');
$atualiza_tema =& xoops_gethandler('member');
$tema_atual = $atualiza_tema->getUser($uid);
$atualiza_tema->updateUserByField($tema_atual, 'theme', $otema);
}
}
return $bloco;
}

function Bloco_Temas_Edita ($options)
{
	//Temas no Select
	$exibir = "<input type='text' name='options[]' value='".intval($options[0])."' />";
	$form = sprintf(_XT_TE_EXIBIR,$exibir);
	//Exibir Total?
	$form .= "<br />"._XT_TE_TOTAL."&nbsp;<input type='radio' id='options[1]' name='options[1]' value='1'";
	if ( $options[1] == 1 ) {
		$form .= " checked='checked'";
	}
	$form .= " />&nbsp;"._YES."<input type='radio' id='options[1]' name='options[1]' value='0'";
	if ( $options[1] == 0 ) {
		$form .= " checked='checked'";
	}
	$form .= " />&nbsp;"._NO."";
	//Exibir Screenshot ?
		$form .= "<br />"._XT_TE_SHOT."&nbsp;<input type='radio' id='options[2]' name='options[2]' value='1'";
	if ( $options[2] == 1 ) {
		$form .= " checked='checked'";
	}
	$form .= " />&nbsp;"._YES."<input type='radio' id='options[2]' name='options[2]' value='0'";
	if ( $options[2] == 0 ) {
		$form .= " checked='checked'";
	}
	$form .= " />&nbsp;"._NO."<br />";
	//Lagura do Screenshot
	$largura = "<input type='text' name='options[]' value='".intval($options[3])."' />";
	$form .= sprintf(_XT_TE_TAMANHO,$largura);
	return $form;
}
?>
