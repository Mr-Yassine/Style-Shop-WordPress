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
define( 'DB_NAME', 'wordpress-website' );

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
define( 'AUTH_KEY',         'QQG&vavt#~tj~uZ7hsi4GYhU]p|ue_f?{-P|<}%5dGF9WxHYjCG!spS#Ho7K:%sT' );
define( 'SECURE_AUTH_KEY',  ')hrzN;.JX:AmQJP8?n?2jfS0nx::>C_}5;OAWDFQ4%IP]y@8n_(A>FrE5{.J{`{/' );
define( 'LOGGED_IN_KEY',    'WP@J``p<4::zWDYH0+,IEQMmIMky>:RT)&@<syyWVO?DQ_H=+F]pZLQ({ad5d`x6' );
define( 'NONCE_KEY',        '83=ex0wWa*Wk.7m[d:_CNF+]P48loEqXS!13?w&(F?(H$~[lnX0<pztjkDkk8#z>' );
define( 'AUTH_SALT',        'Be+e,!kMQR[_sh&6?Ja+QC`,P}Vl6g<*RjJbW9]de,Q!H?OuVc,1-=v3aisL}):i' );
define( 'SECURE_AUTH_SALT', 'GtOBAQ]>:&_DvB1?Q[HIQY6+nKj4xJ}=xbqwh-&9K-fqn/H1]3EpXbq}2u(y~c2c' );
define( 'LOGGED_IN_SALT',   'C}#i3;dI :4JOQA}[b&%bcAu?d&hcKKqgGE2vI/^f7s>=&rT!RLQ*b_z2(`:ki4b' );
define( 'NONCE_SALT',       'B4@,%*_}H=%6rcI!je{Wn-iO|.<@eeVgZw*-^dy|6bV4EG5Cq4.K/M[s[iosKcSe' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
