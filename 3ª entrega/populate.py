import random
b = open('populate.sql','w')
vitimas_horas = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
morada = ['Abrantes', 'Agualva-Cacem', 'Albergaria-a-Velha', 'Albufeira', 'Alcobaca', 'Alcacer do Sal', 'Alfena', 'Almada', 'Almeirim', 'Alverca do Ribatejo', 'Amadora', 'Amarante', 'Amora', 'Anadia', 'Angra do Heroismo', 'Aveiro', 'Barcelos', 'Barreiro', 'Beja', 'Borba', 'Braga', 'Braganca', 'Caldas da Rainha', 'Canico', 'Cantanhede', 'Cartaxo', 'Castelo Branco', 'Chaves', 'Coimbra', 'Costa da Caparica', 'Covilha', 'Camara de Lobos', 'Elvas', 'Entroncamento', 'Ermesinde', 'Esmoriz', 'Espinho', 'Esposende', 'Estarreja', 'Estremoz', 'Fafe', 'Faro', 'Felgueiras', 'Figueira da Foz', 'Fiaes', 'Freamunde', 'Funchal', 'Fundao', 'Fatima', 'Gafanha da Nazare', 'Gandra', 'Gondomar', 'Gouveia', 'Guarda', 'Guimaraes', 'Horta', 'Lagoa', 'Lagos', 'Lamego', 'Leiria', 'Lisboa', 'Lixa', 'Lordelo', 'Loule', 'Loures', 'Lourosa', 'Macedo de Cavaleiros', 'Machico', 'Maia', 'Mangualde', 'Marco de Canaveses', 'Marinha Grande', 'Matosinhos', 'Mealhada', 'Miranda do Douro', 'Mirandela', 'Montemor-o-Novo', 'Montijo', 'Moura', 'Meda', 'Odivelas', 'Olhao da Restauracao', 'Oliveira de Azemeis', 'Oliveira do Bairro', 'Oliveira do Hospital', 'Ourem', 'Ovar', 'Paredes', 'Pacos de Ferreira', 'Penafiel', 'Peniche', 'Peso da Regua', 'Pinhel', 'Pombal', 'Ponta Delgada', 'Ponte de Sor', 'Portalegre', 'Portimao', 'Porto', 'Praia da Vitoria', 'Povoa de Santa Iria', 'Povoa de Varzim', 'Quarteira', 'Queluz', 'Rebordosa', 'Reguengos de Monsaraz', 'Ribeira Grande', 'Rio Maior', 'Rio Tinto', 'Sabugal', 'Sacavem', 'Samora Correia', 'Santa Comba Dao', 'Santa Cruz', 'Santa Maria da Feira', 'Santana', 'Santarem', 'Santiago do Cacem', 'Santo Tirso', 'Seia', 'Seixal', 'Senhora da Hora', 'Serpa', 'Setubal', 'Silves', 'Sines', 'Sao Joao da Madeira', 'Sao Mamede de Infesta', 'Sao Pedro do Sul', 'Tarouca', 'Tavira', 'Tomar', 'Tondela', 'Torres Novas', 'Torres Vedras', 'Trancoso', 'Trofa', 'Valbom', 'Vale de Cambra', 'Valenca', 'Valongo', 'Valpacos', 'Vendas Novas', 'Viana do Castelo', 'Vila Baleira', 'Vila do Conde', 'Vila Franca de Xira', 'Vila Nova de Famalicao', 'Vila Nova de Foz Coa', 'Vila Nova de Gaia', 'Vila Nova de Santo Andre', 'Vila Real', 'Vila Real de Santo Antonio', 'Viseu', 'Vizela', 'agueda', 'evora', 'ilhavo']
numeros_tele = ['337642356', '872731896', '483212341', '430697512', '508344766', '236834061', '411460198', '369562301', '371521900', '719522315', '485686599', '833253064', '557429350', '790569895', '593513226', '321240448', '388724589', '547575213', '515293763', '888439998', '913446374', '275821679', '801392802', '544910527', '351604319', '800797153', '449443453', '286227349', '445539528', '500918268', '777495379', '669442325', '711626120', '766367547', '259708473', '598361460', '904200356', '715898063', '603429541', '616291961', '520784743', '524303477', '451910308', '309275955', '974367316', '389517168', '500567391', '911922129', '736311294', '813659092', '928910978', '214223681', '496600339', '676389530', '414575766', '463696008', '455669677', '883279451', '278305981', '574835127', '730255122', '701818290', '625944195', '821967200', '871852606', '501491867', '623867240', '592248542', '779424240', '242357570', '835245221', '724568561', '573946823', '427491709', '620436860', '423952342', '460602678', '494831817', '240912418', '415730663', '967964672', '858709033', '667573872', '954525373', '449750648', '804460053', '326932478', '304639280', '673848286', '325442167', '863302472', '722682574', '644738834', '510413743', '814639822', '478550167', '624421575', '431290999', '840215097', '674377277', '388982716', '741696811', '632713847', '827342130', '202762337', '864997561', '843663327', '592638022', '345548896', '476914315', '975453657', '405814252', '692787380', '545807321', '733443979', '979321454', '503649892', '507265710', '894886481', '683409568', '258988906', '803574745', '830362448', '512837508', '557293214', '977930616', '395796957', '673459008', '220436611', '547510863', '577841106', '761270949', '892861942', '366239146', '478706682', '480452078', '620956655', '254792542', '926816649', '248886517', '854495725', '997779428', '936535865', '410950752', '770511972', '833966428', '381838720', '206436271', '419825472', '384938025', '656387009', '338520302', '963665872', '700692228', '952820692', '548482095', '265619304', '650737618', '240855399', '692798588', '450326347', '680459608', '303478083', '413870675', '600951044', '661364059', '439413432', '769394324', '237501109', '348790410', '413442480', '876651661', '873323469', '982627638', '244810187', '515596893', '294857703', '808609325', '951631665', '461423341', '352341943', '726519654', '957932679', '919241613', '286635929', '678757854', '441548300', '473487816', '351474332', '858511607', '754527726', '513476840', '546353792', '244792654', '579291430', '990827783', '746201108', '768560007', '706506263', '354778256', '310966247', '945795311', '479374575', '402811231', '411461014', '928840884', '391508291', '568906679', '816540007', '850867694', '778210812', '360539019', '414729495', '464352104', '680948395', '422673062', '971703487', '820679277', '639922051', '886894435', '417527813', '605550599', '782929101', '665213802', '857992223', '237550978', '998640704', '762957525', '972808942', '714597841', '705749624', '948402040', '323813837', '519780797', '538556163', '585459071', '859694527', '460264758', '936353132', '937269576', '941566506', '380448549', '518418804', '480687901', '444421319', '514903574', '838448298', '300440164', '351621003', '540866154', '558221373', '714565781', '303638915', '204567549', '331885233', '231234527', '523667941', '937689038', '907942185', '549637753', '854389658', '690528925', '986470351', '790637940', '564242902', '275924783', '769664359', '834814199', '921315662', '856896566', '232925166', '352776764', '200313207', '436266375', '908727819', '525829270', '730524165', '758447923', '936604660', '589507628', '967304571', '989528427', '479555647', '376946421', '950706661', '317947111', '894911805', '989546534', '363203087', '227372914', '908934376', '901648921', '245532415', '955996912', '960526026', '440725183', '871602382', '658652186', '276741675', '228266218', '821251044', '629928565', '398922662', '840778125', '262713452', '682876268', '806311646', '819730625', '387626929', '275988586', '228804831', '361371797', '476427150', '725535853', '631949464', '424867623', '396750003', '789998955', '554864507', '231491399', '353370865', '509757964', '904854421', '907404777', '975243380', '887920369', '590383563', '212402585', '461564147', '671925962', '589531231', '660979565', '577304891', '694440158', '977903785', '629822524', '203688195', '975838368', '261210473', '745372224', '909370374', '780941175', '421990194', '871285713', '734325094', '987435865', '812926272', '527885566', '570908523', '610813702', '497625978', '825781131', '291473209', '913274635', '501442724', '322611915', '790510859', '489389228', '896692494', '348462653', '895861802', '312889033', '841883631', '904438753', '854667646', '963308137', '686981372', '994338512', '501316076', '608451393', '490890207', '234949024', '444252644', '817421261', '580954920', '569409996', '715886719', '677330495', '324508016', '866836893', '812965713', '763631811', '912810860', '595882393', '707842015', '254984532', '849541208', '650714728', '713518638', '329496532', '535502855', '883830820', '546691537', '411401046', '808362995', '224303857', '867407894', '558620856', '968963470', '952354544']
nomes = ['Afonso Manuel Eustaquio Custodio', 'Afonso Pedro Antunes Da Mota Gomes', 'Afonso Pulido Garcia Lopo De Carvalho', 'Ahmat Afashokov', 'Alexandre Marcelino Neves', 'Alexandre Miguel Da Silva Pires', 'Alexandre Miguel De Sousa Fernandes', 'Alvaro De Carvalho De Almada E Quadros Saldanha', 'Ana Carolina Nunes Marcal', 'Andre Duarte Do Nascimento', 'Andre Filipe Ferreira Do Nascimento', 'Andre Fontes De Matos', 'Andre Jacinto De Sousa Rodrigues', 'Andre Joao De Almeida Avelar', 'Andre Joao Nelas Ferreira', 'Andre Maciel Azevedo', 'Antonio Manuel Angeja Filipe', 'Antonio Pedro Paredes Silva Branco', 'Antonio Romeu Paulo Pinheiro','Armando Luis Ferreira Cardoso Teles Fortes', 'Barbara Duarte Martins', 'Bernardo Ribeiro De Carvalho Soares Fatela', 'Bernardo Vala Lourenco', 'Bruno Gouveia Lourenco Soares Gomes', 'Carolina Micaela Pinto Duarte Pereira', 'Catarina Alexandra Saleiro Rodrigues', 'Catarina Antunes Marques', 'Catarina Duarte Alegria', 'Catarina Galvao Goncalves', 'Catarina Manuel Cativo Carreiro', 'Catarina Mota Monteiro', 'Cristiano Primitivo Constantino Morais Clemente', 'Daniel Lima Duarte Antonio', 'Daniela Narciso Castanho', 'Daniela Regina Malveiro Carvalho', 'Daniela Sofia Franco Martins Amaral', 'Daniela Valiente Falcao Machado', 'DavidAlexandre Barreiro Baptista', 'David Azevedo Escobar De Lima', 'David De Almeida Pissarra', 'Diana Manuela Padilla Moniz', 'Diogo Alexandre Dos Santos Fusco', 'Diogo Antonio Da Silva Costa', 'Diogo Jose De Figueiredo Barbosa', 'Diogo Jose Fidalgo Assuncao', 'Diogo Miguel Preto Cordeiro Branco', 'Diogo Seabra Diogo', 'Diogo Sousa Soares', 'Duarte Miguel Constantino Bento', 'Duarte Vaz Osorio De Penalva Boto', 'Eduardo Moita Ladeiras Coutinho Dos Santos', 'Filipe Andre Gomes Sousa Varela', 'Filipe Rosa Marcos', 'Francisco Alexandre Louro Da Costa', 'Francisco Antonio Martins Mendes De Faria', 'Francisco Ferreira Esteves', 'Francisco Lisboa Ricardo Marques', 'Francisco Miguel Delgado Calado Malveiro', 'Freddy Jesus De Lima Goncalves', 'Goncalo Correia Rodrigues', 'Goncalo Da Silva Duarte', 'Goncalo Duarte Fernandes', 'Goncalo Jorge Neves', 'Guilherme Baeta Campos Da Rocha Fontes', 'Guilherme Garcia inacio De Freitas Jardim', 'Guilherme Henrique Pires Figueiredo', 'Guilherme Mimoso Montez Fernandes', 'Guillermo Andres Da Silva Bettencourt', 'Henrique Afonso Monteiro Pereira Cavaco', 'Henrique Da Conceicao Reis Dos Santos', 'Henrique Lourenco do Espirito Santo Caldas Rosa Ferreira', 'Henrique Maria Almeida Rocha Preto', 'Hugo Henrique Silva Pitorro', 'Ielga Katiana Anacleto De Oliveira', 'Ines Borges Carioca Moreno Rodrigues', 'Ines Lopes Henriques', 'Ines Pedro Pereira', 'Ines Rodrigues Verdasca', 'Ines Sofia Neves Da Silva', 'Joana Rocha Raposo', 'Joao Bernardo Gomes Dos Santos', 'Joao De Quinhones Levy Albuquerque Povoas', 'Joao Diogo Henriques Da Silva', 'Joao Filipe Dias Dos Santos', 'Joao Filipe Silva Lopes Seguro Sanches', 'Joao Francisco Duarte Da Silva', 'Joao Jose Carreto Moreira Fernandes', 'Joao Luis Batalha Honrado', 'Joao Maria Mouro Ferreira Gundersen Marques', 'Joao Miguel Costa Verissimo', 'Joao Miguel Rocha Queiros', 'Joao Nuno Bastos Fonseca', 'Joao Pedro Cavaco Antunes', 'Joao Ricardo Ferreira Simoes', 'Joao Tiago Marques Goncalves', 'Joao Vicente Nunes', 'Jorge Catarino Estevao Troia Godinho', 'Jose Alexandre De Vasconcelos Rodrigues', 'Jose Francisco Giro Pinto Moreira', 'Jose Maria Figueira Janarra', 'Larissa Mendes Da Silva Tomaz', 'Laura Constanca Ferreira Baeta', 'Leonor De Tavora Barroco E Moreira Santos', 'Leonor Silva Pereira De Sousa Veloso', 'Lucia Filipa Lopes Da Silva', 'Luis Leao Morgado Quartin Simao', 'Luis Miguel Ventura Garcia', 'MafaldaDi Martino Caldas Lopes Serafim', 'Mafalda Sofia Carvalho Ferreira', 'Manuel Gomes Carvalho', 'Manuel Leitao Dinis Rainha Monteiro', 'Manuel Marques Costa', 'Manuel Taveira Rodrigues', 'Maria Joao Madeira Duarte', 'Mariana Casimiro Ferreira Laranjo', 'Mariana Cosme Cintrao', 'Mariana Isabel Pereira Chinopa', 'Mariana Vicente Lopes De Amorim Nobre Nunes', 'Marta Adriao Brites', 'Marta Carvalho Chaves Ferreira', 'Martim Belo De Carvalho Duarte Afonso', 'Matheus Guilherme Leca Da Silva Franco', 'Miguel Abreu Lourenco', 'Miguel Alexandre Calheiros Nunes', 'Miguel Alexandre Figueiredo Monteiro', 'Miguel Da Costa Cruz', 'Miguel Goncalves Jardim', 'Miguel Leonardo Pereira Marques Mendes Grilo', 'Miguel Lourenco Rodrigues Pereira', 'Miguel Maria Saldanha Campelo De Magalhaes Crespo', 'Miguel Moura Ramos', 'Monica Chen Jin', 'Nuno Miguel Ferreira Monteiro Martins', 'Paulina Izabela Juzwin', 'Paulo Miguel Jacinto Ferreira Do O', 'Pedro Afonso Da Boa Morte Cruz Nora', 'Pedro Filipe Coelho Perpetua', 'Pedro Goncalo Valerio Almeida', 'Pedro Jose Guerreiro Castelo Ramos', 'Pedro Magalhaes E Silva', 'Pedro Miguel Jardim De Abreu', 'Pedro Ribeiro Rodrigues', 'Rafael Alexandre Milheiro Lourenco', 'Rafael Henriques Dos Santos Goncalves', 'Ricardo Nuno De Castro Calvao', 'Rita Teresa Marmelo Castro Oliveira', 'Rita Tome De Almeida E Silva', 'Rodrigo Carvalho De Alvarenga Nunes', 'Rodrigo Filipe Rodrigues Cabral Gomes', 'Rodrigo Foito De Amoreira Cidra', 'Rodrigo Henriques Palmeirim', 'Rodrigo Jose Batista Antunes', 'Rodrigo Miguel Machado Santos', 'Rodrigo Tavares Antunes', 'Ruben Almeida Ulisses De Carvalho Fonseca', 'Rui Barrios Ferreira','Samuel Castelhano Lourenco', 'Sancha Pinheiro Borges Baptista Barroso', 'Sofia Goncalo Rodrigues', 'Sofia Seabra Bonifacio', 'Susana Moreno Monteiro', 'Tiago De Abreu Morais Goncalves Dias', 'Tiago Emmanuel Dos Santos Fournigault', 'Tiago Fernandes Semide', 'Tomas Andrade Saraiva', 'Tomas Lobo Sequeira', 'Tomas Roquette De Almeida Prego', 'Vasco Filipe Oliveira Rocha', 'Vasco Miguel Marques Pais Cabral', 'Vicente Aser Marques Rebelo Castillo Lorenzo', 'Vitor Manuel Ferreira Do Vale', 'Zhiyong Zhou']
ids = [14000, 14001, 14002, 14003, 14004, 14005, 14006, 14007, 14008, 14009, 14010, 14011, 14012, 14013, 14014, 14015, 14016, 14017, 14018, 14019, 14020, 14021, 14022, 14023, 14024, 14025, 14026, 14027, 14028, 14029, 14030, 14031, 14032, 14033, 14034, 14035, 14036, 14037, 14038, 14039, 14040, 14041, 14042, 14043, 14044, 14045, 14046, 14047, 14048, 14049, 14050, 14051, 14052, 14053, 14054, 14055, 14056, 14057, 14058, 14059, 14060, 14061, 14062, 14063, 14064, 14065, 14066, 14067, 14068, 14069, 14070, 14071, 14072, 14073, 14074, 14075, 14076, 14077, 14078, 14079, 14080, 14081, 14082, 14083, 14084, 14085, 14086, 14087, 14088, 14089, 14090, 14091, 14092, 14093, 14094, 14095, 14096, 14097, 14098, 14099, 14100, 14101, 14102, 14103, 14104, 14105, 14106, 14107, 14108, 14109, 14110, 14111, 14112, 14113, 14114, 14115, 14116, 14117, 14118, 14119, 14120, 14121, 14122, 14123, 14124, 14125, 14126, 14127, 14128, 14129, 14130, 14131, 14132, 14133, 14134, 14135, 14136, 14137, 14138, 14139, 14140, 14141, 14142, 14143, 14144, 14145, 14146, 14147, 14148, 14149, 14150, 14151, 14152, 14153, 14154, 14155, 14156, 14157, 14158, 14159, 14160, 14161, 14162, 14163, 14164, 14165, 14166, 14167, 14168, 14169, 14170, 14171, 14172, 14173, 14174, 14175, 14176, 14177, 14178, 14179, 14180, 14181, 14182, 14183, 14184, 14185, 14186, 14187, 14188, 14189, 14190, 14191, 14192, 14193, 14194, 14195, 14196, 14197, 14198, 14199, 14200, 14201, 14202, 14203, 14204, 14205, 14206, 14207, 14208, 14209, 14210, 14211, 14212, 14213, 14214, 14215, 14216, 14217, 14218, 14219, 14220, 14221, 14222, 14223, 14224, 14225, 14226, 14227, 14228, 14229, 14230, 14231, 14232, 14233, 14234, 14235, 14236, 14237, 14238, 14239, 14240, 14241, 14242, 14243, 14244, 14245, 14246, 14247, 14248, 14249, 14250, 14251, 14252, 14253, 14254, 14255, 14256, 14257, 14258, 14259, 14260, 14261, 14262, 14263, 14264, 14265, 14266, 14267, 14268, 14269, 14270, 14271, 14272, 14273, 14274, 14275, 14276, 14277, 14278, 14279, 14280, 14281, 14282, 14283, 14284, 14285, 14286, 14287, 14288, 14289, 14290, 14291, 14292, 14293, 14294, 14295, 14296, 14297, 14298, 14299, 14300, 14301, 14302, 14303, 14304, 14305, 14306, 14307, 14308, 14309, 14310, 14311, 14312, 14313, 14314, 14315, 14316, 14317, 14318, 14319, 14320, 14321, 14322, 14323, 14324, 14325, 14326, 14327, 14328, 14329, 14330, 14331, 14332, 14333, 14334, 14335, 14336, 14337, 14338, 14339, 14340, 14341, 14342, 14343, 14344, 14345, 14346, 14347, 14348, 14349, 14350, 14351, 14352, 14353, 14354, 14355, 14356, 14357, 14358, 14359, 14360, 14361, 14362, 14363, 14364, 14365, 14366, 14367, 14368, 14369, 14370, 14371, 14372, 14373, 14374, 14375, 14376, 14377, 14378, 14379, 14380, 14381, 14382, 14383, 14384, 14385, 14386, 14387, 14388, 14389, 14390, 14391, 14392, 14393, 14394, 14395, 14396, 14397, 14398, 14399, 14400, 14401, 14402, 14403, 14404, 14405, 14406, 14407, 14408, 14409, 14410, 14411, 14412, 14413, 14414, 14415, 14416, 14417, 14418, 14419, 14420, 14421, 14422, 14423, 14424, 14425, 14426, 14427, 14428, 14429, 14430, 14431, 14432, 14433, 14434, 14435, 14436, 14437, 14438, 14439, 14440, 14441, 14442, 14443, 14444, 14445, 14446, 14447, 14448, 14449, 14450, 14451, 14452, 14453, 14454, 14455, 14456, 14457, 14458, 14459, 14460, 14461, 14462, 14463, 14464, 14465, 14466, 14467, 14468, 14469, 14470, 14471, 14472, 14473, 14474, 14475, 14476, 14477, 14478, 14479, 14480, 14481, 14482, 14483, 14484, 14485, 14486, 14487, 14488, 14489, 14490, 14491, 14492, 14493, 14494, 14495, 14496, 14497, 14498, 14499, 14500, 14501, 14502, 14503, 14504, 14505, 14506, 14507, 14508, 14509, 14510, 14511, 14512, 14513, 14514, 14515, 14516, 14517, 14518, 14519, 14520, 14521, 14522, 14523, 14524, 14525, 14526, 14527, 14528, 14529, 14530, 14531, 14532, 14533, 14534, 14535, 14536, 14537, 14538, 14539, 14540, 14541, 14542, 14543, 14544, 14545, 14546, 14547, 14548, 14549, 14550, 14551, 14552, 14553, 14554, 14555, 14556, 14557, 14558, 14559, 14560, 14561, 14562, 14563, 14564, 14565, 14566, 14567, 14568, 14569, 14570, 14571, 14572, 14573, 14574, 14575, 14576, 14577, 14578, 14579, 14580, 14581, 14582, 14583, 14584, 14585, 14586, 14587, 14588, 14589, 14590, 14591, 14592, 14593, 14594, 14595, 14596, 14597, 14598, 14599, 14600, 14601, 14602, 14603, 14604, 14605, 14606, 14607, 14608, 14609, 14610, 14611, 14612, 14613, 14614, 14615, 14616, 14617, 14618, 14619, 14620, 14621, 14622, 14623, 14624, 14625, 14626, 14627, 14628, 14629, 14630, 14631, 14632, 14633, 14634, 14635, 14636, 14637, 14638, 14639, 14640, 14641, 14642, 14643, 14644, 14645, 14646, 14647, 14648, 14649, 14650, 14651, 14652, 14653, 14654, 14655, 14656, 14657, 14658, 14659, 14660, 14661, 14662, 14663, 14664, 14665, 14666, 14667, 14668, 14669, 14670, 14671, 14672, 14673, 14674, 14675, 14676, 14677, 14678, 14679, 14680, 14681, 14682, 14683, 14684, 14685, 14686, 14687, 14688, 14689, 14690, 14691, 14692, 14693, 14694, 14695, 14696, 14697, 14698, 14699, 14700, 14701, 14702, 14703, 14704, 14705, 14706, 14707, 14708, 14709, 14710, 14711, 14712, 14713, 14714, 14715, 14716, 14717, 14718, 14719, 14720, 14721, 14722, 14723, 14724, 14725, 14726, 14727, 14728, 14729, 14730, 14731, 14732, 14733, 14734, 14735, 14736, 14737, 14738, 14739, 14740, 14741, 14742, 14743, 14744, 14745, 14746, 14747, 14748, 14749, 14750, 14751, 14752, 14753, 14754, 14755, 14756, 14757, 14758, 14759, 14760, 14761, 14762, 14763, 14764, 14765, 14766, 14767, 14768, 14769, 14770, 14771, 14772, 14773, 14774, 14775, 14776, 14777, 14778, 14779, 14780, 14781, 14782, 14783, 14784, 14785, 14786, 14787, 14788, 14789, 14790, 14791, 14792, 14793, 14794, 14795, 14796, 14797, 14798, 14799, 14800, 14801, 14802, 14803, 14804, 14805, 14806, 14807, 14808, 14809, 14810, 14811, 14812, 14813, 14814, 14815, 14816, 14817, 14818, 14819, 14820, 14821, 14822, 14823, 14824, 14825, 14826, 14827, 14828, 14829, 14830, 14831, 14832, 14833, 14834, 14835, 14836, 14837, 14838, 14839, 14840, 14841, 14842, 14843, 14844, 14845, 14846, 14847, 14848, 14849, 14850, 14851, 14852, 14853, 14854, 14855, 14856, 14857, 14858, 14859, 14860, 14861, 14862, 14863, 14864, 14865, 14866, 14867, 14868, 14869, 14870, 14871, 14872, 14873, 14874, 14875, 14876, 14877, 14878, 14879, 14880, 14881, 14882, 14883, 14884, 14885, 14886, 14887, 14888, 14889, 14890, 14891, 14892, 14893, 14894, 14895, 14896, 14897, 14898, 14899, 14900, 14901, 14902, 14903, 14904, 14905, 14906, 14907, 14908, 14909, 14910, 14911, 14912, 14913, 14914, 14915, 14916, 14917, 14918, 14919, 14920, 14921, 14922, 14923, 14924, 14925, 14926, 14927, 14928, 14929, 14930, 14931, 14932, 14933, 14934, 14935, 14936, 14937, 14938, 14939, 14940, 14941, 14942, 14943, 14944, 14945, 14946, 14947, 14948, 14949, 14950, 14951, 14952, 14953, 14954, 14955, 14956, 14957, 14958, 14959, 14960, 14961, 14962, 14963, 14964, 14965, 14966, 14967, 14968, 14969, 14970, 14971, 14972, 14973, 14974, 14975, 14976, 14977, 14978, 14979, 14980, 14981, 14982, 14983, 14984, 14985, 14986, 14987, 14988, 14989, 14990, 14991, 14992, 14993, 14994, 14995, 14996, 14997, 14998, 14999, 15000]
dates = ["'2015-04-23 15:10:11'", "'2015-04-23 17:10:11'", "'2016-04-23 13:10:11'", "'2016-04-23 14:10:11'", "'2016-04-23 16:10:11'", "'2016-04-23 18:10:11'", "'2017-04-23 13:10:11'", "'2017-04-23 14:10:11'", "'2017-04-23 15:10:11'", "'2017-04-23 16:10:11'", "'2017-04-23 17:10:11'", "'2017-04-23 18:10:11'", "'2017-07-23 13:10:11'", "'2017-07-23 14:10:11'", "'2017-07-23 15:10:11'", "'2017-07-23 16:10:11'", "'2017-07-23 17:10:11'", "'2017-07-23 18:10:11'", "'2018-04-23 13:10:11'", "'2018-04-23 14:10:11'", "'2018-04-23 15:10:11'", "'2018-04-23 16:10:11'", "'2018-04-23 17:10:11'", "'2018-04-23 18:10:11'", "'2018-07-23 13:10:11'", "'2018-07-23 14:10:11'", "'2018-07-23 15:10:11'", "'2018-07-23', '16:10:11'", "'2018-07-23 17:10:11'", "'2018-07-23 18:10:11'", "'2018-08-23 13:10:11'", "'2018-08-23 14:10:11'", "'2018-08-23 15:10:11'", "'2018-08-23 16:10:11'", "'2018-08-23 17:10:11'", "'2018-08-23 18:10:11'"]
entidademeio = ["Forca Aerea", "Bombeiros", "Marinha", "PSP", "GNR", "Exercito", "PJ", "INEM", "Uber", "Glovo", "Taxify", "Sapadores", "Aldeoes", "Camara Municipal", "Junta de Freguesia", "Ciclo Preparatorio", "GIRA", "ATM", "BES", "Banco Alimentar", "Igreja Protestante", "Mergulhadores", "Gays", "SuperDrags"]
veiculos = ["Carro", "Carrinha", "Ambulancia", "Camiao", "Helicoptero", "Aviao", "Trator", "Trotineta", "Bicicleta", "Carrinho de mao", "Cavalo", "Carroca", "Empilhadora", "Porta paletes", "Autocarro", "Metro", "Comboio", "Carruagem", "Escadas rolantes", "Passadeira", "Skate", "Tuk-tuk", "Maca", "A pe", "VMER", "O Jose", "Elefante", "Papa reformas"]
meios = []
meios_apoio = []
meios_socorro = []
meios_combate = []
accionas = []
shuffleids = list(ids)
random.shuffle(shuffleids)

