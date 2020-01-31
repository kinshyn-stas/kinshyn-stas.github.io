<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
 <div class="page-header">
    <div class="container-fluid">
      <h1><i class="fa fa-cubes"></i>&nbsp;<?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
        <div class="alert alert-danger autoSlideUp"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php } ?>
    <?php if ($success) { ?>
        <div class="alert alert-success autoSlideUp"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <script>$('.autoSlideUp').delay(3000).fadeOut(600, function(){ $(this).show().css({'visibility':'hidden'}); }).slideUp(600);</script>
    <?php } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i>&nbsp;<span style="vertical-align:middle;font-weight:bold;">Настройки модуля</span></h3>
            <div class="storeSwitcherWidget">
            	<div class="form-group">
                	<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">&nbsp;&nbsp;<?php echo $store['name']; if($store['store_id'] == 0) echo " <strong>".$text_default."</strong>"; ?>&nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                	<ul class="dropdown-menu" role="menu">
                    	<?php foreach ($stores as $st) { ?>
                            <li><a href="index.php?route=<?php echo $modulePath; ?>&store_id=<?php echo $st['store_id'];?>&token=<?php echo $token; ?>"><?php echo $st['name']; ?></a></li>
                    	<?php } ?> 
                	</ul>
            	</div>
            </div>
        </div>
        <div class="panel-body">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
            	<input type="hidden" name="store_id" value="<?php echo $store['store_id']; ?>" />
				<input type="hidden" name="<?php echo $moduleName; ?>_status" value="1" />
                <div class="tabbable">
                    <div class="tab-navigation form-inline">
                        <ul class="nav nav-tabs mainMenuTabs" id="mainTabs" role="tablist">
                            <li class="active"><a href="#controlpanel" data-toggle="tab"><i class="fa fa-power-off"></i>&nbsp;Модуль</a></li>
                            <li id="bundlesTab"><a href="#bundles" data-toggle="tab"><i class="fa fa-cubes"></i>&nbsp;Комплекты</a></li>
                            <li id="settingsTab" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-columns"></i>&nbsp;Настройки<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#widget" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i>&nbsp;Виджет комплектов</a></li>
                                    <li><a href="#view" role="tab" data-toggle="tab"><i class="fa fa-tag"></i>&nbsp;Вид комплекта</a></li>
                                    <li><a href="#listing" role="tab" data-toggle="tab"><i class="fa fa-indent"></i>&nbsp;Список комплектов</a></li>
                                </ul>
                            </li>
                            
                        </ul>
                        <div class="tab-buttons">
                            <button type="submit" class="btn btn-success save-changes"><i class="fa fa-check"></i>&nbsp;Сохранить</button>
                            <a onclick="location = '<?php echo $cancel; ?>'" class="btn btn-warning"><i class="fa fa-times"></i>&nbsp;<?php echo $button_cancel?></a>
                        </div> 
                    </div><!-- /.tab-navigation --> 
                    <div class="tab-content">
                    	<?php
                        if (!function_exists('modification_vqmod')) {
                        	function modification_vqmod($file) {
                        		if (class_exists('VQMod')) {
                       				return VQMod::modCheck(modification($file), $file);
                        		} else {
                        			return modification($file);
                       			}
                        	}
                        }
						?>
                        <div id="controlpanel" class="tab-pane active">
                          <?php require_once modification_vqmod(DIR_APPLICATION.'view/template/'.$modulePath.'/tab_controlpanel.php'); ?>                        
                        </div> 
                        <div id="bundles" class="tab-pane">
                          <?php require_once modification_vqmod(DIR_APPLICATION.'view/template/'.$modulePath.'/tab_bundles.php'); ?>                        
                        </div>    
                        <div id="listing" class="tab-pane">
                          <?php require_once modification_vqmod(DIR_APPLICATION.'view/template/'.$modulePath.'/tab_listing.php'); ?>                        
                        </div>
                        <div id="widget" class="tab-pane">
                          <?php require_once modification_vqmod(DIR_APPLICATION.'view/template/'.$modulePath.'/tab_widget.php'); ?>                        
                        </div>     
						<div id="view" class="tab-pane">
                          <?php require_once modification_vqmod(DIR_APPLICATION.'view/template/'.$modulePath.'/tab_view.php'); ?>                        
                        </div>         
                        <div class="tab-pane hidden">
                          <?php require_once modification_vqmod(DIR_APPLICATION.'view/template/'.$modulePath.'/tab_support.php'); ?>                        
                        </div>
                    </div> <!-- /.tab-content --> 
                </div><!-- /.tabbable -->
            </form>
        </div> 
    </div>
  </div>
</div>
<?php echo $footer; ?>