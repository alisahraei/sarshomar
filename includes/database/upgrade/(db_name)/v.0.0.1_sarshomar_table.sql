CREATE TABLE `surveys` (
`id`            bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id`       int(10) UNSIGNED NOT NULL,
`title`	        varchar(500) NULL,
`lang`	        char(2) NULL,
`password`      varchar(200) NULL,
`privacy`       enum('public','private') NOT NULL DEFAULT 'public',
`status`        enum('draft','publish','expire','deleted','lock','awaiting','block','filter','close', 'full') NOT NULL DEFAULT 'draft',
`branding`      bit(1) NULL,
`brandingtitle` text CHARACTER SET utf8mb4,
`brandingdesc`  text CHARACTER SET utf8mb4,
`brandingmeta`  text CHARACTER SET utf8mb4,
`redirect`		varchar(2000) NULL,
`progresbar`    bit(1) NULL,
`trans`         mediumtext CHARACTER SET utf8mb4,
`countblock`    int(10) UNSIGNED NULL,
`email`      	bit(1) NULL,
`emailto` 		varchar(500) CHARACTER SET utf8mb4,
`emailtitle` 	varchar(500) CHARACTER SET utf8mb4,
`emailmsg`  	text CHARACTER SET utf8mb4,
`welcometitle`    text CHARACTER SET utf8mb4,
`welcomedesc`     text CHARACTER SET utf8mb4,
`welcomemedia`    text CHARACTER SET utf8mb4,
`thankyoutitle`    text CHARACTER SET utf8mb4,
`thankyoudesc`   text CHARACTER SET utf8mb4,
`thankyoumedia` text CHARACTER SET utf8mb4,
`datecreated`   timestamp DEFAULT CURRENT_TIMESTAMP,
`datemodified`  timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `surveys_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `questions` (
`id`            bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`survey_id`       bigint(20) UNSIGNED NOT NULL,
`title` 	    text CHARACTER SET utf8mb4,
`desc` 		    text CHARACTER SET utf8mb4,
`require`       bit(1) NULL,
`type`          varchar(200) NULL,
`media`         text CHARACTER SET utf8mb4,
`maxchar`       int(10) UNSIGNED NULL,
`sort`          int(10)  NULL,
`setting`       mediumtext CHARACTER SET utf8mb4,
`choice`        mediumtext CHARACTER SET utf8mb4,
`status`        enum('draft','publish','expire','deleted','lock','awaiting','block','filter','close', 'full') NOT NULL DEFAULT 'draft',
`datecreated`   timestamp DEFAULT CURRENT_TIMESTAMP,
`datemodified`  timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `questions_survey_id` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

