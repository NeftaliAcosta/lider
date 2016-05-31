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
define('DB_NAME', 'revista3_web');

/** MySQL database username */
define('DB_USER', 'revista3_web');

/** MySQL database password */
define('DB_PASSWORD', 'tUrG%u^[x(iz');

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
define('AUTH_KEY',         'n8&_6_XY,|6f+#)ReE^-ym=+c~ NR]9Sl9h_.!erGWR_5/%>47,9t0&`-[ZBVW]G');
define('SECURE_AUTH_KEY',  'Cw]ga3:1XQ_;vr%AD-)M(wH988h8eqWg<>af{n}XP) 8czh`3y,^hYY(lr_FAnLh');
define('LOGGED_IN_KEY',    ']Z[T%/U?{+)>E `E$nldKS^VhSIwR]%n#0}>U:x%34aFP-5;P{^I8D(hGaXLMALZ');
define('NONCE_KEY',        'q1:?l2Z>Z#OfN4{tR[IctQz?3`2IS.>l-Wh1{u8eGn4_&{N# M}lSrxu|q|K!YU.');
define('AUTH_SALT',        'mwhv+yq2zi|`&%pl}[#mKt#7jgJTGryZ`4h1.VCC2qH+w3!}}5~Sa}9kp~%u<-fg');
define('SECURE_AUTH_SALT', 'f:KA-=!QZl$V(+J,m lc_!LzGMswseI<Wc#=@ivl@U1W-e#Mu;j]x_s^2kt>+Kl5');
define('LOGGED_IN_SALT',   ',-C~krX|FBXs|.UJR|WPBQQMsWK5n&2BFBo`|lX_98#>5=%5`$+)T,{ciaN.hF,]');
define('NONCE_SALT',       'e b>R[`:u*7%ozrC&*P^1.|5V,QK019WRe1Q@|YE?>v9o+(>x|jJjQ+Mg:*:[;js');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
