-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 03 juin 2020 à 13:26
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
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `new_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `new_id`, `content`, `etat`, `dateCreation`) VALUES
(1, 2, 1, 'Où trouver des clubs.', 'Validé', '2018-12-05 13:26:01'),
(2, 3, 2, 'Est-ce un sport ?', 'Refusé', '2018-11-05 13:26:01'),
(3, 4, 3, 'Cela est il dangereux ?', 'Validé', '2018-10-05 13:26:01'),
(4, 3, 1, 'Sur internet', 'Validé', '2018-09-05 13:26:01'),
(5, 3, 2, 'Sur internet a www.chanbara.fr', 'Validé', '2018-08-05 13:26:01');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT '2018-01-01 00:00:00',
  `dateModif` datetime NOT NULL,
  `chapo` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKNewsUser` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `user_id`, `titre`, `dateCreation`, `dateModif`, `chapo`, `content`) VALUES
(1, 2, 'Chanbara', '2018-01-01 00:00:00', '2018-09-30 00:00:00', 'Le Sport chanbara (スポーツチャンバラ) ou \"Spochan\"1 consiste en un combat entre deux participants avec des armes égales ou différentes, de façon libre mais possédant néanmoins des règles minimum.', 'Souvent assimilé au kendo, il en est totalement différent de par sa liberté de pratique, sa façon de combattre et ses nombreuses armes différentes utilisables (kodachi, choken, yari, tanto...). Le sport chanbara se veut l’héritier direct et fidèle des combats livrés entre samouraïs de par son esprit et son réalisme. En effet, à la différence d’autres arts martiaux, le sport chanbara n’a pas subi de codification extrême puisque tous les coups susceptibles de défaire l’adversaire sont admis. Les armes étant en matériaux modernes souples et flexibles, les seules protections nécessaires sont un casque et des gants sans armature rigide. Ce type d\'arme ne fait que rendre ce sport plus spectaculaire car la façon de combattre peut être totalement libre, du moment que l\'on respecte les règles de base du combat au sabre.'),
(2, 3, 'Kendo', '2018-01-01 00:00:00', '2018-09-30 00:00:00', 'Le kendo (剣道 / 劍道?, littéralement « la voie du sabre ») est la version moderne du kenjutsu (剣術?, techniques du sabre), l\'escrime au sabre pratiquée autrefois au Japon par les samouraïs.', '« Le kendo est la plus ancienne, la plus respectée et la plus populaire des disciplines modernes du budō » remarque en 1983 Donn F. Draeger, l\'un des spécialistes des arts martiaux japonais.\r\nDans une école d\'agriculture au Japon, vers 1920\r\nDe nos jours dans un dojo à Tokyo\r\n\r\nAprès une longue période de guerres et l\'unification du pays par le shogun Tokugawa Ieyasu, le Japon entre dans une ère de paix qui durera plus de 260 ans, l\'époque d\'Edo (1600-1868), au cours de laquelle l\'escrime au sabre, le kenjutsu (剣術), qui a perdu sa finalité sur les champs de bataille, continue à être enseignée dans le cadre de la formation de la caste dirigeante, celle des bushi (ou samouraï) : le kenjutsu est l\'un des dix-huit arts martiaux que doit pratiquer le bushi. De nombreux traités sur le sabre sont publiés à cette époque au Japon tel le Gorin no shō de Miyamoto Musashi ou le Hagakure de Yamamoto Jocho. De « sabre pour tuer » (setsuninto, 殺人刀), le kenjutsu évolue vers « sabre pour vivre » (katsuninken, 活人剣) par l\'étude duquel le pratiquant forge sa personnalité. Afin de faciliter la pratique jusque-là limitée à des katas au sabre de bois (bokken) ou au sabre réel, Naganuma Shiro développe au début du XVIIIe siècle le sabre en bambou (shinai) et différentes protections (bogu) afin d\'autoriser des frappes réelles pendant les assauts. Parallèlement à l\'amélioration du matériel qui prend la forme définitive que nous lui connaissons aujourd\'hui peu avant la fin de l\'ère Edo, le kenjutsu évolue vers sa forme moderne, le kendo.\r\n\r\nÀ la Restauration de Meiji (1868), le port du sabre est interdit par décret impérial en 1876, la classe des samouraïs est dissoute et les arts martiaux tombent en désuétude avec l\'introduction des techniques militaires occidentales. Les arts martiaux, dont le kenjutsu, renaissent toutefois dès 1878 dans les écoles de police et la première fédération d\'arts martiaux, la Nihon Butokukai est créée à Kyōto au sein du dojo Butokuden en 1895. Jusque-là appelé kenjutsu, c\'est en 1912 qu\'il est fait pour la première fois mention du kendo dans la publication des Nihon Kendo no Kata (Kata pour le kendo). L\'Occident découvre le kendo dès le XIXe siècle à travers des récits de voyages mais ce n\'est qu\'en 1899 qu\'a lieu la première démonstration de kendo en France à l\'occasion de la visite du créateur du judo moderne, Jigoro Kano.\r\n\r\nLa défaite du Japon en 1945 porte un coup sévère aux arts martiaux japonais en général et au kendo en particulier, responsables selon l\'occupant Américain de véhiculer une idéologie militariste via le bushido. Le kendo sera ainsi interdit après la guerre, mais sa pratique sportive se poursuivra sous le nom de « compétition au shinai » jusqu\'en 1952 date à laquelle se constitue la Fédération Japonaise de Kendo (Zen Nippon Kendo Renmei). À cette occasion, des maîtres sont dépêchés à l\'étranger. C\'est ainsi que maître Minoru Mochizuki, alors 4e dan de kendo vient en France. Sous le contrôle de ces maîtres japonais, parfois rivaux, la France commence la pratique du kendo dès le début des années 1950 sous l\'égide de la Fédération Française d\'Aïkido, Taï-Jitsu et Kendo créée en 1958 par Jim Alckeik, Emile Blanc et Robert Ebgui,celle-ci organise le premier championnat de France de kendo en 1959. '),
(3, 4, 'Iaido', '2018-01-01 00:00:00', '2018-09-30 00:00:00', 'L’iaidō (居合道?) est un art martial d\'origine japonaise basé sur l\'action de dégainer le sabre et de frapper (de taille ou d\'estoc) en un seul geste.', 'Le terme iaidō (居合道?) est composé de trois kanjis signifiant approximativement :\r\n\r\n    « vivre », « exister » (居, i?),\r\n    « harmonie », « union » (合, ai?),\r\n    « voie » (道, dō?).\r\n\r\nIaidō peut donc se traduire par « la voie de la vie en harmonie », ou « exister en union avec la voie ». Le préfixe « i » peut aussi être interprété par le chiffre 1, l\'unité : « la voie de l\'unité de l\'individu », en lui-même pour être en harmonie avec soi et avec les autres.\r\n\r\nNakamura Taisaburō hanshi, 10e dan, en dit ceci :\r\n\r\n    « Iai to wa, hito ni kirarezu, hito kirazu. » « Le iai, c\'est ne pas tuer les autres et ne pas se faire tuer par eux à la fois. »\r\n\r\n    « Jiko no renma ni, shuyou no michi. » « L\'entraînement, le polissage des aptitudes, la voie de la discipline, c\'est se cultiver soi-même. »\r\n\r\nL\'essentiel de la pratique du iaidō consiste en l\'apprentissage et l’exécution de katas (séquences de mouvements précis), s\'exécutant la plupart du temps seul et correspondant à un scénario. Ils démarrent soit debout (tachi iai), soit à genoux au sol (seiza), soit dans une position avec un seul genou au sol (tate hiza). Ces formes constituent autant de supports à l\'enseignement et permettent la transmission de l\'ensemble des techniques d\'une école.\r\n\r\nCes katas se composent à la base des quatre mêmes étapes :\r\n\r\n    Dégainer et première coupe : nukitsuke ou nukiuchi ;\r\n    Coupe principale : kiri tsuke ou kiri oroshi ;\r\n    Nettoyer la lame : chiburi ;\r\n    Remettre la lame au fourreau : notō.\r\n\r\nOn distingue aussi une partie importante propre à de nombreux katas selon les écoles : furikabutte, l’action de « brandir le sabre ». De nombreuses variantes, coupes, frappes d’estoc, frappes avec la poignée du sabre, sont ajoutées dans certains katas.\r\n\r\nCes katas doivent être « habités » par le pratiquant, et induisent des notions fondamentales propres à tous les budō :\r\n\r\n    Zanshin : la vigilance active, le ressenti, la perception de l\'environnement ;\r\n    Seme : la menace, construction de l\'attitude exprimant la capacité de réaction instantanée ;\r\n    Netsuke : le regard global, non focalisé, perception visuelle large ;\r\n    Kokoro : le cœur, l\'esprit, l\'audace, l\'honnêteté, la sincérité (terme difficilement traduisible).'),
(137, 1, 'Samouraï', '2020-04-23 16:38:09', '2020-04-23 16:38:09', 'Le samouraï (侍, samurai) (à ne pas confondre avec le bushi (武士)) est un membre de la classe guerrière qui a dirigé le Japon féodal durant près de 700 ans. ', 'Le terme « samouraï », mentionné pour la première fois dans un texte du Xe siècle, vient du verbe saburau qui signifie « servir ». L\'appellation est largement utilisée dans son sens actuel depuis le début de la période Edo, vers 1600. Auparavant, on désignait les guerriers plutôt par les termes mono no fu (jusqu\'au VIIIe siècle), puis tsuwamono (強者?)1 ou bushi (武士?), qui peuvent l\'un ou l\'autre se traduire par « homme d\'armes ». Les guerriers sont souvent décrits comme des « Ebisu », c’est-à-dire des barbares dans le Dit des Heike. À partir de la période Edo, les termes bushi et samouraï ne sont pas tout à fait synonymes, il existe une différence subtile (voir l\'article Bushi).\r\n\r\nOn trouve aussi parfois le terme buke : il désigne la noblesse militaire attachée au bakufu (gouvernement militaire), par opposition aux kuge, la noblesse de cour attachée à l\'empereur. Les buke sont apparus durant l\'ère Kamakura (1185–1333). '),
(138, 1, 'Yakuza', '2020-04-23 16:44:19', '2020-04-23 16:44:19', 'Un yakuza (ヤクザ／やくざ?) est un membre d\'un groupe du crime organisé au Japon (mafia).', 'L’origine du mot « yakuza » apparait sous le shogunat des Tokugawa (1603-1867)2. Il est tiré d\'une combinaison du jeu de cartes japonais appelé Oicho-Kabu, proche du baccara, qui est traditionnellement joué avec des cartes de kabufuda ou de hanafuda3. À la fin d\'une partie, les valeurs des cartes sont additionnées et l\'unité de la somme représente le score du joueur. Le but du jeu est de s\'approcher le plus de 9.\r\n\r\n« Ya » vient de yattsu, qui signifie huit (peut également se dire hachi), « ku » veut dire neuf (le mot kyu est aussi utilisé), et « za » est sans doute une déformation de « san » qui veut dire trois. Ya-ku-za est donc la somme de 8, 9 et 3, soit 20 et donc un score de 0, qui est une main perdante4. Ce nom signifie donc « perdants », « bons à rien »5. Les yakuzas sont à l\'origine issus des plus pauvres, des exclus de la société. '),
(139, 1, 'Ninja', '2020-04-23 16:45:32', '2020-04-23 16:45:32', 'Ninja (忍者?) est un terme japonais moderne (XXe siècle), servant à désigner une certaine catégorie d\'espions ou mercenaires, actifs jusqu\'à la période d\'Edo (XVIIe siècle), traditionnellement appelés shinobi (忍び?, littéralement « se faufiler »). ', 'Autrefois shinobi, voire kancho, sekko, ou kagimono-hiki, « ninja » vient de nin = furtif et ja ou sha = individu, spécialiste10. Cette lecture est une lecture on\'yomi des deux kanjis 忍 et 者. Dans la lecture native kun\'yomi, il est prononcé shinobi, une forme raccourcie de la transcription shinobi-no-mono (忍の者?), combattant de l\'ombre11.\r\n\r\nLe mot shinobi apparaît dans les écrits jusqu\'à la fin du VIIIe siècle dans des poèmes dans le Man\'yōshū12,13. La connotation sous-jacente de shinobi (忍?) signifie « furtif », « cacher », « secret », d\'où son association avec la perspicacité et l\'invisibilité. Mono (者?) signifie « personne ». Dans les documents historiques, le terme shinobi est presque toujours utilisé. '),
(140, 1, 'Geisha', '2020-04-23 16:47:36', '2020-04-23 16:47:36', 'Une geishaNote 1 (芸者?), aussi appelée geiko (芸子／芸妓?) ou geigi (芸妓?), est au Japon une artiste et une dame de compagnie.', 'Une geishaNote 1 (芸者?), aussi appelée geiko (芸子／芸妓?) ou geigi (芸妓?), est au Japon une artiste et une dame de compagnie, qui consacre sa vie à la pratique artistique raffinée des arts traditionnels japonais pour des prestations d\'accompagnement et de divertissement, pour une clientèle très aisée. Elle cultive le raffinement artistique dans divers domaines tels que l\'habillement en kimono, la musique classique, la danse, les rapports sociaux et la conversation, des jeux... Le mot « geisha » peut s’interpréter comme « personne d’arts » ou « femme qui excelle dans le métier de l\'art ». '),
(141, 1, 'Fudai daimyō', '2020-04-23 16:52:43', '2020-04-23 16:52:43', 'Les fudai daimyō (譜代大名, fudai daimyō) constituent une classe de daimyos qui sont vassaux héréditaires des Tokugawa durant l\'époque d\'Edo du Japon.', 'Nombre des familles qui forment les rangs des fudai daimyō ont servi le clan Tokugawa avant son ascension à la primauté nationale. Parmi ces familles se trouvent les Honda, les Sakai, les Sakakibara, les Ii, les Itakura et les Mizumo. Les « Quatre Grands Généraux » de Tokugawa Ieyasu — Honda Tadakatsu, Sakakibara Yasumasa, Sakai Tadatsugu et Ii Naomasa — sont tous des fudai de l\'avant époque d\'Edo et deviennent des fudai daimyō. En outre, certaines branches du clan Matsudaira (dont est originaire le clan Tokugawa), tout en conservant leur nom « Matsudaira », sont des fudai. '),
(142, 1, 'Yamabushi', '2020-04-23 16:54:56', '2020-04-24 15:57:14', 'Les yamabushi (山伏) (littéralement « ceux qui se prosternent dans les montagnes ») du Japon médiéval étaient des ascètes montagnards et des guerriers.', 'Les yamabushi <script>alert(\'coucou\')</script> commencèrent en tant que yamahoshi, des petits groupes, voire des individus isolés, d\'ermites des montagnes, d\'ascètes, et de « saint hommes », qui suivaient la voie du shugendō, dans une recherche de pouvoirs spirituels, mystiques ou surnaturels, censés être gagnés grâce à l\'ascétisme. Cette voie aurait été fondée par En no Gyōja, anachorète que le folklore japonais dote de pouvoirs de thaumaturge, dont l\'existence réelle est contestée par certains universitaires nippons, mais reconnue par tous les yamabushi modernes au Japon. ');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `loggin` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateRegistration` datetime NOT NULL DEFAULT '2018-12-01 00:00:00',
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `grip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loggin` (`loggin`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `firstname`, `loggin`, `password`, `dateRegistration`, `email`, `picture`, `grip`) VALUES
(1, 'Super-Administrateur', 'Rodier', 'Francis', 'Daihon', '5aceef1f1ae5c53fb4dd70d32af176fef326e8f7', '2018-12-01 00:00:00', 'francisrodier78@yahoo.fr', 'Adresse http d\'une photo.', 'Le développeur qu\'il vous faut.'),
(2, 'Administrateur', 'Mirumoto', 'Otago', 'Otago', 'ddd93944d162a125f5de4b88eb54711be8c4a53e', '2019-01-02 18:09:48', 'Otago@yahoo.fr', ' ', ' '),
(3, 'Membre', 'Bayushi', 'Jotaro', 'Jotaro', '29cd4617378daa398bdb631bdd8a15a7a1d41e47', '2018-12-01 00:00:00', 'jotaro@yahoo.fr', '', ''),
(4, 'Visiteur', 'Kaïu', 'Nakata', 'Nakata', '9323af18be028a8662392d8689e458fc75c5738f', '2018-12-01 00:00:00', 'nakata@yahoo.fr', '', ''),
(31, 'Administrateur', 'Chef', 'Grand', 'admin', 'bf720da93aea358fcaa18ff9b4bd0207feeddc80', '2019-01-07 15:58:21', 'a@a.fr', ' ', ' ');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `FKNewsUser` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
