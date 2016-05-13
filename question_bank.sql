--
-- Database: `question_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `e_id` int(4) NOT NULL,
  `difficulty` int(1) NOT NULL,
  `time_started` datetime DEFAULT CURRENT_TIMESTAMP,
  `time_taken` time DEFAULT NULL,
  `marks_obtained` int(3) NOT NULL,
  `total_marks` int(3) UNSIGNED NOT NULL,
  `u_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`e_id`, `difficulty`, `time_started`, `time_taken`, `marks_obtained`, `total_marks`, `u_id`) VALUES
(1, 2, '2016-03-29 15:12:22', '00:18:24', 56, 80, 2),
(2, 1, '2016-03-29 05:21:12', '00:14:49', 84, 120, 2);

-- --------------------------------------------------------

--
-- Table structure for table `forum_answer`
--

CREATE TABLE `forum_answer` (
  `answer_id` int(7) NOT NULL,
  `forum_id` int(7) DEFAULT NULL,
  `user_id` int(7) DEFAULT NULL,
  `answer` mediumtext COLLATE utf8mb4_bin,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `forum_answer`
--

INSERT INTO `forum_answer` (`answer_id`, `forum_id`, `user_id`, `answer`, `time_added`) VALUES
(1, 7, 2, '&amp;lt;div class="jumbotron" id="top"&amp;gt;&amp;lt;h1&amp;gt;Crackviews&amp;lt;small&amp;gt; Forum &amp;lt;/small&amp;gt;&amp;lt;/h1&amp;gt;&amp;lt;/div&amp;gt;', '2016-03-29 19:20:07'),
(2, 7, 2, '&amp;lt;body&amp;gt;&amp;lt;p&amp;gt;Lol yeah!!&amp;lt;/p&amp;gt;&amp;lt;/body&amp;gt;', '2016-03-30 22:30:49'),
(3, 7, 2, '&amp;lt;div class="jumbotron" id="top"&amp;gt;&amp;lt;h1&amp;gt;Crackviews &amp;lt;small&amp;gt;Forum&amp;lt;/small&amp;gt;&amp;lt;/h1&amp;gt;&amp;lt;/div&amp;gt;', '2016-04-02 00:17:06'),
(4, 10, 1, '&amp;lt;html&amp;gt;Nothing&amp;lt;html&amp;gt;', '2016-04-05 22:52:35'),
(5, 10, 1, 'nothing', '2016-04-05 22:52:41'),
(6, 10, 1, 'how was that done?', '2016-04-05 22:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `forum_questions`
--

CREATE TABLE `forum_questions` (
  `forum_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` mediumtext COLLATE utf8_bin NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `downvote` int(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `forum_questions`
--

INSERT INTO `forum_questions` (`forum_id`, `user_id`, `title`, `description`, `time_added`, `downvote`) VALUES
(1, 1, 'How can i take log ? ', 'hello everyone i want to take log of anyone but i dont know how to use it.\r\n\r\nplease help me ... :>)', '2016-03-16 00:56:13', 0),
(2, 1, 'what is cosine ?', 'hello can anyone explain the physical meaning of cosine?', '2016-03-16 15:52:48', 0),
(3, 1, 'who is vatsal?', 'hello who is vatsal ??', '2016-03-17 08:47:27', 0),
(4, 4, 'who is dhavan?', 'hello eho dfjdladhfhadslfhf', '2016-03-17 12:30:45', 0),
(5, 1, 'what is ms ?', 'wh at hfjadsfas djf;kjafjshfjkajfllksjfklsaflkkalj', '2016-03-19 19:05:41', 0),
(6, 0, 'Have you cleared up??', 'no description :)', '2016-03-26 06:18:34', 0),
(7, 0, 'How are you??', 'foo', '2016-03-28 04:26:45', 0),
(9, 0, '&amp;lt;code&amp;gt;Akash&amp;lt;/code&amp;gt; exists??', '..\r\n', '2016-03-29 11:49:04', 0),
(10, 0, 'Hello!', '-', '2016-04-05 17:22:21', 0);

--
-- Triggers `forum_questions`
--
DELIMITER $$
CREATE TRIGGER `downvote_limit` AFTER UPDATE ON `forum_questions` FOR EACH ROW DELETE FROM forum_questions
WHERE downvote>3
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `question_easy`
--

CREATE TABLE `question_easy` (
  `q_id` int(4) NOT NULL,
  `descript` varchar(500) COLLATE ascii_bin NOT NULL,
  `answer` varchar(1) COLLATE ascii_bin NOT NULL,
  `option_a` varchar(200) COLLATE ascii_bin DEFAULT NULL,
  `option_b` varchar(200) COLLATE ascii_bin DEFAULT NULL,
  `option_c` varchar(200) COLLATE ascii_bin DEFAULT NULL,
  `option_d` varchar(200) COLLATE ascii_bin DEFAULT NULL,
  `q_rank` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `question_easy`
--

INSERT INTO `question_easy` (`q_id`, `descript`, `answer`, `option_a`, `option_b`, `option_c`, `option_d`, `q_rank`) VALUES
(1, 'Hello??', 'a', '5', '2', '4', '3', 0),
(2, 'Lol??', 'd', '5', '2', '4', '3', 0),
(3, 'abroad??', 'c', '5', '2', '6', '3', 0),
(4, 'foreign=abroad??', 'a', 'yes', 'no', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_hard`
--

CREATE TABLE `question_hard` (
  `q_id` int(4) NOT NULL,
  `descript` varchar(500) COLLATE ascii_bin NOT NULL,
  `answer` varchar(1) COLLATE ascii_bin NOT NULL,
  `option_a` varchar(200) COLLATE ascii_bin NOT NULL,
  `option_b` varchar(200) COLLATE ascii_bin NOT NULL,
  `option_c` varchar(200) COLLATE ascii_bin NOT NULL,
  `option_d` varchar(200) COLLATE ascii_bin NOT NULL,
  `q_rank` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `question_hard`
--

INSERT INTO `question_hard` (`q_id`, `descript`, `answer`, `option_a`, `option_b`, `option_c`, `option_d`, `q_rank`) VALUES
(1, 'Hello??', 'a', '5', '2', '4', '3', 0),
(2, 'Hello??', 'a', '5', '2', '4', '3', 0),
(3, 'Hello??', 'a', '5', '2', '4', '3', 0),
(4, 'Hello??', 'a', '5', '2', '4', '3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_medium`
--

CREATE TABLE `question_medium` (
  `q_id` int(4) NOT NULL,
  `descript` varchar(500) COLLATE ascii_bin NOT NULL,
  `answer` varchar(1) COLLATE ascii_bin NOT NULL,
  `option_a` varchar(200) COLLATE ascii_bin NOT NULL,
  `option_b` varchar(200) COLLATE ascii_bin NOT NULL,
  `option_c` varchar(200) COLLATE ascii_bin NOT NULL,
  `option_d` varchar(200) COLLATE ascii_bin NOT NULL,
  `q_rank` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `question_medium`
--

INSERT INTO `question_medium` (`q_id`, `descript`, `answer`, `option_a`, `option_b`, `option_c`, `option_d`, `q_rank`) VALUES
(1, 'Hello??', 'a', '5', '2', '4', '3', 0),
(2, 'Hello??', 'a', '5', '2', '4', '3', 0),
(3, 'Hello??', 'a', '5', '2', '4', '3', 0),
(4, 'Hello??', 'a', '5', '2', '4', '3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_id` int(10) NOT NULL,
  `no_of_test_given_easy` int(3) NOT NULL DEFAULT '0',
  `no_of_test_given_medium` int(3) NOT NULL DEFAULT '0',
  `no_of_test_given_hard` int(3) NOT NULL DEFAULT '0',
  `intro` tinytext NOT NULL,
  `gender` varchar(8) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `college` text,
  `hometown` varchar(50) DEFAULT NULL,
  `experience` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`first_name`, `last_name`, `email_id`, `password`, `user_id`, `no_of_test_given_easy`, `no_of_test_given_medium`, `no_of_test_given_hard`, `intro`, `gender`, `birthdate`, `college`, `hometown`, `experience`) VALUES
('Akash', 'Patel', 'akash29697@gmail.com', 'akash1997', 1, 1, 0, 0, 'Coder, Hard Working, Perceptive about Art, Optimistic in life, bit crazy but well-mannered', '', '0000-00-00', '', 'Kapadvanj', ''),
('kenil', 'limbani', 'kenillimbani8@gmail.com', 'kenil1234', 2, 0, 0, 0, '', '', '0000-00-00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `email_id` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `forum_answer`
--
ALTER TABLE `forum_answer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `forum_questions`
--
ALTER TABLE `forum_questions`
  ADD PRIMARY KEY (`forum_id`);

--
-- Indexes for table `question_easy`
--
ALTER TABLE `question_easy`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `question_hard`
--
ALTER TABLE `question_hard`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `question_medium`
--
ALTER TABLE `question_medium`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`email_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `e_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `forum_answer`
--
ALTER TABLE `forum_answer`
  MODIFY `answer_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `forum_questions`
--
ALTER TABLE `forum_questions`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
