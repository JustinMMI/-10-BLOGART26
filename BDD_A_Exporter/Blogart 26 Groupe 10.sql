-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : sql308.infinityfree.com
-- Généré le :  jeu. 05 fév. 2026 à 11:32
-- Version du serveur :  11.4.9-MariaDB
-- Version de PHP :  7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blogart26`
--

CREATE DATABASE IF NOT EXISTS `blogart26` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `blogart26`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `numArt` int(11) NOT NULL,
  `dtCreaArt` datetime DEFAULT current_timestamp(),
  `dtMajArt` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `libTitrArt` varchar(100) DEFAULT NULL,
  `libChapoArt` text DEFAULT NULL,
  `libAccrochArt` varchar(100) DEFAULT NULL,
  `parag1Art` text DEFAULT NULL,
  `libSsTitr1Art` varchar(100) DEFAULT NULL,
  `parag2Art` text DEFAULT NULL,
  `libSsTitr2Art` varchar(100) DEFAULT NULL,
  `parag3Art` text DEFAULT NULL,
  `libConclArt` text DEFAULT NULL,
  `urlPhotArt` varchar(70) DEFAULT NULL,
  `numThem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`numArt`, `dtCreaArt`, `dtMajArt`, `libTitrArt`, `libChapoArt`, `libAccrochArt`, `parag1Art`, `libSsTitr1Art`, `parag2Art`, `libSsTitr2Art`, `parag3Art`, `libConclArt`, `urlPhotArt`, `numThem`) VALUES
