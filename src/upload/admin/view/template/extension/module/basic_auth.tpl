<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-module" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			</div>
			<h1><?php echo $heading_title; ?></h1>
			<ul class="breadcrumb">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
			<?php } ?>
			</ul>
		</div>
	</div>
<style>
button, input, textarea {
	outline:none!important;
}
#form-module .alert.alert-info{
	margin-bottom:0px;
}
</style>
	<div class="container-fluid">
		<?php if ($error_warning) { ?>
		<div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i>&nbsp;<?php echo $error_warning ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
	    <?php } ?>
		<?php if ($success) { ?>
		<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i>&nbsp;<?php echo $success ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
	    <?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit ?></h3><h3 class="panel-title pull-right">v<?php echo $version ?></h3>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="form-module" class="form-horizontal">

					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-htpasswd_path"><span data-toggle="tooltip" title="<?php echo $entry_htpasswd_path_help ?>"><?php echo $entry_htpasswd_path ?></span></label>
						<div class="col-sm-10">
							<input type="text" name="basic_auth_htpasswd_path" id="input-htpasswd_path" placeholder="<?php echo $entry_htpasswd_path_placeholder ?>" class="form-control" value="<?php echo $basic_auth_htpasswd_path ?>">
							<?php if ($error_htpasswd_path) { ?>
								<div class="text-danger"><?php echo $error_htpasswd_path ?></div>
							<?php } ?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-user_list"><span data-toggle="tooltip" title="<?php echo $entry_user_list_help ?>"><?php echo $entry_user_list ?></span></label>
						<div class="col-sm-10">
							<textarea name="basic_auth_user_list" id="input-user_list" placeholder="<?php echo $entry_user_list_placeholder ?>" cols="30" rows="5" class="form-control"><?php echo $basic_auth_user_list ?></textarea>
							<br>
							<div class="alert alert-info"><?php echo $help_user_list ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-exclude_list"><?php echo $entry_exclude_list ?></label>
						<div class="col-sm-10">
							<textarea name="basic_auth_exclude_list" id="input-exclude_list" placeholder="<?php echo $entry_exclude_list_placeholder ?>" cols="30" rows="5" class="form-control"><?php echo $basic_auth_exclude_list ?></textarea>
							<br>
							<div class="alert alert-info"><?php echo $help_exclude_list ?></div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
<?php echo $footer ?>