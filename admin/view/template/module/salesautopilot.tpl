<?php echo $header; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-salesautopilot" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid"> 
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-salesautopilot" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
            <div class="col-sm-10"><select name="salesautopilot_status" class="form-control">
                  <?php if ($salesautopilot_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $entry_salesautopilot_username; ?></label>
              <div class="col-sm-10"><input type="text" name="salesautopilot_username" value="<?php echo $salesautopilot_username; ?>" class="form-control" /></div>
          </div>
    		  <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $entry_salesautopilot_password; ?></label>
              <div class="col-sm-10"><input type="text" name="salesautopilot_password" value="<?php echo $salesautopilot_password; ?>" class="form-control" /></div>
          </div>
    		  <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $entry_salesautopilot_listid; ?></label>
              <div class="col-sm-10"><input type="text" name="salesautopilot_listid" value="<?php echo $salesautopilot_listid; ?>" class="form-control" /></div>
          </div>
    		  <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $entry_salesautopilot_formid; ?></label>
              <div class="col-sm-10"><input type="text" name="salesautopilot_formid" value="<?php echo $salesautopilot_formid; ?>" class="form-control" /></div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $entry_salesautopilot_statuschangeformid; ?></label>
              <div class="col-sm-10"><input type="text" name="salesautopilot_statuschangeformid" value="<?php echo $salesautopilot_statuschangeformid; ?>" class="form-control" /></div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $entry_debug; ?></label>
              <div class="col-sm-10"><select name="salesautopilot_debug" class="form-control">
                  <?php if ($salesautopilot_debug) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></div>
            </div>
          </table>
        </form>
    </div>
  </div>
</div>
</div>
<?php echo $footer; ?>