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

define( 'DB_NAME', "coronakala" );


/** MySQL database username */

define( 'DB_USER', "root" );


/** MySQL database password */

define( 'DB_PASSWORD', "jdi@zsUys12y7sdf!ddufh" );


/** MySQL hostname */

define( 'DB_HOST', "localhost" );

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

define( 'AUTH_KEY',         '>-@35*qdPKvw[V5Ce00cPa9*kUh^r?}5boKMO#_8TBH?ILqNc]]Dk2$g,Ki]H|+~' );

define( 'SECURE_AUTH_KEY',  '@j>k|/M8ORX;g@ea@{X|:#Zn:KN_Z[EJO4e84vxiwiXX:cRFMV#zBnqP-a!vIwcH' );

define( 'LOGGED_IN_KEY',    'VsCIes#]6bucF;YPn!,,usX`G3sQyNV/IBr/,ykGv4:*-&R4g7M$N~{_Z}!ALEG{' );

define( 'NONCE_KEY',        'IYu:L<(2+t]s r]M(`[I|p@QNe;8;-~TWk)3s>}Xv$r@EHqtG<P/+gB1?onv#;*k' );

define( 'AUTH_SALT',        'zB[l|j9i=D%C9lE<Hkv$YSh*L@XR2E[{n$)gxO}VZG&U~yq#N*q$T?NR9BZ@nn1J' );

define( 'SECURE_AUTH_SALT', 'P]d](/%7^R/&^^6.6{9A]`PG>F7Y4idzO[l6Yj{U94#fRA0`*rQ9uDWk%DY`YQsY' );

define( 'LOGGED_IN_SALT',   '+5P54-2{4^E](MSlW3I~>qr:5scS4JIW5+a?%:b7`KHu:UtNRSBi!Ql2!5>k;(.u' );

define( 'NONCE_SALT',       'SFwe15xlF9`?M#be:?x?ibs99B)O;{cQT%f@7~/o#:fTs!^,Gjs*8s2~exhf3d:N' );


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

 * visit the Codex.

 *

 * @link https://codex.wordpress.org/Debugging_in_WordPress

 */

define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

}


/** Sets up WordPress vars and included files. */

require_once( ABSPATH . 'wp-settings.php' );

