CreateUsersTable: alter table `users` add unique `users_email_unique`(`email`)
CreateUsersTable: alter table `users` add unique `users_mobile_unique`(`mobile`)
CreatePasswordResetsTable: create table `password_resets` (`email` varchar(255) not null, `token` varchar(255) not null, `created_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
CreatePasswordResetsTable: alter table `password_resets` add index `password_resets_email_index`(`email`)
CreateRestaurantsTable: create table `restaurants` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `email` varchar(255) not null, `mobile` varchar(10) not null, `password` varchar(255) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
CreateRestaurantsTable: alter table `restaurants` add unique `restaurants_email_unique`(`email`)
CreateRestaurantsTable: alter table `restaurants` add unique `restaurants_mobile_unique`(`mobile`)
CreateItemsTable: create table `items` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `restaurant_id` bigint unsigned not null, `type` enum('VEG', 'NON-VEG') not null, `price` int not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
CreateItemsTable: alter table `items` add constraint `items_restaurant_id_foreign` foreign key (`restaurant_id`) references `restaurants` (`id`)
CreateOrdersTable: create table `orders` (`id` bigint unsigned not null auto_increment primary key, `user_id` bigint unsigned not null, `restaurant_id` bigint 
unsigned not null, `status` enum('CANCELED', 'PENDING', 'COMPLETED') not null, `total_amount` int not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
CreateOrdersTable: alter table `orders` add constraint `orders_user_id_foreign` foreign key (`user_id`) references `users` (`id`)
CreateOrdersTable: alter table `orders` add constraint `orders_restaurant_id_foreign` foreign key (`restaurant_id`) references `restaurants` (`id`)
CreateOrderItemsTable: create table `order_items` (`id` bigint unsigned not null auto_increment primary key, `order_id` bigint unsigned not null, `item_id` bigint unsigned not null, `quantity` int not null, `amount` int not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 
collate 'utf8mb4_unicode_ci'
CreateOrderItemsTable: alter table `order_items` add constraint `order_items_order_id_foreign` foreign key (`order_id`) references `orders` (`id`)
CreateOrderItemsTable: alter table `order_items` add constraint `order_items_item_id_foreign` foreign key (`item_id`) references `items` (`id`)
CreateOrderItemsTable: alter table `order_items` add unique `order_items_order_id_item_id_unique`(`order_id`, `item_id`)