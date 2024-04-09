-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 06:58 PM
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
-- Database: `bookworm`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookdetails`
--

CREATE TABLE `bookdetails` (
  `bookId` int(4) NOT NULL,
  `bookName` varchar(50) NOT NULL,
  `bookGenre` varchar(20) NOT NULL,
  `authorName` varchar(50) NOT NULL,
  `bookDescription` varchar(5000) NOT NULL,
  `bookImage` varchar(200) NOT NULL,
  `bookPrice` double NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookdetails`
--

INSERT INTO `bookdetails` (`bookId`, `bookName`, `bookGenre`, `authorName`, `bookDescription`, `bookImage`, `bookPrice`, `date`) VALUES
(1, 'The Art Of War', 'Non-Fiction', 'Sun Tzu', 'Written in the 6th century BC, Sun Tzu’s The Art of War is still used as a book of military strategy today. Napoleon, Mae Zedong, General Vo Nguyen Giap and General Douglas MacArthur all claimed to have drawn inspiration from it. And beyond the world of war, business and management gurus have also applied Sun Tzu’s ideas to office politics and corporate strategy.', 'ArtOfWar.jpg', 42.1, '2024-03-30 22:27:02'),
(2, 'Between The World And Me', 'Non-Fiction', 'Ta-Nehisi Coates', '“This is your country, this is your world, this is your body, and you must find some way to live within the all of it.” In a profound work that pivots from the biggest questions about American history and ideals to the most intimate concerns of a father for his son, Ta-Nehisi Coates offers a powerful new framework for understanding our nation’s history and current crisis. Americans have built an empire on the idea of “race,” a falsehood that damages us all but falls most heavily on the bodies of black women and men—bodies exploited through slavery and segregation, and, today, threatened, locked up, and murdered out of all proportion. What is it like to inhabit a black body and find a way to live within it? And how can we all honestly reckon with this fraught history and free ourselves from its burden? Between the World and Me is Ta-Nehisi Coates’s attempt to answer these questions in a letter to his adolescent son. Coates shares with his son—and readers—the story of his awakening to the truth about his place in the world through a series of revelatory experiences, from Howard University to Civil War battlefields, from the South Side of Chicago to Paris, from his childhood home to the living rooms of mothers whose children’s lives were taken as American plunder. Beautifully woven from personal narrative, reimagined history, and fresh, emotionally charged reportage, Between the World and Me clearly illuminates the past, bracingly confronts our present, and offers a transcendent vision for a way forward.', 'betweenTheWorldAndMe.jpg', 32, '2024-03-30 22:27:02'),
(4, 'Dune', 'Sci-Fi', 'Frank Herbert', 'Set on the desert planet Arrakis, Dune is the story of the boy Paul Atreides, heir to a noble family tasked with ruling an inhospitable world where the only thing of value is the “spice” melange, a drug capable of extending life and enhancing consciousness. Coveted across the known universe, melange is a prize worth killing for...When House Atreides is betrayed, the destruction of Paul’s family will set the boy on a journey toward a destiny greater than he could ever have imagined. And as he evolves into the mysterious man known as Muad’Dib, he will bring to fruition humankind’s most ancient and unattainable dream.', 'Dune.jpg', 47.15, '2024-03-30 22:27:02'),
(5, 'Akira, Vol. 1', 'Sci-Fi', 'Katsuhiro Otomo', 'Welcome to Neo-Tokyo, built on the ashes of a Tokyo annihilated by a blast of unknown origin that triggered World War III. The lives of two streetwise teenage friends, Tetsuo and Kaneda, change forever when paranormal abilities begin to waken in Tetsuo, making him a target for a shadowy agency that will stop at nothing to prevent another catastrophe like the one that leveled Tokyo. At the core of the agency’s motivation is a raw, all-consuming fear of an unthinkable, monstrous power known only as Akira.Katsuhiro Otomo’s stunning science fiction masterpiece is considered by many to be the finest work of graphic fiction ever produced, and Otomo’s brilliant animated film version is regarded worldwide as a classic.This edition includes a new foreword from the author and a postscript from Dark Horse publisher Mike Richardson!', 'Akira_Vol1.jpg', 98.55, '2024-03-30 22:27:02'),
(6, 'Dune Messiah', 'Sci-Fi', 'Frank Herbert', 'Book Two in the Magnificent Dune Chronicles--the Bestselling Science Fiction Adventure of All TimeDune Messiah continues the story of Paul Atreides, better known--and feared--as the man christened Muad\'Dib. As Emperor of the Known Universe, he possesses more power than a single man was ever meant to wield. Worshipped as a religious icon by the fanatical Fremens, Paul faces the enmity of the political houses he displaced when he assumed the throne--and a conspiracy conducted within his own sphere of influence.And even as House Atreides begins to crumble around him from the machinations of his enemies, the true threat to Paul comes to his lover, Chani, and the unborn heir to his family\'s dynasty...Includes an introduction by Brian Herbert', 'Dune_Messiah.jpg', 47.15, '2024-03-30 22:27:02'),
(7, 'Akira, Vol. 2', 'Sci-Fi', 'Katsuhiro Otomo', 'In the year 2019, a cataclysmic blast levels the city of Tokyo and triggers World War III. By 2030, the dazzling Neo-Tokyo rises from Tokyo\'s ashes, but the power that once sent the world to the brink of Armageddon-a being of monstrous telekinetic power known only as Akira-lives on in absolute-zero frozen stasis far below the city. Those who stand guard will stop at nothing to keep Akira from awakening, but an angry young man named Tetsuo, himself possessing of immense-and rapidly growing-psychic abilities, becomes obsessed with confronting Akira face-to-face. In time, Akira will surely awaken, and Tetsuo may be the only being potentially capable of controlling him, but Tetsuo is becoming increasingly unstable and violent, and a group including his former friend Kaneda sets out to destroy Tetsuo before he can release Akira-or before Tetsuo himself becomes so powerful that no force on Earth can stop him!', 'Akira_Vol2.jpg', 98.55, '2024-03-30 22:27:02'),
(8, 'Akira, Vol. 3', 'Sci-Fi', 'Katsuhiro Otomo', 'In the 21st century, the glittering Neo-Tokyo has risen from the rubble of a Tokyo destroyed by an apocalyptic telekinetic blast from a young boy called Akira -- the subject of a covert government experiment gone wrong now imprisoned in frozen stasis. But Tetsuo, an angry young man with immense and rapidly growing psychic abilities, has done the unthinkable: he has released Akira and set into motion a chain of events that could once destroy the city and drag the world to the brink of Armageddon. Resistance agents and an armada of government forces race against the clock to find the child with godlike powers before his unthinkable destructive abilities are unleashed!', 'Akira_Vol3.jpg', 98.55, '2024-03-30 22:27:02'),
(9, 'Akira, Vol. 4', 'Sci-Fi', 'Katsuhiro Otomo', 'Set off by the bullet of a would-be assassin, Neo-Tokyo has been leveled by Akira\'s godlike psychic fury. Now cut off from the rest of world, the Great Tokyo Empire rises, with Akira its king, Tetsuo its mad prime minister, and a growing army of fanatic acolytes. Forces on the outside still search for a way to stop Akira, and the answer may lie in the hands of the mysterious Lady Miyako, a powerful member of Akira\'s psychic brotherhood. But the solution to harnessing Akira may ultimately be more dangerous than Akira himself!', 'Akira_Vol4.jpg', 98.55, '2024-03-30 22:27:02'),
(10, 'Akira, Vol. 5', 'Sci-Fi', 'Katsuhiro Otomo', 'In the 21st century, the once-glittering Neo-Tokyo lies in ruins, leveled in minutes by the infinite power of the child psychic giant, Akira. Now a wasteland of rubble and anarchy, the Great Tokyo Empire rises, a ragtag group of zealots and crazies who worship and fear Akira and his mad prime minister, Tetsuo, an angry teen with immense powers of his own -- and equally immense twisted ambitions. The planet at large is not taking the threat lying down, however, and the might of the world is ready to take on the Empire, but will technology\'s most advanced weaponry be enough to destroy Akira -- and is Tetsuo an ever greater threat?', 'Akira_Vol5.jpg', 98.55, '2024-03-30 22:27:02'),
(11, 'Akira, Vol. 6', 'Sci-Fi', 'Katsuhiro Otomo', 'The explosive finale to one of graphic fiction\'s greatest achievements is here! The mad psychic colossus Tetsuo, the world\'s military, and the remaining psychics of The Project face off -- with the child psychic god, Akira, the wild card -- in what may not only decide the fate of mankind, but may determine the next step in human evolution! This long-awaited volume -- a staggering 440 pages -- features the impossible-to-find final chapters of Akira, never before collected in the U.S., presented as they were intended to be seen in their original, stunning black and white! Featuring a revised translation and top-quality art reproduction, this is the final edition of one of comics\' definitive works, a six-volume epic of over two thousand pages. Katsuhiro Otomo\'s entire masterpiece is finally available -- only from Dark Horse!', 'Akira_Vol6.jpg', 98.55, '2024-03-30 22:27:02'),
(12, 'Planetes, Vol. 1', 'Sci-Fi', 'Makoto Yukimura', 'Haunted by a space flight accident that claimed his beloved wife, Yuri finds a job cleaning space debris from Earth\'s orbit. His team consists of Hachimaki, a hot shot debris-man with a sailor\'s affinity for the orbital ocean; Fee, a tomboy beauty with an abrasive edge and a penchant for smoking; and Pops, a veteran orbital mechanic whose avuncular presence soothes the stress of the job. Planetes follows the lives of Yuri and his fellow debris-men as they work and ruminate at the edge of the great empyrean sea.', 'Planetes_Vol1.jpg', 36.8, '2024-03-30 22:27:02'),
(13, 'Planetes, Vol. 2', 'Sci-Fi', 'Makoto Yukimura', 'Yuri, Hachimaki and Fee already have a new ship to return to work. Once surpassed its spatial phobia, Hachimaki decides to take seriously his physical training to pass the test of E.V.A. Its goal is to be part of the team responsible for the first ship shuttle Jupiter, the Von Braun. What we do not know any of the three astronauts is that it has cast them a stowaway, Goro Hoshino, the father of Hachi. The Locksmith magnate by the Von Braun project wants to hire him as a mechanic but he refuses. This may be the opportunity for Hachimaki to achieve his dream.', 'Planetes_Vol2.jpg', 36.8, '2024-03-30 22:27:02'),
(14, 'Planetes, Vol. 3', 'Sci-Fi', 'Makoto Yukimura', 'After an excruciating selection process, Hachimaki is accepted into the Mars Development Project, his lifelong dream. However, feelings of elation are soon sucked up by a black hole of despair as he comes to grips with the fact that he will be leaving everything he holds dear behind. This realization forces Hachimaki to contemplate the meaning of his existence and the nature of his life in space.', 'Planetes_Vol3.jpg', 36.8, '2024-03-30 22:27:02'),
(15, 'Planetes, Vol. 4', 'Sci-Fi', 'Makoto Yukimura', 'Tanabe makes friends with an alleged extraterrestrial! Meanwhile, Hachimaki begins his training for the trip to Jupiter, but faces melancholy and makes an important decision. And, with the imminent space war, Fee deals with her domestic issues and remembers her past with her uncle, to reconsider her stance on injustices in front of her.', 'Planetes_Vol4.jpg', 36.8, '2024-03-30 22:27:02'),
(16, 'Stormlight Archive: The Way Of Kings', 'Fantasy', 'Brandon Sanderson', 'From #1 New York Times bestselling author Brandon Sanderson, The Way of Kings, book one of The Stormlight Archive begins an incredible new saga of epic proportion.Roshar is a world of stone and storms. Uncanny tempests of incredible power sweep across the rocky terrain so frequently that they have shaped ecology and civilization alike. Animals hide in shells, trees pull in branches, and grass retracts into the soilless ground. Cities are built only where the topography offers shelter.It has been centuries since the fall of the ten consecrated orders known as the Knights Radiant, but their Shardblades and Shardplate remain: mystical swords and suits of armor that transform ordinary men into near-invincible warriors. Men trade kingdoms for Shardblades. Wars were fought for them, and won by them.One such war rages on a ruined landscape called the Shattered Plains. There, Kaladin, who traded his medical apprenticeship for a spear to protect his little brother, has been reduced to slavery. In a war that makes no sense, where ten armies fight separately against a single foe, he struggles to save his men and to fathom the leaders who consider them expendable.Brightlord Dalinar Kholin commands one of those other armies. Like his brother, the late king, he is fascinated by an ancient text called The Way of Kings. Troubled by over-powering visions of ancient times and the Knights Radiant, he has begun to doubt his own sanity.Across the ocean, an untried young woman named Shallan seeks to train under an eminent scholar and notorious heretic, Dalinar\'s niece, Jasnah. Though she genuinely loves learning, Shallan\'s motives are less than pure. As she plans a daring theft, her research for Jasnah hints at secrets of the Knights Radiant and the true cause of the war.The result of over ten years of planning, writing, and world-building, The Way of Kings is but the opening movement of the Stormlight Archive, a bold masterpiece in the making.Speak again the ancient oaths:Life before death.Strength before weakness.Journey before Destination.and return to men the Shards they once bore.The Knights Radiant must stand again.', 'TheWayOfKings.jpg', 47.2, '2024-03-30 22:27:02'),
(17, 'Stormlight Archive: Words of Radiance', 'Fantasy', 'Brandon Sanderson', 'Words of Radiance, Book Two of the Stormlight Archive, continues the immersive fantasy epic that The Way of Kings began.Expected by his enemies to die the miserable death of a military slave, Kaladin survived to be given command of the royal bodyguards, a controversial first for a low-status ', 'WordsOfRadiance.jpg', 47.2, '2024-03-30 22:27:02'),
(18, 'Stormlight Archive: Oathbringer', 'Fantasy', 'Brandon Sanderson', 'In Oathbringer, the third volume of the New York Times bestselling Stormlight Archive, humanity faces a new Desolation with the return of the Voidbringers, a foe with numbers as great as their thirst for vengeance.Dalinar Kholin\'s Alethi armies won a fleeting victory at a terrible cost: The enemy Parshendi summoned the violent Everstorm, which now sweeps the world with destruction, and in its passing awakens the once peaceful and subservient parshmen to the horror of their millennia-long enslavement by humans. While on a desperate flight to warn his family of the threat, Kaladin Stormblessed must come to grips with the fact that the newly kindled anger of the parshmen may be wholly justified.Nestled in the mountains high above the storms, in the tower city of Urithiru, Shallan Davar investigates the wonders of the ancient stronghold of the Knights Radiant and unearths dark secrets lurking in its depths. And Dalinar realizes that his holy mission to unite his homeland of Alethkar was too narrow in scope. Unless all the nations of Roshar can put aside Dalinar\'s blood-soaked past and stand together--and unless Dalinar himself can confront that past--even the restoration of the Knights Radiant will not prevent the end of civilization.', 'Oathbringer.jpg', 47.2, '2024-03-30 22:27:02'),
(19, 'Stormlight Archive: Rhythm Of War', 'Fantasy', 'Brandon Sanderson', 'The eagerly awaited sequel to the #1 New York Times bestselling Oathbringer, from epic fantasy author Brandon SandersonAfter forming a coalition of human resistance against the enemy invasion, Dalinar Kholin and his Knights Radiant have spent a year fighting a protracted, brutal war. Neither side has gained an advantage, and the threat of a betrayal by Dalinar\'s crafty ally Taravangian looms over every strategic move.Now, as new technological discoveries by Navani Kholin\'s scholars begin to change the face of the war, the enemy prepares a bold and dangerous operation. The arms race that follows will challenge the very core of the Radiant ideals, and potentially reveal the secrets of the ancient tower that was once the heart of their strength.At the same time that Kaladin Stormblessed must come to grips with his changing role within the Knights Radiant, his Windrunners face their own problem: As more and more deadly enemy Fused awaken to wage war, no more honorspren are willing to bond with humans to increase the number of Radiants. Adolin and Shallan must lead the coalition’s envoy to the honorspren stronghold of Lasting Integrity and either convince the spren to join the cause against the evil god Odium, or personally face the storm of failure.', 'RhythmOfWar.jpg', 47.2, '2024-03-30 22:27:02'),
(20, 'Nirnama', 'Fantasy', 'Hilal Asyraf', 'A warrior without a name has become the talk of the town. His carefree attitude helps the people across the Peninsula, and his boldness in opposing the tyranny of the holy rulers has made him the subject of discussion among the people.No one knows his name. Hence, the public starts calling him Nirnama - Nameless.Following Nirnama\'s latest intervention, the Ujing Region, a territory of the Kingdom of Indera Kayangan, falls into the hands of the White Semutar Kingdom, causing the holy rulers, the government of the Kingdom of Indera Kayangan, and the rulers of the Peninsula to become increasingly suspicious of the reality of a being named Nirnama.Will Nirnama pose a threat to him?What is the connection between Nirnama and the White Semutar Kingdom?Who is Nirnama really?', 'Nirnama.jpg', 50, '2024-03-30 22:27:02'),
(21, 'Ascendance Of A Bookworm: Part 1 Volume 1', 'Fantasy', 'Miya Kazuki', 'A certain college girl who\'s loved books ever since she was a little girl dies in an accident and is reborn in another world she knows nothing about. She is now Myne, the sickly five-year-old daughter of a poor soldier. To make things worse, the world she\'s been reborn in has a very low literacy rate and books mostly don\'t exist. She\'d have to pay an enormous amount of money to buy one.Myne resolves herself: If there aren\'t any books, she\'ll just have to make them! Her goal is to become a librarian. This story begins with her quest to make books so she can live surrounded by them!Dive into this biblio-fantasy written for book lovers and bookworms!', 'AscendanceOfABookworm_P1Vol1.jpg', 37.75, '2024-03-30 22:27:02'),
(22, 'Ascendance Of A Bookworm: Part 1 Volume 2', 'Fantasy', 'Miya Kazuki', 'It has been a year since our hero was reborn into a new world in the body of Myne, a sickly little girl from a poor family. She\'s been doing her best to fulfill her dream of making books, but her plans have been foiled at every turn.But now Myne has a deal with Benno the merchant: With her friend Lutz\'s help, she will make a paper prototype that he can sell in his shop. In exchange, he will take her and Lutz on as apprentices. But making the prototype is filled with its own challenges, and can she trust a conniving merchant like Benno? And the most important question is, does Myne have the deadly sickness known as ', 'AscendanceOfABookworm_P1Vol2.jpg', 37.75, '2024-03-30 22:27:02'),
(23, 'Ascendance Of A Bookworm: Part 1 Volume 3', 'Fantasy', 'Miya Kazuki', 'Just as Myne gets her foot in the door of making paper, she collapses due to the sickness known as the devouring. She\'s getting better thanks to the help of those around her, but the devouring remains clouded in mystery. As the world expands, so too does her passion for making books! This volume is the conclusion to Part 1 and shows a glimpse into the future of the series!', 'AscendanceOfABookworm_P1Vol3.jpg', 37.75, '2024-03-30 22:27:02'),
(24, 'Pluto, Vol.1', 'Mystery', 'Naoki Urasawa', 'In a distant future where sentient humanoid robots pass for human, someone or some thing is out to destroy the seven great robots of the world. Europol\'s top detective Gesicht is assigned to investigate these mysterious robot serial murders; the only catch is that he himself is one of the seven targets.', 'Pluto_Vol1.jpg', 51.9, '2024-03-30 22:27:02'),
(25, 'Pluto, Vol.2', 'Mystery', 'Naoki Urasawa', 'In a distant future where sentient humanoid robots pass for human, someone or some thing is out to destroy the seven great robots of the world. Europol’s top detective Gesicht is assigned to investigate these mysterious robot serial murders—the only catch is that he himself is one of the seven targets.Atom, a boy robot whose sophisticated AI programming seamlessly blurs the distinction between man and machine, starts his own investigation into the serial murders of the great robots of the world. When he discovers that the killer’s motives may be connected with the geopolitical events of the recent past, he realizes that the case is far larger than anyone could have ever imagined.Contains Chapters 8 to 15.', 'Pluto_Vol2.jpg', 51.9, '2024-03-30 22:27:02'),
(26, 'Pluto, Vol.3', 'Mystery', 'Naoki Urasawa', 'In a distant future where sentient humanoid robots pass for human, someone or some thing is out to destroy the seven great robots of the world. Europol’s top detective Gesicht is assigned to investigate these mysterious robot serial murders—the only catch is that he himself is one of the seven targets.When robots become so highly advanced in function, yet so similar in kind to humans, societal resistance is inevitable. In this backdrop of technophobic discrimination, Europol’s top robot detective Gesicht and Atom, the most advanced robot in the world continue their investigation into the serial murders of the great robots of the world. The leaves of this mystery masterfully unfold into a complex intersection of reactionary robot hate groups, global politics, and an exploration of robot identity.', 'Pluto_Vol3.jpg', 51.9, '2024-03-30 22:27:02'),
(27, 'Pluto, Vol.4', 'Mystery', 'Naoki Urasawa', 'A powerful, destructive force in the form of a tornado is killing the great robots of the world one by one. Who or what could be behind this whirlwind? Be it man or robot, it now has its sights set on Atom, the most advanced robot ever created--and Atom is ready to dive right into the eye of the storm.Contains Chapters 24 to 31.', 'Pluto_Vol4.jpg', 51.9, '2024-03-30 22:27:02'),
(28, 'Pluto, Vol.5', 'Mystery', 'Naoki Urasawa', 'A robot may not harm or kill a human being. Article 13 of the Robot Laws.Adolph, a member of a robot hate group, is being used as a pawn and hunted down by the members of his own brotherhood. He must now turn to his worst enemy for protection--Gesicht, the robot who he believes killed his own brother.', 'Pluto_Vol5.jpg', 51.9, '2024-03-30 22:27:02'),
(29, 'Pluto, Vol.6', 'Mystery', 'Naoki Urasawa', 'A new vision based on Astro Boy - ', 'Pluto_Vol6.jpg', 51.9, '2024-03-30 22:27:02'),
(30, 'Pluto, Vol.7', 'Mystery', 'Naoki Urasawa', 'Who Killed Astro Boy? No Robots; Human vs. humanoid!Pluto has destroyed six out of the seven great robots of the world, and the pacifist robot Epsilon is the only one that remains. Will Epsilon, who refused to participate in the 39th Central Asian War, leave behind his war-orphaned charges to step onto the battlefield? It just might be that kindly Epsilon, who wields the power of photon energy, will be Pluto\'s greatest opponent of all!Contains Chapters 48 to 55.', 'Pluto_Vol7.jpg', 51.9, '2024-03-30 22:27:02'),
(31, 'Pluto, Vol.8', 'Mystery', 'Naoki Urasawa', 'A new vision based on Astroboy - ', 'Pluto_Vol8.jpg', 51.9, '2024-03-30 22:27:02'),
(32, 'The Housemaid', 'Mystery', 'Freida McFadden', '“Welcome to the family,” Nina Winchester says as I shake her elegant, manicured hand. I smile politely, gazing around the marble hallway. Working here is my last chance to start fresh. I can pretend to be whoever I like. But I’ll soon learn that the Winchesters’ secrets are far more dangerous than my own…Every day I clean the Winchesters’ beautiful house top to bottom. I collect their daughter from school. And I cook a delicious meal for the whole family before heading up to eat alone in my tiny room on the top floor.I try to ignore how Nina makes a mess just to watch me clean it up. How she tells strange lies about her own daughter. And how her husband Andrew seems more broken every day. But as I look into Andrew’s handsome brown eyes, so full of pain, it’s hard not to imagine what it would be like to live Nina’s life. The walk-in closet, the fancy car, the perfect husband.I only try on one of Nina’s pristine white dresses once. Just to see what it’s like. But she soon finds out… and by the time I realize my attic bedroom door only locks from the outside, it’s far too late.But I reassure myself: the Winchesters don’t know who I really am.They don’t know what I’m capable of…An unbelievably twisty read that will have you glued to the pages late into the night. Anyone who loves The Woman in the Window, The Wife Between Us and The Girl on the Train won’t be able to put this down!', 'The_Housemaid.jpg', 29.9, '2024-03-30 22:27:02'),
(33, 'The Housemaid\'s Secret', 'Mystery', 'Freida McFadden', 'As he continues showing me their incredible penthouse apartment, I have a terrible feeling about the woman behind closed doors. But I can\'t risk losing this job – not if I want to keep my darkest secret safe . . .It\'s hard to find an employer who doesn\'t ask too many questions about my past. So I thank my lucky stars that the Garricks miraculously give me a job, cleaning their stunning penthouse with views across the city and preparing fancy meals in their shiny kitchen. I can work here for a while, stay quiet until I get what I want. It\'s almost perfect. But I still haven\'t met Mrs Garrick, or seen inside the guest bedroom. I\'m sure I hear her crying. I notice spots of blood around the neck of her white nightgowns when I\'m doing laundry. And one day I can\'t help but knock on the door. When it gently swings open, what I see inside changes everything...That\'s when I make a promise. After all, I\'ve done this before. I can protect Mrs. Garrick while keeping my own secrets locked up safe. Douglas Garrick has done wrong. He is going to pay. It\'s simply a question of how far I\'m willing to go...', 'The_Housemaid_Secret.jpg', 29.9, '2024-03-30 22:27:02'),
(34, 'We Have Always Lived In The Castle', 'Horror', 'Shirley Jackson', 'Shirley Jackson’s beloved gothic tale of a peculiar girl named Merricat and her family’s dark secretTaking readers deep into a labyrinth of dark neurosis, We Have Always Lived in the Castle is a deliciously unsettling novel about a perverse, isolated, and possibly murderous family and the struggle that ensues when a cousin arrives at their estate. This edition features a new introduction by Jonathan Lethem.', 'WeHaveAlwaysLivedInTheCastle.jpg', 9.4, '2024-03-30 22:27:02'),
(35, 'Uzumaki', 'Mystery', 'Junji Ito', 'Spirals... this town is contaminated with spirals...Kurouzu-cho, a small fogbound town on the coast of Japan, is cursed. According to Shuichi Saito, the withdrawn boyfriend of teenager Kirie Goshima, their town is haunted not by a person or being but by a pattern: uzumaki, the spiral — the hypnotic secret shape of the world. This bizarre masterpiece of horror manga is now available in a single volume. Fall into a whirlpool of terror!', 'Uzumaki.jpg', 56.6, '2024-03-30 22:27:02'),
(36, 'The Fortune Seller', 'Thriller', 'Rachel Kapelke-Dale', 'Middle-class Rosie Macalister has worked for years to fit in with her wealthy friends on the Yale equestrian team, but when she comes back from her junior year abroad with newfound confidence, she finds the group has been infiltrated by the mysterious Annelise Tattinger.A talented tarot reader and a brilliant rider, the Annelise is unlike anyone Rosie has ever met--but when one of their friends notices money disappearing from her bank account, Annelise\'s place in the circle is thrown into question. As the women turn against each other, the group’s unspoken tensions and assumptions lead to devastating consequences.It\'s only after graduation, when Rosie begins a job at a Manhattan hedge fund, that she begins to uncover Annelise\'s true identity--and how her place in their elite Yale set was no accident. Is it too late for Rosie to make right what went wrong, or does everyone\'s luck run out at some point? Set in the heady days of the early aughts, The Fortune Seller is a haunting examination of class, ambition, and the desires that shape our lives.', 'The_Fortune_Seller.jpg', 70.8, '2024-03-30 22:27:02'),
(37, 'The Rumor Game', 'Thriller', 'Thomas Mullen', 'A determined reporter and a reluctant FBI agent face off against fascist elements in World War II-era Boston.Reporter Anne Lemire writes the Rumor Clinic, a newspaper column that disproves the many harmful rumors floating around town, some of them spread by Axis spies and others just gossip mixed with fear and ignorance. Tired of chasing silly rumors about Rosie Riveters\' safety on the job, she wants to write about something bigger.Special Agent Devon Mulvey, one of the few Catholics at the FBI, spends his weekdays preventing industrial sabotage and his Sundays spying on clerics with suspect loyalties—and he spends his evenings wooing the many lonely women whose husbands are off at war.When Anne’s story about Nazi propaganda intersects with Devon’s investigation into the death of a factory worker, the two are led down a dangerous trail of espionage, organized crime, and domestic fascism—one that implicates their own tangled pasts and threatens to engulf the city in violence.With vibrant historical atmosphere and a riveting mystery that illuminates still-timely issues about disinformation and power, Thomas Mullen delivers another powerful thriller.', 'TheRumorGame.jpg', 70.9, '2024-03-30 22:27:02'),
(38, 'Diary Of A Wimpy Kid', 'Comedy', 'Jeff Kinney', 'In the first book of the Diary of a Wimpy Kid series, #1 international bestselling author Jeff Kinney, introduces us to Greg Heffley: an unforgettable, unlikely hero that every family can relate to.Being a kid can really stink. And no one knows this better than Greg. He finds himself thrust into middle school, where undersized weaklings share the hallways with kids who are taller, meaner, and already shaving. Greg is happy to have Rowley Jefferson, his sidekick, along for the ride. But when Rowley\'s star starts to rise, Greg tries to use his best friend\'s newfound popularity to his own advantage, kicking off a chain of events that will test their friendship in hilarious fashion.The hazards of growing up before you\'re ready are uniquely revealed through words and drawings as Greg records them in his diary. But as Greg says: “Just don’t expect me to be all “Dear Diary” this and “Dear Diary” that.”Luckily for us, what Greg Heffley says he won’t do and what he actually does are two very different things.', 'Diary_Of_A_Wimpy_Kid.jpg', 47.25, '2024-03-30 22:27:02'),
(39, 'Three Days Of Happiness', 'Drama', 'Sugaru Miaki', 'In this dark, moody love story, college student Kusunoki decides to sell off the next thirty years of his life at a mysterious shop in exchange for money-and maybe a chance to find something worth living for.', 'ThreeDaysOfHappiness.jpg', 47.2, '2024-03-30 22:27:02'),
(40, 'Macbeth: Moment By Moment', 'Drama', 'William Shakespeare', 'What he hears will change everything. Egged on by his wife, he decides to kill in order to gain the Scottish crown. How many people will have to die in Macbeth\'s pursuit of power? With armies, ghosts and magic against him, will Macbeth survive in this tale of greed and betrayal? Getting the crown is one thing - keeping it is quite another.', 'Macbeth.jpg', 14.15, '2024-03-30 22:27:02'),
(41, 'Welcome To The N.H.K', 'Drama', 'Tatsuhiko Takimoto', 'Tatsuhiro Satou, a university dropout entering his fourth year of unemployment. He leads a reclusive life as a hikikomori, ultimately coming to the bizarre conclusion that this happened due to some sort of conspiracy. One day just when his life seems entirely unchanging, he meets Misaki Nakahara, a mysterious girl who claims to be able to cure Tatsuhiro of his hikikomori ways. She presents him with a contract basically outlining that once a day they would meet in the evening in a local park where Misaki would lecture to Tatsuhiro in an effort to rid him of his lifestyle. During these outings, many subjects are discussed, though they almost always pertain in some way to psychology or psychoanalysis.', 'WelcomeToTheNHK.jpg', 23.6, '2024-03-30 22:27:02'),
(42, 'Resurrection Walk', 'Thriller', 'Michael Connelly', 'Defense attorney Mickey Haller is back, taking the long shot cases, where the chances of winning are one in a million. After getting a wrongfully convicted man out of prison, he is inundated with pleas from incarcerated people claiming innocence. He enlists his half brother, retired LAPD Detective Harry Bosch, to weed through the letters, knowing most claims will be false.', 'ResurrectionWalk.jpg', 40, '2024-03-31 15:49:16'),
(44, 'Diavola', 'Horror', 'Jennifer Marie Thorne', 'Jennifer Thorne skewers all-too-familiar family dynamics in this sly, wickedly funny vacation-Gothic. Beautifully unhinged and deeply satisfying, Diavola is a sharp twist on the classic haunted house story, exploring loneliness, belonging, and the seemingly inescapable bonds of family mythology.\r\n\r\nAnna has two rules for the annual Pace family destination vacations: Tread lightly and survive.\r\n\r\nIt isn’t easy when she’s the only one in the family who doesn’t quite fit in. Her twin brother, Benny, goes with the flow so much he’s practically dissolved, and her older sister, Nicole, is so used to everyone—including her blandly docile husband and two kids—falling in line that Anna often ends up in trouble for simply asking a question. Mom seizes every opportunity to question her life choices, and Dad, when not reminding everyone who paid for this vacation, just wants some peace and quiet.\r\n\r\nThe gorgeous, remote villa in tiny Monteperso seems like a perfect place to endure so much family togetherness, until things start going off the rails—the strange noises at night, the unsettling warnings from the local villagers, and the dark, violent past of the villa itself.\r\n\r\n(Warning: May invoke feelings of irritation, dread, and despair that come with large family gatherings.)', 'Diavola.jpg', 70.9, '2024-04-02 07:19:43'),
(45, 'Rouge', 'Horror', 'Mona Awad', 'From the critically acclaimed author of Bunny comes a horror-tinted, gothic fairy tale about a lonely dress shop clerk whose mother’s unexpected death sends her down a treacherous path in pursuit of youth and beauty. Can she escape her mother’s fate—and find a connection that is more than skin deep?\r\n\r\nFor as long as she can remember, Belle has been insidiously obsessed with her skin and skincare videos. When her estranged mother Noelle mysteriously dies, Belle finds herself back in Southern California, dealing with her mother’s considerable debts and grappling with lingering questions about her death. The stakes escalate when a strange woman in red appears at the funeral, offering a tantalizing clue about her mother’s demise, followed by a cryptic video about a transformative spa experience. With the help of a pair of red shoes, Belle is lured into the barbed embrace of La Maison de Méduse, the same lavish, culty spa to which her mother was devoted. There, Belle discovers the frightening secret behind her (and her mother’s) obsession with the mirror—and the great shimmering depths (and demons) that lurk on the other side of the glass.\r\n\r\nSnow White meets Eyes Wide Shut in this surreal descent into the dark side of beauty, envy, grief, and the complicated love between mothers and daughters. With black humor and seductive horror, Rouge explores the cult-like nature of the beauty industry—as well as the danger of internalizing its pitiless gaze. Brimming with California sunshine and blood-red rose petals, Rouge holds up a warped mirror to our relationship with mortality, our collective fixation with the surface, and the wondrous, deep longing that might lie beneath.', 'Rouge.jpg', 29.9, '2024-04-02 10:01:19');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `bookName` varchar(50) NOT NULL,
  `bookPrice` double NOT NULL,
  `bookImage` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` double NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `bookId`, `userId`, `bookName`, `bookPrice`, `bookImage`, `quantity`, `total`, `date`) VALUES
(97, 44, 5, 'Diavola', 70.9, 'Diavola.jpg', 1, 71, '2024-04-02 08:50:46'),
(98, 1, 5, 'The Art Of War', 42.1, 'ArtOfWar.jpg', 1, 42, '2024-04-02 08:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `confirmorder`
--

CREATE TABLE `confirmorder` (
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPhoneNo` int(11) NOT NULL,
  `userAddress` varchar(500) NOT NULL,
  `paymentMethod` varchar(20) NOT NULL,
  `totalBooks` varchar(500) NOT NULL,
  `orderDate` varchar(100) NOT NULL,
  `paymentStatus` varchar(20) NOT NULL DEFAULT 'pending',
  `date` varchar(20) NOT NULL,
  `totalPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirmorder`
