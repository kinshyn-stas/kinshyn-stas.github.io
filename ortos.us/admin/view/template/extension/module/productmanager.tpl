<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">

    <!-- Licensing -->
      <?php if (empty($moduleData['LicensedOn'])) { ?>
       <div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>Внимание! Не активирована версия модуля</h4>
        <div style="height:5px;"></div>
        <a class="btn btn-danger" href="javascript:void(0)" onclick="$('a[href=#isense_support]').trigger('click')">Введите номер заказа</a>
    </div>
    <?php } ?>
      <a href="#isense_support" class="hidden"></a>
      <?php if ($error_warning) { ?>
        <div class="alert alert-danger autoSlideUp"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
      <?php } ?>
      <?php if ($validation_success) { ?>
          <div class="alert alert-success autoSlideUp"><i class="fa fa-check-circle"></i> <?php echo $validation_success; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
          </div>
          <script>$('.autoSlideUp').delay(3000).fadeOut(600, function(){ $(this).show().css({'visibility':'hidden'}); }).slideUp(600);</script>
      <?php } ?>

      <div id="licenseInputs" class="form-group" style="display: none;">
          <input type="text" class="licenseCodeBox form-control" style="width: 20%; display:inline-block" placeholder="&nbsp;Номер заказа" name="License" id="moduleLicense" value="<?php echo !empty($moduleData['License']) ? $moduleData['License'] : ''?>" />
          <button type="button" class="btn btn-success btnActivateLicense" style="display: none;"><i class="fa fa-check"></i>&nbsp;Активировать</button>
      </div>

      <?php 
          $hostname = (!empty($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '' ;
          $hostname = (strstr($hostname,'http://') === false) ? 'http://'.$hostname: $hostname;
      ?>
        <span class="hidden save-changes"></span> 
        <input name="cHRpbWl6YXRpb24ef4fe" type="hidden" class="licensingFields" value="<?php echo !empty($moduleData['License']) ? base64_encode(json_encode($moduleData['License'])) : ''; ?>" />
        <input name="OaXRyb1BhY2sgLSBDb21" type="hidden" class="licensingFields" value="<?php echo !empty($moduleData['LicensedOn']) ? $moduleData['LicensedOn'] : ''; ?>" />

        <script type="text/javascript">
          var domain='<?php echo base64_encode($hostname); ?>';
          var domainraw='<?php echo $hostname; ?>';
          var timenow=<?php echo time(); ?>;
          var MID = 'AGLRX7Q9RW';

          $('.save-changes').on('click', function() {
            $('input[name=cHRpbWl6YXRpb24ef4fe]').val($('#moduleLicense').val());
            $('input[name=OaXRyb1BhY2sgLSBDb21]').val("<?php echo time(); ?>");
            $.ajax({
              url: "index.php?route=extension/module/productmanager/license&token=" + token,
              type: "POST",
              data: $('.licensingFields').serialize(),
              success: function () {
                location.reload();
              }
            });
          });
          
          $('a[href=#isense_support]').on('click', function() {
            $('#licenseInputs').fadeIn();
            $('.btnActivateLicense').fadeIn();
          });
        </script>

        <script type="text/javascript" src="view/javascript/val.js"></script>
    <!-- Licensing End -->

      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="submit" form="form-product" formaction="<?php echo $copy; ?>" data-toggle="tooltip" title="<?php echo $button_copy; ?>" class="btn btn-default"><i class="fa fa-copy"></i></button>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
        <div class="pull-right" style="margin-top: -4px;">
          <a <?php if ($excelport) { ?> href="<?php echo $excelport_link; ?>" <?php } else { ?> onclick="alert('<?php echo $excelport_error; ?>');" <?php } ?> target="_blank" data-toggle="tooltip" title="Export using ExcelPort" class="btn btn-primary btn-sm"><i style="font-size:inherit !important;font-weight: inherit !important;" class="fa fa-file-excel-o"></i>&nbsp;&nbsp;<?php echo $text_export; ?></a>
            <a id="tableColumns" data-toggle="tooltip" title="<?php echo $button_togglecolumns; ?>" class="btn btn-warning btn-sm"><i style="font-size:inherit !important;font-weight: inherit !important;" class="fa fa-table"></i>&nbsp;<?php echo $button_togglecolumns; ?></a>            
            <button data-toggle="tooltip" title="<?php echo $showhide_filter; ?>" class="btn btn-sm btn-default" onclick="$('.filter-well').toggle(250);"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>    
      </div>
      </div>
      <div class="panel-body">
        <div class="well well-sm filter-well">
          <div class="row">

            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                <input type="text" name="filter_name" value="<?php echo !empty($filter_name) ? $filter_name : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group" id="price-group">
                <label class="control-label" for="input-price"><?php echo $entry_price; ?></label>
                <div class="input-group">
                  <div class="input-group-btn">
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">Больше, чем <i class="fa fa-caret-down"></i></button>
                    <ul class="dropdown-menu">
                      <li>
                        <a data-operation=">" class="btn btn-link">Больше, чем</a>
                      </li>
                      <li>
                        <a data-operation="<" class="btn btn-link">Меньше, чем</a>
                      </li>
                      <li>
                        <a data-operation="><" class="btn btn-link">Между</a>
                      </li>
                      <li>
                        <a data-operation="=" class="btn btn-link">Равно</a>
                      </li>
                    </ul>
                  </div>
                  <input type="hidden" name="price_operation" id="price-operation" value="<?php echo !empty($price_operation) ? $price_operation : 'more_than'; ?>">
                  <input type="text" name="filter_price" value="<?php echo !empty($filter_price) ? $filter_price : ''; ?>" placeholder="<?php echo $entry_price; ?>" id="input-price" class="form-control" />
                </div>
                <div id="price-between-wrapper" style="text-align: center; margin-top: 10px; display: none;">
                  <input type="text" style="display: inline-block; width: 45%;" class="form-control" name="filter_price_from" value="<?php echo !empty($filter_price_from) ? $filter_price_from : ''; ?>" placeholder="From"/>
                  &nbsp;&&nbsp;
                  <input type="text" style="display: inline-block; width: 45%;" class="form-control" name="filter_price_to" value="<?php echo !empty($filter_price_to) ? $filter_price_to : ''; ?>" placeholder="To"/>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
                <select name="filter_status" id="input-status" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!$filter_status && !is_null($filter_status)) { ?>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                    <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-model"><?php echo $entry_model; ?></label>
                <input type="text" name="filter_model" value="<?php echo !empty($filter_model) ? $filter_model : ''; ?>" placeholder="<?php echo $entry_model; ?>" id="input-model" class="form-control" />
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group" id="quantity-group">
                <label class="control-label" for="input-quantity"><?php echo $entry_quantity; ?></label>
                <div class="input-group">
                  <div class="input-group-btn">
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">More than <i class="fa fa-caret-down"></i></button>
                    <ul class="dropdown-menu">
                      <li>
                        <a data-operation=">" class="btn btn-link">More than</a>
                      </li>
                      <li>
                        <a data-operation="<" class="btn btn-link">Less than</a>
                      </li>
                      <li>
                        <a data-operation="><" class="btn btn-link">Between</a>
                      </li>
                      <li>
                        <a data-operation="=" class="btn btn-link">Exactly</a>
                      </li>
                    </ul>
                  </div>
                  <input type="hidden" name="quantity_operation" id="quantity-operation" value="<?php echo !empty($quantity_operation) ? $quantity_operation : 'more_than'; ?>">
                  <input type="text" name="filter_quantity" value="<?php echo !empty($filter_quantity) ? $filter_quantity : ''; ?>" id="input-quantity" placeholder="<?php echo $entry_quantity; ?>" class="form-control" />
                </div>
                <div id="quantity-between-wrapper" style="text-align: center; margin-top: 10px; display: none;">
                  <input type="text" style="display: inline-block; width: 45%;" class="form-control" name="filter_quantity_from" value="<?php echo !empty($filter_quantity_from) ? $filter_quantity_from : ''; ?>" placeholder="From" />
                  &nbsp;&&nbsp;
                  <input type="text" style="display: inline-block; width: 45%;" class="form-control" name="filter_quantity_to" value="<?php echo !empty($filter_quantity_to) ? $filter_quantity_to : ''; ?>" placeholder="To" />
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-limit"><?php echo $entry_limit; ?></label>
                <input type="text" name="filter_limit" value="<?php echo !empty($filter_limit) ? $filter_limit : ''; ?>" placeholder="<?php echo $entry_limit_placeholder; ?>" id="input-limit" class="form-control" />
              </div>
            </div>

          </div>


          <div class="row">

            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-manufacturer"><?php echo $entry_manufacturer; ?></label>
                <input type="text" name="filter_manufacturer" value="<?php echo !empty($filter_manufacturer) ? $filter_manufacturer : ''; ?>" placeholder="<?php echo $entry_manufacturer; ?>" id="input-manufacturer" class="form-control" />
                <input type="hidden" name="filter_manufacturer_id" value="0" id="filter_manufacturer_id" class="form-control" />
              </div>            
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-category"><?php echo $entry_category; ?></label>
                <input type="text" name="filter_category_name" value="<?php echo !empty($filter_category) ? $filter_category : ''; ?>" placeholder="<?php echo $entry_category; ?>" id="input-category-name" class="form-control" />
                 <input type="hidden" name="filter_category" value="<?php echo !empty($filter_category) ? $filter_category : ''; ?>" placeholder="<?php echo $entry_category; ?>" id="input-category" class="form-control" />
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-sku"><?php echo $entry_sku; ?></label>
                <input type="text" name="filter_sku" value="<?php echo !empty($filter_sku) ? $filter_sku : ''; ?>" placeholder="<?php echo $entry_sku; ?>" id="input-sku" class="form-control" />
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-sm-offset-8 col-sm-4"><button type="button" id="button-filter" style="margin-top: 10px;" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button></div>
          </div>
        </div>
        <div id="popoverHiddenContent" style="display: none;">
           <div> 
            <div class="col-xs-6" style="margin:0px;padding:0 15px 0 0;">  
                  <?php $i=0; foreach ($tableData as $key => $value) { ?>                      
                      <div class="checkbox">
                          <label>
                            <input type="checkbox" class="tableColumnToggle" onclick="updateColumns(this);" data-key="<?php echo $key; ?>" /> <?php echo $value['name']; ?>
                          </label>
                      </div>
                      <?php if ($i==15) { echo "</div><div class='col-xs-6' style='margin:0px;padding:0px;'>"; } ?>
                  <?php $i++; } ?>
              </div>
              <div class="clearfix"></div>
              <em><?php echo $asterisk_warning; ?></em>
           </div>
        </div>  
        <div id="popoverHiddenTitle" style="display: none">
           <strong><?php echo $button_togglecolumns; ?>:</strong>
        </div>
        <div id="productsWrapper">
          &nbsp;
        </div>
      </div>
    </div>
  </div>
<!-- Modal Image Bulk Uploading -->
<?php require_once 'productmanager/productmanager_image_bulk.tpl'; ?>

<!-- Modal Product Quick Edit -->
<?php require_once 'productmanager/productmanager_quick_edit.tpl'; ?>

<div id="module-edit-custom-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Edit Product" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-body">
            <iframe id="module-edit-custom-iframe" frameborder="0" allowtransparency="true" seamless></iframe>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Закрыть</button>
        </div>
    </div>
  </div>
</div>
<div id="module-edit-custom-bulk-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Edit Product" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-body">
            <iframe id="module-edit-custom-bulk-iframe" frameborder="0" allowtransparency="true" seamless></iframe>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Закрыть</button>
        </div>
    </div>
  </div>
</div>
<style type="text/css">
.popover-medium {
  max-width: 600px;
  min-width: 320px;
  width: auto;
}
</style>
<script type="text/javascript"><!--
var files;
var token = '<?php echo $token; ?>';
var tax_classes = <?php echo json_encode($tax_classes); ?>;
var weight_classes = <?php echo json_encode($weight_classes); ?>;
var length_classes = <?php echo json_encode($length_classes); ?>;
var stock_statuses = <?php echo json_encode($stock_statuses); ?>;
var manufacturers = <?php echo json_encode($manufacturers); ?>;
var lang_images = <?php echo json_encode($lang_images);?>;

var bulk_atleast2 = '<?php echo $bulk_atleast2; ?>';
var bulk_zip_error = '<?php echo $bulk_zip_error; ?>';
var bulk_image_result = '<?php echo $bulk_image_result; ?>';
var confirm_bulk = '<?php echo $confirm_bulk; ?>';

var text_enabled = '<?php echo $text_enabled; ?>';
var text_disabled = '<?php echo $text_disabled; ?>';
var text_yes = '<?php echo $text_yes; ?>';
var text_no = '<?php echo $text_no; ?>';
</script>
</div>
<?php echo $footer; ?>