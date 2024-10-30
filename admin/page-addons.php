<h3><?php _e( 'Installed Add-ons', 'hw-monitor' ); ?></h3>
<ul id="hwm-addon-list">
	<?php foreach ( $this->view->info as $addon ): ?>
		<li>
			<span class="addon-name"><?php echo $addon['name']; ?></span>
			<?php if ( count( $addon['error'] ) ): ?>
				<ul class="addon-error">
					<?php foreach ( $addon['error'] as $err ): ?>
						<li>
							<div class="addon-error-message"><?php echo $err['message']; ?></div>
							<?php if ( $err['detail'] ): ?>
								<div>
									----- <?php _e( 'Detail', 'hw-monitor' ); ?> -----<br>
									<?php echo $err['detail']; ?>
								</div>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
</ul>
