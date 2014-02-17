<?php
/**
 * @package Hello_Dolly
 * @version 1.6
 */
/*
Plugin Name: Ads Tool
Plugin URI: http://wordpress.org/
Description: This will be for a simple Wordpress Plugin that will allow you to add and image link from Photobucket or other online source and add headline and the link to a website when the image is clicked and hit submit and then it creates the code to the site on another page.
Author: Vips
Version: 1.6
Author URI: http://wordpress.org/
*/
function ads_tool_activation() {}
register_activation_hook(__FILE__, 'ads_tool_activation');

function ads_tool_deactivation() {}
register_deactivation_hook(__FILE__, 'ads_tool_deactivation');

function ads_tool_form() {
	$base_url = __DIR__;	
	$form_path = plugins_url();	
	?>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo $form_path ?>/ads_tool/include/ad_style.css" />
    <?php 
	if(isset($_POST['ad_s_b'])){		
		$baseurl = get_bloginfo('url');
		$htmlstr="
			   <html> ##
				    <body>##
					
					<table width='600px' border='0' align='center' cellpadding='0' cellspacing='0'>##
						<tr>
							<td>
								<FONT face='impact' color='#aa1f06' size='6'>".$_POST['ad_h_l']."</Font>
							</td>	 
						</tr>##
						<tr>
							<td>
								<a href='".$_POST['ad_w']."'>
								<img border='0' src='".$_POST['ad_i_u']."' />
								</a>
							</td>	 
						</tr>##";
						if($_POST['area2'] ){
							$htmlstr.="<tr>
								<td>
									<p>".$_POST['area2']."</p>
								</td>	 
							</tr>##";
						}
		$htmlstr.="</table>##
				 </div>
					</body>##
				   </html>";
				   
		$display_preview = $finalhtml= str_replace('##','<br/>',htmlentities($htmlstr));
	       
		$finalhtml = '<div class="succ_box">'.$finalhtml.'</div>
	
		<div class="succ_box_btn">
			<form action="" method="post">
				<table>
					<tr>
						<td><input type="submit" value="Click To Preview" name="ad-preview-sub"></td>
						<td><a href="#" class="bttngo">Go To Craigslist</a></td>
					</tr>
					<tr>
						<td><a href="javascript:void(0);" onclick="history.back();" class="bttnbk">Go To Backpage</a></td>
						<td><a href="'.get_permalink($post->ID).'" class="bttnad">Make Another AD</a></td>
					</tr>
				</table>			
				<input type="hidden" name="ad_h_l" value="'.$_POST['ad_h_l'].'">
				<input type="hidden" name="ad_i_u" value="'.$_POST['ad_i_u'].'">
				<input type="hidden" name="area2" value="'.$_POST['area2'].'">
				<input type="hidden" name="ad_w" value="'.$_POST['ad_w'].'">
			</form>
		</div>';
		echo $finalhtml;
	}elseif(isset($_POST['ad-preview-sub']) && $_POST['ad-preview-sub']== 'Click To Preview'){
		
		$htmlstrp ="<div class='succ_box'><table width='600px' border='0' align='center' cellpadding='0' cellspacing='0'>
				<tr>
					<td>
						<FONT face='impact' color='#aa1f06' size='6'>".$_POST['ad_h_l']."</Font>
					</td>	 
				</tr>
				<tr>
					<td>
						<a href='".$_POST['ad_w']."'>
							<img border='0' src='".$_POST['ad_i_u']."' />
						</a>
					</td>	 
				</tr>";
				if($_POST['area2'] ){
					$htmlstrp.="<tr>
						<td>
							<p>".$_POST['area2']."</p>
						</td>	 
					</tr>";
				}
		$htmlstrp.="</table></div>";
		
		$htmlstrp.= '<div class="succ_box_btn">
				<form action="" method="post">
					<table>
						<tr>
							<td><input type="submit" value="Click To Source Code" name="ad_s_b"></td>
							<td><a href="#" class="bttngo">Go To Craigslist</a></td>
						</tr>
						<tr>
							<td><a href="javascript:void(0);" onclick="history.back();" class="bttnbk">Go To Backpage</a></td>
							<td><a href="'.get_permalink($post->ID).'" class="bttnad">Make Another AD</a></td>
						</tr>
					</table>					
					<input type="hidden" name="ad_h_l" value="'.$_POST['ad_h_l'].'">
					<input type="hidden" name="ad_i_u" value="'.$_POST['ad_i_u'].'">
					<input type="hidden" name="area2" value="'.$_POST['area2'].'">
					<input type="hidden" name="ad_w" value="'.$_POST['ad_w'].'">
				</form>
			</div>';	
		echo $htmlstrp;
	}else{
		$form = '<script type="text/javascript" src="'.$form_path.'/ads_tool/include/nicEdit.js"></script>
		 <script type="text/javascript" src="'.$form_path.'/ads_tool/include/submitvalidation.js"></script>
		 
		 <script type="text/javascript">
			bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance(area2); });
		</script>
		 
		<form action="'.get_permalink($post->ID).'" method="post" onSubmit="return validateForm()" id="ad-sub-frm">
		<div class="tbl-wrapper">
			<table>
				<tr>
					<td></td>
					<td><h2>Enter Your Ad Information</h1></td>
				</tr>
				<tr>
					<td class="form_test">Ad Headine <em>*</em></td>
					<td><input type="text" name="ad_h_l" id="ad_h_l">
					<span style="display:none;" class="error" id="er_1"></span></td>
				</tr>
				<tr>
					<td class="form_test">Image URL <em>*</em></td>
					<td><input type="text" name="ad_i_u" id="ad_i_u" data-validation="url"><span>path to your ad graphic http://imagehostingsite.com/ad-graphic.jpg</span>
					<br/>
					<span style="display:none;" class="error" id="er_2"></span>
					</td>
				</tr>
				<tr>
					<td class="form_test">Website <em>*</em></td>
					<td><input type="text" name="ad_w" id="ad_w" data-validation="url"><span>you must put full url including http://</span>
					<br/>
					<span style="display:none;" class="error" id="er_3"></span>
					</td>
				</tr>
				<tr class="tr-ckedit">
					<td class="form_test1">Ad Copy / Page Text</td>
					<td>
					<textarea class="ckeditor"   cols="80" id="area2" name="area2" rows="10">
					</textarea>
					
					</td>
					
				</tr>
				 
				<tr >
					<td></td>
					<td><input type="submit" name="ad_s_b" value="Create Your Ad"></td>
				</tr> 
		 </table>
		</div>
		</form>';
		return $form;
	}	
}

add_shortcode("ads_tool", "ads_tool_form");
//add_action('get_content', 'ads_tool_form');


?>
