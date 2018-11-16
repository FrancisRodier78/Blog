-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 26 oct. 2018 à 16:51
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisator_id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `grip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrator`
--

INSERT INTO `administrator` (`id`, `utilisator_id`, `picture`, `grip`) VALUES
(1, 1, '', 'Francis Rodier le développeur qu\'il vous faut.');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `post_id`, `content`) VALUES
(1, 2, 1, 'Où trouver des clubs.'),
(2, 3, 2, 'Est-ce un sport ?'),
(3, 4, 3, 'Cela est il dangereux ?');

-- --------------------------------------------------------

--
-- Structure de la table `link`
--

DROP TABLE IF EXISTS `link`;
CREATE TABLE IF NOT EXISTS `link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `link`
--

INSERT INTO `link` (`id`, `content`) VALUES
(1, 'CV en PDF');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT '2018-01-01 00:00:00',
  `dateModif` datetime NOT NULL,
  `chapo` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `user_id`, `titre`, `dateCreation`, `dateModif`, `chapo`, `content`) VALUES
(1, 2, 'Chanbara', '2018-01-01 00:00:00', '2018-09-30 00:00:00', 'Le Sport chanbara (スポーツチャンバラ) ou \"Spochan\"1 consiste en un combat entre deux participants avec des armes égales ou différentes, de façon libre mais possédant néanmoins des règles minimum.', 'Souvent assimilé au kendo, il en est totalement différent de par sa liberté de pratique, sa façon de combattre et ses nombreuses armes différentes utilisables (kodachi, choken, yari, tanto...). Le sport chanbara se veut l’héritier direct et fidèle des combats livrés entre samouraïs de par son esprit et son réalisme. En effet, à la différence d’autres arts martiaux, le sport chanbara n’a pas subi de codification extrême puisque tous les coups susceptibles de défaire l’adversaire sont admis. Les armes étant en matériaux modernes souples et flexibles, les seules protections nécessaires sont un casque et des gants sans armature rigide. Ce type d\'arme ne fait que rendre ce sport plus spectaculaire car la façon de combattre peut être totalement libre, du moment que l\'on respecte les règles de base du combat au sabre.'),
(2, 3, 'Kendo', '2018-01-01 00:00:00', '2018-09-30 00:00:00', 'Le kendo (剣道 / 劍道?, littéralement « la voie du sabre ») est la version moderne du kenjutsu (剣術?, techniques du sabre), l\'escrime au sabre pratiquée autrefois au Japon par les samouraïs.', '« Le kendo est la plus ancienne, la plus respectée et la plus populaire des disciplines modernes du budō » remarque en 1983 Donn F. Draeger, l\'un des spécialistes des arts martiaux japonais.\r\nDans une école d\'agriculture au Japon, vers 1920\r\nDe nos jours dans un dojo à Tokyo\r\n\r\nAprès une longue période de guerres et l\'unification du pays par le shogun Tokugawa Ieyasu, le Japon entre dans une ère de paix qui durera plus de 260 ans, l\'époque d\'Edo (1600-1868), au cours de laquelle l\'escrime au sabre, le kenjutsu (剣術), qui a perdu sa finalité sur les champs de bataille, continue à être enseignée dans le cadre de la formation de la caste dirigeante, celle des bushi (ou samouraï) : le kenjutsu est l\'un des dix-huit arts martiaux que doit pratiquer le bushi. De nombreux traités sur le sabre sont publiés à cette époque au Japon tel le Gorin no shō de Miyamoto Musashi ou le Hagakure de Yamamoto Jocho. De « sabre pour tuer » (setsuninto, 殺人刀), le kenjutsu évolue vers « sabre pour vivre » (katsuninken, 活人剣) par l\'étude duquel le pratiquant forge sa personnalité. Afin de faciliter la pratique jusque-là limitée à des katas au sabre de bois (bokken) ou au sabre réel, Naganuma Shiro développe au début du XVIIIe siècle le sabre en bambou (shinai) et différentes protections (bogu) afin d\'autoriser des frappes réelles pendant les assauts. Parallèlement à l\'amélioration du matériel qui prend la forme définitive que nous lui connaissons aujourd\'hui peu avant la fin de l\'ère Edo, le kenjutsu évolue vers sa forme moderne, le kendo.\r\n\r\nÀ la Restauration de Meiji (1868), le port du sabre est interdit par décret impérial en 1876, la classe des samouraïs est dissoute et les arts martiaux tombent en désuétude avec l\'introduction des techniques militaires occidentales. Les arts martiaux, dont le kenjutsu, renaissent toutefois dès 1878 dans les écoles de police et la première fédération d\'arts martiaux, la Nihon Butokukai est créée à Kyōto au sein du dojo Butokuden en 1895. Jusque-là appelé kenjutsu, c\'est en 1912 qu\'il est fait pour la première fois mention du kendo dans la publication des Nihon Kendo no Kata (Kata pour le kendo). L\'Occident découvre le kendo dès le XIXe siècle à travers des récits de voyages mais ce n\'est qu\'en 1899 qu\'a lieu la première démonstration de kendo en France à l\'occasion de la visite du créateur du judo moderne, Jigoro Kano.\r\n\r\nLa défaite du Japon en 1945 porte un coup sévère aux arts martiaux japonais en général et au kendo en particulier, responsables selon l\'occupant Américain de véhiculer une idéologie militariste via le bushido. Le kendo sera ainsi interdit après la guerre, mais sa pratique sportive se poursuivra sous le nom de « compétition au shinai » jusqu\'en 1952 date à laquelle se constitue la Fédération Japonaise de Kendo (Zen Nippon Kendo Renmei). À cette occasion, des maîtres sont dépêchés à l\'étranger. C\'est ainsi que maître Minoru Mochizuki, alors 4e dan de kendo vient en France. Sous le contrôle de ces maîtres japonais, parfois rivaux, la France commence la pratique du kendo dès le début des années 1950 sous l\'égide de la Fédération Française d\'Aïkido, Taï-Jitsu et Kendo créée en 1958 par Jim Alckeik, Emile Blanc et Robert Ebgui,celle-ci organise le premier championnat de France de kendo en 1959. '),
(3, 4, 'Iaido', '2018-01-01 00:00:00', '2018-09-30 00:00:00', 'L’iaidō (居合道?) est un art martial d\'origine japonaise basé sur l\'action de dégainer le sabre et de frapper (de taille ou d\'estoc) en un seul geste.', 'Le terme iaidō (居合道?) est composé de trois kanjis signifiant approximativement :\r\n\r\n    « vivre », « exister » (居, i?),\r\n    « harmonie », « union » (合, ai?),\r\n    « voie » (道, dō?).\r\n\r\nIaidō peut donc se traduire par « la voie de la vie en harmonie », ou « exister en union avec la voie ». Le préfixe « i » peut aussi être interprété par le chiffre 1, l\'unité : « la voie de l\'unité de l\'individu », en lui-même pour être en harmonie avec soi et avec les autres.\r\n\r\nNakamura Taisaburō hanshi, 10e dan, en dit ceci :\r\n\r\n    « Iai to wa, hito ni kirarezu, hito kirazu. » « Le iai, c\'est ne pas tuer les autres et ne pas se faire tuer par eux à la fois. »\r\n\r\n    « Jiko no renma ni, shuyou no michi. » « L\'entraînement, le polissage des aptitudes, la voie de la discipline, c\'est se cultiver soi-même. »\r\n\r\nL\'essentiel de la pratique du iaidō consiste en l\'apprentissage et l’exécution de katas (séquences de mouvements précis), s\'exécutant la plupart du temps seul et correspondant à un scénario. Ils démarrent soit debout (tachi iai), soit à genoux au sol (seiza), soit dans une position avec un seul genou au sol (tate hiza). Ces formes constituent autant de supports à l\'enseignement et permettent la transmission de l\'ensemble des techniques d\'une école.\r\n\r\nCes katas se composent à la base des quatre mêmes étapes :\r\n\r\n    Dégainer et première coupe : nukitsuke ou nukiuchi ;\r\n    Coupe principale : kiri tsuke ou kiri oroshi ;\r\n    Nettoyer la lame : chiburi ;\r\n    Remettre la lame au fourreau : notō.\r\n\r\nOn distingue aussi une partie importante propre à de nombreux katas selon les écoles : furikabutte, l’action de « brandir le sabre ». De nombreuses variantes, coupes, frappes d’estoc, frappes avec la poignée du sabre, sont ajoutées dans certains katas.\r\n\r\nCes katas doivent être « habités » par le pratiquant, et induisent des notions fondamentales propres à tous les budō :\r\n\r\n    Zanshin : la vigilance active, le ressenti, la perception de l\'environnement ;\r\n    Seme : la menace, construction de l\'attitude exprimant la capacité de réaction instantanée ;\r\n    Netsuke : le regard global, non focalisé, perception visuelle large ;\r\n    Kokoro : le cœur, l\'esprit, l\'audace, l\'honnêteté, la sincérité (terme difficilement traduisible).');

-- --------------------------------------------------------

--
-- Structure de la table `relation_link`
--

DROP TABLE IF EXISTS `relation_link`;
CREATE TABLE IF NOT EXISTS `relation_link` (
  `administrator_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `relation_link`
