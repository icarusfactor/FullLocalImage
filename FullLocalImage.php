<?php


/**                                                                                                                          
 * MediaWiki Local Image Extension                                                                                          
 * {{php}}{{Category:Extensions|LaguagePages}}                                                                               
 * @package MediaWiki                                                                                                        
 * @subpackage Extensions                                                                                                    
 * @author Daniel Yount  icarusfactor factorf2@yahoo.com                                                                     
 * @licence GNU General Public Licence 3.0 or later                                                                          
 * @Description Creates parserfunction. Localimage to work similar
 *      to the Localurl function except return the path to a image not a article.
 8 Place image in local directory with the name /images/Local-*'
 *
 * Installation:                                                                                                                
 * install this file in                                                                                                       
 *                                                                                                                              
 *  ${IP}/extensions/FullLocalImage/FullLocalImage.php                                                                                   
 *                                                                                                                             
 * and add the following line at the end of
 * ${IP}/LocalSettings.php :                                                         
 *                                                                                                                             
 * require_once("$IP/extensions/FullLocalImage/FullLocalImage.php");                                                                    
**/                  

 
define('LOCALIMG_VERSION','0.5');
 
$wgExtensionFunctions[] = 'wfSetupLocalIMG';
$wgHooks['LanguageGetMagic'][] = 'wfLocalIMGLanguageGetMagic';



 
$wgExtensionCredits['parserhook'][] = array(
        'name'        => 'Local Image',
        'author'      => 'Daniel Yount - @icarusfactor factorf2@yahoo.com',
        'description' => 'View Local Image',
        'url'         => 'http://www.mediawiki.org',
        'version'     => LOCALIMG_VERSION
);
 
function wfLocalIMGLanguageGetMagic(&$magicWords,$langCode = 0) {
        $magicWords['localimg'] = array(0,'localimg');
        return true;
}
 
function wfSetupLocalIMG() {
        global $wgParser;
        $wgParser->setFunctionHook('localimg','wfRenderLocalIMG');
        return true;
}


# Renders a table of all the individual month tables
function wfRenderLocalIMG(  &$parser ) {
        $output='';

        $argv = array();
        foreach (func_get_args() as $arg) if (!is_object($arg)) {
                if (preg_match('/^(.+?)\\s*=\\s*(.+)$/',$arg,$match)) $argv[$match[1]]=$match[2];
        }
      
              
        if (isset($argv['image']))    {      $localimg  = $argv['image']; } else { return ' ';} 
        if (isset($argv['link']))    {           $thelink  = $argv['link']; }  


         if (isset($argv['link']))    {  
                 $output .= '<A HREF="'.$thelink.'"><IMG ALIGN="middle"   SRC="/images/Local-'.$localimg.'"></A>';
               }
         else{
                 $output .= '<IMG ALIGN="middle"   SRC="/images/Local-'.$localimg.'">';
               }


 return $parser->insertStripItem( $output, $parser->mStripState );
}




?>
