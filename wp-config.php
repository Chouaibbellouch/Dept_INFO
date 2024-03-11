<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link https://fr.wordpress.org/support/article/editing-wp-config-php/ Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'LIPN_DB' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'admin' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '79f7FWxoK4' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', '127.0.0.1' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'oJ{s93YOkw/c<k5L7Toj1E/h{CRy@Q=C>H=)+g!(n U#YGg&N:X?NP{mqWpJBlw_' );
define( 'SECURE_AUTH_KEY',  ')~z.}c1YQ2.e9mfIk*>)_H(kz8iFn%AcNvw_Q+xumI;-V85$KuSzAEEgxc,OkJIH' );
define( 'LOGGED_IN_KEY',    'q$tQ>-66m(j@MflM+EiBTYa>//*nfK-DeQj(e[*n,BfjGmAR:my<zewmi(<D!Yc.' );
define( 'NONCE_KEY',        'O4)&Oe5o[NUx!p0JTNCJWs>x9|Js=k}GTV6)G<o:wMzg%yxej;8?5pP*N,]&H*2|' );
define( 'AUTH_SALT',        '$PiX`T&f0*TTJKE&DnY!H28E;#o+?N;gUaKwAltZ:pftf])P]9.howX1!+x,MTM[' );
define( 'SECURE_AUTH_SALT', '3]s^R`=lda;|y]^0,pq{vV:v/Q<H7J%(eHNF-HfC;l01M&{4R,B(npqx4s*Fc~E{' );
define( 'LOGGED_IN_SALT',   'SMOq7+=]yB`6soP{cifAdUwB}+~CDplY6WJjaCxaObFmUX|C0?C:^0{d$R]mX.Q+' );
define( 'NONCE_SALT',       '[kZp|.;Kn?dmwbkttxCNCqt_MSg&xviHTLcH.gZyNUoqd&{fi$K=*k3iAOz ,nr.' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs et développeuses : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs et développeuses d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur la documentation.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