(9, '2026-02-04 08:15:07', '2026-02-05 04:10:05', 'Bordeaux célèbre son terroir : quand la gastronomie locale devient un événement incontournable', 'Entre traditions culinaires, innovations gastronomiques et passion du terroir, Bordeaux s’impose une fois de plus comme une capitale incontournable de la gastronomie française à l’occasion d’un événement qui rassemble chefs, producteurs et amateurs de bonne chère.', 'À Bordeaux, la gastronomie ne se limite pas à l’assiette : elle se vit, se partage et se célèbre lor', 'Ce nouvel événement gastronomique bordelais réunit chefs renommés, jeunes talents de la cuisine moderne, cavistes passionnés et producteurs locaux autour d’une même ambition : valoriser le terroir girondin. Vins d’appellation, recettes traditionnelles revisitées, produits issus de l’agriculture biologique et créations innovantes se côtoient dans une atmosphère conviviale. Bordeaux confirme ainsi son rôle de vitrine culinaire, où la gastronomie rime avec transmission et créativité.', 'Quand tradition et innovation se rencontrent', 'Au cœur de l’événement, les visiteurs découvrent une cuisine qui respecte les racines tout en osant la modernité. Des chefs de restaurant et de brasserie proposent des accords mets et vins audacieux, tandis que les pâtissiers bordelais revisitent les classiques avec finesse. Chaque dégustation raconte une histoire, celle d’un savoir-faire transmis et réinventé, mettant à l’honneur les producteurs locaux et les vignobles de la région.', 'Un rendez-vous festif pour les amateurs de gastronomie', 'Plus qu’un simple festival culinaire, cet événement est un véritable lieu de rencontres. Ateliers de dégustation de vin, démonstrations de chefs, échanges avec des cavistes et marchés éphémères permettent au public de s’immerger pleinement dans l’univers gastronomique bordelais. C’est aussi l’occasion de découvrir de nouvelles adresses, de nouvelles recettes et des produits authentiques qui font la richesse de la cuisine locale.', 'Avec cet événement, Bordeaux prouve une fois de plus que sa gastronomie est vivante, innovante et profondément ancrée dans son terroir. Entre dégustations, découvertes et convivialité, la ville offre une expérience culinaire complète qui séduit autant les passionnés que les curieux. Un rendez-vous à ne pas manquer pour tous ceux qui souhaitent goûter à l’âme gastronomique bordelaise.', 'art_6984889d8efcf1.48233569.jpeg', 1),
(10, '2026-02-04 08:23:10', '2026-02-05 04:09:57', 'L\'Art de la Dégustation à Bordeaux : Un Voyage Culinaire Inoubliable', 'Plongez au cœur de l\'excellence gastronomique bordelaise, où chaque plat, chaque vin et chaque service sont une invitation à un voyage sensoriel mémorable, célébrant la richesse des produits locaux et la créativité des chefs.', 'Bordeaux, ville de prestige et d\'élégance, ne cesse de surprendre par sa scène culinaire, offrant de', 'La gastronomie bordelaise est une symphonie de saveurs, où la tradition rencontre l\'innovation. Nos restaurants et brasseries mettent en avant des chefs passionnés, qui transforment des produits locaux d\'une qualité incroyable en des plats délicieux et élégants. Que ce soit pour une entrée raffinée, un plat principal savoureux ou un dessert exquis, chaque bouchée est une célébration du terroir. Le service, toujours impeccable, contribue à faire de chaque repas un moment unique.', 'Entre Vins et Terroir : L\'Alliance Parfaite', 'Bordeaux est indissociable de ses vignobles. La dégustation de vin est ici un art, où chaque appellation raconte une histoire. Les cavistes experts vous guident à travers une sélection de vins qui complètent parfaitement les plats. C\'est l\'occasion de découvrir des accords mets et vins audacieux, où les saveurs du vin subliment celles de la cuisine moderne et traditionnelle. L\'expérience est enrichie par les producteurs locaux, véritables garants de la qualité des produits qui finissent dans votre assiette.', 'Des Innovations Gourmandes aux Marchés Bio', 'Au-delà des classiques, Bordeaux est aussi un vivier d\'innovation. Les pâtissiers rivalisent de créativité pour proposer des desserts qui sont de véritables œuvres d\'art. Les cocktails, pensés pour accompagner les saveurs de la région, ajoutent une touche de modernité à l\'expérience. Le Marché BIO, quant à lui, est une source inépuisable de produits frais et authentiques, inspirant de nouvelles recettes et confirmant l\'engagement de la ville envers une gastronomie durable. C\'est une invitation à explorer la richesse des produits qui font la renommée de notre terroir.', 'La scène gastronomique bordelaise est une invitation constante à la découverte. Chaque restaurant, chaque chef, chaque produit raconte une histoire de passion, de tradition et d\'innovation. Que vous soyez amateur de grands vins, de plats gourmands ou de douceurs sucrées, Bordeaux offre une expérience culinaire tout simplement incroyable. Venez déguster le meilleur de notre terroir !', 'art_698488950d9a99.19114597.jpg', 2),
(11, '2026-02-04 08:28:48', '2026-02-05 04:09:44', 'Les Secrets des Chefs Bordelais : Entre Terroir et Cuisine Moderne', 'Découvrez l\'âme culinaire de Bordeaux à travers ses chefs talentueux, qui conjuguent avec passion la richesse du terroir local et les audaces de la cuisine moderne pour des expériences gastronomiques inoubliables.', 'À Bordeaux, la figure du chef est centrale : véritable artisan, il incarne l\'alliance parfaite entre', 'Les restaurants bordelais sont le théâtre d\'une créativité sans cesse renouvelée. Nos chefs, véritables ambassadeurs du goût, mettent en lumière la qualité exceptionnelle des produits locaux. Du Marché BIO aux producteurs locaux, ils sélectionnent avec rigueur chaque ingrédient pour élaborer des recettes qui célèbrent le terroir. Leur savoir-faire permet de sublimer des saveurs authentiques, offrant des entrées délicates, des plats généreux et des desserts surprenants, toujours avec un service élégant.', 'L\'Héritage du Vignoble au Cœur de l\'Assiette', 'La connexion entre la cuisine et le vignoble est indissociable à Bordeaux. Les chefs intègrent les vins d\'appellation dans leurs créations, proposant des accords mets et vins qui élèvent l\'expérience de dégustation. Que ce soit un vin puissant pour accompagner un plat de viande ou un vin plus léger pour une entrée, chaque choix est pensé pour harmoniser les saveurs. C\'est cette synergie entre le vignoble et la table qui fait la renommée de notre gastronomie, une véritable tradition bordelaise.', 'L\'Innovation au Service du Goût : Une Gastronomie Vivante', 'Si la tradition est un pilier, l\'innovation est le moteur de la cuisine bordelaise contemporaine. Les chefs explorent de nouvelles techniques, revisitent les classiques et créent des cocktails audacieux qui complètent les repas. La pâtisserie, elle aussi, se réinvente, offrant des créations visuellement superbes et délicieusement surprenantes. Cette dynamique fait de Bordeaux une destination de choix pour ceux qui recherchent une gastronomie vivante, moderne et pleine de bonnes surprises.', 'Le rôle des chefs bordelais est essentiel dans la réputation gastronomique de notre ville. Grâce à leur passion, leur talent et leur engagement envers le terroir et l\'innovation, ils continuent de faire de Bordeaux une capitale culinaire incontournable. Chaque dégustation est une célébration, chaque plat une invitation à découvrir l\'incroyable richesse de notre patrimoine gustatif.', 'art_69848888d344b8.05412697.jpeg', 2),
(12, '2026-02-04 08:31:31', '2026-02-05 04:10:41', 'Bordeaux, Destination Gourmande : La Dégustation au Cœur de l\'Expérience', 'Immersion dans l\'univers gastronomique bordelais, où la dégustation est une véritable institution, invitant à explorer la richesse des saveurs, des vins et des produits du terroir dans une ambiance conviviale et élégante.', 'Plus qu\'une ville, Bordeaux est une invitation constante à l\'éveil des papilles, une destination où', 'La gastronomie à Bordeaux se vit avant tout à travers l\'expérience de la dégustation. Que ce soit dans un restaurant étoilé, une brasserie animée ou lors d\'un festival culinaire, chaque occasion est propice à savourer des plats délicieux. Les chefs, véritables artistes, mettent en scène des produits locaux d\'une qualité exceptionnelle, du vignoble au Marché BIO. Leur savoir-faire permet de transformer ces ingrédients en des créations gourmandes, des entrées aux desserts, qui sont de véritables hommages au terroir.', 'L\'Art de Déguster le Vin : Une Tradition Bordelaise', 'Il est impossible de parler de dégustation à Bordeaux sans évoquer le vin. Les appellations prestigieuses sont ici reines, et la dégustation de vin est une tradition profondément ancrée. Les cavistes et les experts guident les visiteurs à travers les vignobles et les caves, révélant les secrets des grands crus. Chaque verre est une histoire, un voyage sensoriel qui se marie parfaitement avec la cuisine moderne, offrant des accords mets et vins incroyables qui subliment l\'ensemble du repas.', 'Au-delà des Classiques : Innovation et Plaisirs Sucrés', 'Si les traditions sont chéries, Bordeaux n\'en est pas moins une ville à la pointe de l\'innovation culinaire. Les pâtissiers rivalisent de créativité pour proposer des douceurs élégantes et surprenantes. Les recettes se réinventent, intégrant des influences nouvelles tout en respectant l\'authenticité des produits. Que ce soit pour un cocktail original ou un dessert raffiné, la ville offre une palette de saveurs et d\'expériences qui rendent chaque dégustation unique et mémorable.', 'Bordeaux se positionne comme une destination incontournable pour les amateurs de bonne chère et de bon vin. La dégustation y est une véritable célébration, un art de vivre qui conjugue la richesse du terroir, le talent des chefs et l\'élégance du service. C\'est une ville où chaque plat, chaque verre, chaque instant est une promesse de découvertes délicieuses et inoubliables.', 'art_698488c1a34fd0.54776941.jpg', 3),
(13, '2026-02-04 08:40:00', '2026-02-05 04:09:28', 'Quand la Gastronomie s\'Installe là où on ne l\'Attend Pas', 'Oubliez les cadres classiques et laissez-vous surprendre par le Bordeaux secret, celui qui bouscule les codes de la gastronomie pour offrir des expériences de dégustation dans des lieux atypiques et mystérieux.', 'À Bordeaux, l\'audace culinaire ne se niche pas seulement dans l\'assiette, elle s\'exprime aussi à tra', 'La scène bordelaise fourmille de pépites cachées : dîners clandestins dans des ateliers d\'artistes, dégustations de vin au cœur de bases sous-marines ou tables éphémères sur des toits-terrasses privés. Ici, l’innovation rejoint l\'insolite. Les chefs osent sortir de leur cuisine habituelle pour préparer des plats délicieux dans des cadres bruts et authentiques. On y découvre une cuisine moderne qui s\'adapte à l\'environnement, où chaque recette semble raconter une histoire différente, loin du tumulte des brasseries traditionnelles.', 'L\'Art de la Dégustation en Terre Inconnue', 'Ces expériences privilégient souvent le contact direct avec le produit. Imaginez une dégustation de vin orchestrée par un caviste passionné au milieu d\'un ancien chai industriel réhabilité. Les vins d’appellation révèlent alors des facettes insoupçonnées, portés par une atmosphère singulière. C’est cette alliance entre l\'élégant et l\'industriel, ou le terroir et l\'urbain, qui crée un contraste incroyable et séduit une nouvelle génération de gourmets en quête d\'originalité.', 'Des Saveurs Uniques pour des Moments Privilégiés', 'Dans ces lieux insolites, le service se veut plus personnel, presque intimiste. On y déguste des entrées audacieuses et des desserts graphiques, souvent élaborés avec des produits sourcés directement auprès d\'un producteur local ou dénichés sur un marché BIO de quartier. Ces rendez-vous, souvent tenus secrets jusqu\'au dernier moment, prouvent que la gastronomie bordelaise sait rester vivante et surprenante, se réinventant sans cesse pour offrir bien plus qu\'un bon repas : un souvenir impérissable.', 'Explorer le Bordeaux insolite, c\'est accepter de perdre ses repères pour mieux redécouvrir le goût. Entre lieux décalés et talent des chefs, la capitale mondiale du vin démontre qu’elle maîtrise l\'art de surprendre les papilles. Une expérience à tenter pour quiconque souhaite voir la gastronomie sous un angle nouveau, créatif et résolument incroyable.', 'art_69848878f31256.24599295.jpeg', 4),
(14, '2026-02-05 02:59:35', '2026-02-05 05:57:32', 'Bordeaux : Dans les Secrets d\'un Caviste Passionné', '[i]Partez à la rencontre de ceux qui font battre le cœur des chais bordelais. Entre expertise technique et amour du partage, le caviste est l\'intermédiaire indispensable entre le vignoble et votre verre.[/i]', 'Le métier de caviste à Bordeaux ne s\'improvise pas ; c\'est un [u]véritable sacerdoce[/u] dédié à la', 'Qu\'il travaille dans une boutique de centre-ville ou au sein d\'une grande brasserie, le caviste bordelais est un sélectionneur rigoureux. Il parcourt chaque [b]vignoble[/b] pour dénicher l\'appellation qui saura surprendre. En collaboration étroite avec les chefs de restaurant, il élabore des recettes d\'accords mets et vins où chaque dégustation devient une révélation. Son rôle est aussi d\'intégrer les nouveautés de la [b]cuisine moderne[/b], prouvant que la tradition peut parfaitement s\'allier à l\'innovation.', '[b]L\'Art de Conseiller : Plus qu\'un Service, une Expérience[/b]', 'Entrer dans une cave à Bordeaux, c\'est s\'offrir un voyage sensoriel. Le service y est élégant et personnalisé. Le caviste ne se contente pas de vendre une bouteille ; il raconte l\'histoire du [b]producteur local[/b], explique les nuances du terroir et conseille sur la température idéale de service pour que vos plats soient sublimés. Pour les amateurs de produits sains, il saura vous orienter vers les pépites du [b]Marché BIO[/b], de plus en plus présentes dans les rayons spécialisés.', '[b]Dégustation et Transmission : Le Partage au Centre[/b]', 'De nombreux cavistes organisent désormais des ateliers de dégustation de vin thématiques. C\'est l\'occasion de découvrir des entrées raffinées ou des desserts surprenants qui s\'accordent avec des crus méconnus. Ces moments sont souvent le point d\'orgue d\'un [b]festival culinaire[/b] ou d\'un événement local, où l\'on apprend que le vin est un produit vivant, tout comme la gastronomie incroyable qui l\'accompagne. C\'est cette passion qui fait de Bordeaux une destination [i]délicieuse[/i] et unique.', 'Le caviste est bien plus qu\'un simple marchand : c\'est un gardien du temple, un passeur de saveurs qui garantit que l\'excellence bordelaise reste accessible à tous. En valorisant le travail du chef et du vigneron, il assure la pérennité d\'une culture gastronomique élégante et [b]incroyable[/b].', 'art_6984886a153273.68391109.jpeg', 2),
(15, '2026-02-05 03:06:21', '2026-02-05 04:09:01', 'Constantia, le nouveau restaurant gastronomique le moins cher de Bordeaux', 'Pour seulement 55€, il est possible de déguster le menu en 4 temps de chez Constantia Bordeaux. Une formule accessible, qui fait de la nouvelle adresse gastronomique la moins chère de Bordeaux. Décomplexée mais ô combien raffinée.', 'C\'est le seul et unique restaurant gastronomique du quartier des Bassins à Flot.', 'Il a surpris les habitants de la rue Lucien Faure au mois de septembre après 5 années de chantier d\'envergure. Malgré les nombreux assauts rencontrés par la complexité du bâtiment, son propriétaire Fabien Bouchereau n\'a pas renoncé. Et quelle belle intuition. Aujourd\'hui, le restaurant Constantia se porte à merveille et a pû dévoiler son spot d\'exception avec une salle principale, un salon intimiste de réception et un rooftop estival de 100 m2 à l\'étage.', 'Le vin ou l\'âme sacrée de Constantia', 'L\'ADN de Constantia Bordeaux, c\'est sa carte de vins exclusifs et rares. Avec un total de 1500 références triées sur le volet (soit l’une des plus grandes cartes de vins d’un restaurant à Bordeaux), l\'idée était de \"créer un restaurant pour mettre en valeur des jolis vins\". Entre les vieux millésimes incontournables, les flacons internationaux et les petits producteurs montants du coin, le restaurant représente un large panel de terroirs. Et pour une expérience encore plus millésimée, le restaurant applique des prix cavistes bien plus raisonnables que d\'ordinaire.', 'Des assiettes fusion d’inspiration japonaise', 'Avec à cœur de mettre en valeur l’excellence des vignerons à travers une cuisine noble mais décontractée, Constantia Bordeaux propose une cuisine traditionnelle française avec une touche asiatique. La carte a été confiée au chef Antoine Velasco et son chef adjoint Enzo Capelle, tous deux issus de belles adresses étoilées. Sur place, on profite d\'un menu en 4 ou 6 temps qui oscille entre 55€ et 78€. Du jamais vu à Bordeaux ! La formule accords mets & vins a été pensée par un sommelier réputé, anciennement propriétaire de Vins Urbains quartier Saint-Pierre. Chez Constantia Bordeaux, l\'heure est au voyage et à la découverte. Tous les plats sont relevés par une épice, une tradition japonaise, une influence chinoise ou encore un ingrédient typique vietnamien. Parmi les best-sellers ? Le tataki de bœuf, la cuisse de pigeon en tempura, l’aubergine laquée, la pêche pochée et glacée ou la framboise et sa ganache à la vanille maturée. Pour ne pas rester sur ses acquis et profiter des produits de saison, l\'établissement change sa carte tous les mois.', 'Au total, 3 espaces sont disponibles : la salle principale du restaurant avec 32 couverts intimistes dans une décoration chic et sobre (avec là-encore quelques inspirations asiatiques), un salon privé classique style XVIIIème siècle avec moulures, toilettes et terrasses privés pour les repas d\'affaires ou les rencontres privées et le toit-terrasse végétalisé à l\'étage de 48 places qui proposera une belle carte de tapas au printemps et en été. Dans une atmosphère chaleureuse, Constantia brille par sa simplicité et l\'exigence de ses mets. On s’y sent bien, comme à la maison. La haute gastronomie est désacralisée, servie sur un plateau d’argent. 5 étoiles pour ce nouveau restaurant dédié aux amoureux de gastronomie et de vin.', 'art_6984885deb7369.41119866.jpg', 4),
(16, '2026-02-05 03:07:56', '2026-02-05 05:57:41', 'Bordeaux en Fête : Le Festival Culinaire qui Révèle nos Talents', '[i]Chaque année, Bordeaux s\'anime et célèbre sa gastronomie lors d\'un événement incontournable. Chefs, producteurs et amoureux du goût se retrouvent pour un [u]festival culinaire[/u] où [b]tradition[/b] et [b]innovation[/b] se côtoient dans une ambiance unique.[/i]', 'Plus qu\'un simple rassemblement, cet événement est la vitrine de l\'incroyable richesse du [b]terroir', 'Au cœur de [b]Bordeaux[/b], un [b]événement[/b] majeur met en lumière la diversité de notre [b]gastronomie[/b]. Ce [b]festival culinaire[/b] réunit des [b]chefs[/b] renommés et de jeunes talents de la [b]cuisine moderne[/b], tous animés par la passion du bon goût. Les [b]restaurants[/b] et [b]brasseries[/b] partenaires proposent des [b]plats[/b] [b]délicieux[/b] et des [b]entrées[/b] créatives, souvent accompagnés de [b]cocktails[/b] inventifs. C\'est l\'occasion parfaite de découvrir des [b]recettes[/b] revisitées et des produits [b]élégants[/b] issus de notre région.', '[b]Quand le Vignoble Rencontre l\'Assiette : L\'Art des Accords[/b]', 'L\'essence de [b]Bordeaux[/b] réside aussi dans son [b]vin[/b]. Lors de cet événement, la [b]dégustation de vin[/b] est à l\'honneur. Des [b]cavistes[/b] experts guident le public à travers les [b]vignobles[/b] et les appellations, proposant des accords mets et vins [b]incroyables[/b]. Le [b]service[/b] personnalisé permet à chacun d\'apprécier la complexité de chaque cru, qu\'il provienne d\'un [b]producteur local[/b] engagé ou d\'un grand domaine. C\'est une immersion complète dans le patrimoine œnologique de la région.', '[b]Douceurs et Découvertes : La Pâtisserie à l\'Honneur[/b]', 'Les amateurs de sucré ne sont pas en reste. Les [b]pâtissiers[/b] bordelais dévoilent leurs talents avec des [b]desserts[/b] raffinés et innovants. Le [b]Marché BIO[/b] inspire également de nouvelles créations, où les fruits de saison et les ingrédients locaux sont sublimés. Cet événement est une véritable célébration des [b]produits[/b] de qualité, offrant une [b]dégustation[/b] variée qui ravit tous les palais, des plus classiques aux plus aventureux.', 'Le festival culinaire de [b]Bordeaux[/b] est un rendez-vous à ne pas manquer pour quiconque souhaite explorer la richesse de notre [b]gastronomie[/b]. Entre [b]tradition[/b], [b]innovation[/b], [b]délicieux[/b] [b]plats[/b] et [b]vins[/b] d\'exception, c\'est une expérience [b]incroyable[/b] et [b]élégante[/b] qui prouve, une fois de plus, pourquoi [b]Bordeaux[/b] est une capitale mondiale du bon goût.', 'art_69848851196ef4.80247224.jpeg', 1),
(17, '2026-02-05 03:10:04', '2026-02-05 05:57:50', 'Bordeaux se Réinvente : L\'Ère de la Cuisine Fusion et Créative', '[i]Loin des clichés, la scène gastronomique bordelaise embrasse un mouvement émergeant : la fusion. Chefs audacieux marient [b]terroir[/b] et influences du monde, créant une cuisine [u]moderne[/u] et incroyablement savoureuse.[/i]', 'Bordeaux, ville d\'histoire et de [b]tradition[/b], prouve qu\'elle est aussi à la pointe de l\'[u]inno', 'Dans les [b]restaurants[/b] de [b]Bordeaux[/b], une nouvelle dynamique se dessine : celle de la cuisine fusion. Les [b]chefs[/b] explorent des saveurs lointaines pour les marier aux [b]produits locaux[/b] d\'exception. Imaginez une [b]recette[/b] classique revisitée avec des épices asiatiques, ou un poisson de l\'Atlantique sublimé par des techniques latino-américaines. Chaque [b]plat[/b] est une [b]dégustation[/b] surprenante et [b]délicieuse[/b], où l\'[b]élégance[/b] de la présentation n\'a d\'égale que la richesse des goûts.', '[b]Quand le Vin d\'Appellation Rencontre des Saveurs Exotiques[/b]', 'L\'intégration de cette [b]cuisine moderne[/b] s\'étend naturellement au [b]vin[/b]. Les [b]cavistes[/b] et sommeliers relèvent le défi de trouver les accords parfaits entre les [b]vins d\'appellation[/b] de notre [b]vignoble[/b] et ces créations métissées. Un service [b]incroyable[/b] et attentif permet de guider les convives à travers des associations audacieuses. Ce mariage réussi entre le local et l\'international confirme le dynamisme et l\'ouverture de la [b]gastronomie[/b] bordelaise.', '[b]De Nouveaux Horizons pour les Papilles Bordelaises[/b]', 'Cette [b]innovation[/b] se retrouve également dans les [b]desserts[/b] et les [b]cocktails[/b]. Les [b]pâtissiers[/b] créent des douceurs où les fruits exotiques se mêlent aux saveurs du [b]terroir[/b], tandis que les barmen inventent des boissons qui complètent harmonieusement ces nouvelles expériences gustatives. C\'est un mouvement qui encourage la découverte et l\'ouverture d\'esprit, faisant de [b]Bordeaux[/b] une destination encore plus [b]délicieuse[/b] et passionnante.', 'Le mouvement de la cuisine fusion est une preuve éclatante que la [b]gastronomie[/b] de [b]Bordeaux[/b] est en constante évolution. Grâce à des [b]chefs[/b] visionnaires, la ville offre désormais des expériences culinaires [b]incroyables[/b], mariant avec succès [b]tradition[/b] et influences du monde entier pour le plus grand plaisir des papilles.', 'art_69848846ef72d2.99110812.jpeg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `numCom` int(11) NOT NULL,
  `dtCreaCom` datetime DEFAULT current_timestamp(),
  `libCom` text NOT NULL,
  `dtModCom` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `attModOK` tinyint(1) DEFAULT 0,
  `notifComKOAff` text DEFAULT NULL,
  `dtDelLogCom` datetime DEFAULT NULL,
  `delLogiq` tinyint(1) DEFAULT 0,
  `numArt` int(11) NOT NULL,
  `numMemb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`numCom`, `dtCreaCom`, `libCom`, `dtModCom`, `attModOK`, `notifComKOAff`, `dtDelLogCom`, `delLogiq`, `numArt`, `numMemb`) VALUES
(11, '2026-02-04 08:21:52', 'Vraiment pas à mon goût, ça respire vraiment l\'IA... Trop dommage!', '2026-02-04 08:22:30', 0, 'Blasphématoire', NULL, 1, 9, 1009),
(12, '2026-02-04 08:24:12', 'Waouh, super article ! Ça se voit que ce n’est pas généré par une IA, ça change des autres blogs !', '2026-02-04 08:29:05', 1, NULL, NULL, 0, 9, 1005),
(13, '2026-02-04 08:26:47', 'Je chercher justement des bonnes adresse ! Merci SAGASTRONOMIQUE !', '2026-02-04 08:27:29', 1, NULL, NULL, 0, 10, 1005),
(14, '2026-02-04 08:27:23', 'Francheman, il è mème pa complé sept artikle... Cé pa profesionèl, sa menque de kalité, sé vréman pa ouf. Je reviundrai plu !!!', '2026-02-04 08:28:47', 0, 'Mes yeux saignent.', NULL, 1, 10, 1009),
(15, '2026-02-04 08:30:08', 'on est dans Ratatouille là ou quoi?', '2026-02-04 08:36:59', 0, 'Et tu n’es pas critique culinaire', NULL, 1, 11, 1009),
(16, '2026-02-04 08:33:11', 'Excellent article, ça m\'a vraiment passionné !', '2026-02-04 08:37:21', 1, NULL, NULL, 0, 9, 1003),
(18, '2026-02-04 08:43:57', 'Bordeaux est le berceau de la quintessence de la gastronomie française, tel une mélodie sur le palet à chaque adresse conseillée par la plateforme numérique Bordeaux Sagastronomique. Merci du plus profond de mon coeur.', '2026-02-04 08:44:46', 1, NULL, NULL, 0, 13, 1009),
(19, '2026-02-04 08:45:01', 'C\'est quoi ces titres qui ne veulent rien dire ! Vraiment nul, le mec qui à écrit ça ne sait même pas écrire un prompte ! Puis les sujets sont minable, y\'a pas d\'information, je suis sûr que le site a été coder en 1h par des incompétents notoire.', NULL, 0, NULL, NULL, 0, 13, 1005),
(20, '2026-02-04 08:47:02', 'Il est assez visible que ce site a été créé par des incompétents notoires en moins d\'1h, c\'est n\'importe quoi !', '2026-02-04 08:47:44', 0, 'Si tu n\'es pas content ne commente pas', NULL, 1, 10, 1003),
(22, '2026-02-04 08:48:40', 'Je connais le chef sur la photo !! C\'est mon cousin !', '2026-02-05 03:09:11', 1, NULL, NULL, 0, 11, 1005),
(24, '2026-02-05 03:08:55', 'Trop bien comme adresse, je connaissais pas du tout! Rendre la gastronomie relativement abordable permet à tout le monde de profiter de ces expériences culinaires!', NULL, 0, NULL, NULL, 0, 15, 1009),
(25, '2026-02-05 03:12:08', 'Trop drôle, je connais le monsieur en arrière plan, c\'est mon cousin!', '2026-02-05 03:12:17', 1, NULL, NULL, 0, 17, 1009);

-- --------------------------------------------------------

--
-- Structure de la table `likeart`
--

CREATE TABLE `likeart` (
  `numMemb` int(11) NOT NULL,
  `numArt` int(11) NOT NULL,
  `likeA` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `likeart`
--

INSERT INTO `likeart` (`numMemb`, `numArt`, `likeA`) VALUES
(7, 9, 1),
(7, 10, 1),
(7, 11, 1),
(7, 12, 1),
(7, 13, 1),
(7, 14, 1),
(7, 15, 1),
(7, 16, 1),
(7, 17, 1),
(1003, 9, 1),
(1003, 12, 1),
(1003, 13, 1),
(1009, 9, 1),
(1009, 10, 1),
(1009, 15, 1),
(1009, 17, 1);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `numMemb` int(11) NOT NULL,
  `prenomMemb` varchar(70) NOT NULL,
  `nomMemb` varchar(70) NOT NULL,
  `pseudoMemb` varchar(70) NOT NULL,
  `passMemb` varchar(70) NOT NULL,
  `eMailMemb` varchar(100) NOT NULL,
  `dtCreaMemb` datetime DEFAULT current_timestamp(),
  `dtMajMemb` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `accordMemb` tinyint(1) DEFAULT 1,
  `cookieMemb` varchar(70) DEFAULT NULL,
  `numStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`numMemb`, `prenomMemb`, `nomMemb`, `pseudoMemb`, `passMemb`, `eMailMemb`, `dtCreaMemb`, `dtMajMemb`, `accordMemb`, `cookieMemb`, `numStat`) VALUES
