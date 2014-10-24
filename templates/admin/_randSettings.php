<div class="postbox-container memberdeck" style="width:50%; float:none;">
	<div class="metabox-holder">
		<div style="min-height:0;" class="meta-box-sortables">
			<div class="postbox">
				<h3 class="hndle"><span><?php _e('Manage User Credits', 'randide') ?></span></h3>
				<div class="inside">
					<form id="manage-credits" action="" method="post">
						<p><?php _e('Manually add or remove credits from user accounts', 'randide') ?>.</p>
						<div class="form-row">
							<label for="current-credits"><?php _e('Enter Credits', 'randide') ?></label>
							<input type="number" value="" id="user-credits" name="user_credits">
						</div>
						<div class="submit">
							<button class="button button-primary" name="rand_submit" id="rand-submit"><?php _e('Save', 'randide') ?></button>
							<button class="button"><?php _e('Cancel', 'randide') ?></button>
						</div>
					</form>
				</div>
			</div>
			
			<div class="postbox">
				<h3 class="hndle"><span><?php _e('Project Settings', 'randide') ?></span></h3>
				<div class="inside">
					<form id="manage-credits" action="" method="post">
						<p><?php _e('Add default project end date for all projects created in future', 'randide') ?>.</p>
						<div class="form-row">
							<label for="current-credits"><?php _e('Default Project End Date', 'randide') ?></label>
							<input type="text" value="<?php echo $default_proj_end_date ?>" id="default-project-end-date" name="default_project_end_date">
						</div>
						<div class="submit">
							<button class="button button-primary" name="rand_proj_date_submit" id="rand-proj-date-submit"><?php _e('Save', 'randide') ?></button>
							<button class="button"><?php _e('Cancel', 'randide') ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>