<?php $sec = $this->view->interval * 25; ?>
<input type="hidden" id="admin-ajax-url" value="<?php echo admin_url( 'admin-ajax.php' ); ?>">
<input type="hidden" id="interval" value="<?php echo $this->view->interval; ?>">
<input type="hidden" id="sec" value="<?php echo sprintf( __( '%% Utilization, %s seconds', 'hw-monitor' ), $sec ); ?>">
<div id="hwm-area"></div>