(7, 'Paul', 'PAULY', 'Paul Pauly', '$2y$10$wgeJEJH5RT0hMrxwnctS7.CtIRCZokEacoBttQMZtpj93J7gugh3C', 'paul.pauly@mmibordeaux.com', '2026-01-29 16:55:44', '2026-02-04 04:26:55', 1, NULL, 1),
(1003, 'Justin', 'Esquer', 'JuJust1', '$2y$10$4JumJTSEb0sxdAM7BZ6Mkeswb2gkSr7ygS3ABK4Bnyt9QMZVXFIHu', 'juste1secondaire@gmail.com', '2026-02-04 07:36:56', '2026-02-04 07:41:04', 1, NULL, 1),
(1005, 'MonPrenom', 'MonNom', 'TheoAdmin', '$2y$10$ozCP82sKw4z7AbYgaQn.Me4hTH2Nl1.PJH4Rpx.F4JrH5Y6K1TkzK', 'TC@example.com', '2026-02-04 07:43:19', '2026-02-04 07:52:43', 1, NULL, 1),
(1006, 'Admin', 'Admin', 'Admin01', '$2y$10$elgzt.rkYTNAeFyKY6XdhevCzEitx9SX9zkodL0RaP8nfymxB03HC', 'admin@blogart26.com', '2026-02-04 10:47:46', NULL, 1, NULL, 1),
(1007, 'Modo', 'Modo', 'Modo01', '$2y$10$WYE8TWob3DdENv0wMGHwc.kDrbZ8JnzADgZjyatBGBMl2cXzLQlIy', 'modo@blogart26.com', '2026-02-04 10:48:47', NULL, 1, NULL, 2),
(1008, 'User', 'User', 'User01', '$2y$10$rV89Mn6l8VobNCPRCMr09.OVHcHZssr/gHovkGtaIEl5TzG6r0H7u', 'user@blogart26.com', '2026-02-04 10:50:37', NULL, 1, NULL, 3),
(1009, 'Julianne', 'ROGAM', 'Jujuuu07', '$2y$10$LMVG9nd.cubLLO3CpEdWK.XbYoXG2bkfcZIB7924ai5WxGHtT3dJS', 'julianne.rogam@blogart.fr', '2026-02-04 07:54:30', '2026-02-04 11:05:37', 1, NULL, 1),
(1010, 'lisa', 'bruno', 'lisabrn', '$2y$10$NNrTi9JG6ViXglgObUmgHeyvL8RWeCcFZd5JmCEY5682sYMsUSrtG', 'bruno.lisa@mmibordeaux.com', '2026-02-04 08:07:48', '2026-02-04 11:08:24', 1, NULL, 1),
(1011, 'Eliott', 'Beauchamp', 'Eliott Beauchamp', '$2y$10$PNCAzDfjv/1L6.GcU51xRO37.IC4jfl9jRbZFtb32Zm5h.Xqh8.5S', 'eliott.beauchamp@mmibordeaux.com', '2026-02-05 00:21:16', '2026-02-05 00:22:30', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `motcle`
--

CREATE TABLE `motcle` (
  `numMotCle` int(11) NOT NULL,
  `libMotCle` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `motcle`
--

INSERT INTO `motcle` (`numMotCle`, `libMotCle`) VALUES
(1, 'Bordeaux'),
(8, 'Vin'),
(9, 'Gatsronomie'),
(10, 'Restaurant'),
(11, 'Chef'),
(12, 'Tradition'),
(13, 'Innovation'),
(14, 'Terroir'),
(15, 'Dégustation'),
(17, 'Producteur Local'),
(18, 'Cuisine Moderne'),
(19, 'Événement'),
(20, 'Festival Culinaire'),
(21, 'Brasserie'),
(22, 'Caviste'),
(23, 'Pâtisserie'),
(24, 'Marché BIO'),
(25, 'Recette'),
(26, 'Vignoble'),
(27, 'Appellation'),
(28, 'Dégustation'),
(29, 'Dégustation de vin'),
(30, 'Délicieux'),
(31, 'Incroyable'),
(33, 'Bon'),
(34, 'Plats'),
(35, 'Desserts'),
(36, 'Cocktails'),
(37, 'Entrées'),
(39, 'Service'),
(40, 'Produits'),
(41, 'Elegant');

-- --------------------------------------------------------

--
-- Structure de la table `motclearticle`
--

CREATE TABLE `motclearticle` (
  `numArt` int(11) NOT NULL,
  `numMotCle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `motclearticle`
--

INSERT INTO `motclearticle` (`numArt`, `numMotCle`) VALUES
(9, 1),
(9, 8),
(9, 9),
(9, 10),
(9, 11),
(9, 12),
(9, 13),
(9, 14),
(9, 15),
(9, 17),
(9, 19),
(9, 20),
(9, 26),
(9, 27),
(9, 29),
(10, 1),
(10, 8),
(10, 9),
(10, 10),
(10, 11),
(10, 12),
(10, 13),
(10, 14),
(10, 15),
(10, 17),
(10, 18),
(10, 23),
(10, 24),
(10, 25),
(10, 26),
(10, 27),
(10, 30),
(10, 31),
(10, 33),
(10, 34),
(10, 35),
(10, 36),
(10, 37),
(10, 39),
(10, 40),
(10, 41),
(11, 1),
(11, 9),
(11, 10),
(11, 11),
(11, 12),
(11, 13),
(11, 14),
(11, 18),
(11, 26),
(11, 28),
(11, 30),
(11, 34),
(11, 35),
(11, 39),
(11, 41),
(12, 1),
(12, 8),
(12, 9),
(12, 10),
(12, 11),
(12, 14),
(12, 15),
(12, 18),
(12, 23),
(12, 26),
(12, 30),
(12, 34),
(12, 35),
(12, 39),
(12, 41),
(13, 1),
(13, 8),
(13, 9),
(13, 11),
(13, 13),
(13, 14),
(13, 15),
(13, 17),
(13, 18),
(13, 25),
(13, 30),
(13, 31),
(13, 35),
(13, 37),
(13, 41),
(14, 1),
(14, 8),
(14, 9),
(14, 11),
(14, 14),
(14, 17),
(14, 18),
(14, 22),
(14, 24),
(14, 26),
(14, 29),
(14, 30),
(14, 34),
(14, 39),
(14, 41),
(15, 1),
(15, 9),
(15, 14),
(15, 18),
(15, 30),
(15, 31),
(15, 34),
(15, 41),
(16, 1),
(16, 8),
(16, 9),
(16, 11),
(16, 12),
(16, 13),
(16, 14),
(16, 15),
(16, 17),
(16, 18),
(16, 19),
(16, 20),
(16, 22),
(16, 23),
(16, 24),
(16, 25),
(16, 26),
(16, 27),
(16, 30),
(16, 31),
(16, 33),
(16, 34),
(16, 35),
(16, 36),
(16, 37),
(16, 39),
(16, 40),
(16, 41),
(17, 1),
(17, 8),
(17, 9),
(17, 11),
(17, 13),
(17, 14),
(17, 15),
(17, 18),
(17, 25),
(17, 31),
(17, 34),
(17, 35),
(17, 41);

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `numStat` int(11) NOT NULL,
  `libStat` varchar(25) NOT NULL,
  `dtCreaStat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`numStat`, `libStat`, `dtCreaStat`) VALUES
(1, 'Administrateur', '2023-02-19 15:15:59'),
(2, 'Modérateur', '2023-02-19 15:19:12'),
(3, 'Membre', '2023-02-20 08:43:24');

-- --------------------------------------------------------

--
-- Structure de la table `thematique`
--

CREATE TABLE `thematique` (
  `numThem` int(11) NOT NULL,
  `libThem` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `thematique`
--

INSERT INTO `thematique` (`numThem`, `libThem`) VALUES
(1, 'L\'événement'),
(2, 'L\'acteur-clé'),
(3, 'Le mouvement émergeant'),
(4, 'L\'insolite / le clin d\'œil');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`numArt`),
  ADD KEY `ARTICLE_FK` (`numArt`),
  ADD KEY `FK_ASSOCIATION_1` (`numThem`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`numCom`),
  ADD KEY `COMMENT_FK` (`numCom`),
  ADD KEY `FK_ASSOCIATION_2` (`numArt`),
  ADD KEY `FK_ASSOCIATION_3` (`numMemb`);

--
-- Index pour la table `likeart`
--
ALTER TABLE `likeart`
  ADD PRIMARY KEY (`numMemb`,`numArt`),
  ADD KEY `LIKEART_FK` (`numMemb`,`numArt`),
  ADD KEY `FK_LIKEART1` (`numArt`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`numMemb`),
  ADD KEY `MEMBRE_FK` (`numMemb`),
  ADD KEY `FK_ASSOCIATION_4` (`numStat`);

--
-- Index pour la table `motcle`
--
ALTER TABLE `motcle`
  ADD PRIMARY KEY (`numMotCle`),
  ADD KEY `MOTCLE_FK` (`numMotCle`);

--
-- Index pour la table `motclearticle`
--
ALTER TABLE `motclearticle`
  ADD PRIMARY KEY (`numArt`,`numMotCle`),
  ADD KEY `MOTCLEARTICLE_FK` (`numArt`),
  ADD KEY `MOTCLEARTICLE2_FK` (`numMotCle`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`numStat`),
  ADD KEY `STATUT_FK` (`numStat`);

--
-- Index pour la table `thematique`
--
ALTER TABLE `thematique`
  ADD PRIMARY KEY (`numThem`),
  ADD KEY `THEMATIQUE_FK` (`numThem`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `numArt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `numCom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `numMemb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1012;

--
-- AUTO_INCREMENT pour la table `motcle`
--
ALTER TABLE `motcle`
  MODIFY `numMotCle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `numStat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `thematique`
--
ALTER TABLE `thematique`
  MODIFY `numThem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_ASSOCIATION_1` FOREIGN KEY (`numThem`) REFERENCES `thematique` (`numThem`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_ASSOCIATION_2` FOREIGN KEY (`numArt`) REFERENCES `article` (`numArt`),
  ADD CONSTRAINT `FK_ASSOCIATION_3` FOREIGN KEY (`numMemb`) REFERENCES `membre` (`numMemb`);

--
-- Contraintes pour la table `likeart`
--
ALTER TABLE `likeart`
  ADD CONSTRAINT `FK_LIKEART1` FOREIGN KEY (`numArt`) REFERENCES `article` (`numArt`),
  ADD CONSTRAINT `FK_LIKEART2` FOREIGN KEY (`numMemb`) REFERENCES `membre` (`numMemb`);

--
-- Contraintes pour la table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `FK_ASSOCIATION_4` FOREIGN KEY (`numStat`) REFERENCES `statut` (`numStat`);

--
-- Contraintes pour la table `motclearticle`
--
ALTER TABLE `motclearticle`
  ADD CONSTRAINT `FK_MotCleArt1` FOREIGN KEY (`numMotCle`) REFERENCES `motcle` (`numMotCle`),
  ADD CONSTRAINT `FK_MotCleArt2` FOREIGN KEY (`numArt`) REFERENCES `article` (`numArt`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
