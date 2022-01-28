-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 28 jan. 2022 à 14:19
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetmodalweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `ID` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `titre` varchar(256) NOT NULL,
  `contenu` text NOT NULL,
  `image` varchar(256) NOT NULL,
  `statut` varchar(20) NOT NULL DEFAULT 'attente',
  `parution` timestamp NOT NULL DEFAULT current_timestamp(),
  `maj` timestamp NOT NULL DEFAULT current_timestamp(),
  `nb_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`ID`, `id_auteur`, `titre`, `contenu`, `image`, `statut`, `parution`, `maj`, `nb_like`) VALUES
(1, 1, 'Création du binet kI', 'Le binet kI est au binet iK ce que Le Gorafi est au Figaro, c\'est-à-dire une parodie amusante qui utilise l\'humour pour faire rire ses lecteurs.\r\n\r\nC\'est un journal collaboratif, écrit par ses reporters. N\'importe qui peut faire une demande aux administrateurs pour devenir reporter - dégainez votre plume et rejoignez-nous !', 'img_kI', 'valide', '2021-12-17 14:39:45', '2021-12-17 14:39:45', 1),
(2, 1, 'Un deuxième article !', 'Et de deux.\r\nDeux, c\'est mieux que un, mais toujours moins que le nombre d\'articles par iK.\r\n\r\nJ\'appelle donc tous les journalistes du site à se mobiliser pour en avoir plein !\r\n\r\nCa rendra le site plus intéressant. En effet, la section \"populaire\" doit faire une liste de 5 articles, donc bon...', 'img_kI', 'valide', '2021-12-17 15:53:17', '2021-12-17 15:53:17', 0),
(3, 4, 'Le binet kI grandit !', '<p>Le binet kI se d&eacute;veloppe. Pour la premi&egrave;re fois, un article a &eacute;t&eacute; soumis depuis le site du binet ! C\'est une grande nouvelle pour la libert&eacute; d\'expression &agrave; l\'X. Pour publier dans l\'iK, les X doivent suivre une proc&eacute;dure tr&egrave;s tr&egrave;s compliqu&eacute;e pleines d\'emb&ucirc;ches :</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;- &eacute;crire un article sur un doc Word</p>\r\n<p>&nbsp;- se connecter sur Zimbra ou sur toute autre bo&icirc;te mail</p>\r\n<p>&nbsp;- chercher le mail du binet iK ou du kessier iK</p>\r\n<p>&nbsp;- &eacute;crire un mail expliquant qu\'on veut publier un article dans l\'iK</p>\r\n<p>&nbsp;- mettre en PJ l\'article qu\'on veut mettre</p>\r\n<p>&nbsp;- recevoir une r&eacute;ponse du binet iK qui demande de corriger des fautes d\'orthographe</p>\r\n<p>&nbsp;- corriger les fautes</p>\r\n<p>&nbsp;-&nbsp; &nbsp;recommencer &agrave; partir de l\'&eacute;tape 2</p>\r\n<p>&nbsp;- ...</p>\r\n<p>&nbsp;</p>\r\n<p>C\'est long et compliqu&eacute; ! Tandis que sur le site du kI, c\'est beaucoup plus simple ! Si vous &ecirc;tes journaliste, il suffira d\'UNE SEULE &eacute;tape :</p>\r\n<p>&nbsp;- vous vous connectez ; vous cliquez sur \"&eacute;crire un article\" ; vous l\'&eacute;crivez ; vous le soumettez !</p>\r\n<p>&nbsp;</p>\r\n<p>Et si vous n\'&ecirc;tes encore que simple visiteur, pas de panique. Deux &eacute;tapes suffiront pour devenir journaliste :</p>\r\n<p>&nbsp;- se connecter</p>\r\n<p>&nbsp;- cliquer sur \"Devenir journaliste\" et suivre la proc&eacute;dure qui s\'affiche &agrave; l\'&eacute;cran</p>\r\n<p>Encore une fois, simple comme bonjour. Alors,&nbsp;<strong>n\'h&eacute;sitez plus :</strong></p>\r\n<p><span style=\"font-size: 24pt;\">DEVENEZ JOURNALISTE kI</span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'img_kI', 'valide', '2021-12-22 11:09:18', '2021-12-22 16:19:44', 0),
(4, 4, 'Le binet kI grandit !', '<p>Le binet kI se d&eacute;veloppe. Pour la premi&egrave;re fois, un article a &eacute;t&eacute; soumis depuis le site du binet ! C\'est une grande nouvelle pour la libert&eacute; d\'expression &agrave; l\'X. Pour publier dans l\'iK, les X doivent suivre une proc&eacute;dure tr&egrave;s tr&egrave;s compliqu&eacute;e pleines d\'emb&ucirc;ches :</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;- &eacute;crire un article sur un doc Word</p>\r\n<p>&nbsp;- se connecter sur Zimbra ou sur toute autre bo&icirc;te mail</p>\r\n<p>&nbsp;- chercher le mail du binet iK ou du kessier iK</p>\r\n<p>&nbsp;- &eacute;crire un mail expliquant qu\'on veut publier un article dans l\'iK</p>\r\n<p>&nbsp;- mettre en PJ l\'article qu\'on veut mettre</p>\r\n<p>&nbsp;- recevoir une r&eacute;ponse du binet iK qui demande de corriger des fautes d\'orthographe</p>\r\n<p>&nbsp;- corriger les fautes</p>\r\n<p>&nbsp;-&nbsp; &nbsp;recommencer &agrave; partir de l\'&eacute;tape 2</p>\r\n<p>&nbsp;- ...</p>\r\n<p>&nbsp;</p>\r\n<p>C\'est long et compliqu&eacute; ! Tandis que sur le site du kI, c\'est beaucoup plus simple ! Si vous &ecirc;tes journaliste, il suffira d\'UNE SEULE &eacute;tape :</p>\r\n<p>&nbsp;- vous vous connectez ; vous cliquez sur \"&eacute;crire un article\" ; vous l\'&eacute;crivez ; vous le soumettez !</p>\r\n<p>&nbsp;</p>\r\n<p>Et si vous n\'&ecirc;tes encore que simple visiteur, pas de panique. Deux &eacute;tapes suffiront pour devenir journaliste :</p>\r\n<p>&nbsp;- se connecter</p>\r\n<p>&nbsp;- cliquer sur \"Devenir journaliste\" et suivre la proc&eacute;dure qui s\'affiche &agrave; l\'&eacute;cran</p>\r\n<p>Encore une fois, simple comme bonjour. Alors,&nbsp;<strong>n\'h&eacute;sitez plus :</strong></p>\r\n<p><span style=\"font-size: 24pt;\">DEVENEZ JOURNALISTE kI</span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'img_kI', 'attente', '2021-12-22 11:10:09', '2021-12-22 17:07:57', 0),
(5, 4, 'Test de sécurité', '<p>Si vous voyez juste &eacute;crit une balise script avec une insctruction JS, et que rien n\'a pop&eacute;, alors c\'est que tiny a bien g&eacute;r&eacute; ses bails. Sinon, c\'est la merde galactique.</p>', 'img_kI', 'refuse', '2021-12-22 11:17:23', '2021-12-22 17:08:14', 0),
(6, 4, 'Tentative de fraude 2', '<p>&lt;script&gt;alert(\"vuln&eacute;rable\");&lt;/script&gt;</p>', 'img_kI', 'refuse', '2021-12-22 17:08:55', '2022-01-21 15:41:35', 0),
(7, 5, 'Article et sécurité', '<div>L\'autre jour je me suis dit \"et si j\'&eacute;crivais un article pour le kI ?\", je me pr&eacute;cipite sur mon ordi, me connecte en vitesse et commence &agrave; r&eacute;diger l\'article que voil&agrave;.</div>\r\n<div>Je viens pour me plaindre de quelque chose qui ne me pla&icirc;t pas beaucoup sur ce site. Regardez bien la mise en forme de cet article. Mieux que &ccedil;a. Vous ne voyez rien ? Alors regardez mieux, partez comparer avec un autre article - disons, au hasard, le premier. Regardez bien... et soudain, c\'est l\'&eacute;vidence.</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;** LES ESPACES ENTRE LES LIGNES SONT SI DIFFERENTS **</div>\r\n<div>&nbsp;</div>\r\n<div>Ceux-l&agrave; sont bien mieux, n\'est-ce pas ? Du moins je pense que tous les X devraient, en l\'honneur de l\'uniforme, pr&eacute;f&eacute;rer cet espacement entre les lignes.</div>\r\n<div>En un mot:</div>\r\n<div>&nbsp;</div>\r\n<div>Cet</div>\r\n<div>espace</div>\r\n<div>l&agrave;</div>\r\n<div>&nbsp;</div>\r\n<div>Vaut mieux que:</div>\r\n<div>&nbsp;</div>\r\n<p>Cet</p>\r\n<p>espace</p>\r\n<p>l&agrave;</p>\r\n<div>&nbsp;</div>\r\n<div>Au-del&agrave; du fait qu\'il n\'y avait pas qu\'un mot, mais trois, vous devriez vous r&eacute;volter en apprenant que &lt;em&gt;PAR DEFAUT, C\'EST LE DEUXIEME TYPE&lt;/em&gt; (moche)&nbsp;<em>QUI EST UTILISE PAR LES JOURNALISTES.</em></div>\r\n<div>Bref, apr&egrave;s l\'affaire Total, l\'affaire des espacements de paragraphe embrasera-t-il le plat&acirc;l ?</div>\r\n<div>&nbsp;</div>\r\n<div>Ceci &eacute;tant dit, il reste un point &agrave; aborder. Ce site est prot&eacute;g&eacute; contre les failles XSS gr&acirc;ce &agrave; un ing&eacute;nieux syst&egrave;me de relecture attentif de la part des admin ! La preuve ci-dessous :</div>\r\n<div>&lt;script&gt;alert(\"Si vous voyez un pop-up, c\'est que l\'admin n\'a pas fait son taf\");&lt;/script&gt;</div>', 'img_kI', 'valide', '2021-12-22 17:18:13', '2021-12-22 17:21:57', 0),
(18, 1, 'Titre qui pose problème', '<p>Un texte qui a l\'air innocent</p>\r\n<p>&lt;script&gt;alert(\"probl&egrave;me\")&lt;/script&gt;</p>\r\n<p>Et qui pourtant pose probl&egrave;me.</p>\r\n<p>&lt;script&gt;alert(\"Pas si simple!\");&lt;script&gt;</p>', 'img_kI', 'valide', '2022-01-14 14:33:26', '2022-01-14 14:39:17', 0),
(19, 1, 'ENCORE DES TESTS', '<div>Coucou</div>\r\n<div>&nbsp;</div>\r\n<div>Ceci est un test.</div>\r\n<div>La grande question est: passera-t-il le validateur W3C ?</div>\r\n<div>Une autre question importante reli&eacute;e &agrave; cela : &lt;script&gt;alert(\"Qu\'avez-vous vu ?\");&lt;/script&gt;</div>\r\n<div>&nbsp;</div>\r\n<div>A +</div>', 'img_kI', 'valide', '2022-01-14 15:02:53', '2022-01-14 15:03:04', 0),
(20, 4, 'Article', '<div>Bonjour</div>\r\n<div>J\'&eacute;cris un artcile</div>\r\n<div>Je sais pas quoi mettre !</div>\r\n<div>&nbsp;</div>\r\n<div>Au revoir</div>', 'img_kI', 'refuse', '2022-01-21 12:43:05', '2022-01-21 12:43:37', 0),
(23, 5, 'Le PSC élu meilleur cours par les étudiants', '<div><em>[ENGLISH BELOW]</em></div>\r\n<div>&nbsp;</div>\r\n<div>Bonjour,</div>\r\n<div>&nbsp;</div>\r\n<div>Nous avons eu l\'immense honneur de nous entretenir avec *ri* *ab**ye, le pr&eacute;sident de l\'Ecole polytechnique, qui a pr&eacute;f&eacute;r&eacute; rester anonyme.</div>\r\n<div>Cette interview &eacute;tait si dense en renseignements et en information que nous avons d&eacute;cid&eacute; d\'&eacute;crire une s&eacute;rie d\'articles &agrave; ce sujet. Ceci est donc le premier d\'une&nbsp;<em>**longue, longue**</em> s&eacute;rie d\'au moins 1 article(s).</div>\r\n<div>&nbsp;</div>\r\n<div style=\"padding-left: 40px;\"><span style=\"background-color: #bfedd2;\">LE PSC ELU MEILLEUR COURS PAR LES ETUDIANTS</span></div>\r\n<div><span style=\"background-color: #ffffff;\">Les &eacute;tudiants ont &eacute;t&eacute; sond&eacute;s l\'ann&eacute;e derni&egrave;re, &agrave; l\'issue de leur soutenance de PSC. La question suivante leur a &eacute;t&eacute; adress&eacute;e :</span></div>\r\n<div><span style=\"background-color: #ffffff;\">&lt;&lt; Pensez-vous que les PSC (et vos jurys) sont ce qu\'il y a de mieux &agrave; l\'X ?&gt;&gt;</span></div>\r\n<div>Dans 95% des cas, les &eacute;tudiants ont r&eacute;pondu \"oui\". Ce pourcentage grimpe m&ecirc;me &agrave; 100% si l\'on exclu les &eacute;l&egrave;ves renvoy&eacute;s depuis.</div>\r\n<div>&nbsp;</div>\r\n<div>Les kessiers \"ens\" (<em>pour \"enseignement\", NDMDR)&nbsp;</em>ont vivement protest&eacute;. \"Je ne savais pas que le PSC &eacute;tait le cours pr&eacute;f&eacute;r&eacute; des X, on aurait pu me pr&eacute;venir\". Toutefois notre interlocuteur n\'a pas accord&eacute; de cr&eacute;dit &agrave; ces protestations, jug&eacute;es hors-sujet. D\'ailleurs, nous avons appris que leur mandat vient de se terminer.</div>\r\n<div>&nbsp;</div>\r\n<div>En revanche, chez les tuteurs, c\'est la f&ecirc;te. \"Nous avons toujours su que les &eacute;l&egrave;ves nous appr&eacute;ciaient, ils savent bien que travailler le PSC est le meilleur moyen de perdre leur temps\", nous dit un tuteur du d&eacute;partement PHY <em>(pour \"physique\", NDMDR).</em> \"Or les &eacute;tudiants aiment perdre leur temps, tout le monde sait &ccedil;a\". D\'une logique implacable, digne de cette belle discipline.</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>', 'img_9', 'valide', '2022-01-21 15:59:53', '2022-01-21 16:03:28', 0);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `ID` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `date_release` datetime NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`ID`, `id_auteur`, `id_article`, `date_release`, `content`) VALUES
(1, 4, 1, '2022-01-06 20:30:17', 'Un article d\'anthologie !'),
(6, 4, 1, '2022-01-06 20:41:13', 'Des commentaires ultra-pertinents'),
(7, 4, 1, '2022-01-06 20:41:33', 'Et qui s\'actualise en direct, pas mal !\r\nEn plus des sauts de lignes qui fonctionnent.'),
(8, 1, 1, '2022-01-07 13:33:59', 'Il reste à tester la fonctionnalité \"plusieurs pages\" pour les commentaires. Il faut donc en écrire plusieurs.'),
(9, 4, 1, '2022-01-07 13:34:15', 'Oui c\'est vrai'),
(10, 6, 1, '2022-01-07 17:23:43', 'En fait c\'est juste une page de test'),
(11, 1, 1, '2022-01-23 15:10:55', 'Il faut que j\'écrive plein de commentaires'),
(12, 1, 1, '2022-01-23 15:11:09', 'Demandez-moi pourquoi !'),
(13, 4, 1, '2022-01-23 15:11:45', '...pourquoi ?'),
(14, 5, 1, '2022-01-23 15:12:09', 'Je pense que j\'ai deviné pourquoi !'),
(15, 6, 1, '2022-01-23 15:12:33', 'pas moi. Du coup, pourquoi ?'),
(16, 6, 1, '2022-01-23 15:13:45', 'pas moi. Du coup, pourquoi ?'),
(17, 6, 1, '2022-01-23 15:13:59', 'pas moi. Du coup, pourquoi ?'),
(18, 1, 1, '2022-01-23 15:15:05', 'Pour pouvoir naviguer dans les commentaires & voir si ça marche bien'),
(19, 1, 1, '2022-01-23 15:47:33', 'Pour pouvoir naviguer dans les commentaires & voir si ça marche bien');

-- --------------------------------------------------------

--
-- Structure de la table `demande_upgrade`
--

CREATE TABLE `demande_upgrade` (
  `ID` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `promo` int(11) NOT NULL,
  `motivation` text NOT NULL,
  `type_demande` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `ID` int(11) NOT NULL,
  `original_name` varchar(256) NOT NULL,
  `id_auteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`ID`, `original_name`, `id_auteur`) VALUES
