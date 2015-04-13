<?php 
/**
 * @package Flipping Cards
 * @version 2.0
 */
/*
Plugin Name: Flipping Cards
Plugin URI: http://codecanyon.net/user/davidbo90/portfolio
Description: This is a plugin that lets you create cards with a flipping effect.
Author: David Blanco
Version: 2.0
Author URI: http://codecanyon.net/user/davidbo90
*/

/* ------------------------ OPTIONS PAGE ------------------------ */
  class FC_Options{

      public $options;

      public function __construct(){
          //delete_option('fc_plugin_options');
          $this->options = get_option('fc_plugin_options');
          $this->register_settings_and_fields();
      }

      public function add_menu_page(){
          add_options_page('Flipping Cards Options', 'Flipping Cards', 'administrator', __FILE__, array('FC_Options', 'display_options_page'));
      }

      public function display_options_page(){
          ?>
          
          <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Flipping Cards Default Options</h2>

            <form action="options.php" method="post" enctype="multipart/form-data">
                <?php settings_fields('fc_plugin_options'); ?>

                <?php do_settings_sections(__FILE__); ?>

                <p class="submit">
                    <input name="submit" type="submit" class="button-primary" value="Save Changes" />
                </p>

            </form>

          </div>
          
          <?php
      }

      public function register_settings_and_fields(){

          register_setting('fc_plugin_options', 'fc_plugin_options');//3rd param = optional callback
          add_settings_section('fc_main_section', 'Main Settings', array($this, 'fc_main_section_cb'), __FILE__);// id, title, cb, which page?

          add_settings_field('fc_type', 'Type of Card: ', array($this, 'fc_type_setting'), __FILE__, 'fc_main_section');
          add_settings_field('fc_direction', 'Direction: ', array($this, 'fc_direction_setting'), __FILE__, 'fc_main_section');
          add_settings_field('fc_autoFlip', 'Auto Flip Interval (Milliseconds): ', array($this, 'fc_autoFlip_setting'), __FILE__, 'fc_main_section');
          add_settings_field('fc_autoFlipStart', 'Auto Flip Start Time out (Milliseconds): ', array($this, 'fc_autoFlipStart_setting'), __FILE__, 'fc_main_section');
          add_settings_field('fc_float', 'Float: ', array($this, 'fc_float_setting'), __FILE__, 'fc_main_section');
          add_settings_field('fc_margin', 'Margin (top, right, bottom, left): ', array($this, 'fc_margin_setting'), __FILE__, 'fc_main_section');
          add_settings_field('fc_width', 'Width: ', array($this, 'fc_width_setting'), __FILE__, 'fc_main_section');
          add_settings_field('fc_height', 'Height: ', array($this, 'fc_height_setting'), __FILE__, 'fc_main_section');
          add_settings_field('fc_border', 'Border: ', array($this, 'fc_border_setting'), __FILE__, 'fc_main_section');
          add_settings_field('fc_borderradius', 'Border Radius: ', array($this, 'fc_borderradius_setting'), __FILE__, 'fc_main_section');
          add_settings_field('fc_padding', 'Padding: ', array($this, 'fc_padding_setting'), __FILE__, 'fc_main_section');
          add_settings_field('fc_background', 'Background Color: ', array($this, 'fc_background_setting'), __FILE__, 'fc_main_section');
          add_settings_field('fc_color', 'Font Color: ', array($this, 'fc_color_setting'), __FILE__, 'fc_main_section');
          add_settings_field('fc_textalign', 'Text Align: ', array($this, 'fc_textalign_setting'), __FILE__, 'fc_main_section');
      }

      public function fc_main_section_cb(){
          //Optional
      }

      /*
          INPUTS
      */

       public function fc_float_setting(){
          $float = 'none';
          if(!empty($this->options['fc_float'])){
              $float = $this->options['fc_float'];
          }

          $none = "";
          if($float == 'none'){
            $selected = "selected='selected'";
          }

          $left = "";
          if($float == 'left'){
            $left = "selected='selected'";
          }

          $right = "";
          if($float == 'right'){
            $right = "selected='selected'";
          }

          echo "<select name='fc_plugin_options[fc_float]'>";
            echo "<option value='none' $none>none</option>";
            echo "<option value='left' $left>left</option>";
            echo "<option value='right' $right>right</option>";
          echo "</select>";
      }

      public function fc_margin_setting(){
          $margin = "0px 10px 10px 0px";
          if(!empty($this->options['fc_margin'])){
              $margin = $this->options['fc_margin'];
          }

          echo "<input name='fc_plugin_options[fc_margin]' type='text' value='{$margin}' />";
      }

      public function fc_width_setting(){
          $width = "200px";
          if(!empty($this->options['fc_width'])){
              $width = $this->options['fc_width'];
          }

          echo "<input name='fc_plugin_options[fc_width]' type='text' value='{$width}' />";
      }

      public function fc_height_setting(){
          $height = "200px";
          if(!empty($this->options['fc_height'])){
              $height = $this->options['fc_height'];
          }

          echo "<input name='fc_plugin_options[fc_height]' type='text' value='{$height}' />";
      }

      public function fc_border_setting(){
          $border = "1px solid #BFBFBF";
          if(!empty($this->options['fc_border'])){
              $border = $this->options['fc_border'];
          }

          echo "<input name='fc_plugin_options[fc_border]' type='text' value='{$border}' />";
      }

       public function fc_borderradius_setting(){
          $borderradius = "2px";
          if(!empty($this->options['fc_borderradius'])){
              $borderradius = $this->options['fc_borderradius'];
          }

          echo "<input name='fc_plugin_options[fc_borderradius]' type='text' value='{$borderradius}' />";
      }

      public function fc_padding_setting(){
          $padding = "20px";
          if(!empty($this->options['fc_padding'])){
              $padding = $this->options['fc_padding'];
          }

          echo "<input name='fc_plugin_options[fc_padding]' type='text' value='{$padding}' />";
      }

      public function fc_background_setting(){
          $color = "#FBFBFB";
          if(!empty($this->options['fc_background'])){
              $color = $this->options['fc_background'];
          }

          echo "<input name='fc_plugin_options[fc_background]' id='colorselector2FC' type='text' value='{$color}' /><input type='text' class='current-color' id='curent-colorFC'/>";
      }

      public function fc_color_setting(){
          $color = "inherit";
          if(!empty($this->options['fc_color'])){
              $color = $this->options['fc_color'];
          }

          echo "<input name='fc_plugin_options[fc_color]' type='text' value='{$color}' />";
      }

      public function fc_textalign_setting(){
          $textalign = 'center';
          if(!empty($this->options['fc_textalign'])){
              $textalign = $this->options['fc_textalign'];
          }

          $right = "";
          if($textalign == 'right'){
            $right = "selected='selected'";
          }

          $center = "";
          if($textalign == 'center'){
            $center = "selected='selected'";
          }

          $left = "";
          if($textalign == 'left'){
            $left = "selected='selected'";
          }

          echo "<select name='fc_plugin_options[fc_textalign]'>";
            echo "<option value='right' $right>right</option>";
            echo "<option value='center' $center>center</option>";
            echo "<option value='left' $left>left</option>";
          echo "</select>";
      }

       public function fc_type_setting(){
          $type = 'fc_over';
          if(!empty($this->options['fc_type'])){
              $type = $this->options['fc_type'];
          }

          $over = "";
          if($type == 'fc_over'){
            $over = "selected='selected'";
          }

          $click = "";
          if($type == 'fc_click'){
            $click = "selected='selected'";
          }

          $button = "";
          if($type == 'fc_button'){
            $button = "selected='selected'";
          }

          $auto = "";
          if($type == 'fc_auto'){
            $auto = "selected='selected'";
          }

          echo "<select name='fc_plugin_options[fc_type]'>";
            echo "<option value='fc_over' $over>over</option>";
            echo "<option value='fc_click' $click>click</option>";
            echo "<option value='fc_button' $button>button</option>";
            echo "<option value='fc_auto' $auto>auto</option>";
          echo "</select>";
      }

      public function fc_direction_setting(){
          $direction = 'right';
          if(!empty($this->options['fc_direction'])){
              $direction = $this->options['fc_direction'];
          }

          $right = "";
          if($direction == 'right'){
            $right = "selected='selected'";
          }

          $left = "";
          if($direction == 'left'){
            $left = "selected='selected'";
          }

          $top = "";
          if($direction == 'top'){
            $top = "selected='selected'";
          }

          $bottom = "";
          if($direction == 'bottom'){
            $bottom = "selected='selected'";
          }

          echo "<select name='fc_plugin_options[fc_direction]'>";
            echo "<option value='right' $right>right</option>";
            echo "<option value='left' $left>left</option>";
            echo "<option value='top' $top>top</option>";
            echo "<option value='bottom' $bottom>bottom</option>";
          echo "</select>";
      }


      public function fc_autoFlip_setting(){
          $autoFlip = "3000";
          if(!empty($this->options['fc_autoFlip'])){
              $autoFlip = $this->options['fc_autoFlip'];
          }

          echo "<input name='fc_plugin_options[fc_autoFlip]' type='text' value='{$autoFlip}' />";
      }


      public function fc_autoFlipStart_setting(){
        $autoFlipStart = "2000";
          if(!empty($this->options['fc_autoFlipStart'])){
            $autoFlipStart = $this->options['fc_autoFlipStart'];
          }

          echo "<input name='fc_plugin_options[fc_autoFlipStart]' type='text' value='{$autoFlipStart}' />";
      }

  }

  add_action('admin_menu', 'initOptionsFC');

  function initOptionsFC(){
      FC_Options::add_menu_page();
  }

  add_action('admin_init', 'initAdminFC');

  function initAdminFC(){
    
      new FC_Options();
  }

  add_action( 'admin_head', 'header_colorpickerFC' );

  function header_colorpickerFC(){
      $url = plugin_dir_url(__FILE__)."css/colorpicker.css";
      echo "<link rel='stylesheet' href='$url'>";

      $url2 = plugin_dir_url(__FILE__)."js/colorpicker.min.js";
      echo "<script src='$url2'></script>";

      $options = get_option('fc_plugin_options');
      $color = "#FBFBFB";
      if(!empty($options['fc_background'])){
          $color = $options['fc_background'];
  }
?>
      
<script>
  jQuery(document).ready(function(){
    jQuery('#curent-colorFC').css('background', '<?php echo $color; ?>');

    jQuery('#colorselector2FC').ColorPicker({
        color: '<?php echo $color; ?>',
        onShow: function (colpkr) {
            jQuery(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            jQuery(colpkr).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex, rgb) {
            jQuery('#curent-colorFC').css('backgroundColor', '#' + hex);
            jQuery('#colorselector2FC').val('#'+hex);
        }
    });
  });
</script>

<?php
  }

/* ------------------------ END OPTIONS PAGE ------------------------ */


/* --------------------- SHORTCODE ------------------ */	

  add_shortcode( 'flippingCard', 'flipping_card' );
  add_shortcode( 'fc_front', 'flipping_card_front' );
  add_shortcode( 'fc_back', 'flipping_card_back' );

/* --------------------- STYLE AND SCRIPTS ------------------ */	

  function fc_scripts()  
  {  
      // Register the script like this for a plugin:  
      wp_register_script( 'fc-script', plugins_url( '/js/flipCard.js', __FILE__ ), array( 'jquery' ) );  
      
      // For either a plugin or a theme, you can then enqueue the script:  
      wp_enqueue_script( 'fc-script' );  
  }  

  function fc_styles()  
  {  
      //GRID STYLE
      wp_register_style( 'fc-style', plugins_url( '/css/flipCard.css', __FILE__ ), array(), '20120208', 'all' );  
      wp_enqueue_style( 'fc-style' );  

      /*
      // Register stylesheet
      wp_register_style( 'fc-ie', plugins_url( '/css/ie.css', __FILE__ ) );
      // Apply IE conditionals
      $GLOBALS['wp_styles']->add_data( 'fc-ie', 'conditional', 'lt IE' );
      // Enqueue stylesheet
      wp_enqueue_style( 'fc-ie' );
      */
  }  

  
  add_action( 'wp_enqueue_scripts', 'fc_styles' );
  add_action( 'wp_enqueue_scripts', 'fc_scripts' ); 

  function flipping_card_front($atts, $content = null){
      $style = "";

      if( isset($atts['borderradius']) ){
          $style.="border-radius:".$atts['borderradius'].";";
      }
      if( isset($atts['background']) ){
          $style.="background:".$atts['background'].";";
      }
      if( isset($atts['padding']) ){
          $style.="padding:".$atts['padding'].";";
      }
      if( isset($atts['textalign']) ){
          $style.="text-align:".$atts['textalign'].";";
      }

      $class = "";
      if( isset($atts['class']) ){
        $class = $atts['class'];
      }

  		return "
  			<div class='fc_front $class' style='$style'>
  				".do_shortcode($content)."
			  </div>
  		";
  }

  function flipping_card_back($atts, $content = null){
      $style = "";

      if( isset($atts['borderradius']) ){
          $style.="border-radius:".$atts['borderradius'].";";
      }
      if( isset($atts['background']) ){
          $style.="background:".$atts['background'].";";
      }
      if( isset($atts['padding']) ){
          $style.="padding:".$atts['padding'].";";
      }
      if( isset($atts['textalign']) ){
          $style.="text-align:".$atts['textalign'].";";
      }
      $class = "";
      if( isset($atts['class']) ){
        $class = $atts['class'];
      }

  		return "
  			<div class='fc_back $class' style='$style'>
  				".do_shortcode($content)."
			  </div>
  		";
  }

  function getStringBetween($str, $shortcode){

     preg_match_all("%(?<=\[$shortcode\]).*?(?=\[\/$shortcode\])%s",$str, $result, PREG_PATTERN_ORDER);

      return $result[0][0];
  }

  function flipping_card( $atts, $content = null ) {

    $options = get_option('fc_plugin_options');

    $style = "";
    $ratio = "";

    if( isset($atts['float']) ){
        $style.="float:".$atts['float'].";";

        if( $atts['float'] == 'none' ){
          $style.="clear:both;";
        }
    }else{
        $float = 'none';
        if(!empty($options['fc_float'])){
            $float = $options['fc_float'];
        } 

        $style.="float:".$float.";";

        if( $float == 'none' ){
            $style.="clear:both;";
        }
    }
    if( isset($atts['margin']) ){
        $style.="margin:".$atts['margin'].";";
    }else{
        $margin = "0px 10px 10px 0px";
        if(!empty($options['fc_margin'])){
            $margin = $options['fc_margin'];
        }

        $style.="margin:".$margin.";";
    }

    if( isset($atts['ratio']) ){
        $ratio = $atts['ratio'];
    }

    if( isset($atts['width']) ){
        $style.="width:".$atts['width'].";";
    }else{
        $width = "200px";
        if(!empty($options['fc_width'])){
            $width = $options['fc_width'];
        }

        $style.="width:".$width.";";
    }
    if( isset($atts['height']) ){
        $style.="height:".$atts['height'].";";
    }else{
        $height = "200px";
        if(!empty($options['fc_height'])){
            $height = $options['fc_height'];
        }

        $style.="height:".$height.";";
    }

    if( isset($atts['color']) ){
        $style.="color:".$atts['color'].";";
    }else{
        $color = "inherit";
        if(!empty($options['fc_color'])){
            $color = $options['fc_color'];
        }

        $style.="color:".$color.";";
    }

    $style2 = "";
    $style3 = "";
    if( isset($atts['border']) ){
        $style2.="border:".$atts['border'].";";
    }else{
        $border = "1px solid #BFBFBF";
        if(!empty($options['fc_border'])){
            $border = $options['fc_border'];
        }

        $style2.="border:".$border.";";
    }
    if( isset($atts['borderradius']) ){
        $style2.="border-radius:".$atts['borderradius'].";";
        $style3.='borderradius="'.$atts['borderradius'].'"';
    }else{
        $borderradius = "2px";
        if(!empty($options['fc_borderradius'])){
            $borderradius = $options['fc_borderradius'];
        }

        $style2.="border-radius:".$borderradius.";";
        $style3.='borderradius="'.$borderradius.'"';
    }

    if( isset($atts['padding']) ){
        $style3.=' padding="'.$atts['padding'].'"';
    }else{
        $padding = "20px";
        if(!empty($options['fc_padding'])){
            $padding = $options['fc_padding'];
        }

        $style3.=' padding="'.$padding.'"';
    }
    if( isset($atts['background']) ){
        $style3.=' background="'.$atts['background'].'"';
    }else{
        $color = "#FBFBFB";
        if(!empty($options['fc_background'])){
            $color = $options['fc_background'];
        }

        $style3.=' background="'.$color.'"';
    }
    if( isset($atts['textalign']) ){
        $style3.=' textalign="'.$atts['textalign'].'"';
    }else{
        $textalign = "center";
        if(!empty($options['fc_textalign'])){
            $textalign = $options['fc_textalign'];
        }

        $style3.=' textalign="'.$textalign.'"';
    }

    $type = "fc_over";
    if( isset($atts['type']) ){
        $type ='fc_'.$atts['type'];
    }else{
        $type2 = "fc_over";
        if(!empty($options['fc_type'])){
            $type2 = $options['fc_type'];
        }

        $type = $type2;
    }


    $direction = "right";
    if( isset($atts['direction']) ){
        $direction = $atts['direction'];
    }else{
        $direction2 = "right";
        if(!empty($options['fc_direction'])){
            $direction2 = $options['fc_direction'];
        }

        $direction = $direction2;
    }

    //Add CSS classes for back and front side
    $cssFront = "";
    if( isset($atts['front_class']) ){
        $cssFront = "class='".$atts['front_class']."'";
    }
    $cssBack = "";
    if( isset($atts['back_class']) ){
        $cssBack = "class='".$atts['back_class']."'";
    }


    $autoFlip = "3000";
    if( isset($atts['autoflip']) ){
        $autoFlip = $atts['autoflip'];
    }else{
        $autoFlip2 = "3000";
        if(!empty($options['fc_autoFlip'])){
            $autoFlip2 = $options['fc_autoFlip'];
        }

        $autoFlip = $autoFlip2;
    }

    $autoFlipStart = "2000";
    if( isset($atts['autoflipstart']) ){
        $autoFlipStart = $atts['autoflipstart'];
    }else{
        $autoFlipStart2 = "2000";
        if(!empty($options['fc_autoFlipStart'])){
            $autoFlipStart2 = $options['fc_autoFlipStart'];
        }

        $autoFlipStart = $autoFlipStart2;
    }

    $dataAutoFlip = "data-autoflip='$autoFlip'";
    $dataStart    = "data-start='$autoFlipStart'";

    if($type != 'fc_auto'){
        $dataAutoFlip = "";
        $dataStart    = "";      
    }


    $content = str_replace("<br />", "", $content);
    
    $cards = "";
    $cards .= "[fc_front $cssFront $style3]".getStringBetween($content, "fc_front")."[/fc_front]";
    $cards .= "[fc_back $cssBack $style3]".getStringBetween($content, "fc_back")."[/fc_back]";

  	return "
  			<div class='fc_card-container' style='$style' data-ratio='$ratio'>

  			    <div class='fc_card $type' data-direction='$direction' style='$style2' $dataAutoFlip $dataStart>
  			      ".do_shortcode($cards)."
  			    </div>
  				
  			</div>
  	";

  }

?>
