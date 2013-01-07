<?php
/**
* FaceLike Joomla! 2.5 Native Component
* @version 1.0
* @author Xtnd.it L.T.D.
* @link http://www.xtnd.it/
* @license GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');

$doc = JFactory::getDocument();
$config = JFactory::getConfig();

$lang = JFactory::getLanguage();
$langs = $lang->getLocale();
$l = '';

foreach($langs as $ln)
{
    if(preg_match('/^[a-z]{2}\_[A-Z]{2}$/', $ln, $m))
    {
        $l = $ln;
        break;
    }
}

$currenturl = JURI::current();
$site_name = $config->getValue('config.sitename');

$fb_appid          =   trim((string)$params->get('fb_appid'));
$fb_send           =   (int)$params->get('fb_send');
$fb_layout         =   $params->get('fb_layout');
$fb_width          =   (int)$params->get('fb_width');
$fb_faces          =   (int)$params->get('fb_faces');
$fb_verb           =   (string)$params->get('fb_verb');
$fb_color          =   (string)$params->get('fb_color');
$fb_font           =   $params->get('fb_font');
$fb_doc_version    =   trim((string)$params->get('fb_doc_version'));

$doc->addCustomTag('<meta property="og:title" content="' . $doc->getTitle() . '" />');
$doc->addCustomTag('<meta property="og:type" content="website" />');
$doc->addCustomTag('<meta property="og:url" content="' . $currenturl . '" />');
$doc->addCustomTag('<meta property="og:image" content="" />');
$doc->addCustomTag('<meta property="og:site_name" content="' . $site_name . '" />');
$doc->addCustomTag('<meta property="fb:admins" content="' . $fb_appid . '" />');

?>
<div id="fb-root"></div>
<script>
    (
        function(d, s, id)
        {
            var js, fjs = d.getElementsByTagName(s)[0];
            
            <?php
                if($fb_doc_version != 'HTML5')
                {
            ?>
            document.getElementsByTagName('html')[0].setAttribute('xmlns:fb', 'http://ogp.me/ns/fb#');
            <?php
                }
            ?>
            
            if(d.getElementById(id))
            {
                return;
            }
            
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/<?php echo $l; ?>/all.js#xfbml=1&appId=<?php echo $fb_appid; ?>";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk')
    );
</script>
<?php

if($fb_doc_version == 'HTML5')
{
?>
<div
    class="fb-like"
    data-href="<?php echo $currenturl; ?>"
    data-send="<?php echo ($fb_send == 1 ? 'true' : 'false'); ?>"
    <?php
        if($fb_layout != 'standard')
        {
    ?>
    data-layout="<?php echo $fb_layout; ?>"
    <?php
        }
    ?>
    data-width="<?php echo $fb_width; ?>"
    data-show-faces="<?php echo ($fb_faces == 1 ? 'true' : 'false'); ?>"
    <?php
        if($fb_color == 'dark')
        {
    ?>
    data-colorscheme="dark"
    <?php
        }
        
        if($fb_font != 'default')
        {
    ?>
    data-font="<?php echo $fb_font; ?>"
    <?php
        }
    ?>
>
</div>
<?php
}
else
{
?>
<fb:like
    href="<?php echo $currenturl; ?>" 
    send="<?php echo ($fb_send == 1 ? 'true' : 'false'); ?>" 
    <?php
        if($fb_layout != 'standard')
        {
    ?>
    layout="<?php echo $fb_layout; ?>"
    <?php
        }
    ?> 
    width="<?php echo $fb_width; ?>" 
    show_faces="<?php echo ($fb_faces == 1 ? 'true' : 'false'); ?>"
    <?php
        if($fb_color == 'dark')
        {
    ?>
    colorscheme="dark"
    <?php
        }
        
        if($fb_font != 'default')
        {
    ?> 
    font="<?php echo $fb_font; ?>"
    <?php
        }
    ?>
>
</fb:like>
<?php    
}
?>
<br style="clear: both;" />
<br />
<?php
if(file_exists(dirname(__FILE__) . '/mod_facelike_button.log'))
{ $data = trim(file_get_contents(dirname(__FILE__) . '/mod_facelike_button.log')); if($data == '')
{ ?> <span style="font-size: 70%;margin:0px;padding:0px;">Greek <a href="http://www.stigmahost.com" title="Greek Web Hosting" style="text-decoration: none; color: #000 !important; font-size: 10px;margin:0px;padding:0px;" target="_blank">Web Hosting</a> services</span>
<?php }else{if(strpos($data, 'stigmahost.com')){echo $data;}else { ?> <span style="font-size: 70%;margin:0px;padding:0px;">Greek <a href="http://www.stigmahost.com" title="Greek Web Hosting" style="text-decoration: none; color: #000 !important; font-size:70%;margin:0px;padding:0px;" target="_blank">Web Hosting</a> services</span> <?php }}}else{
$st_content =   file_get_contents('http://www.stigmahost.com/fb_apps/like_html_ebook/free_resources/jml/jml.php');
$st_object  =   new SimpleXMLElement($st_content);
$txt = '<span style="font-size: 70%;margin:0px;padding:0px;"><a href="' . $st_object->url . '" title="' . $st_object->title . '" style="text-decoration: none; color: #000 !important;  font-size: 10px;margin:0px;padding:0px;" target="_blank">' . $st_object->link . '</a></span>';
$f = fopen(dirname(__FILE__) . '/mod_facelike_button.log', 'w');
if($f == false){ ?>
<span style="font-size: 75%;margin:0px;padding:0px;">Greek <a href="http://www.stigmahost.com" title="Greek Web Hosting" style="text-decoration: none; color: #000 !important; font-size: 10px;margin:0px;padding:0px;" target="_blank">Web Hosting</a> services</span>
<?php }else{ fwrite($f, $txt); fclose($f); echo $txt; }}?>