(9, 'x logo 2.jpeg', 5);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `ID` int(11) NOT NULL,
  `id_likeur` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `date_like` timestamp NOT NULL DEFAULT current_timestamp(),
  `nature_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`ID`, `id_likeur`, `id_article`, `date_like`, `nature_like`) VALUES
(16, 1, 1, '2022-01-23 15:31:15', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `first_date` datetime NOT NULL DEFAULT current_timestamp(),
  `type` varchar(20) NOT NULL DEFAULT 'visiteur',
  `type_demande` varchar(20) NOT NULL DEFAULT 'visiteur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `first_date`, `type`, `type_demande`) VALUES
(1, 'aminassian', '$2y$10$gafAMJML6Ct5RZ/v55BLRe8FOw0VQKWlGJcGUjAi4fMKJ6p/XKUvG', '2021-12-05 23:17:44', 'admin', 'admin'),
(3, 'utilisateurRandom', '$2y$10$ZxDNoAVp0mEnWvGS5KyKa.Cn1IPbxwEvGoDWIFi1c4D31sohmAWDG', '2021-12-05 23:18:23', 'visiteur', 'visiteur'),
(4, 'projet.modal', '$2y$10$gRK/AthJDwKCaHfbOujocuI6TDOZyvHgV7f4c789vCBsia9W/VcTy', '2021-12-17 15:28:46', 'journaliste', 'journaliste'),
(5, 'projet.modal2', '$2y$10$gRK/AthJDwKCaHfbOujocuI6TDOZyvHgV7f4c789vCBsia9W/VcTy', '2021-12-17 15:33:31', 'journaliste', 'journaliste'),
(6, 'randomX', '$2y$10$I.tbAZvxEcIc1cW1uACsEOqMCFkK2Fbjxx0nmUDm/yvKly46EMn5C', '2021-12-19 23:15:20', 'visiteur', 'journaliste'),
(7, 'otherRandomX', '$2y$10$I.tbAZvxEcIc1cW1uACsEOqMCFkK2Fbjxx0nmUDm/yvKly46EMn5C', '2021-12-22 16:54:30', 'journaliste', 'journaliste'),
(8, 'otherOtherRandomX', '$2y$10$I.tbAZvxEcIc1cW1uACsEOqMCFkK2Fbjxx0nmUDm/yvKly46EMn5C', '2021-12-22 16:54:30', 'visiteur', 'visiteur'),
(9, 'randomXX', '$2y$10$I.tbAZvxEcIc1cW1uACsEOqMCFkK2Fbjxx0nmUDm/yvKly46EMn5C', '2022-01-07 16:57:12', 'visiteur', 'visiteur'),
(10, 'antoine.dmi', '$2y$10$rorbx/x8Vdo2is7O6Fiy4u259.k66TvI95iMn8quR60r4OiyxYDR6', '2022-01-21 14:24:59', 'visiteur', 'visiteur'),
(11, 'randomX20', '$2y$10$NKbHOBQtt6BVbRTmZg/8weomVpa6YzASSDSwf/RTqxxa5yGUokvCG', '2022-01-21 14:54:33', 'visiteur', 'visiteur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_auteur` (`id_auteur`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_auteur` (`id_auteur`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `demande_upgrade`
--
ALTER TABLE `demande_upgrade`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_auteur` (`id_auteur`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_likeur` (`id_likeur`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `demande_upgrade`
--
ALTER TABLE `demande_upgrade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`id_auteur`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_auteur`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `articles` (`ID`);

--
-- Contraintes pour la table `demande_upgrade`
--
ALTER TABLE `demande_upgrade`
  ADD CONSTRAINT `demande_upgrade_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`id_auteur`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_likeur`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `articles` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
