<?php

define('WP_HOME', 'http://dev.patrickowen.net');
define('WP_SITEURL', WP_HOME . '/site/');

define('WP_CONTENT_DIR', APP_ROOT . 'wp-content');
define('WP_CONTENT_URL', APP_ROOT . 'wp-content');

//define('ABSPATH', APP_ROOT . '/site/');

define('WP_DEBUG', true);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'po_db');

/** MySQL database username */
define('DB_USER', 'po_adm');

/** MySQL database password */
define('DB_PASSWORD', 'password');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 */
define('AUTH_KEY',         'X`Y PDf>m{D+t-b#f6t3%s$HevBD?{715b4$W+^h9G&)uMpE*.9AQgZA[9pX1PFI');
define('SECURE_AUTH_KEY',  '[3[EIhl5GT)Dqx1M- wv_.i7-dqBIR!u>W0(g25evY[Js7lLqm}:|/rd: OpWzx:');
define('LOGGED_IN_KEY',    'A|Rs0F@lxb g{ogVl-S#O _I`oP7Zg)nO-]?l@X?zWTMipja14w12+nx;S&P)~ir');
define('NONCE_KEY',        'eS_:eLe=`uW7bXqZ>PujKO');
define('AUTH_SALT',        '`Ft=m@3m[*H8UO}PHOn.$|q!LTo+sCj_Y*%rY2A+!I|:et3_ D1{]?1XP)}~I#%n');
define('SECURE_AUTH_SALT', 'GUSokY=|yA!-R%C1btZAMqQn>&%[p/!Q+n.!f4FNq|zC7wv#DRI4F{Pi^9Rq7A(E');
define('LOGGED_IN_SALT',   'e!|`)t6ls=Oi;[J6uwDt9W isAj}c6eLK@Lyx/%$R|RiiHtg1|_G3)Yul]||?Fwp');
define('NONCE_SALT',       '+ R}fNten');
/**#@-*/