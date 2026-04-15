-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 15 2026 г., 07:18
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `avrora`
--

-- --------------------------------------------------------

--
-- Структура таблицы `appeals`
--

CREATE TABLE `appeals` (
  `id` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `fullname` char(255) NOT NULL,
  `email` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `booked_places`
--

CREATE TABLE `booked_places` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `restaurant` text NOT NULL,
  `address` text NOT NULL,
  `date` tinytext NOT NULL,
  `time` tinytext NOT NULL,
  `table_` text NOT NULL,
  `fullname` tinytext NOT NULL,
  `phone` tinytext NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `free_places`
--

CREATE TABLE `free_places` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `restaurant` text NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL,
  `table_` int(11) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `free_places`
--

INSERT INTO `free_places` (`id`, `restaurant_id`, `restaurant`, `date`, `time`, `table_`, `address`) VALUES
(2, 1, 'ТОРНЕ', '18 июля', '16:00', 1, 'Гизельское шоссе д.26'),
(3, 1, 'ТОРНЕ', '18 июля', '17:00', 1, 'Гизельское шоссе д.26'),
(4, 1, 'ТОРНЕ', '18 июля', '18:00', 1, 'Гизельское шоссе д.26'),
(5, 1, 'ТОРНЕ', '18 июля', '19:00', 1, 'Гизельское шоссе д.26'),
(7, 1, 'ТОРНЕ', '18 июля', '17:00', 1, 'Гизельское шоссе д.26'),
(8, 1, 'ТОРНЕ', '18 июля', '18:00', 1, 'Гизельское шоссе д.26'),
(9, 1, 'ТОРНЕ', '18 июля', '19:00', 1, 'Гизельское шоссе д.26'),
(12, 1, 'ТОРНЕ', '19 июля', '16:00', 1, 'Гизельское шоссе д.26'),
(13, 1, 'ТОРНЕ', '19 июля', '18:00', 1, 'Гизельское шоссе д.26'),
(14, 1, 'ТОРНЕ', '19 июля', '19:00', 1, 'Гизельское шоссе д.26'),
(16, 1, 'ТОРНЕ', '19 июля', '17:00', 1, 'Гизельское шоссе д.26'),
(17, 1, 'ТОРНЕ', '19 июля', '18:00', 1, 'Гизельское шоссе д.26'),
(18, 1, 'ТОРНЕ', '19 июля', '19:00', 1, 'Гизельское шоссе д.26'),
(21, 1, 'ТОРНЕ', '20 июля', '16:00', 1, 'Гизельское шоссе д.26'),
(23, 1, 'ТОРНЕ', '20 июля', '19:00', 1, 'Гизельское шоссе д.26'),
(27, 1, 'ТОРНЕ', '20 июля', '19:00', 1, 'Гизельское шоссе д.26'),
(29, 1, 'ТОРНЕ', '21 июля', '16:00', 1, 'Гизельское шоссе д.26'),
(30, 1, 'ТОРНЕ', '21 июля', '16:00', 1, 'Гизельское шоссе д.26'),
(31, 1, 'ТОРНЕ', '21 июля', '18:00', 1, 'Гизельское шоссе д.26'),
(35, 1, 'ТОРНЕ', '21 июля', '18:00', 1, 'Гизельское шоссе д.26'),
(36, 1, 'ТОРНЕ', '21 июля', '19:00', 1, 'Гизельское шоссе д.26'),
(39, 2, 'Vincenzo', '18 июля', '15:00', 1, 'Генерала Плиева д. 17'),
(40, 2, 'Vincenzo', '18 июля', '16:00', 2, 'Генерала Плиева д. 17'),
(41, 2, 'Vincenzo', '18 июля', '17:00', 3, 'Генерала Плиева д. 17'),
(42, 2, 'Vincenzo', '18 июля', '18:00', 4, 'Генерала Плиева д. 17'),
(43, 2, 'Vincenzo', '18 июля', '19:00', 5, 'Генерала Плиева д. 17'),
(44, 2, 'Vincenzo', '18 июля', '20:00', 1, 'Генерала Плиева д. 17'),
(45, 2, 'Vincenzo', '19 июля', '15:00', 1, 'Генерала Плиева д. 17'),
(46, 2, 'Vincenzo', '19 июля', '16:00', 2, 'Генерала Плиева д. 17'),
(47, 2, 'Vincenzo', '19 июля', '17:00', 3, 'Генерала Плиева д. 17'),
(48, 2, 'Vincenzo', '19 июля', '18:00', 4, 'Генерала Плиева д. 17'),
(49, 2, 'Vincenzo', '19 июля', '19:00', 5, 'Генерала Плиева д. 17'),
(50, 2, 'Vincenzo', '19 июля', '20:00', 1, 'Генерала Плиева д. 17'),
(51, 2, 'Vincenzo', '20 июля', '15:00', 1, 'Генерала Плиева д. 17'),
(52, 2, 'Vincenzo', '20 июля', '16:00', 2, 'Генерала Плиева д. 17'),
(53, 2, 'Vincenzo', '20 июля', '17:00', 3, 'Генерала Плиева д. 17'),
(54, 2, 'Vincenzo', '20 июля', '18:00', 4, 'Генерала Плиева д. 17'),
(55, 2, 'Vincenzo', '20 июля', '19:00', 5, 'Генерала Плиева д. 17'),
(56, 2, 'Vincenzo', '20 июля', '20:00', 1, 'Генерала Плиева д. 17'),
(57, 2, 'Vincenzo', '21 июля', '15:00', 1, 'Генерала Плиева д. 17'),
(58, 2, 'Vincenzo', '21 июля', '16:00', 2, 'Генерала Плиева д. 17'),
(59, 2, 'Vincenzo', '21 июля', '17:00', 3, 'Генерала Плиева д. 17'),
(60, 2, 'Vincenzo', '21 июля', '18:00', 4, 'Генерала Плиева д. 17'),
(61, 2, 'Vincenzo', '21 июля', '19:00', 5, 'Генерала Плиева д. 17'),
(62, 2, 'Vincenzo', '21 июля', '20:00', 1, 'Генерала Плиева д. 17'),
(63, 2, 'Vincenzo', '22 июля', '15:00', 1, 'Генерала Плиева д. 17'),
(64, 2, 'Vincenzo', '22 июля', '16:00', 2, 'Генерала Плиева д. 17'),
(65, 2, 'Vincenzo', '22 июля', '17:00', 3, 'Генерала Плиева д. 17'),
(66, 2, 'Vincenzo', '22 июля', '18:00', 4, 'Генерала Плиева д. 17'),
(67, 2, 'Vincenzo', '22 июля', '19:00', 5, 'Генерала Плиева д. 17'),
(68, 2, 'Vincenzo', '22 июля', '20:00', 1, 'Генерала Плиева д. 17'),
(69, 2, 'Vincenzo', '23 июля', '15:00', 1, 'Генерала Плиева д. 17'),
(70, 2, 'Vincenzo', '23 июля', '16:00', 2, 'Генерала Плиева д. 17'),
(71, 2, 'Vincenzo', '23 июля', '17:00', 3, 'Генерала Плиева д. 17'),
(72, 2, 'Vincenzo', '23 июля', '18:00', 4, 'Генерала Плиева д. 17'),
(73, 2, 'Vincenzo', '23 июля', '19:00', 5, 'Генерала Плиева д. 17'),
(75, 2, 'Vincenzo', '23 июля', '20:00', 1, 'Генерала Плиева д. 17');

-- --------------------------------------------------------

--
-- Структура таблицы `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `session_token` text NOT NULL,
  `description` longtext NOT NULL,
  `img` text NOT NULL,
  `site` text NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `login`, `password`, `session_token`, `description`, `img`, `site`, `address`) VALUES
(1, 'ТОРНЕ', '01AVR-TORNE', '$2y$10$OymWMGCxgZhG9V8v4iGqGOpewK/oLU.B8lhTandzkgc0Os3Z6NCke', 'fb2d94e27251cf2ee15bfdbfcd71cf842ef019accfeeaa52847329240a240579', 'Концертно-банкетный зал «Торне» — идеальное место для проведения вашего мероприятия.<br>\r\nПочему выбирают нас:<br>\r\n-Просторный зал в современном стиле с продуманной планировкой;<br>\r\n-Профессиональное оборудование: мощная звуковая система и современная светотехника;<br>\r\n-Качественная кухня с разнообразным меню на любой вкус;<br>\r\n-Удобство для гостей и организаторов;<br>\r\nМы создадим идеальную атмосферу для:<br>\r\n-Торжественных свадебных банкетов<br>\r\n-Ярких концертов и творческих вечеров<br>\r\n-Корпоративных мероприятий и презентаций<br>\r\n-Праздников любого масштаба<br>\r\n«Торне» — где технические возможности встречаются с комфортом, а ваш праздник становится незабываемым событием.<br>\r\nЗабронируйте дату для вашего мероприятия уже сегодня!', 'torne/main.png', 'https://www.mercadagroup.ru/restaurants/torne/', 'Гизельское шоссе д.26'),
(2, 'Vincenzo', '01AVR-VINCHENZO', '$2y$10$E6E4DDIDFecTKcJFJ2esOej2KWVcnvH3OTo3r52PQWWRn/pkjsQQ.', '3263d58908dda92370357116ca3e9d4015dc7134d066d252c395035f50386f82', 'Сеть хлебных магазинов «Vincenzo» – это сочетание вкусных десертов, широкого ассортимента хлебобулочных изделий, правильного кофе, комфортной атмосферы и дружественных цен. Каждое утро мы предлагаем владикавказцам более 25 сортов свежеиспеченного хлеба на все случаи трапезы – завтрак, кофе-брейк, обед (под первые и вторые блюда), легкий ужин, для бутербродов.<br><br>\r\n\r\nЛюбой кофе из «Vincenzo» можно забрать с собой на вынос в удобной фирменной упаковке, либо насладиться напитком за столиками внутри магазинов или на уютных уличных скамейках, установленных специально для наших посетителей.', 'vincenzo/main.png', 'https://www.mercadagroup.ru/restaurants/vincenczo-xleb/', 'Генерала Плиева д. 17');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appeals`
--
ALTER TABLE `appeals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `booked_places`
--
ALTER TABLE `booked_places`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `free_places`
--
ALTER TABLE `free_places`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `appeals`
--
ALTER TABLE `appeals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `booked_places`
--
ALTER TABLE `booked_places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `free_places`
--
ALTER TABLE `free_places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT для таблицы `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
