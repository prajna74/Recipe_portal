-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 03:23 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`follower_id`, `followed_id`) VALUES
(11, 14),
(12, 11),
(12, 13),
(13, 11),
(13, 12),
(14, 11),
(14, 12),
(15, 12),
(15, 14);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingr_id` int(11) NOT NULL,
  `ingr_name` varchar(255) DEFAULT NULL,
  `ingr_qty` varchar(100) DEFAULT NULL,
  `recipe_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingr_id`, `ingr_name`, `ingr_qty`, `recipe_id`) VALUES
(17, 'rava', '1 kg', 28),
(18, 'rava', '1 kg', 29),
(19, 'rava', '1 kg', 30),
(20, '5', 'Make green chutney Next, wash and chop the coriander and mint leaves to prepare the green chutney fo', 31),
(21, 'vegetables', '1/2 kg', 31),
(22, 'Boneless rib steak', '1.5 kg', 32),
(23, 'small pear', '1 1/2', 32),
(24, 'soya sauce', '1/4 cup', 32),
(25, 'sesame oil', '2 tb', 32),
(26, 'brown sugar', '2 tb', 32),
(27, 'Garlic', '1', 32),
(28, 'Ginger', '3', 32),
(29, 'Onion', '2', 32),
(30, 'Chopped veggies', 'few', 33),
(31, 'Green chilli', '2', 33),
(32, 'Bread', '2 slices', 33),
(33, 'cheese', '2', 33),
(34, 'Chat masala', '2 tb', 33),
(35, 'Eggs', '4', 34),
(36, 'Spinach', '.2kg', 34),
(37, 'bean salad', '400g', 34),
(38, 'Tomatoes', '2', 34),
(39, 'gg', '2 tb', 35),
(40, 'tomotoes', '2', 36),
(41, 'spinach', '80 grams', 36),
(42, 'skinless salmon fillets', '2', 36),
(43, 'oven roasted veggies', '100 grams', 37),
(44, 'kidney beans in chilly sauce', '80 grams', 37),
(45, 'mixed grain pouch', '1', 37),
(46, 'tomatoes', '2', 37),
(47, 'almonds', '150 grams', 38),
(48, 'Hazelnut', '80 grams', 39),
(49, 'dark chocolate', '150 grams', 39),
(50, 'bananas', '3', 39),
(51, 'Puff pastry', '300 grams', 39),
(52, 'Light brown sugar', '3 tb', 39),
(53, 'vanilla icecream', 'optional', 39);

-- --------------------------------------------------------

--
-- Table structure for table `post_rating`
--

CREATE TABLE `post_rating` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `rating` int(2) NOT NULL,
  `review` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_rating`
--

INSERT INTO `post_rating` (`id`, `userid`, `postid`, `rating`, `review`, `timestamp`) VALUES
(1, 12, 38, 3, 'not bad', '2020-12-26 04:58:34'),
(2, 12, 38, 4, 'Good!', '2020-12-26 04:58:56'),
(3, 12, 39, 4, 'Great recipe', '2020-12-26 05:23:35'),
(5, 13, 34, 4, 'Awesome!', '2020-12-26 05:47:14'),
(6, 13, 34, 4, 'Awesome!', '2020-12-26 05:47:26'),
(7, 11, 32, 4, 'good', '2020-12-26 08:51:44'),
(8, 11, 32, 4, 'good', '2020-12-26 08:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `r_date` datetime DEFAULT current_timestamp(),
  `prep_time` varchar(200) DEFAULT NULL,
  `image_path` varchar(300) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `r_name` varchar(500) DEFAULT NULL,
  `cat` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `r_date`, `prep_time`, `image_path`, `user_id`, `description`, `r_name`, `cat`) VALUES
