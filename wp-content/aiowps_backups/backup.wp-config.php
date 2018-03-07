<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'u0381560_paradizhersones');

/** Имя пользователя MySQL */
define('DB_USER', 'u0381560_pzhers');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'yv}#UIxR!LjG');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'e16s#wSyv|{hHCd)S}peVCjIefI9ChB=I%53v0s91Cry<#R&yg4q.p*J_TKmDzVa');
define('SECURE_AUTH_KEY',  'nmS#)ee(T.)e3xi$n`iE;(h/ue7vn}&pl!F*+2@Pvvagm4L7{q]mR6A=nSE, n4}');
define('LOGGED_IN_KEY',    'xZB6@1)YhO36L*l0DgYyq#$?G_mXK<_Y;5|Dd(frz2NN5ILOMqJuT0[A)1iR]?AW');
define('NONCE_KEY',        'X]g3A?mKOOH/R&ria}PTCpgfQ)~PN=ot z>.&h0*2NSdJ*A-HxoAN>A%xI!L7Fo~');
define('AUTH_SALT',        'Hz7E)/]#ZzKcZL3lML<gR6DCq@$FZ[R>@#dL-n~s6*yMT@=co?gFg-JOo3Y0$Vik');
define('SECURE_AUTH_SALT', '$j0e>g0F%Ck2i3(|^cX^g{sO}4{q!)h3DJlse/GWd/|`]fDx??(nAns[!S3&<h6R');
define('LOGGED_IN_SALT',   'hAXqr_JKP}30WEcf<(R)3C./=pkBjm9cX@mn^`j+6?Eg0_f~L8h!%cvyvR<[5KnU');
define('NONCE_SALT',       'O^EoWTh>4XR)AYM3bZKxWG Z;anpS00NSqeHP3lgFXPG|NHe+lQ]EjcPdiEN?@Lp');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'prz_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
