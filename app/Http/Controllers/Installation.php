<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Installation extends Controller
{

    /**
     * @var \mysqli $c Database instance
     */
    protected $c;

    function __construct()
    {
        /**
         * Determing if the user has already installed this app
         * by checking for DB credentials
         */
       if (env('DB_PASSWORD') && env('DB_USERNAME') && env('DB_DATABASE') && env('DB_HOST')) {
           echo "<h1>Simply has already been installed</h1>";
           exit;
       }
    }

    public function index()
    {
        return view('simply.install');
    }

    public function install(Request $request)
    {
        $this->validate($request, [
            'dbUser' => 'required',
            'dbName' => 'required',
            'dbPass' => 'required',
            'dbPort' => 'required',
            'dbHost' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $this->checkConnection($request);

        if ($this->updateFile($request)) {

        } else {
            echo "There was an error installing your Simply, please go back and try again!";
            exit;
        }
    }

    public function checkConnection(Request $request)
    {

        try {
            $host = $request->get('dbHost');
            $port = $request->get('dbPort');
            $pass = $request->get('dbPass');
            $user = $request->get('dbUser');
            $name = $request->get('dbName');
            $e = $request->get('email');
            $p = $request->get('password');

            $this->c = new \mysqli($host, $user, $pass, $name, $port);

            try {
                $this->dumpUser($e, $p);
                return response()->redirectToRoute('home');
            } catch (\Exception $exception) {
                $this->rollover();
                echo "There was an error with the installation, refresh this page to continue...";
            }

        } catch (\Exception $except) {
            echo $this->getErrorMessage($except->getMessage());
            exit;
        }
    }

    public function dumpUser($e, $p)
    {
        $p = bcrypt($p);
        \DB::statement("SET NAMES utf8;");
        \DB::statement("SET time_zone = '+00:00';");
        \DB::statement("SET foreign_key_checks = 0;");
        \DB::statement("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';");
        \DB::statement("DROP TABLE IF EXISTS `users`;");
        \DB::statement("CREATE TABLE `users` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`first_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`last_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`user_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,`email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,`password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,`mobile` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`country` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,`state` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,`website` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`facebook` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,`twitter` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,`instagram` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,`gender` varchar(6) COLLATE utf8_unicode_ci NOT NULL,`image` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`),UNIQUE KEY `users_email_unique` (`email`),UNIQUE KEY `users_mobile_unique` (`mobile`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        \DB::statement("INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_name`, `email`, `password`, `mobile`, `country`, `state`, `website`, `facebook`, `twitter`, `instagram`, `gender`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES(1,'first','last','{$e}','{$e}','{$p}','01234567890',NULL,NULL,'website.com',NULL,NULL,NULL,'male','avatar-male.png',NULL,'2018-02-08 16:38:34','2018-02-08 16:38:34')");
        \DB::statement("DROP TABLE IF EXISTS `appsetting`;");
        \DB::statement("CREATE TABLE `appsetting` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`setting_id` int(10) unsigned NOT NULL,`name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`value` text COLLATE utf8_unicode_ci NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`),KEY `appsetting_setting_id_foreign` (`setting_id`),CONSTRAINT `appsetting_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `settinglist` (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        \DB::statement("INSERT INTO `appsetting` (`id`, `setting_id`, `name`, `value`, `created_at`, `updated_at`) VALUES(1,1,'name','Simply',NULL,NULL),(2,	1,'user.register','true',NULL,NULL);");
        \DB::statement("DROP TABLE IF EXISTS `categories`;");
        \DB::statement("CREATE TABLE `categories`(`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`title` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`icon` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`),UNIQUE KEY `categories_name_unique` (`name`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        \DB::statement("INSERT INTO `categories` (`id`, `name`, `title`, `icon`, `created_at`, `updated_at`) VALUES(1,'Undefined','Doesn\'t hold any category','fi-wrench',NULL,NULL);");
        \DB::statement("DROP TABLE IF EXISTS `pages`;");
        \DB::statement("CREATE TABLE `pages`(`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`title` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`description` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`content` longtext COLLATE utf8_unicode_ci NOT NULL,`author` int(10) unsigned NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,`deleted_at` timestamp NULL DEFAULT NULL,`is_a_menu` tinyint(1) NOT NULL DEFAULT '0',PRIMARY KEY (`id`),KEY `pages_author_foreign` (`author`),CONSTRAINT `pages_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        \DB::statement("INSERT INTO `pages` (`id`, `title`, `description`, `content`, `author`, `created_at`, `updated_at`, `deleted_at`, `is_a_menu`) VALUES(1,'About Us','','',1,NULL,NULL,NULL,0),(2,'Contact Us','','',1,NULL,NULL,NULL,0);");
        \DB::statement("DROP TABLE IF EXISTS `pagessetting`;");
        \DB::statement("CREATE TABLE `pagessetting` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`page_id` int(10) unsigned NOT NULL,`search` tinyint(1) NOT NULL,`share` tinyint(1) NOT NULL,`fullpage` tinyint(1) NOT NULL,`leftnav` tinyint(1) NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`),KEY `pagessetting_page_id_foreign` (`page_id`),CONSTRAINT `pagessetting_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        \DB::statement("DROP TABLE IF EXISTS `password_resets`;");
        \DB::statement("CREATE TABLE `password_resets` (`email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,`token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`created_at` timestamp NULL DEFAULT NULL,KEY `password_resets_email_index` (`email`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        \DB::statement("DROP TABLE IF EXISTS `post`;");
        \DB::statement("CREATE TABLE `post` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`title` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`description` varchar(250) COLLATE utf8_unicode_ci NOT NULL,`image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,`content` longtext COLLATE utf8_unicode_ci NOT NULL,`user_id` int(10) unsigned NOT NULL,`category_id` int(10) unsigned NOT NULL,`views` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',`tags` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`url` varchar(250) COLLATE utf8_unicode_ci NOT NULL,`type` int(11) NOT NULL DEFAULT '0' COMMENT '0 - Draft, 1 - Scheduled, 2 - Published, 3 - Deleted',`schedule` datetime DEFAULT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,`deleted_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`),UNIQUE KEY `post_url_unique` (`url`),UNIQUE KEY `post_title_unique` (`title`),KEY `post_user_id_foreign` (`user_id`),KEY `post_category_id_foreign` (`category_id`),CONSTRAINT `post_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,CONSTRAINT `post_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        \DB::statement("DROP TABLE IF EXISTS `role`;");
        \DB::statement("CREATE TABLE `role` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`description` varchar(191) COLLATE utf8_unicode_ci NOT NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        \DB::statement("INSERT INTO `role` (`id`, `name`, `description`) VALUES(1,'author','Someone who\'s access is to create content.'),(2,'administrator','Have all the access to every function on this app.');");
        \DB::statement("DROP TABLE IF EXISTS `settinglist`;");
        \DB::statement("CREATE TABLE `settinglist` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`value` varchar(191) COLLATE utf8_unicode_ci NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        \DB::statement("INSERT INTO `settinglist` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES(1,'app','Application',NULL,NULL);");
        \DB::statement("DROP TABLE IF EXISTS `userrole`;");
        \DB::statement("CREATE TABLE `userrole` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`role_id` int(10) unsigned NOT NULL,`user_id` int(10) unsigned NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`),UNIQUE KEY `userrole_user_id_unique`(`user_id`),KEY `userrole_role_id_foreign` (`role_id`),CONSTRAINT `userrole_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,CONSTRAINT `userrole_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        \DB::statement("INSERT INTO `userrole` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES(1,2,1,'2018-02-08 16:38:34','2018-02-08 16:38:34');");

    }

    public function rollover()
    {

        $env = file_get_contents(__DIR__ . '/../../../.env');

        /**
         * Changing the values in the .env file to match the once provided by the user
         */
        $newENV = preg_replace('/DB_DATABASE=(\w+)?/', "DB_DATABASE=", $env);
        $newENV = preg_replace('/DB_USERNAME=(\w+)?/', "DB_USERNAME=", $newENV);
        $newENV = preg_replace('/DB_PASSWORD=(\w+)?/', "DB_PASSWORD=", $newENV);
        $newENV = preg_replace('/DB_HOST=((\w+)(.+))?/', "DB_HOST=", $newENV);
        $newENV = preg_replace('/DB_PORT=(\w+)?/', "DB_PORT=", $newENV);

        return file_put_contents(__DIR__ . '/../../../.env', $newENV);
    }

    /**
     * Get the exception message from mysqli and
     * interprete it to something the user will understand
     * @param $message \Exception::getMessage()
     *
     * @return mixed
     */
    public function getErrorMessage($message)
    {
        $wordArray = explode(":", str_replace(" ", "", $message));
        if (in_array("(HY000/1049)", $wordArray)) {
            return "The database specified does not already exit, create it and retry again";
        } elseif (in_array("(HY000/1045)", $wordArray)) {
            return "The database username or password is not correct";
        } elseif (in_array("php_network_getaddresses", $wordArray)) {
            return "The database host cannot be connected to, please verify that it is correct";
        }
    }

    public function updateFile($request)
    {

        $env = file_get_contents(__DIR__ . '/../../../.env');

        /**
         * Changing the values in the .env file to match the once provided by the user
         */
        $newENV = preg_replace('/DB_DATABASE=(\w+)?/', "DB_DATABASE=" . $request->get('dbName'), $env);
        $newENV = preg_replace('/DB_USERNAME=(\w+)?/', "DB_USERNAME=" . $request->get('dbUser'), $newENV);
        $newENV = preg_replace('/DB_PASSWORD=(\w+)?/', "DB_PASSWORD=" . $request->get('dbPass'), $newENV);
        $newENV = preg_replace('/DB_HOST=((\w+)(.+))?/', "DB_HOST=" . $request->get('dbHost'), $newENV);
        $newENV = preg_replace('/DB_PORT=(\w+)?/', "DB_PORT=" . $request->get('dbPort'), $newENV);

        return file_put_contents(__DIR__ . '/../../../.env', $newENV);
    }

}
