-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 14 2019 г., 14:40
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `server9`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attendees`
--

CREATE TABLE `attendees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password-hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` longtext COLLATE utf8mb4_unicode_ci,
  `linkedin_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('female','male','X') COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(10) UNSIGNED NOT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attendees`
--

INSERT INTO `attendees` (`id`, `firstname`, `lastname`, `username`, `email`, `password-hash`, `photo`, `linkedin_url`, `gender`, `age`, `api_token`, `created_at`, `updated_at`) VALUES
(5, 'attendee1', 'attendee1', 'attendee1', 'user@mail.ru', '31a2025f16fbc224f13fd3c44d441f70', 'Z:\\OpenServer\\OSPanel\\userdata\\temp\\phpB264.tmp', 'http://server9.com/BY_JS-PHP_A/edit/5', 'female', 21, '6fcf38dfc3b9d4c1816cc536efa7dcca', '2019-08-14 08:11:47', '2019-08-14 08:11:47'),
(16, 'firstname', 'lastname', 'firstname', 'attendee@mail', '31a2025f16fbc224f13fd3c44d441f70', NULL, NULL, 'female', 20, NULL, '2019-08-14 08:38:12', '2019-08-14 08:38:12'),
(17, 'firstname1', 'lastname1', 'firstname1', 'attendee2@mail', '31a2025f16fbc224f13fd3c44d441f70', NULL, NULL, 'male', 21, NULL, '2019-08-14 08:38:12', '2019-08-14 08:38:12'),
(18, 'firstname2', 'lastname2', 'firstname2', 'attendee3@mail', '31a2025f16fbc224f13fd3c44d441f70', NULL, NULL, 'female', 22, NULL, '2019-08-14 08:38:12', '2019-08-14 08:38:12'),
(19, 'firstname3', 'lastname3', 'firstname3', 'attendee4@mail', '31a2025f16fbc224f13fd3c44d441f70', NULL, NULL, 'male', 23, NULL, '2019-08-14 08:38:12', '2019-08-14 08:38:12'),
(20, 'firstname4', 'lastname4', 'firstname4', 'attendee5@mail', '31a2025f16fbc224f13fd3c44d441f70', NULL, NULL, 'female', 24, NULL, '2019-08-14 08:38:12', '2019-08-14 08:38:12');

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `duration_days` smallint(5) UNSIGNED NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `standard_price` double NOT NULL,
  `capacity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `date`, `time`, `duration_days`, `location`, `standard_price`, `capacity`) VALUES
(1, 'Web conference', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.', '2019-08-15', '08:00:00', 1, 'Floor1', 500, 250),
(2, 'Fishing experience', 'Lorem ipsum dolor sit amet, sadipscing consetetur elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.', '2019-08-30', '08:00:00', 1, 'Garden Area', 100, 30),
(5, 'WS2019', 'Desc', '2019-08-15', '11:22:00', 21, 'Floor1', 122, 10),
(6, 'WS2019', 'Desc', '2019-08-15', '11:22:00', 21, 'Floor1', 122, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `event_attendee`
--

CREATE TABLE `event_attendee` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `attendee_id` bigint(20) UNSIGNED NOT NULL,
  `registration_type` enum('early_bird','general','vip') COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_date` datetime NOT NULL,
  `calculated_price` double(8,2) UNSIGNED NOT NULL,
  `event_rating` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `event_attendee`
--

INSERT INTO `event_attendee` (`id`, `event_id`, `attendee_id`, `registration_type`, `registration_date`, `calculated_price`, `event_rating`, `created_at`, `updated_at`) VALUES
(2, 1, 5, 'early_bird', '2019-08-14 11:11:53', 425.00, NULL, NULL, NULL),
(8, 1, 16, 'early_bird', '2019-06-15 20:20:01', 425.00, NULL, NULL, NULL),
(9, 1, 17, 'vip', '2019-06-15 20:20:00', 600.00, NULL, NULL, NULL),
(10, 1, 18, 'general', '2019-06-15 20:20:00', 500.00, NULL, NULL, NULL),
(11, 1, 19, 'early_bird', '2019-06-15 20:20:00', 425.00, NULL, NULL, NULL),
(12, 1, 20, 'early_bird', '2019-06-15 20:20:00', 425.00, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_14_094835_create_attendees_table', 2),
(4, '2019_08_14_102749_create_event_attendee_table', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speaker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `event_id`, `title`, `room`, `speaker`) VALUES
(1, 1, 'CSS applied at 8:30', 'R05', 'Mac Entyre'),
(2, 1, 'JS advanced at 10:00', 'R06', 'Ann Codelle'),
(3, 2, 'fishing in troubled waters', NULL, NULL),
(4, 2, 'preparing fish for dish', NULL, NULL),
(5, 5, 'ses 1', 'Room 1', 'Speaker 1'),
(6, 5, 'Session 2', 'Room 2', 'Speaker 2');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'adminuser1', '$2y$10$mFVr6jE10jJlbjTFq3lypewE3jJPbj3SmzlblnKuNyrvAcac3By6m', NULL, '2019-08-14 05:31:07', '2019-08-14 05:31:07');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `event_attendee`
--
ALTER TABLE `event_attendee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_attendee_event_id_foreign` (`event_id`),
  ADD KEY `event_attendee_attendee_id_foreign` (`attendee_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_event_id_foreign` (`event_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attendees`
--
ALTER TABLE `attendees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `event_attendee`
--
ALTER TABLE `event_attendee`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `event_attendee`
--
ALTER TABLE `event_attendee`
  ADD CONSTRAINT `event_attendee_attendee_id_foreign` FOREIGN KEY (`attendee_id`) REFERENCES `attendees` (`id`),
  ADD CONSTRAINT `event_attendee_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Ограничения внешнего ключа таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
