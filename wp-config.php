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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'RvzMrLHjvtqQ7WSstxx4YphKZngsIuug6zzt+buFQDXmcnJ7LGqOUvvDSSFNx4ilI1b++WCw4VLNiZ1brN9Y3w==');
define('SECURE_AUTH_KEY',  'HkyXHLZSxZRHFBXppsXgVALkEXkOXf2OTBTfbb8U7eoQUIPSakP7ZzYhOb8zZCwEHd127/ZoWOcrPDqnQ3T/Bw==');
define('LOGGED_IN_KEY',    'x/Usc+8zELOAsSo5brRF6upGKEpToLc2ivTuhSOgCRJ+ecZLljMKrtTrZPV/avccQCGGwjxfBHsY/TvLnF9Dpg==');
define('NONCE_KEY',        'H+DoSPTiQbQ7UqcMII1yKkz5NYCoZcR7iyQtTIS4ULSN2besFCUBT9aklk5obdwgzX8/Ok5cID+k39KeNTwGxg==');
define('AUTH_SALT',        'qpIx0k2lp7G4aF+NMLa/nQ3YrBZ5326IReLrwlvEoYrv1I7ybM1lHefzP1CkaJiQ1exWagvnJMiiPHsT3eVHDw==');
define('SECURE_AUTH_SALT', 'GQyr3AZk1RxzJkGdq9djsB8QgMUiUpu/MwixIqanVfen46GZr7hUQqpoFoACndjsBntXiXX0FaKuBywEzT+sqA==');
define('LOGGED_IN_SALT',   'A9otDVUbjclqLtMwxJWPMWnUm9k035NZbYUcrA6IujAs1G06EwRMGPkgQa34MGV+eBIz0f1pEaqgO4lPWoYYUA==');
define('NONCE_SALT',       'xsF0dN0CHKnyxMzh5EGA1gvsYzpEc0RTDOQvdQJ+OqFudKQcv1yo41uZSy1s4tk0HDbvDNeXvARNcg5fLuC7uA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
