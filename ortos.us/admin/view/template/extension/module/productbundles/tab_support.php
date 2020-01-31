<div class="container-fluid">
	<div class="row">
  		<div class="col-md-4">
			<?php if (empty($moduleData['LicensedOn'])): ?>
    			<div class="licenseAlerts"></div>
    			<div class="licenseDiv"></div>
                <table class="table notLicensedTable">
                	<tr>
                    	<td colspan="2">
                            <div class="form-group">
                                <input type="text" class="licenseCodeBox form-control" name="<?php echo $moduleName; ?>[LicenseCode]" id="moduleLicense" value="<?php echo !empty($moduleData['LicenseCode']) ? $moduleData['LicenseCode'] : ''?>" />
                            </div>
                  		</td>
                	</tr>
              	</table>
				<?php 
                    $hostname = (!empty($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '' ;
                    $hostname = (strstr($hostname,'http://') === false) ? 'http://'.$hostname: $hostname;
                ?>
				<script type="text/javascript">
                var domain='<?php echo base64_encode($hostname); ?>';
                var domainraw='<?php echo $hostname; ?>';
                var timenow=<?php echo time(); ?>;
                var MID = 'VLS0W1DLZ0';
                </script>
                <script type="text/javascript" src="view/javascript/val.js"></script>
    		<?php endif; ?>
    
			<?php if (!empty($moduleData['LicensedOn'])): ?>
    			<input name="cHRpbWl6YXRpb24ef4fe" type="hidden" value="<?php echo base64_encode(json_encode($moduleData['License'])); ?>" />
    			<input name="OaXRyb1BhY2sgLSBDb21" type="hidden" value="<?php echo $moduleData['LicensedOn']; ?>" />
    		<?php endif; ?>
  		</div>
  
	</div>
</div>