(37, '2020-12-25 23:06:24', '30', 'images/vegchilli.jpg', 13, 'The easiest chilli you\'ll ever make, with ready-to-eat grains, kidney beans in chilli sauce and summer veggies - it\'s 4 of your 5-a-day too!', 'Vegetarian chilli', 'veg'),
(34, '2020-12-25 22:18:08', '20', 'images/bakedeggs.jpg', 12, 'Make these tasty easy baked eggs.', 'Saucy bean baked eggs', 'Non Veg'),
(33, '2020-12-25 21:59:34', '15', 'images/veg-grilled-sandwich.jpg', 12, 'Easy peasy lemon squeezy', 'Bombay grilled sandwich', 'veg'),
(32, '2020-12-25 21:47:13', '30', 'images/bulgogi.jpg', 15, 'Bulgogi for your rescue!', 'Bulgogi', 'Non Veg'),
(36, '2020-12-25 23:00:15', '30', 'images/Salmon-Pasta-with-Spinach-4.jpg', 14, 'A fresh, healthy pasta dish thats ready in a flash. A handful of punchy ingredients make for a colourful supper thats high in folate, fibre, iron and omega-3\r\n\r\n', 'salmon and spinach', 'Non Veg'),
(38, '2020-12-25 23:16:48', '25', 'images/almonds-and-almond-milk-1296x728.jpg', 11, 'Make your own almond milk to use as a substitute for dairy milk. Its simple to make and tastes great in porridge, smoothies and hot drinks', 'Almond milk', 'veg'),
(39, '2020-12-26 05:30:47', '30', 'images/banana_galette-5eb2549.jpg', 11, 'Impress friends and family with this simple, 5-ingredient galette with caramelised banana and chocolate. This easy dessert goes wonderfully with ice cream.', 'Caramelised banana and chocolate galette', 'veg');

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

CREATE TABLE `steps` (
  `step_id` int(11) NOT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `step_number` int(11) DEFAULT NULL,
  `step_desc` longtext DEFAULT NULL,
  `step_dur` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`step_id`, `recipe_id`, `step_number`, `step_desc`, `step_dur`) VALUES
