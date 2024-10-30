<?php
/**
 * Memory Usage add-onn (default add-on)
 */

/**
 * Get memory usage
 *
 * @param array $data
 *
 * @return array
 */
function hwm_add_mem_data( $data ) {
	$res = array(
		'id'      => 'mem_usage',
		'name'    => __( 'Memory', 'hw-monitor' ),
		'color'   => '#9C27B0',
		'summary' => '',
		'rate'    => '',
		'desc'    => array(),
		'error'   => array(),
	);

	$desc = array(
		__( 'In use', 'hw-monitor' )    => '',
		__( 'Available', 'hw-monitor' ) => '',
		__( 'Cached', 'hw-monitor' )    => '',
	);

	exec( 'free', $output, $return_var );

	if ( ! ! $return_var ) {
		$res['error'][] = array(
			'message' => __( "Failed to execute the 'free' command.", 'hw-monitor' ),
			'detail'  => '<pre>' . implode( PHP_EOL, $output ) . '</pre>',
		);
	} else {
		foreach ( $output as $row ) {
			if ( ! preg_match( '/^Mem:\s+(?<total>\d+)\s+(?<used>\d+)\s+(?<free>\d+)\s+(?<shared>\d+)\s+(?<bufferd>\d+)\s+(?<cached>\d+).*$/', $row, $m ) ) {
				continue;
			}

			$res['rate']    = (int) ( $m['used'] / $m['total'] * 100 );
			$res['summary'] = sprintf( "%.1f GB", round( $m['total'] / ( 1024 * 1024 ), 1 ) );

			$desc[ __( 'In use', 'hw-monitor' ) ]    = sprintf( "%.1f GB", round( $m['used'] / ( 1024 * 1024 ), 1 ) );
			$desc[ __( 'Available', 'hw-monitor' ) ] = sprintf( "%.1f GB", round( $m['free'] / ( 1024 * 1024 ), 1 ) );
			$desc[ __( 'Cached', 'hw-monitor' ) ]    = sprintf( "%.1f GB", round( $m['cached'] / ( 1024 * 1024 ), 1 ) );

			break;
		}

		if ( $res['rate'] === '' ) {
			$res['error'][] = array(
				'message' => __( 'Failed to acquire Memory usage rate', 'hw-monitor' ),
				'detail'  => '<pre>' . implode( PHP_EOL, $output ) . '</pre>',
			);
		}
	}

	$res['desc'] = $desc;
	$data[]      = $res;

	return $data;
}

add_filter( 'add_hwm_data', 'hwm_add_mem_data', 1 );