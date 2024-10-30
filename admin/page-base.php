<?php
$hwm_url   = menu_page_url( 'hw-monitor/hw-monitor.php', 0 );
$tab_class = array(
	'monitor' => 'nav-tab',
	'setting' => 'nav-tab',
	'addons'  => 'nav-tab'
);
$view_file = '';

switch ( $this->view->active_tab ) {
	case 'setting':
		$tab_class['setting'] .= ' nav-tab-active';
		$view_file            = plugin_dir_path( __FILE__ ) . 'page-setting.php';
		break;

	case 'addons':
		$tab_class['addons'] .= ' nav-tab-active';
		$view_file           = plugin_dir_path( __FILE__ ) . 'page-addons.php';
		break;

	case 'monitor':
	default:
		$tab_class['monitor'] .= ' nav-tab-active';
		$view_file            = plugin_dir_path( __FILE__ ) . 'page-monitor.php';
		break;
}
?>
<div class="wrap">
	<h1>HW Monitor</h1>
	<?php settings_errors(); ?>
	<h2 class="nav-tab-wrapper">
		<a href="<?php echo esc_url( add_query_arg( array( 'tab' => 'monitor' ), $hwm_url ) ); ?>" class="<?php echo $tab_class['monitor']; ?>">
			<?php _e( 'Monitor', 'hw-monitor' ); ?>
		</a>
		<a href="<?php echo esc_url( add_query_arg( array( 'tab' => 'setting' ), $hwm_url ) ); ?>" class="<?php echo $tab_class['setting']; ?>">
			<?php _e( 'Setting', 'hw-monitor' ); ?>
		</a>
		<a href="<?php echo esc_url( add_query_arg( array( 'tab' => 'addons' ), $hwm_url ) ); ?>" class="<?php echo $tab_class['addons']; ?>">
			<?php _e( 'Add-ons', 'hw-monitor' ); ?>
		</a>
	</h2>
	<div><?php include( $view_file ); ?></div>
</div>