<form action="<?php echo esc_url( add_query_arg( array( 'tab' => 'setting' ), $hwm_url ) ); ?>" method="post">
	<table class="form-table">
		<tr>
			<th><?php _e( "Data collection interval:", 'hw-monitor' ); ?></th>
			<td>
				<input type="number" name="interval" min="1" required value="<?php echo $this->view->interval; ?>">&nbsp;<?php _e( 'sec.', 'hw-monitor' ); ?>
			</td>
		</tr>
	</table>
	<p class="submit">
		<input type="submit" class="button button-primary" name="submit" value="<?php _e( 'Update', 'hw-monitor' ); ?>"/>
	</p>
</form>