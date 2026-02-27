-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 27 2026 г., 21:29
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
-- Структура таблицы `booked_places`
--

CREATE TABLE `booked_places` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `restaurant` text NOT NULL,
  `date` tinytext NOT NULL,
  `time` tinytext NOT NULL,
  `fullname` tinytext NOT NULL,
  `phone` tinytext NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `booked_places`
--

INSERT INTO `booked_places` (`id`, `restaurant_id`, `restaurant`, `date`, `time`, `fullname`, `phone`, `code`) VALUES
(10, 1, '1', '20 июля', '21:00', 'Тогузов Сармат Гириханович', '+79288560709', 'BKD-AVR-751680709'),
(11, 1, '1', '21 июля', '21:00', 'Тогузов Сармат Гириханович', '+79288560709', 'BKD-AVR-402010709'),
(13, 1, '1', '20 июля', '20:00', 'Новикова Анна Ивановна', '+79934996321', 'BKD-AVR-235716321'),
(14, 1, '1', '19 июля', '20:00', 'Заебикова Зара Вадимовна', '+79882583636', 'BKD-AVR-368853636'),
(15, 1, 'ТОРНЕ', '18 июля', '22:00', 'Караева Елизавета Петровна', '+79888359985', 'BKD-AVR-403819985'),
(16, 1, 'ТОРНЕ', '18 июля', '20:00', 'Петросянц Иван', '+79997772577', 'BKD-AVR-583062577');

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
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `free_places`
--

INSERT INTO `free_places` (`id`, `restaurant_id`, `restaurant`, `date`, `time`, `address`) VALUES
(2, 1, 'ТОРНЕ', '18 июля', '16:00', 'Гизельское шоссе д.26'),
(3, 1, 'ТОРНЕ', '18 июля', '17:00', 'Гизельское шоссе д.26'),
(4, 1, 'ТОРНЕ', '18 июля', '18:00', 'Гизельское шоссе д.26'),
(5, 1, 'ТОРНЕ', '18 июля', '19:00', 'Гизельское шоссе д.26'),
(7, 1, 'ТОРНЕ', '18 июля', '17:00', 'Гизельское шоссе д.26'),
(8, 1, 'ТОРНЕ', '18 июля', '18:00', 'Гизельское шоссе д.26'),
(9, 1, 'ТОРНЕ', '18 июля', '19:00', 'Гизельское шоссе д.26'),
(10, 1, 'ТОРНЕ', '18 июля', '20:00', 'Гизельское шоссе д.26'),
(12, 1, 'ТОРНЕ', '19 июля', '16:00', 'Гизельское шоссе д.26'),
(13, 1, 'ТОРНЕ', '19 июля', '18:00', 'Гизельское шоссе д.26'),
(14, 1, 'ТОРНЕ', '19 июля', '19:00', 'Гизельское шоссе д.26'),
(16, 1, 'ТОРНЕ', '19 июля', '17:00', 'Гизельское шоссе д.26'),
(17, 1, 'ТОРНЕ', '19 июля', '18:00', 'Гизельское шоссе д.26'),
(18, 1, 'ТОРНЕ', '19 июля', '19:00', 'Гизельское шоссе д.26'),
(21, 1, 'ТОРНЕ', '20 июля', '16:00', 'Гизельское шоссе д.26'),
(22, 1, 'ТОРНЕ', '20 июля', '18:00', 'Гизельское шоссе д.26'),
(23, 1, 'ТОРНЕ', '20 июля', '19:00', 'Гизельское шоссе д.26'),
(25, 1, 'ТОРНЕ', '20 июля', '17:00', 'Гизельское шоссе д.26'),
(26, 1, 'ТОРНЕ', '20 июля', '18:00', 'Гизельское шоссе д.26'),
(27, 1, 'ТОРНЕ', '20 июля', '19:00', 'Гизельское шоссе д.26'),
(29, 1, 'ТОРНЕ', '21 июля', '16:00', 'Гизельское шоссе д.26'),
(30, 1, 'ТОРНЕ', '21 июля', '16:00', 'Гизельское шоссе д.26'),
(31, 1, 'ТОРНЕ', '21 июля', '18:00', 'Гизельское шоссе д.26'),
(32, 1, 'ТОРНЕ', '21 июля', '19:00', 'Гизельское шоссе д.26'),
(34, 1, 'ТОРНЕ', '21 июля', '17:00', 'Гизельское шоссе д.26'),
(35, 1, 'ТОРНЕ', '21 июля', '18:00', 'Гизельское шоссе д.26'),
(36, 1, 'ТОРНЕ', '21 июля', '19:00', 'Гизельское шоссе д.26');

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
  `site` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `login`, `password`, `session_token`, `description`, `img`, `site`) VALUES
(1, 'TORNE', '01AVR-TORNE', '$2y$10$OymWMGCxgZhG9V8v4iGqGOpewK/oLU.B8lhTandzkgc0Os3Z6NCke', 'fb2d94e27251cf2ee15bfdbfcd71cf842ef019accfeeaa52847329240a240579', 'Концертно-банкетный зал «Торне» — идеальное место для проведения вашего мероприятия.<br>\r\nПочему выбирают нас:<br>\r\n-Просторный зал в современном стиле с продуманной планировкой;<br>\r\n-Профессиональное оборудование: мощная звуковая система и современная светотехника;<br>\r\n-Качественная кухня с разнообразным меню на любой вкус;<br>\r\n-Удобство для гостей и организаторов;<br>\r\nМы создадим идеальную атмосферу для:<br>\r\n-Торжественных свадебных банкетов<br>\r\n-Ярких концертов и творческих вечеров<br>\r\n-Корпоративных мероприятий и презентаций<br>\r\n-Праздников любого масштаба<br>\r\n«Торне» — где технические возможности встречаются с комфортом, а ваш праздник становится незабываемым событием.<br>\r\nЗабронируйте дату для вашего мероприятия уже сегодня!', 'torne/main.png', 'https://www.mercadagroup.ru/restaurants/torne/');

--
-- Индексы сохранённых таблиц
--

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
-- AUTO_INCREMENT для таблицы `booked_places`
--
ALTER TABLE `booked_places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `free_places`
--
ALTER TABLE `free_places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