--

INSERT INTO `confirmorder` (`orderId`, `userId`, `userName`, `userEmail`, `userPhoneNo`, `userAddress`, `paymentMethod`, `totalBooks`, `orderDate`, `paymentStatus`, `date`, `totalPrice`) VALUES
(1, 1, 'Ijam', 'ijam@gmail.com', 1183478294, 'Serendah, Rawang, Selangor, Malaysia - 48300', 'cash on delivery', ' The Art Of War #1,(1) ', '01-Apr-2024', 'completed', '01.04.2024', 42.1),
(2, 1, 'Ijam', 'ijam@gmail.com', 1183478294, 'Serendah, Rawang, Selangor, Malaysia - 48300', 'Debit card', ' Resurrection Walk #42,(1) ', '01-Apr-2024', 'completed', '01.04.2024', 40),
(3, 1, 'Ijam', 'ijam@gmail.com', 1183478294, 'Serendah, Rawang, Selangor, Malaysia - 48300', 'Paypal', ' Between The World And Me #2,(1) ', '01-Apr-2024', 'completed', '01.04.2024', 32),
(8, 1, 'Ijam', 'ijam@gmail.com', 1183478294, 'Serendah, Rawang, Selangor, Malaysia - 48300', 'Amazon Pay', ' Komi Cant Communicate, Vol. 1 #43,(1) ', '01-Apr-2024', 'completed', '01.04.2024', 49.9),
(10, 5, 'Alfonso Acap', 'acap@gmail.com', 198765432, 'Sungai Dua, Georgetown, Penang, Malaysia - 11900', 'Google Pay', ' The Art Of War #1,(1) ', '01-Apr-2024', 'completed', '01.04.2024', 42.1),
(36, 1, 'Ijam', 'ijam@gmail.com', 1183478294, 'Serendah, Rawang, Selangor, Malaysia - 48300', 'Debit card', ' Akira, Vol. 1 #5,(1)  Akira, Vol. 2 #7,(1) ', '02-Apr-2024', 'completed', '02.04.2024', 197.1),
(37, 1, 'Ijam', 'ijam@gmail.com', 1183478294, 'Serendah, Rawang, Selangor, Malaysia - 48300', 'Debit card', ' Diavola #44,(1) ', '02-Apr-2024', 'completed', '02.04.2024', 70.9),
(38, 6, 'Nizam', 'nizam@gmail.com', 1156247802, 'cheras, kuala lumpur , selangor, malaysia - 56100', 'Paypal', ' Rouge #45,(4) ', '02-Apr-2024', 'completed', '02.04.2024', 119.6),
(39, 1, 'Ijam', 'ijam@gmail.com', 1183478294, 'Serendah, Rawang, Selangor, Malaysia - 48300', 'Debit card', ' Rouge #45,(1) ', '05-Apr-2024', 'completed', '05.04.2024', 29.9),
(40, 1, 'Ijam', 'ijam@gmail.com', 1183478294, 'Serendah, Rawang, Selangor, Malaysia - 48300', 'cash on delivery', ' Dune #4,(1)  Dune Messiah #6,(1) ', '05-Apr-2024', 'pending', '', 94.3);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messageId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `phoneNo` int(20) NOT NULL,
  `message` text NOT NULL,
  `messageDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`messageId`, `userId`, `userName`, `userEmail`, `phoneNo`, `message`, `messageDate`) VALUES
(4, 1, 'Ijam', 'ijam@gmail.com', 1183478294, 'Hello', '2024-04-05 15:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userAddress` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` int(6) NOT NULL,
  `bookName` varchar(50) NOT NULL,
  `bookPrice` double NOT NULL,
  `quantity` int(100) NOT NULL,
  `subTotal` double NOT NULL,
  `paymentStatus` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `userAddress`, `city`, `state`, `country`, `zipcode`, `bookName`, `bookPrice`, `quantity`, `subTotal`, `paymentStatus`) VALUES
(38, 1, 'Serendah', 'Rawang', 'Selangor', 'Malaysia', 48300, 'Akira, Vol. 1', 98.55, 1, 98.55, 'pending'),
(39, 1, 'Serendah', 'Rawang', 'Selangor', 'Malaysia', 48300, 'Akira, Vol. 2', 98.55, 1, 98.55, 'pending'),
(40, 1, 'Serendah', 'Rawang', 'Selangor', 'Malaysia', 48300, 'Diavola', 70.9, 1, 70.9, 'pending'),
(41, 6, 'cheras', 'kuala lumpur ', 'selangor', 'malaysia', 56100, 'Rouge', 29.9, 4, 119.6, 'pending'),
(42, 1, 'Serendah', 'Rawang', 'Selangor', 'Malaysia', 48300, 'Rouge', 29.9, 1, 29.9, 'pending'),
(43, 1, 'Serendah', 'Rawang', 'Selangor', 'Malaysia', 48300, 'Dune', 47.15, 1, 47.15, 'pending'),
(44, 1, 'Serendah', 'Rawang', 'Selangor', 'Malaysia', 48300, 'Dune Messiah', 47.15, 1, 47.15, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `userId` int(100) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `userEmail` varchar(20) NOT NULL,
  `userPassword` varchar(20) NOT NULL,
  `userType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userId`, `userName`, `userEmail`, `userPassword`, `userType`) VALUES
(1, 'Ijam', 'ijam@gmail.com', 'Ijam2004.', 'User'),
(2, 'Syaznizam', 'syaz@gmail.com', 'Syaz04.', 'Admin'),
(6, 'Nizam', 'nizam@gmail.com', 'Nizam04.', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookdetails`
--
ALTER TABLE `bookdetails`
  ADD PRIMARY KEY (`bookId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `confirmorder`
--
ALTER TABLE `confirmorder`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookdetails`
--
ALTER TABLE `bookdetails`
  MODIFY `bookId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `confirmorder`
--
ALTER TABLE `confirmorder`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `userId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
