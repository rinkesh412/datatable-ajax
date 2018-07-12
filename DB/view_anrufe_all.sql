-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql581.your-server.de
-- Generation Time: May 29, 2018 at 02:02 PM
-- Server version: 5.7.22-1
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kkdevn_db1`
--

-- --------------------------------------------------------

--
-- Structure for view `view_anrufe_all`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`kkdevn_1`@`%` SQL SECURITY DEFINER VIEW `view_anrufe_all`  AS  select `call_list_entries`.`start_time` AS `call_datetime`,(case `call_list_entries`.`detailed_call_state` when 1 then 0 else 1 end) AS `call_answered`,sec_to_time(`call_list_entries`.`duration`) AS `call_duration`,`call_direction`.`name_de` AS `call_direction`,`internalparticipant`.`number` AS `internal_number`,`internalparticipant`.`resolved_name` AS `internal_name`,`externalparticipant`.`number` AS `external_number`,`externalparticipant`.`resolved_name` AS `external_name`,(case `call_list_entries`.`transferred_from` when 3 then `transferredfromparticipant`.`resolved_name` when 4 then 'Warteschleife' else '-' end) AS `call_transferred_from`,`transfer_to_mode`.`name_de` AS `call_transferred_to`,(case when (`call_list_entries`.`pickup_participant_id` > 0) then `pickupparticipant`.`resolved_name` else '-' end) AS `call_pickuped_by`,`call_list_entries`.`number_called` AS `number_called`,cast(`call_list_entries`.`start_time` as date) AS `call_date`,cast(`call_list_entries`.`start_time` as time(6)) AS `call_time`,`call_list_entries`.`rid` AS `rid` from ((((((((((`call_list_entries` left join `call_direction` on((`call_list_entries`.`call_direction` = `call_direction`.`id`))) left join `call_list_participants` `internalparticipant` on((`call_list_entries`.`local_participant_id` = `internalparticipant`.`id`))) left join `call_list_participants` `externalparticipant` on((`call_list_entries`.`peer_participant_id` = `externalparticipant`.`id`))) left join `transfer_from_mode` on((`call_list_entries`.`transferred_from` = `transfer_from_mode`.`id`))) left join `detailed_call_state` on((`call_list_entries`.`detailed_call_state` = `detailed_call_state`.`id`))) left join `transfer_to_mode` on((`call_list_entries`.`transferred_to` = `transfer_to_mode`.`id`))) left join `call_state` on((`call_list_entries`.`call_state` = `call_state`.`id`))) left join `call_list_entry_state` on((`call_list_entries`.`call_list_entry_state_id` = `call_list_entry_state`.`id`))) left join `call_list_participants` `pickupparticipant` on((`call_list_entries`.`pickup_participant_id` = `pickupparticipant`.`id`))) left join `call_list_participants` `transferredfromparticipant` on((`call_list_entries`.`transferred_from_participant_id` = `transferredfromparticipant`.`id`))) order by `call_list_entries`.`start_time` desc ;

--
-- VIEW  `view_anrufe_all`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