#random.sample(population, k)
#random.choice(lista)
'''camara'''
for i in range(100):
	string = ""
	string += "insert into camara values ('" + str(ids[i]) + "');"+ '\n'
	b.write(string)

'''video, segmento_video'''
for i in range(100):
	string = ""
	idn = i % 4
	year = str(2015 + idn)
	month = str((i % 12)+1)
	if (eval(month) < 10): month = "0" + month
	nuc = str(ids[i])
	string += "insert into video values ('"+year+"-"+month+"-01 15:10:11', '"+year+"-"+month+"-01 19:10:11', '" + nuc + "'); \n"
	string += "insert into segmento_video values ('1', 3600, '"+year+"-"+month+"-01 15:10:11', '" + nuc + "'); \n"
	string += "insert into segmento_video values ('2', 3600, '"+year+"-"+month+"-01 15:10:11', '" + nuc + "'); \n"
	string += "insert into segmento_video values ('3', 3600, '"+year+"-"+month+"-01 15:10:11', '" + nuc + "'); \n"
	string += "insert into segmento_video values ('4', 3600, '"+year+"-"+month+"-01 15:10:11', '" + nuc + "'); \n"
	b.write(string)

'''localidade'''
for i in range(len(morada)):	
	string = ""
	string += "insert into localidade values ('" + str(morada[i]) + "');"+ '\n'
	b.write(string)

