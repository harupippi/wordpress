<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意: 
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'wordpress');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'root');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', '');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8mb4');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Q43`9y3s{|s0hXf:S.GosT1uewa2Xr]u$s_dSw($,M@(ZIt1r.77H9RrP:+eYa(c');
define('SECURE_AUTH_KEY',  '+#;+3>f!:5c0*q*Y*N: g~(<.icw3s+w3ve+n2nHT?APrdx|OGwVar9ztoPwA3iU');
define('LOGGED_IN_KEY',    'LV:M2GR9JuOhUL=9NqhUONNm&6ep~CLr<&N/p+q{-G?PlL:?<j|(3H`5^!$U@$lo');
define('NONCE_KEY',        ']&RsxApQtOQbo|C/1=rp2sFsj/NE+0aa>RPw(Dk!AR2T;36uT|G|=|bH1:|lJ,r8');
define('AUTH_SALT',        '8z:D@oD,%|dvUi>D5Q32&!aK>gfA};4 ]bNgyjf@0];$fE{(LlP!}u%]>`N4O4tX');
define('SECURE_AUTH_SALT', 'k5++V;K+,V^cHWWwrDeeJihHBR+-sO.?V.pRCwlMwq)L_gLMRfylcri^4jyXb/-]');
define('LOGGED_IN_SALT',   '3KD+KlqUL:-TjY+Hw|Mf9BxB1iA+P|K;v7kAd|t^~(]6 z@wkpXEO|Jz(A{9y4kk');
define('NONCE_SALT',       '}6kbX+18+kJd$6A=-A|-6/sns[AM?{gI-+KW[?Rk`IIT,0be)l^Oaq&Kcgwq@L,L');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
