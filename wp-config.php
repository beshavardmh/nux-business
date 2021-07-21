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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'nux_business' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '-K@8P5[]8pRd=?,4,}P@@nhg;gC{c15,r+>P8k1p-X2H*<v*TUh3:/{WnlDFIup]' );
define( 'SECURE_AUTH_KEY',  '$4Gn@?=eyEc1fRQjtm!v$8b%;5^[!scraT*bQFe6bQWW M`~5H{S1[|4MN|b+Fy_' );
define( 'LOGGED_IN_KEY',    'Uc7YLdmQN)<*Qb@Wf%~ Bhy!ck<&MZ`zlkaSwt`wZp-h3uQNl[:m8sMDoW.NQ+zz' );
define( 'NONCE_KEY',        '^9RZYTo2SLb9Ge( Y-hZS1)a-(pMp,yfanp;/R4;$(WFq;qZpbhGt O/&WEHqZu3' );
define( 'AUTH_SALT',        '%Za+6|nQb(?nhy=a[un:%ZMU8WRn$%R,vkTz-|AIcES#`lrD6gAaB]PQeO=e1[|l' );
define( 'SECURE_AUTH_SALT', 'P)J{ZB_ti4HS3,q{}*R_Bdl^UPP.!hymioJJ kzhS6mh>:s7fb)N<mEMIo*Q2hmD' );
define( 'LOGGED_IN_SALT',   '`;9axC?W;M89c4nlM1`3YwX:^4&%Bz3~@5i zmsX9f<v-sR TW~iJPxY{C7#-L5`' );
define( 'NONCE_SALT',       'g79phUocsFH+]p(eJ&Ac~F;Q6o~/0czfc,FF@tJtE{;e?vYB=4[7&Tt7r>0fg2@}' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */

$table_prefix = 'nxb_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