'''vigia'''
for i in range(99):	
	string = ""
	string += "insert into vigia values ('" + random.choice(morada) + "', '" + str(ids[i]) + "');"+ '\n'
	b.write(string)

string = "insert into vigia values ('Monchique', '" + str(ids[99]) + "');"+ '\n'
b.write(string)

'''processo_socorro, evento_emergencia'''
for i in range(100):	
	string = ""
	string += "insert into processo_socorro values ('" + str(ids[i]) + "');"+ '\n'
	for j in range(int(random.random()*4)):
		datei = int(j * 36/4) + int(random.random()*36/4)
		string += "insert into evento_emergencia values ('" + str(numeros_tele[i*4 + j]) + "', " + dates[datei] + ", '"  + random.choice(nomes) + "', '" + random.choice(morada) + "', '" + str(ids[i]) +  "');\n"
	b.write(string)

'''entidade_meio'''
for i in range(len(entidademeio)):
	string = ""
	string += "insert into entidade_meio values ('" + str(entidademeio[i]) + "');"+ '\n'
	b.write(string)

'''meio, meio_combate, meio_apoio, meio_socorro'''
for i in range(500):
	string = ""
	noment = random.choice(entidademeio)
	meios.append((ids[i], noment))
	string += "insert into meio values ('" + str(ids[i]) + "', '" + random.choice(veiculos) + ' ' + random.choice(nomes).split()[-1] + "', '" + noment + "');"+ '\n'
	added = False
	while(not added):
		if int(random.random() + 0.5):
			meios_combate.append((ids[i], noment))
			string += "insert into meio_combate values ('" + str(ids[i]) + "', '" + noment + "');\n"
			added = True
		if int(random.random() + 0.5):
			meios_apoio.append((ids[i], noment))
			string += "insert into meio_apoio values ('" + str(ids[i]) + "', '" + noment + "');\n"
			added = True
		if int(random.random() + 0.5):
			meios_socorro.append((ids[i], noment))
			string += "insert into meio_socorro values ('" + str(ids[i]) + "', '" + noment + "');\n"
			added = True
	b.write(string)

