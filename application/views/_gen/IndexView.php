<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Generator</title>
    <?php
    echo link_css('asset/css/bootstrap.min.css');
    echo link_css('asset/css/bootstrap-responsive.min.css');
    ?>
  </head>
  <body>

    <div class="container">
      <h1>Generator</h1>
      <?=form_open('gen/result/', array('class' => 'form-horizontal'))?>
        <div class="form-group">
          <label for="titleClass" class="col-sm-2 control-label">Title Class</label>
          <div class="col-sm-10">
            <input type="text" name="titleClass" value="" placeholder="Title">
          </div>
        </div>
        <div class="form-group">
          <label for="tableName" class="col-sm-2 control-label">Table Name</label>
          <div class="col-sm-10">
            <input type="text" name="tableName" value="" placeholder="Table Name">
          </div>
        </div>
        <div class="form-group">
          <label for="primaryKey" class="col-sm-2 control-label">PrimaryKey Table</label>
          <div class="col-sm-10">
            <input type="text" name="primaryKey" value="" placeholder="Primary Key">
          </div>
        </div>
        <div class="form-group">
          <label for="records" class="col-sm-2 control-label">Records</label>
          <div class="col-sm-10">
            <input type="text" name="records[]" value="" placeholder="Records">
            <button type="button" name="addField" id="addField" class="btn btn-primary">Add</button>
          </div>
        </div>
        <div id="attrAddField"></div>
        <div class="form-group">
          <label for="records" class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <input type="submit" name="process" value="Process" class="btn btn-success" />
          </div>
        </div>
      <?=form_close()?>
    </div>

    <?php
    echo link_js('asset/js/jquery.min.js');
    echo link_js('asset/js/jquery.ui.custom.js');
    echo link_js('asset/js/bootstrap.min.js');
    echo link_js('asset/genFile/custom.js');
    ?>
  </body>
</html>
