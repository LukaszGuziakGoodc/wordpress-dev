<?php
/**
 * The base configuration for WordPress
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// --- 1. Network Settings (Docker/SSL Proxy) ---
define( 'WP_HOME', 'https://localhost:8443' );
define( 'WP_SITEURL', 'https://localhost:8443' );

// --- 2. Database Settings ---
define( 'DB_NAME',     'wpdb' );
define( 'DB_USER',     'wpuser' );
define( 'DB_PASSWORD', 'wppass' );
define( 'DB_HOST',     'db' );
define( 'DB_CHARSET',  'utf8mb4' );
define( 'DB_COLLATE',  '' );

// --- 3. Authentication Unique Keys and Salts ---
define('AUTH_KEY',         'v6Tv#}3x:olf00r8N4Ax5HR=)nHGS0$zsRc>*%Ntu7ci');
define('SECURE_AUTH_KEY',  '{,Ud64Lu}iLb!,~z&[k>o>_JQdPVs5`Hl;>=Qw`r;`lP5');
define('LOGGED_IN_KEY',    'cDB-0x{+LPVc]N[=O8.Q&KII+^=_UXpAZp^:eg{O7K;g');
define('NONCE_KEY',        'kKhcpKNgdK-W(Rl<)zgaQ4afV>UAQ?/XAnN@=)rXs8Wy');
define('AUTH_SALT',        '4AM* 2mYPZ1U0wJ=1D3~_6Pmp9ibo^j`s/DNm7@$uFwo');
define('SECURE_AUTH_SALT', '<5UJY$EptpP-o&4:;{xO<@$&j+V (m5+Kj)Wq,{b0`v');
define('LOGGED_IN_SALT',   'F+/W|oo;t%i}ququu>MdYqbsc?8PKV|h`=eY)c9gt@yt');
define('NONCE_SALT',       'qecbc;rTDGD^S*4!%sqNprmQ3hY*7qiht:gb$z:9JGN8r');

// --- 4. Database Table Prefix ---
$table_prefix = 'pww_';

// --- 5. For Developers: WordPress Debugging Mode ---
define( 'WP_DEBUG',         true );
define( 'WP_DEBUG_LOG',     false ); // To uciszy błąd "Security" natychmiast
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

// --- 6. SSL Fixes for Local Development ---
add_filter('https_local_ssl_verify', '__return_false');
add_filter('https_ssl_verify',       '__return_false');

// --- 7. FIX DLA SITE HEALTH (cURL error 7) - Wersja dla portu 8443 ---
add_filter( 'http_request_args', function( $args, $url ) {
    if ( strpos( $url, 'localhost:8443' ) !== false ) {
        $args['sslverify'] = false;
    }
    return $args;
}, 10, 2 );

add_filter( 'pre_http_request', function( $pre, $args, $url ) {
    if ( strpos( $url, 'localhost:8443' ) !== false ) {
        // Zamieniamy zewnętrzny adres localhost:8443 na wewnętrzny wp-nginx:443
        $new_url = str_replace( 'localhost:8443', 'wp-nginx', $url );
        return wp_remote_request( $new_url, $args );
    }
    return $pre;
}, 10, 3 );
// --- 8. ustawiamy no index, jest to mocnejsze zabezpieczenie niż to w panelu,  które również wykonaliśmy ---
define( 'WP_ENVIRONMENT_TYPE', 'development' );
/* That's all, stop editing! */