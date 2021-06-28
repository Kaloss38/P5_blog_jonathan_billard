-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 28 juin 2021 à 13:44
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `p5blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `content` int(11) NOT NULL,
  `creationDate` date NOT NULL,
  `validated` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`postId`,`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `title` varchar(75) NOT NULL,
  `header` varchar(155) NOT NULL,
  `content` text NOT NULL,
  `creationDate` datetime NOT NULL,
  `modificationDate` datetime DEFAULT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `userId`, `title`, `header`, `content`, `creationDate`, `modificationDate`, `thumbnail`) VALUES
(13, 1, 'Un nouvel article qui a Ã©tÃ© UPDATE coucou', 'Voici une introduction !!!!!', '<h1 style=\"text-align: center;\">Un contenu avec un titre centr&eacute;</h1><p>&nbsp;</p><p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae metus a ligula feugiat lobortis. In luctus accumsan velit, ut vestibulum erat consectetur a. Duis a metus condimentum, placerat libero nec, varius lacus. Quisque volutpat consectetur purus ac ultricies. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam suscipit id augue at venenatis. Sed nunc diam, condimentum vitae dui molestie, vehicula dictum tellus. Proin at tincidunt turpis.</p><p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Praesent ac vulputate enim, nec elementum nulla. In hac habitasse platea dictumst. Nullam non hendrerit tortor, sit amet convallis ipsum. Aliquam dignissim odio et urna malesuada venenatis. Donec ac dapibus lorem. Nulla sodales placerat sapien. Nullam id neque a enim dictum eleifend eget sit amet ex. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas condimentum finibus ligula sit amet pulvinar. Mauris posuere quam ac eros eleifend hendrerit. Sed et ipsum sit amet risus finibus consectetur vel nec justo. In volutpat, mauris ornare elementum consectetur, erat diam dapibus est, at egestas eros nulla ut odio. Ut quis velit velit. Nam eu massa at nisi egestas auctor efficitur et dolor.</p><p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Mauris pulvinar felis nec metus imperdiet porttitor. In at sodales est. Mauris est urna, fringilla non dolor et, lobortis porttitor nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Quisque ante massa, pharetra ut scelerisque lacinia, placerat in quam. Nullam id imperdiet sapien. Donec scelerisque luctus pulvinar. Phasellus vel lorem et elit placerat egestas eu ac felis. Ut malesuada scelerisque aliquet.</p><p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Fusce varius eu arcu vel porta. Donec id ipsum vitae erat volutpat egestas quis in metus. Mauris egestas consequat hendrerit. Aenean in diam sit amet mauris semper dictum. In vel sapien vel ligula hendrerit mattis id quis sem. Integer commodo a neque commodo aliquam. Nunc diam turpis, fringilla aliquet nulla non, egestas accumsan nunc.</p><p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Nunc ac nisl vitae orci placerat laoreet. Proin iaculis condimentum dui, in ultricies nulla porttitor ut. Nulla eget volutpat diam. Duis tempor dui vitae nisi consectetur porta id vel ex. Vestibulum iaculis laoreet nisi quis pulvinar. Curabitur cursus venenatis posuere. Phasellus a neque non eros convallis sollicitudin id eu velit. In rutrum lorem eget erat vulputate, nec suscipit urna sagittis. Nulla non nisl et nunc elementum tincidunt et consectetur leo. Quisque lacinia nec ipsum ut faucibus. Proin rhoncus efficitur lectus, nec consectetur sem accumsan commodo.</p>', '2021-06-14 14:41:12', '2021-06-25 16:34:42', 'public/img/2021_06_25_16_34_42.jpg'),
(26, 1, 'Test', 'Encore un test', '<p>Toujours des test</p>', '2021-06-21 13:59:02', '2021-06-25 17:29:18', 'public/img/2021_06_21_13_59_02.jpg'),
(27, 1, 'Coucou', 'Salut', '<p>Hello</p>', '2021-06-28 07:49:31', NULL, 'public/img/2021_06_28_07_49_31.jpg'),
(25, 1, 'Encore un nouvel article sur COBRA KAI qui est Ã©ditÃ©', 'Voici un article a propos de la sÃ©rie Netflix Cobra Kai', '<h1 style=\"text-align: center;\">Un contenu avec un titre centr&eacute;</h1><p>&nbsp;</p><p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae metus a ligula feugiat lobortis. In luctus accumsan velit, ut vestibulum erat consectetur a. Duis a metus condimentum, placerat libero nec, varius lacus. Quisque volutpat consectetur purus ac ultricies. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam suscipit id augue at venenatis. Sed nunc diam, condimentum vitae dui molestie, vehicula dictum tellus. Proin at tincidunt turpis.</p><p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Praesent ac vulputate enim, nec elementum nulla. In hac habitasse platea dictumst. Nullam non hendrerit tortor, sit amet convallis ipsum. Aliquam dignissim odio et urna malesuada venenatis. Donec ac dapibus lorem. Nulla sodales placerat sapien. Nullam id neque a enim dictum eleifend eget sit amet ex. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas condimentum finibus ligula sit amet pulvinar. Mauris posuere quam ac eros eleifend hendrerit. Sed et ipsum sit amet risus finibus consectetur vel nec justo. In volutpat, mauris ornare elementum consectetur, erat diam dapibus est, at egestas eros nulla ut odio. Ut quis velit velit. Nam eu massa at nisi egestas auctor efficitur et dolor.</p><p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Mauris pulvinar felis nec metus imperdiet porttitor. In at sodales est. Mauris est urna, fringilla non dolor et, lobortis porttitor nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Quisque ante massa, pharetra ut scelerisque lacinia, placerat in quam. Nullam id imperdiet sapien. Donec scelerisque luctus pulvinar. Phasellus vel lorem et elit placerat egestas eu ac felis. Ut malesuada scelerisque aliquet.</p><p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Fusce varius eu arcu vel porta. Donec id ipsum vitae erat volutpat egestas quis in metus. Mauris egestas consequat hendrerit. Aenean in diam sit amet mauris semper dictum. In vel sapien vel ligula hendrerit mattis id quis sem. Integer commodo a neque commodo aliquam. Nunc diam turpis, fringilla aliquet nulla non, egestas accumsan nunc.</p><p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Nunc ac nisl vitae orci placerat laoreet. Proin iaculis condimentum dui, in ultricies nulla porttitor ut. Nulla eget volutpat diam. Duis tempor dui vitae nisi consectetur porta id vel ex. Vestibulum iaculis laoreet nisi quis pulvinar. Curabitur cursus venenatis posuere. Phasellus a neque non eros convallis sollicitudin id eu velit. In rutrum lorem eget erat vulputate, nec suscipit urna sagittis. Nulla non nisl et nunc elementum tincidunt et consectetur leo. Quisque lacinia nec ipsum ut faucibus. Proin rhoncus efficitur lectus, nec consectetur sem accumsan commodo.</p>', '2021-06-21 13:54:01', '2021-06-21 14:08:55', 'public/img/2021_06_21_13_54_01.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `isActive` tinyint(4) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL,
  `password` varchar(50) NOT NULL,
  `token` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