'''acciona'''
for i in range(100):
	string = ""
	meio = meios[i]
	pscorr = shuffleids[i]
	accionas.append((meio[0], meio[1], pscorr))
	string += "insert into acciona values ('" + str(meio[0]) + "', '" + meio[1] + "', '" + str(pscorr) + "');\n"
	b.write(string)

'''transporta
for i in range(len(meios_socorro)):
	string = ""
	meio = meios_socorro[i]
	pscorr = shuffleids[i]
	string += "insert into transporta values ('" + str(meio[0]) + "', '" + meio[1] + "', '" + str(random.choice(vitimas_horas)) + "', '" + str(pscorr) + "');\n"
	b.write(string)

alocado
for i in range(len(meios_apoio)):
	string = ""
	meio = meios_apoio[i]
	pscorr = shuffleids[i]
	string += "insert into alocado values ('" + str(meio[0]) + "', '" + meio[1] + "', '" + str(random.choice(vitimas_horas)) + "', '" + str(pscorr) + "');\n"
	b.write(string)'''

'''transporta e alocado'''
for i in range(len(accionas)):
	string = ""
	meio = accionas[i][0]
	nome = accionas[i][1]
	pscorr = accionas[i][2]
	if (meio, nome) in meios_apoio:
		string += "insert into alocado values ('" + str(meio) + "', '" + nome + "', '" + str(random.choice(vitimas_horas)) + "', '" + str(pscorr) + "');\n"
	if (meio, nome) in meios_socorro:
		string += "insert into transporta values ('" + str(meio) + "', '" + nome + "', '" + str(random.choice(vitimas_horas)) + "', '" + str(pscorr) + "');\n"
	b.write(string)	



