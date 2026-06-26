-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2026 at 03:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdad_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant_skills`
--

CREATE TABLE `applicant_skills` (
  `id` bigint(20) NOT NULL,
  `pwd_profile_id` bigint(20) NOT NULL,
  `skill_name` varchar(255) DEFAULT NULL,
  `proficiency_level` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) NOT NULL,
  `pwd_profile_id` bigint(20) NOT NULL,
  `job_post_id` bigint(20) NOT NULL,
  `application_status` varchar(50) DEFAULT 'pending',
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `company_phone` varchar(30) DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `business_permit_path` varchar(255) DEFAULT NULL,
  `verification_status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employment_predictions`
--

CREATE TABLE `employment_predictions` (
  `id` bigint(20) NOT NULL,
  `pwd_profile_id` bigint(20) NOT NULL,
  `predicted_employment_type` varchar(255) DEFAULT NULL,
  `confidence_score` decimal(5,4) DEFAULT NULL,
  `model_version` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_posts`
--

CREATE TABLE `job_posts` (
  `id` bigint(20) NOT NULL,
  `employer_id` bigint(20) NOT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `job_description` text DEFAULT NULL,
  `employment_type` varchar(100) DEFAULT NULL,
  `job_location` varchar(255) DEFAULT NULL,
  `salary_min` decimal(10,2) DEFAULT NULL,
  `salary_max` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_recommendations`
--

CREATE TABLE `job_recommendations` (
  `id` bigint(20) NOT NULL,
  `pwd_profile_id` bigint(20) NOT NULL,
  `job_post_id` bigint(20) NOT NULL,
  `similarity_score` decimal(5,4) DEFAULT NULL,
  `recommendation_rank` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_skills`
--

CREATE TABLE `job_skills` (
  `id` bigint(20) NOT NULL,
  `job_post_id` bigint(20) NOT NULL,
  `skill_name` varchar(255) DEFAULT NULL,
  `required_level` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pwd_profiles`
--

CREATE TABLE `pwd_profiles` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `registry_reference_id` bigint(20) NOT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `resume_path` varchar(255) DEFAULT NULL,
  `portfolio_path` varchar(255) DEFAULT NULL,
  `profile_completed` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pwd_registry_reference`
--

CREATE TABLE `pwd_registry_reference` (
  `id` bigint(20) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `date_issued` date NOT NULL,
  `date_expired` date NOT NULL,
  `registration_no` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `suffix` varchar(20) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `age` int(11) NOT NULL,
  `blood_type` varchar(5) DEFAULT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `sex` varchar(20) NOT NULL,
  `civil_status` varchar(30) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `nationality` varchar(50) NOT NULL DEFAULT 'Filipino',
  `mobile_no` varchar(20) DEFAULT NULL,
  `address` text NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL DEFAULT 'Mandaluyong City',
  `disability_type` varchar(100) NOT NULL,
  `disability_visibility` varchar(50) DEFAULT NULL,
  `cause_of_disability` varchar(100) DEFAULT NULL,
  `educational_attainment` varchar(100) DEFAULT NULL,
  `employment_status` varchar(50) DEFAULT NULL,
  `type_of_employment` varchar(50) DEFAULT NULL,
  `occupation_group` varchar(150) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `organization_affiliation` varchar(150) DEFAULT NULL,
  `current_assistive_device` varchar(100) DEFAULT NULL,
  `mobility_status` varchar(50) DEFAULT NULL,
  `total_family_members` int(11) DEFAULT NULL,
  `primary_caregiver` varchar(100) DEFAULT NULL,
  `emergency_contact_name` varchar(150) DEFAULT NULL,
  `emergency_contact_no` varchar(20) DEFAULT NULL,
  `contact_status` varchar(30) DEFAULT NULL,
  `pwd_id_status` varchar(30) DEFAULT NULL,
  `registration_source` varchar(100) DEFAULT NULL,
  `date_registered` date NOT NULL,
  `last_updated` date DEFAULT NULL,
  `verification_status` varchar(50) NOT NULL DEFAULT 'Pending',
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skill_gap_results`
--

CREATE TABLE `skill_gap_results` (
  `id` bigint(20) NOT NULL,
  `pwd_profile_id` bigint(20) NOT NULL,
  `job_post_id` bigint(20) NOT NULL,
  `missing_skill` varchar(255) DEFAULT NULL,
  `recommended_training_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` bigint(20) NOT NULL,
  `training_title` varchar(255) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `training_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_skills`
--

CREATE TABLE `training_skills` (
  `id` bigint(20) NOT NULL,
  `training_id` bigint(20) NOT NULL,
  `skill_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'pwd',
  `account_status` varchar(20) DEFAULT 'pending',
  `terms_accepted` tinyint(1) DEFAULT 0,
  `terms_accepted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant_skills`
--
ALTER TABLE `applicant_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicant_skills_index_18` (`pwd_profile_id`),
  ADD KEY `applicant_skills_index_19` (`skill_name`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_index_28` (`pwd_profile_id`),
  ADD KEY `applications_index_29` (`job_post_id`),
  ADD KEY `applications_index_30` (`application_status`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_logs_index_39` (`user_id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `employers_index_20` (`user_id`),
  ADD KEY `employers_index_21` (`verification_status`);

--
-- Indexes for table `employment_predictions`
--
ALTER TABLE `employment_predictions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employment_predictions_index_33` (`pwd_profile_id`);

--
-- Indexes for table `job_posts`
--
ALTER TABLE `job_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_posts_index_22` (`employer_id`),
  ADD KEY `job_posts_index_23` (`job_title`),
  ADD KEY `job_posts_index_24` (`employment_type`),
  ADD KEY `job_posts_index_25` (`status`);

--
-- Indexes for table `job_recommendations`
--
ALTER TABLE `job_recommendations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_recommendations_index_31` (`pwd_profile_id`),
  ADD KEY `job_recommendations_index_32` (`job_post_id`);

--
-- Indexes for table `job_skills`
--
ALTER TABLE `job_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_skills_index_26` (`job_post_id`),
  ADD KEY `job_skills_index_27` (`skill_name`);

--
-- Indexes for table `pwd_profiles`
--
ALTER TABLE `pwd_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `pwd_profiles_index_16` (`user_id`),
  ADD KEY `pwd_profiles_index_17` (`registry_reference_id`);

--
-- Indexes for table `pwd_registry_reference`
--
ALTER TABLE `pwd_registry_reference`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_number` (`id_number`),
  ADD UNIQUE KEY `registration_no` (`registration_no`),
  ADD KEY `pwd_registry_reference_index_0` (`id_number`),
  ADD KEY `pwd_registry_reference_index_1` (`registration_no`),
  ADD KEY `pwd_registry_reference_index_2` (`date_expired`),
  ADD KEY `pwd_registry_reference_index_3` (`last_name`),
  ADD KEY `pwd_registry_reference_index_4` (`first_name`),
  ADD KEY `pwd_registry_reference_index_5` (`sex`),
  ADD KEY `pwd_registry_reference_index_6` (`mobile_no`),
  ADD KEY `pwd_registry_reference_index_7` (`barangay`),
  ADD KEY `pwd_registry_reference_index_8` (`city`),
  ADD KEY `pwd_registry_reference_index_9` (`disability_type`),
  ADD KEY `pwd_registry_reference_index_10` (`educational_attainment`),
  ADD KEY `pwd_registry_reference_index_11` (`employment_status`),
  ADD KEY `pwd_registry_reference_index_12` (`occupation_group`),
  ADD KEY `pwd_registry_reference_index_13` (`pwd_id_status`),
  ADD KEY `pwd_registry_reference_index_14` (`date_registered`),
  ADD KEY `pwd_registry_reference_index_15` (`verification_status`);

--
-- Indexes for table `skill_gap_results`
--
ALTER TABLE `skill_gap_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skill_gap_results_index_36` (`pwd_profile_id`),
  ADD KEY `skill_gap_results_index_37` (`job_post_id`),
  ADD KEY `skill_gap_results_index_38` (`recommended_training_id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_skills`
--
ALTER TABLE `training_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_skills_index_34` (`training_id`),
  ADD KEY `training_skills_index_35` (`skill_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant_skills`
--
ALTER TABLE `applicant_skills`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employment_predictions`
--
ALTER TABLE `employment_predictions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_posts`
--
ALTER TABLE `job_posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_recommendations`
--
ALTER TABLE `job_recommendations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_skills`
--
ALTER TABLE `job_skills`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pwd_profiles`
--
ALTER TABLE `pwd_profiles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pwd_registry_reference`
--
ALTER TABLE `pwd_registry_reference`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skill_gap_results`
--
ALTER TABLE `skill_gap_results`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_skills`
--
ALTER TABLE `training_skills`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicant_skills`
--
ALTER TABLE `applicant_skills`
  ADD CONSTRAINT `applicant_skills_ibfk_1` FOREIGN KEY (`pwd_profile_id`) REFERENCES `pwd_profiles` (`id`);

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`pwd_profile_id`) REFERENCES `pwd_profiles` (`id`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`job_post_id`) REFERENCES `job_posts` (`id`);

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `employers`
--
ALTER TABLE `employers`
  ADD CONSTRAINT `employers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `employment_predictions`
--
ALTER TABLE `employment_predictions`
  ADD CONSTRAINT `employment_predictions_ibfk_1` FOREIGN KEY (`pwd_profile_id`) REFERENCES `pwd_profiles` (`id`);

--
-- Constraints for table `job_posts`
--
ALTER TABLE `job_posts`
  ADD CONSTRAINT `job_posts_ibfk_1` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`id`);

--
-- Constraints for table `job_recommendations`
--
ALTER TABLE `job_recommendations`
  ADD CONSTRAINT `job_recommendations_ibfk_1` FOREIGN KEY (`pwd_profile_id`) REFERENCES `pwd_profiles` (`id`),
  ADD CONSTRAINT `job_recommendations_ibfk_2` FOREIGN KEY (`job_post_id`) REFERENCES `job_posts` (`id`);

--
-- Constraints for table `job_skills`
--
ALTER TABLE `job_skills`
  ADD CONSTRAINT `job_skills_ibfk_1` FOREIGN KEY (`job_post_id`) REFERENCES `job_posts` (`id`);

--
-- Constraints for table `pwd_profiles`
--
ALTER TABLE `pwd_profiles`
  ADD CONSTRAINT `pwd_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pwd_profiles_ibfk_2` FOREIGN KEY (`registry_reference_id`) REFERENCES `pwd_registry_reference` (`id`);

--
-- Constraints for table `skill_gap_results`
--
ALTER TABLE `skill_gap_results`
  ADD CONSTRAINT `skill_gap_results_ibfk_1` FOREIGN KEY (`pwd_profile_id`) REFERENCES `pwd_profiles` (`id`),
  ADD CONSTRAINT `skill_gap_results_ibfk_2` FOREIGN KEY (`job_post_id`) REFERENCES `job_posts` (`id`),
  ADD CONSTRAINT `skill_gap_results_ibfk_3` FOREIGN KEY (`recommended_training_id`) REFERENCES `trainings` (`id`);

--
-- Constraints for table `training_skills`
--
ALTER TABLE `training_skills`
  ADD CONSTRAINT `training_skills_ibfk_1` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
