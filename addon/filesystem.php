<?php
/**
 * FileSystem Usage add-on (default add-on)
 */

/**
 * Get disk usage
 *
 * @param array $data
 *
 * @return array
 */
function hwm_add_filesystem_usage_data( $data ) {
	$res = array(
		'id'      => 'filesystem_usage',
		'name'    => __( 'FileSystem', 'hw-monitor' ),
		'color'   => '#4cAF50',
		'summary' => '',
		'rate'    => '',
		'desc'    => array(),
		'error'   => array(),
	);

	$desc = array(
		__( 'Mounted on', 'hw-monitor' ) => '',
		__( 'In use', 'hw-monitor' )     => '',
		__( 'Available', 'hw-monitor' )  => '',
	);

	exec( 'df', $output, $return_var );

	if ( ! ! $return_var ) {
		$res['error'][] = array(
			'message' => __( "Failed to execute the 'df' command.", 'hw-monitor' ),
			'detail'  => '<pre>' . implode( PHP_EOL, $output ) . '</pre>',
		);
	} else {
		$tmp = array();

		foreach ( $output as $row ) {
			if ( ! preg_match( '/^(?<fs>\S+)\s+(?<blocks>\d+)\s+(?<used>\d+)\s+(?<available>\d+)\s+(?<use>\d+)%\s+(?<mounted>\S+).*$/', $row, $m ) ) {
				continue;
			} elseif ( strpos( ABSPATH, $m['mounted'] ) !== 0 ) {
				continue;
			} elseif ( isset( $tmp['mounted'] ) && strlen( $tmp['mounted'] ) > strlen( $m['mounted'] ) ) {
				continue;
			}

			$tmp = $m;
		}

		if ( ! $tmp ) {
			$res['error'][] = array(
				'message' => __( "The output of the 'df' command is an unexpected format.", 'hw-monitor' ),
				'detail'  => '<pre>' . implode( PHP_EOL, $output ) . '</pre>',
			);
		} else {
			$res['summary'] = $tmp['fs'];
			$res['rate']    = $tmp['use'];

			$desc[ __( '* Information on the file system where WordPress of the following path is installed.', 'hw-monitor' ) ] = ABSPATH;

			$desc[ __( 'Mounted on', 'hw-monitor' ) ] = $tmp['mounted'];
			$desc[ __( 'In use', 'hw-monitor' ) ]     = sprintf( "%.1f GB", round( $tmp['used'] / ( 1000 * 1000 ), 1 ) );
			$desc[ __( 'Available', 'hw-monitor' ) ]  = sprintf( "%.1f GB", round( $tmp['available'] / ( 1000 * 1000 ), 1 ) );
		}
	}

	$res['desc'] = $desc;
	$data[]      = $res;

	return $data;
}

add_filter( 'add_hwm_data', 'hwm_add_filesystem_usage_data', 2 );
