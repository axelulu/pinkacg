1. Pink_users表的创建结构如下：

```sql
CREATE TABLE `pink_users` (
                              `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT primary key ,
                              `user_login` varchar(60) NOT NULL DEFAULT '',
                              `user_pass` varchar(255) NOT NULL DEFAULT '',
                              `user_email` varchar(100) NOT NULL DEFAULT '',
                              `user_url` varchar(100) DEFAULT '',
                              `user_registered` datetime NOT NULL DEFAULT '1999-01-01 00:00:00',
                              `user_activation_key` varchar(255) NOT NULL DEFAULT '',
                              `display_name` varchar(60) NOT NULL DEFAULT '',
                              `description` varchar(255) DEFAULT '',
                              `user_avatar` varchar(255) DEFAULT '',
                              `user_credit` int NOT NULL DEFAULT '0',
                              `user_status` int(11) NOT NULL DEFAULT '0',
                              `user_level` tinyint NOT NULL DEFAULT '0',
                              `session_tokens` text ,
                              `sign_daily` int NOT NULL DEFAULT '0',
                              `capabilities` varchar(100) NOT NULL DEFAULT 'visitor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
```

