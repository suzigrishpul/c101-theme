<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  
 *
 * @package WordPress
 * @subpackage Bare 
 * @since Bare 1.0
 */
?>  
		<br style="clear: both;" /></div><!--main--> <br style="clear: both;" />
	</div><!--container-->
	<div class="clear"></div>
	<div id="footer">
		<div id="footer-wrapper">
			<div id="search"><form action="/" id="searchform" method="get"><input type="text" id="s" name="s" placeholder="SEARCH C-101" class="search"><input type="submit" value=">"></form>
			<div style="height:40px;">&nbsp;</div>
<?php /*
			<!-- PayPal Logo --><a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/mktg/logo/bdg_secured_by_pp_2line.png" border="0" alt="Secured by PayPal"></a><div style="text-align:center"><a href="https://www.paypal.com/webapps/mpp/how-paypal-works"></a></div><!-- PayPal Logo -->
      */?>
      <div id="google_translate_element"></div><script type="text/javascript">
      function googleTranslateElementInit() {
      new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
      }
      </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
      </div>
			<div id="credits">
			<div><span class="org-name">Conscientization 101, LLC</span><br>
			Copyright &copy;&nbsp;<?php echo date("Y");?> All Rights Reserved<br><br>
			<a href="/c101-sitemap/">site map</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/?p=1438">terms & conditions</a><br><br>
			powered by <a href="http://radicaldesigns.org" target="_blank">radicalDESIGNS</a></div>
			</div>
		</div>
	</div><!--footer-->
	<div id="footer-black"></div>
	<div id="footer-red"></div>
</div><!--wrapper-->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