--

INSERT INTO `relation_link` (`administrator_id`, `link_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `relation_rights`
--

DROP TABLE IF EXISTS `relation_rights`;
CREATE TABLE IF NOT EXISTS `relation_rights` (
  `right_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `relation_rights`
--

INSERT INTO `relation_rights` (`right_id`, `role_id`) VALUES
(1, 1),
(5, 1),
(1, 2),
(2, 2),
(3, 2),
(5, 2),
(6, 2),
(7, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 5);

-- --------------------------------------------------------

--
-- Structure de la table `rights`
--

DROP TABLE IF EXISTS `rights`;
CREATE TABLE IF NOT EXISTS `rights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rights`
--

INSERT INTO `rights` (`id`, `description`) VALUES
(1, 'Lecture commentaire'),
(2, 'Modifier commentaire'),
(3, 'Ajouter commentaire'),
(4, 'Valider commentaire'),
(5, 'Lecture post'),
(6, 'Modifier post'),
(7, 'Ajouter post'),
(8, 'Valider post'),
(9, 'Valider/Modifier Utilisateur'),
(10, 'Aucun droit');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Visiteur'),
(2, 'Membre'),
(3, 'Administrateur'),
(4, 'Super-Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `role_id`, `name`, `firstname`, `email`) VALUES
(1, 0, 'Rodier', 'Francis', 'francisrodier78@yahoo.fr'),
(2, 0, 'Mirumoto', 'Otago', 'Otago@yahoo.fr'),
(3, 0, 'Bayushi', 'Jotaro', 'jotaro@yahoo.fr'),
(4, 0, 'Kaïu', 'Nakata', 'nakata@yahoo.fr');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
