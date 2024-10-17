
--
-- Table structure for table `team_info`
--

CREATE TABLE `team_info` (
  `id` int(11) NOT NULL,
  `uid` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT 'John Doe',
  `department` varchar(50) NOT NULL DEFAULT 'Development',
  `designation` varchar(50) NOT NULL DEFAULT 'Intern',
  `contact` varchar(20) NOT NULL DEFAULT '+8801950693473',
  `email` varchar(50) NOT NULL DEFAULT 'info@company.com',
  `job_status` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `blood_group` varchar(10) NOT NULL DEFAULT 'A+',
  `image_path` varchar(200)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL -- store password as hashes
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Indexes for table `team_info`
--
ALTER TABLE `team_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);


--
-- AUTO_INCREMENT for table `team_info`
--
ALTER TABLE `team_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;
