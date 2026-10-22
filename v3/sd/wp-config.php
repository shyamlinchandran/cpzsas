<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'dimsappco_wp386');

/** MySQL database username */
define('DB_USER', 'dimsappco_wp386');

/** MySQL database password */
define('DB_PASSWORD', 'd3p.SY68.x');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'hg6yvyo5lqifxmcasvdmnuqitbgbvbzir2hdzxmeo9lnvwkqh9nqbtwcrbrdafra');
define('SECURE_AUTH_KEY',  'ygyixullupnl0lycbv5jgsxlokssz9akiw32dpsc2yfm7kgnjbidpfe6gr8tubr6');
define('LOGGED_IN_KEY',    'tvivsmzygys2nxesvwvuqi38imr09misutzeomsghxbmvxvo2n3rdzr9arxugc2q');
define('NONCE_KEY',        'q8xpiyksv2yb748utrpf9cryearhabjqxbliw8nn6p9vexxgz85bxnzxmiotwtle');
define('AUTH_SALT',        'ycqnhljrgysfrgfoe0vj7ouu8cwjk3yrobfg9fh2uwfs03wht4vupvb9yjmew5ha');
define('SECURE_AUTH_SALT', 'cjbbwz9jlqe1ykadxsbgkva6rf3fiu5hq2igdpe1aczwe5x7k3mdhrwqkcjqutyi');
define('LOGGED_IN_SALT',   'migggagl01xjz6s1qwxxaxqtf7maianlq4vz5podnfzkrxdj3i0s3qpr6bjylqj3');
define('NONCE_SALT',       'j7dv94lfh0ufnwud1gyo8nuode17okpfqwpqonuwwcuz1y76spupq2zv8wtdb8jd');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpux_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