'''coordenador'''
for i in range(100):
	string = "insert into coordenador values ('" + str(shuffleids[i]) + "');\n"
	b.write(string)

'''audita'''
for i in range(90):
	idcoor = str(shuffleids[i])
	nummeio = str(accionas[i][0])
	noment = accionas[i][1]
	numproc = str(accionas[i][2])

	idn = i % 4
	year = str(2015 + idn)
	month = str((i % 12) + 1)
	n_month = str(((i + 1) % 12) + 1)
	if (eval(month) < 10): month = "0" + month
	dhinicio = year + "-" + month + "-01 15:10:11"
	dhfim = year + "-" + n_month + "-01 15:10:11"

	data = "2018-11-28"
	texto = "it is wednesday my dudes"

	string = "insert into audita values ('" + idcoor + "', '" + nummeio + "', '" + noment + "', '" + numproc + "', '" + dhinicio + "', '" + dhfim + "', '" + data + "', '" + texto + "');\n"
	b.write(string)

'''solicita'''
for i in range(100):
	idcoor = str(shuffleids[i])

	idn = i % 4
	year = str(2015 + idn)
	month = str((i % 12)+1)
	n_month = str(((i + 1) % 12) + 1)
	if (eval(month) < 10): month = "0" + month

	nuc = str(ids[i])

	string = "insert into solicita values ('" + idcoor + "', '" + year+"-"+month+"-01 15:10:11" + "', '" + nuc + "', '" + year+"-"+n_month+"-01 15:10:11" + "', '" + year+"-"+n_month+"-02 15:10:11" + "');\n"
	b.write(string)

b.close()