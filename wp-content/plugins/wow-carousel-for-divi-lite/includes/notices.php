<?php
namespace WowDiviCarouselLite;

defined( 'ABSPATH' ) || die();

class Notices {

	private static $instance = null;

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct() {
		add_action( 'admin_init', array( $this, 'admin_notice_init' ) );
		add_action( 'admin_notices', array( $this, 'black_friday_cyber_monday_deals' ), 10 );
	}

	public function admin_notice_init() {
		add_action( 'wp_ajax_dismiss_admin_notice', array( $this, 'admin_notice' ) );
	}

	public function admin_notice() {
		$option_name        = sanitize_text_field( $_POST['option_name'] );
		$dismissible_length = sanitize_text_field( $_POST['dismissible_length'] );

		if ( 'forever' != $dismissible_length ) {
			$dismissible_length = ( 0 == absint( $dismissible_length ) ) ? 1 : $dismissible_length;
			$dismissible_length = strtotime( absint( $dismissible_length ) . ' days' );
		}

		check_ajax_referer( 'dismissible-notice', 'nonce' );

		self::set_admin_notice_cache( $option_name, $dismissible_length );

		wp_die();
	}

	public static function set_admin_notice_cache( $id, $timeout ) {

		$cache_key = 'wdcl-admin-notice-' . md5( $id );

		update_site_option( $cache_key, $timeout );

		return true;
	}

	public static function is_admin_notice_active( $arg ) {
		 $array      = explode( '-', $arg );
		$length      = array_pop( $array );
		$option_name = implode( '-', $array );

		$db_record = self::get_admin_notice_cache( $option_name );

		if ( 'forever' == $db_record ) {
			return false;
		} elseif ( absint( $db_record ) >= time() ) {
			return false;
		} else {
			return true;
		}
	}

	public static function get_admin_notice_cache( $id = false ) {
		if ( ! $id ) {
			return false;
		}
		$cache_key = 'wdcl-admin-notice-' . md5( $id );
		$timeout   = get_site_option( $cache_key );
		$timeout   = 'forever' === $timeout ? time() + 60 : $timeout;

		if ( empty( $timeout ) || time() > $timeout ) {
			return false;
		}

		return $timeout;
	}

	public function get_total_interval( $interval, $type ) {
		switch ( $type ) {
			case 'years':
				return $interval->format( '%Y' );
				break;
			case 'months':
				$years  = $interval->format( '%Y' );
				$months = 0;
				if ( $years ) {
					$months += $years * 12;
				}
				$months += $interval->format( '%m' );
				return $months;
				break;
			case 'days':
				return $interval->format( '%a' );
				break;
			case 'hours':
				$days  = $interval->format( '%a' );
				$hours = 0;
				if ( $days ) {
					$hours += 24 * $days;
				}
				$hours += $interval->format( '%H' );
				return $hours;
				break;
			case 'minutes':
				$days    = $interval->format( '%a' );
				$minutes = 0;
				if ( $days ) {
					$minutes += 24 * 60 * $days;
				}
				$hours = $interval->format( '%H' );
				if ( $hours ) {
					$minutes += 60 * $hours;
				}
				$minutes += $interval->format( '%i' );
				return $minutes;
				break;
			case 'seconds':
				$days    = $interval->format( '%a' );
				$seconds = 0;
				if ( $days ) {
					$seconds += 24 * 60 * 60 * $days;
				}
				$hours = $interval->format( '%H' );
				if ( $hours ) {
					$seconds += 60 * 60 * $hours;
				}
				$minutes = $interval->format( '%i' );
				if ( $minutes ) {
					$seconds += 60 * $minutes;
				}
				$seconds += $interval->format( '%s' );
				return $seconds;
				break;
			case 'milliseconds':
				$days    = $interval->format( '%a' );
				$seconds = 0;
				if ( $days ) {
					$seconds += 24 * 60 * 60 * $days;
				}
				$hours = $interval->format( '%H' );
				if ( $hours ) {
					$seconds += 60 * 60 * $hours;
				}
				$minutes = $interval->format( '%i' );
				if ( $minutes ) {
					$seconds += 60 * $minutes;
				}
				$seconds     += $interval->format( '%s' );
				$milliseconds = $seconds * 1000;
				return $milliseconds;
				break;
			default:
				return null;
		}
	}

	public function days_differences() {

		$install_date = get_option( 'wdcl_activation_time' );

		$datetime1    = \DateTime::createFromFormat( 'U', $install_date );
		$datetime2    = \DateTime::createFromFormat( 'U', strtotime( 'now' ) );

		$interval  = $datetime2->diff( $datetime1 );
		$days_diff = $this->get_total_interval( $interval, 'days' );
		return $days_diff;

	}

	public function bf_deal( $notice_key ) { ?>

		<div data-dismissible="<?php echo esc_attr( $notice_key ); ?>" class="notice wdcl-notice notice-success is-dismissible">
			<div class="notice-right-container">
				<a href="https://wowcarousel.com/pricing/?utm_source=dashboard&utm_medium=wow&utm_campaign=BF2020" target="_blank">
					<img src="https://wowcarousel.com/wp-content/uploads/2020/11/wow-bf-2020.jpg" alt="wow carousel pro">
				</a>
			</div>
		</div>

		<?php
	}



	public function black_friday_cyber_monday_deals() {

		if ( ! self::is_admin_notice_active( 'wdcl-bf2020' ) ) {
			return;
		}

		$today       = date( 'Y-m-d' );
		$expire      = '2020-12-03';
		$today_time  = strtotime( $today );
		$expire_time = strtotime( $expire );

		if ( $expire_time >= $today_time ) {
			$this->bf_deal( 'wdcl-bf2020' );
		}

	}

}

Notices::get_instance();