(29, 28, 1, 'add water', 50),
(30, 29, 1, 'hh', 80),
(31, 30, 1, 'hh', 80),
(32, 31, 1, 'Chop veggies', 3),
(33, 32, 1, 'Wrap steak in plastic wrap, and place in the freezer for 30 minutes. Unwrap and slice across the grain into 1/4-inch thick slices.', 5),
(34, 32, 2, 'In a medium bowl, combine pear, soy sauce, brown sugar, sesame oil, garlic, ginger and gochujang. In a gallon size Ziploc bag, combine soy sauce mixture and steak; marinate for at least 2 hours to overnight, turning the bag occasionally.', 10),
(35, 32, 3, 'Heat 1 tablespoon vegetable oil in a cast iron grill pan over medium-high heat.* Working in batches, add steak to the grill pan in a single layer and cook, flipping once, until charred and cooked through, about 2-3 minutes per side. Repeat with remaining 1 tablespoon vegetable oil and steak.', 3),
(36, 32, 4, 'Serve immediately, garnished with green onions and sesame seeds, if desired.', 1),
(37, 33, 1, 'To prepare this yummy sandwich, peel and slice the onion and cucumber in the round shape. Wash the tomatoes and cut round slices of it as well.', 5),
(38, 33, 2, 'Next, wash and chop the coriander and mint leaves to prepare the green chutney for sandwich. Add them along with green chillies and salt in a mixer jar and blend to a smooth paste, and try not to add too much water.', 5),
(39, 33, 3, 'Trim the bread from all sides and apply butter on one bread, then apply the green chutney all over. Next, place the cucumber, tomato, onion slices over the bread slice along with potato slice. Now, sprinkle salt over the veggies along with chaat masala. Cover this slice with the other one and cut into bite-size pieces.', 3),
(40, 33, 4, 'Once you are done with placing the sandwich, spread the grated cheese over it. Grill the sandwich for around 2-3 minutes and once done, serve hot.', 2),
(41, 34, 1, 'Tip the tomatoes and bean salad into an ovenproof frying pan or shallow flameproof casserole dish. Simmer for 10 mins, or until reduced. Stir in the spinach and cook for 5 mins more until wilted. ', 5),
(42, 34, 2, 'Heat the grill to medium. Make four indentations in the mixture using the back of a spoon, then crack one egg in each. Nestle the ham in the mixture, then grill for 4-5 mins, or until the whites are set and the yolks runny. Serve with rye bread, if you like.', 10),
(43, 35, 1, 'sdfdv', 10),
(44, 36, 1, 'Cook the pasta following pack instructions. Fry the salmon for 4-6 mins with the tomatoes in their oil. Flake the fish in the pan, then add the drained pasta and the spinach. Stir for 1-2 mins until the spinach is wilted and everything is coated.', 15),
(45, 37, 1, 'Heat oven to 200C/180C fan/ gas 6. Cook the vegetables in a casserole dish for 15 mins. Tip in the beans and tomatoes, season, and cook for another 10-15 mins until piping hot. Heat the pouch in the microwave on High for 1 min and serve with the chilli.', 15),
(46, 38, 1, 'Put the almonds in a large bowl and cover with water, then cover the bowl and leave to soak overnight or for at least 4 hrs. ', 10),
(47, 38, 2, 'The next day, drain and rinse the almonds, then tip into a blender with 750ml cold water. Whizz until smooth. Pour the mixture into a muslin-lined sieve over a jug and allow it to drip through. Stir the mixture gently with a spoon to speed up the process. ', 5),
(48, 38, 3, 'When most of the liquid has gone through into the jug, gather the sides of the muslin together and squeeze tightly with both hands to extract the last of the milk.', 5),
(49, 39, 1, 'Heat the oven to 200C/180C fan/gas 6. Blitz 50g of the hazelnuts in a small food processor until they resemble fine breadcrumbs, then tip into a bowl with the chocolate.', 10),
(50, 39, 2, 'Roll the pastry out to a round roughly 30cm in diameter on a sheet of baking parchment. Scatter the chocolate and hazelnut mixture over the pastry circle, leaving a 5cm border. Top with the bananas and most of the remaining hazelnuts, then fold the edges of the pastry over. Transfer the galette to a baking sheet along with the baking parchment, then chill in the fridge for at least 10 mins.', 10),
(51, 39, 3, 'Remove from the fridge and sprinkle the sugar over the galette, then bake for 25-30 mins, or until golden and puffed up. Scatter over the remaining hazelnuts and serve with a scoop of vanilla ice cream, if you like.', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `user_image_name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `phone_no`, `email`, `description`, `user_pass`, `user_image_name`) VALUES
(11, 'Prajna', 'holla', '8762417975', 'prajnaholla29@gmail.com', 'Happy soul who is happier while cooking.', 'prajwal', 'images/profile2.png'),
(12, 'Vani', 'holla', '9449331225', 'vholla@gmail.com', 'Loves cooking', 'van', 'images/profile1.jpg'),
(13, 'Prarthana', 'k', '9449331226', 'pk29@gmail.com', 'Baby in the field ', 'prarthana', 'images/profile1.jpg'),
(14, 'Adarsh', 'M', '8762417976', 'adarshmayya@gmail.com', 'Hey there!', 'adarsh', 'images/profile5.jpg'),
(15, 'Min', 'Yoongi', '9449331235', 'meow@gmail.com', 'Annyeong', 'yoongi', 'images/profile4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`follower_id`,`followed_id`),
  ADD  KEY `followed_id` (`followed_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingr_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `post_rating`
--
ALTER TABLE `post_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `steps`
--
ALTER TABLE `steps`
  ADD PRIMARY KEY (`step_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `phone_no` (`phone_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `post_rating`
--
ALTER TABLE `post_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `steps`
--
ALTER TABLE `steps`
  MODIFY `step_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
