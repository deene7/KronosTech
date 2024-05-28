-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/05/2024 às 21:25
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `kronostech`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(68, 1155.00, 'Aguardando Pagamento', 10, 1234, 'ceilandia', 'qnn 20 conjunto c casa 40', '2024-05-22 16:00:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(98, 68, '1', 'Processador AMD Ryzen 7 5700x 3.4GHz (TURBO 4.6GHz) 32MB CACHE AMD', 'new1.jpg', 1155.00, 1, 10, '2024-05-22 16:00:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(108) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) DEFAULT NULL,
  `product_image3` varchar(255) DEFAULT NULL,
  `product_image4` varchar(255) DEFAULT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_cname` varchar(101) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_cname`) VALUES
(1, 'Processador AMD Ryzen 7 5700x 3.4GHz (TURBO 4.6GHz) 32MB CACHE AMD', 'Processador', '- Marca: AMD<br>\n- Linha de produto: Processadores AMD Ryzen 7 para desktop<br>\n- Nº de núcleos de CPU: 8<br>\n- Nº de threads: 16<br>\n- Clock de Max Boost: Até 4.6GHz\n- Clock básico: 3,7 GHz<br>\n        - Cachê L1 total: 512 KB<br>\n- Cachê L2 total', 'new1.jpg', 'new1.1.jpg', 'new1.2.jpg', 'new1.3.jpg', 1155.00, 'Processador AMD Ryzen 7 5700x'),
(2, 'Placa de Vídeo Gigabyte GEFORCE RTX 4060 TI 8GB', 'Placa de vídeo', '- Estilo: 4060 Ti WINDFORCE OC <br>\n- Processador gráfico: NVIDIA GeForce RTX 4060 Ti <br>\n- Marca: GIGABYTE <br>\n- Tamanho da memória RAM da placa gráfica: 8 GB <br>\n- Velocidade do clock da GPU: 2550 MHz <br>\n- Interface de saída de vídeo: Display Port,', 'new2.png', 'gfc4060-1.png', 'gfc4060-2.png', 'gfc4060-3.png', 2599.90, 'Placa de Vídeo Gigabyte GEFORCE RTX 4060 TI 8GB'),
(3, 'Teclado Mecânico Gamer Razer Blackwidow V3 Tenkeyless Yellow Switch, Preto', 'Teclado', '- SWITCHES MECÂNICOS RAZER Yellow  <br>\n- EQUIPADO COM RAZER CHROMA RGB <br>\n- ESTRUTURA EM ALUMÍNIO <br>\n- Idioma: Português, Português <br>\n- Data de lançamento: 10 de novembro de 2020 <br>\n- Número do modelo: RZ03-03491800-R3M1 <br>', 'new3.webp', 'razer-3.jpg', 'razer-4.jpg', 'razer-5.jpg', 899.00, 'Teclado Mecânico Gamer Razer Blackwidow V3'),
(4, 'Monitor Gamer AOC DESTINY 25 240Hz 0,5ms FreeSync Premium 25G3ZM, Preto', 'Monitor', '- Tamanho da tela: 24,5 Polegadas <br>\n- Resolução máxima do visor: 1920 x 1080 Pixels <br>\n- Marca: AOC <br>\n- Taxa de atualização:	240 Hz <br>\n- Peso do produto: 6,68 Kilograms <br>\n- Voltagem: 240 Volts, 110 Volts <br>', 'AOC-1.png', 'AOC-2.png', 'aoc-3.png', 'aoc-4.png', 1304.00, 'Monitor Gamer AOC DESTINY 25 240Hz'),
(5, 'Placa Mãe Gigabyte B550M AORUS Elite, Chipset B550, AMD AM4, mATX, DDR4', 'Placa Mãe', '- Marca	GIGABYTE <br>\n- Soquete da CPU	Soquete AM4 <br>\n- Tecnologia de memória RAM	DDR4 <br>\n- Série B550M <br>\n- Velocidade do relógio de memória:	4400 MHz <br>\n- Entradas para memória: 4 <br>\n- Interface da placa de vídeo: PCI Express <br>', 'b550m-2.jpg', 'b550m-3.jpg', 'b550m-4.jpg', NULL, 736.00, 'Placa Mãe Gigabyte B550M AORUS Elite'),
(6, 'Headset Gamer Sem Fio Redragon Zeus Pro, Driver 53mm, Bluetooth, Compatível com Windows, Preto - H51', 'fone de ouvido', '- Cor: Preto <br>\n- Diâmetro do driver: 53 mm <br>\n- Frequência de resposta: 20Hz ~ 20KHz <br>\n- Compatibilidade com OS: Windows XP/Vista/7/8/10/11 <br>\n- Conexão: 2.4/BT/USB <br>\n- Duração da bateria: aproximadamente 18h <br> ', 'red-1.jpg', 'red-5.jpg', 'red-2.jpg', 'red-4.jpg', 357.89, 'Headset Gamer Sem Fio Redragon Zeus Pro'),
(7, 'Processador Intel Core i5-13400F 2.5GHz (4.6 Turbo) 10 Core LGA 1700', 'Processador', '\n- Marca Intel <br>\n- Fabricante da CPU: Intel<br>\n- Modelo da CPU: Intel Core i5<br>\n- Soquete da CPU: LGA 1700<br>\n- Plataforma :Windows<br>', 'intel1.jpg', 'intel2.jpg', 'intel3.jpg', NULL, 1459.00, 'Processador Intel Core i5-13400F 2.5GHz'),
(8, 'Placa de Vídeo RX 6600 CLD 8GB ASRock AMD Radeon, 8GB, GDDR6 - 90-GA2RZZ-00UANF', 'Placa de vídeo', ' - Marca: ASRock <br> - Modelo: AMD Radeon RX 6600 CLD 8G<br> - PCI Express 4.0<br> - Capacidade da memória: 8GB<br> - Tipo: GDDR6<br> - Clock: 14 Gbps<br> - Interface: 128 bits<br>', 'radeon1.jpg', 'radeon2.jpg', 'radeon3.jpg', 'radeon4.jpg', 1349.99, 'Placa de Vídeo RX 6600 CLD 8GB ASRock'),
(9, 'Placa Mãe Gigabyte B760M AORUS ELITE (rev. 1.0), LGA 1700, DDR5', 'Placa mãe', '- Marca: Gigabyte<br>\r\n- Modelo: B760M AORUS ELITE<br>\r\n- Soquete LGA1700: suporte para processadores Intel  Core, Pentium  Gold e Celeron  de 13ª e 12ª geração <br>\r\n- Intel B760 Express<br>\r\n- Suporte para DDR5 7600(OC) / 7400(OC) / 7200(OC) / 7000(OC) ', 'bintel3.jpg', 'bintel2.jpg', 'bintel1.jpg', 'bintel4.jpg', 1399.99, 'Placa Mãe Gigabyte B760M AORUS ELITE'),
(10, 'Gabinete Gamer Corsair 7000X, RGB, Full Tower, Lateral em Vidro Temperado, Preto - CC-9011226-WW', 'Gabinete', '- Marca: Corsair<br>\r\n- Modelo: CC-9011226-WW<br>\r\n- Slots de expansão: 8 vertical + 3 horizontal<br>\r\n- Baias Case Drive: (x6) 3,5 pol. (x3) 2,5 pol.<br>\r\n- Fator de forma: TORRE COMPLETA<br>\r\n- Caixa em janela: Vidro temperado<br>\r\n- Cor: PRETO<br>', 'gab corsair1.jpg', 'gab corsair 2.jpg', 'gab corsair 3.jpg', 'gab corsair 4.jpg', 1599.90, 'Gabinete Gamer Corsair 7000X, RGB, Full Tower'),
(11, 'Memória Kingston Fury Beast, RGB, 16GB, 3200MHz, DDR4, CL16, Preto - KF432C16BB12A/16', 'Memória', '- Marca: Kingston<br>\r\n- Modelo: KF432C16BB12A/16<br>\r\n- Fonte de alimentação: VDD: 1,2 V Típico<br>\r\n- VDDQ: 1,2 V típico<br>\r\n- VPP: 2,5 V Típico<br>\r\n- VDDSPD: 2,2 V a 3,6 V<br>\r\n- Terminação On-Die (ODT)<br>\r\n- 16 bancos internos; 4 grupos de 4 bancos', 'fury1.jpg', 'fury2.jpg', 'fury3.jpg', 'fury4.jpg', 339.99, 'Memória Kingston Fury Beast, RGB, 16GB'),
(12, 'Mouse Gamer Sem Fio Logitech G Pro X Superlight, 25600 DPI, 5 Botões, USB, Vermelho - 910-006783', 'Mouse', '- Marca: Logitech<br>\r\n- Altura: 125,0 mm<br>\r\n- Largura: 63,5 mm<br>\r\n- Profundidade: 40,0 mm<br>\r\n- 5 botões<br>\r\n- Sensor: HERO<br>\r\n- Resolução: 100 – 25.600 dpi<br>', 'logi1.jpg', 'logi2.jpg', 'logi3.jpg', 'logi4.jpg', 679.00, 'Mouse Gamer Sem Fio Logitech G Pro X Superlight'),
(13, 'SSD 500 GB XPG Spectrix S20G, M.2 2280, PCIe Gen3x4, Leitura: 2500 MB/s e Gravação: 1800 MB/s, 3D NA', 'SSD', '- Marca: XPG<br>\r\n- Modelo: ASPECTRIXS20G-500G-C<br>\r\n- Capacidade: 500 GB<br>\r\n- Fator de forma: M.2 2280<br>\r\n- Flash NAND: 3D NAND<br>\r\n- Leitura sequencial (máx.): Até 2500 MB / s<br>\r\n- Gravação sequencial (máx.): Até 1800 MB / s<br>\r\n- PCIe Gen3x4<b', 'xpg1.jpg', 'xpg2.jpg', 'xpg3.jpg', 'xpg4.jpg', 331.73, 'SSD 500 GB XPG Spectrix S20G, M.2 2280'),
(14, 'HD WD Black Performance, 2TB, 3.5\', SATA - WD2003FZEX', 'HDD', '- Marca: Western Digital<br>\r\n- Modelo: WD2003FZEX 00Z4SA0<br>\r\n- Capacidade: 2TB<br>\r\n- Interface: SATA 6.0Gb/s<br>\r\n- Velocidade de Rotação: 7200 RPM<br>\r\n- Cachê: 64MB<br>\r\n- Form Factor: 3,5\'<br>', 'black1.jpg', 'black2.jpg', 'black3.jpg', NULL, 698.99, 'HD WD Black Performance, 2TB'),
(15, 'Fonte MSI MAG A850GL, 850W, 80 Plus Gold, Modular, PFC Ativo, com cabo, Preto', 'Fonte', '- Marca: MSI<br>\r\n- Modelo: MAG A850GL<br>\r\n- Compatível com ATX 3.0<br>\r\n- Preparado para PCIe 5.0<br>\r\n- Certificação 80 PLUS Gold<br>\r\n- Design totalmente modular<br>\r\n- Projeto PFC ativo<br>', 'msi1.jpg', 'msi2.jpg', 'msi3.jpg', 'msi4.jpg', 659.99, 'Fonte MSI MAG A850GL, 850W, 80 Plus Gold'),
(16, 'Placa de Vídeo SuperFrame NVIDIA GeForce RTX 3060 EPIC, White, 12GB, GDDR6, DLSS, Ray Tracing\r\n', 'Placa de Vídeo', '- Marca: SuperFrame <br>\r\n- Modelo: RTX 3060 SFEPIC 12G WHITE <br>\r\n- CUDA Cores: 3584 <br>\r\n- Clock base / Clock Boost: 1320/1777Mhz <br>\r\n- Tamanho da memória: 12GB <br>\r\n- Tipo de memória: GDDR6 <br>\r\n- Frequência da memória:1875', 'placa sframe1.jpg', 'placa sframe2.jpg', 'placa sframe3.jpg', 'placa sframe4.jpg', 2799.99, 'Placa de Vídeo SuperFrame NVIDIA GeForce RTX 3060 EPIC, White, 12GB, GDDR6, DLSS, Ray Tracing'),
(17, 'Placa de Vídeo SuperFrame NVIDIA GeForce RTX 3060 EPIC, Black, 12GB, GDDR6, DLSS, Ray Tracing\r\n', 'Placa de Vídeo', '- Marca: SuperFrame <br>\r\n- Modelo: RTX 3060 SFEPIC 12G WHITE <br>\r\n- CUDA Cores: 3584 <br>\r\n- Clock base / Clock Boost: 1320/1777Mhz <br>\r\n- Tamanho da memória: 12GB <br>\r\n- Tipo de memória: GDDR6 <br>\r\n- Frequência da memória:1875', 'placa sframe2m1.jpg', 'placa sframe2m2.jpg', 'placa sframe2m3.jpg', 'placa sframe2m4.jpg', 2799.99, 'Placa de Vídeo SuperFrame NVIDIA GeForce RTX 3060 EPIC, Black, 12GB, GDDR6, DLSS, Ray Tracing'),
(18, 'Cadeira Gamer Vertagear Racing SL2000, Black-Purple, VG-SL2000_BP', 'Cadeira', '- Marca: Vertagear <br>\r\n- Modelo: VG-SL2000_BP <br>\r\n- Cor: Preto/Roxo <br>\r\n- Carga Máxima: 150 kg <br>', 'cadeira vetgear1.png', 'cadeira vetgear2.png', 'cadeira vetgear3.png', 'cadeira vetgear4.png', 899.67, 'Cadeira Gamer Vertagear Racing SL2000, Black-Purple, VG-SL2000_BP'),
(19, 'Cadeira Gamer Mymax Mx5, Suportado até 150Kg, Giratória, Preto e Branco\r\n', 'Cadeira', '- Marca: Mymax <br>\r\n- Modelo: Mx5 <br>\r\n- Cor:  Preto/Branco\r\n- Revestimento: Estofamento de tecido sintético PU. <br>\r\n- Estrutura:  Metálica <br>', 'cadeira mymax1.jpg', 'cadeira mymax2.jpg', 'cadeira mymax3.jpg', 'cadeira mymax4.jpg', 664.05, 'Cadeira Gamer Mymax Mx5, Suportado até 150Kg, Giratória, Preto e Branco'),
(20, 'Gabinete Gamer NZXT H9 Elite, Mid Tower, Vidro Temperado, White, ATX, Sem Fonte, Com 4 Fans, CM-H91E', 'Gabinete', '- Marca:NZXT <br>\r\n- Modelo: CM-H91EW-01 <br>\r\n- Cor: Branco <br>\r\n- Suporte da placa mãe: Mini-ITX, Micro-ATX, ATX <br>\r\n- Tipo de gabinete: Mid Tower <br>\r\n- Materiais: Aço SGCC, Vidro Temperado <br>', 'gabinete nzxt1.jpg', 'gabinete nzxt2.jpg', 'gabinete nzxt3.jpg', 'gabinete nzxt4.jpg', 1669.00, 'Gabinete Gamer NZXT H9 Elite, Mid Tower, Vidro Temperado, White, ATX, Sem Fonte, Com 4 Fans, CM-H91EW'),
(21, 'Memória Kingston Fury Beast, 8GB, 3200MHz, DDR4, CL16, Preto - KF432C16BB/8', 'Memória', '- Marca: Kingston <br>\r\n- Modelo: KF432C16BB/8 <br>\r\n- Dissipador de calor de perfil baixo <br>\r\n- Upgrade de alta performance <br>\r\n- Intel XMP-ready <br>\r\n- Pronto para AMD Ryzen <br>\r\n- Velocidades*: 3200 MHz <br>', 'memoriaA1.jpg', 'memoriaA2.jpg', 'memoriaA3.jpg', 'memoriaA4.jpg', 159.99, 'Memória Kingston Fury Beast, 8GB, 3200MHz, DDR4'),
(22, 'Memória RAM XPG Spectrix D35G, RGB, 16GB, 3200MHz, DDR4, CL16, Preto', 'Memória', '- Marca: XPG <br>\r\n- Modelo: Spectrix D35G <br>\r\n- Capacidade: 16GB <br> \r\n- 3200Mhz <br>\r\n- DDR4 <br>\r\n- CL16 <br>\r\n- RGB <br>\r\n- Compatível com RoHS <br>\r\n- Dissipador de Calor de Baixo Perfil', 'memoriaB1.jpg', 'memoriaB2.jpg', 'memoriaB3.jpg', '', 279.99, 'Memória RAM XPG Spectrix D35G, RGB, 16GB, 3200MHz, DDR4'),
(23, 'Memória RAM XPG Gammix D35, 8GB, 3200MHz, DDR4, CL16, Preto - AX4U32008G16A-SBKD35', 'Memória', '- Marca: XPG <br>\r\n- Modelo: Gammix D35 <br>\r\n- Capacidade: 8GB <br>\r\n- 3200Mhz <br>\r\n- DDR4 <br>\r\n- CL16 <br>\r\n- Dissipador de Calor de Perfil Baixo <br>', 'memoriaC1.jpg', 'memoriaC2.jpg', 'memoriaC3.jpg', NULL, 149.99, 'Memória RAM XPG Gammix D35, 8GB, 3200MHz, DDR4'),
(24, 'Processador AMD Ryzen 9 7900X3D, 5.6GHz Max Turbo, Cache 140MB, AM5, 12 Núcleos, Vídeo Integrado - 1', 'Processador', '- Marca: AMD <br>\r\n- Nº de núcleos de CPU: 12 <br>\r\n- Nº de threads: 24 <br>\r\n- Clock de Max Boost: Até 5.6GHz <br>\r\n- Clock básico: 4,4 GHz <br>\r\n- Total de Cache L1: 768KB <br>\r\n- Cache L2 Total: 12MB <br>', 'processaA1.jpg', 'processaA2.jpg', 'processaA3.jpg', 'processaA4.jpg', 2899.99, 'Processador AMD Ryzen 9 7900X3D, 5.6GHz Max Turbo, Cache 140MB, AM5, 12 Núcleos, Vídeo Integrado'),
(25, 'Processador Intel Core i9-12900KS, 3.4GHz (5.5GHz Max Turbo), Cache 30MB, LGA 1700, Vídeo Integrado', 'Processador', '- Marca: Intel <br>\r\n- Base da Frequência P-core: 3,4GHz <br>\r\n- Base da Frequência E-core: 2,5GHz <br>\r\n- Threads do Processador: 24 <br>\r\n- Tipo de memória2: DDR5 e DDR4 <br>\r\n- Velocidade máxima de memória: 4800 MT/s e 3200 MT/s <br>\r\n- Canais de Memór', 'processaB1.jpg', 'processaB2.jpg', 'processaB3.jpg', NULL, 2497.99, 'Processador Intel Core i9-12900KS, 3.4GHz (5.5GHz Max Turbo), Cache 30MB, Vídeo Integrado.'),
(26, 'Placa Mãe ASRock B450M Steel Legend, AMD AM4, mATX, DDR4', 'Placa mãe', '- Marca: ASRock <br>\r\n- ASRock USB 3.1 Gen2 <br>\r\n- Porta tipo ASRock USB 3.1 Gen2 (10 Gb / s) <br>\r\n- Porta ASRock USB 3.1 Gen2 tipo C (10 Gb / s) <br>\r\n- ASRock Liga Super <br>\r\n- Dissipador de calor em liga de alumínio XXL <br>\r\n- Acoplador de potência', 'placaA4.jpg', 'placaA1.jpg', 'placaA2.jpg', 'placaA3.jpg', 648.99, 'Placa Mãe ASRock B450M Steel Legend, AMD AM4, mATX, DDR4'),
(27, 'Placa-Mãe MSI MPG B550 Gaming Plus, AMD AM4, ATX', 'Placa mãe', '- Marca: MSI  <br>\r\n- 1x slot PCIe 4.0 / 3.0 x16 (PCI_E1)*  <br>\r\n- 6x portas SATA de 6 Gb/s  <br>\r\n- 2x slots M.2 (Chave M) <br>\r\n- Arquitetura de memória de Dual Channel  <br>\r\n- Suporta memória UDIMM não ECC  <br>\r\n- Suporta memória sem buffer  <br>', 'placaB1.jpg\r\n', 'placaB2.jpg', 'placaB3.jpg', 'placaB4.jpg', 929.99, 'Placa-Mãe MSI MPG B550 Gaming Plus, AMD AM4, ATX'),
(28, 'Teclado Mecânico Gamer Husky Gaming HailStorm, Preto - RGB, 65%, Switch Gateron Red, ABNT2', 'Teclado', '- Marca: Husky Gaming <br>\r\n- Dimensões: (L x P x A) 315 x 109 x 32 mm <br>\r\n- Teclado Mecânico Modelo 65% <br>\r\n- 69 Teclas: Padrão ABNT2 <br>\r\n- Backlight RGB <br>\r\n- Efeitos de Iluminação: 13 modos <br>\r\n- 100% Anti-ghosting <br>', 'tecladoA1.jpg', 'tecladoA2.jpg', 'tecladoA5.jpg', 'tecladoA6.jpg', 249.00, 'Teclado Mecânico Gamer Husky Gaming HailStorm, Preto -RGB, 65%,Switch Gateron Red.'),
(29, 'Teclado Mecânico Gamer HyperX Alloy MKW100, RGB, Switch Red, Full Size', 'Teclado', '- Marca: HyperX <br>\r\n- Iluminação RGB dinâmica por teclado <br>\r\n- Estrutura durável em alumínio <br>\r\n- Descanso para pulso removível <br>\r\n- Switches mecânicos confiáveis à prova de poeira[2] <br>\r\n- Conector USB em metal dourado com cabo trançado resi', 'tecladoB1.jpg', 'tecladoB2.jpg', 'tecladoB3.jpg', 'tecladoB4.jpg', 229.99, 'Teclado Mecânico Gamer HyperX Alloy MKW100, RGB, Switch Red.'),
(30, 'Teclado Mecânico Gamer Husky Gaming HailStorm, Branco, RGB, 65%, Switch Gateron Red, ABNT2', 'Teclado', '- Marca: Husky Gaming <br>\r\n- Dimensões: (L x P x A) 315 x 109 x 32 mm <br>\r\n- Teclado Mecânico Modelo 65% <br>\r\n- 69 Teclas: Padrão ABNT2 <br>\r\n- Backlight RGB <br>\r\n- Efeitos de Iluminação: 13 modos <br>\r\n- 100% Anti-ghosting <br>\r\n', 'tecladoC1.jpg', 'tecladoC2.jpg', 'tecladoC3.jpg', 'tecladoC4.jpg', 249.99, 'Teclado Mecânico Gamer Husky Gaming HailStorm, Branco, RGB, 65%, Switch Gateron Red.'),
(31, 'Mouse Gamer Redragon Invader M719, RGB, 7 Botões, 10000DPI - RGB', 'Mouse', '- Marca: Redragon <br>\r\n- Sensor PIXART PMW3325 para Alta Performance (10000 DPI/20G/100ips) <br>\r\n- Iluminação RGB Ajustável <br>\r\n- mova versão com sistema de Iluminação Chroma RGB! (7 Diferentes Modos de Iluminação) <br>\r\n- Polling Rate de 1000hz (Temp', 'mouseA1.jpg', 'mouseA2.jpg', 'mouseA3.jpg', 'mouseA4.jpg', 89.99, 'Mouse Gamer Redragon Invader M719, RGB, 7 Botões, 10000DPI - RGB'),
(32, 'Mouse Gamer HyperX Pulsefire Haste RGB, 16000 DPI ', 'Mouse', '- Marca: HyperX <br>\r\n- Formato: Simétrico <br>\r\n- Sensor: Pixart PAW3335 <br>\r\n- Resolução: Até 16000 DPI com software <br>\r\n- Pré-definições de DPI: 400 / 800 / 1600 / 3200 DPI <br>\r\n- Velocidade: 450ips <br>\r\n- Aceleração: 40G <br>', 'mouseB1.jpg', 'mouseB2.jpg', 'mouseB3.jpg', 'mouseB4.jpg', 149.99, 'Mouse Gamer HyperX Pulsefire Haste RGB, 16000 DPI '),
(33, 'Mouse Sem Fio Gamer Fallen Pantera PRO Wireless, 26000 DPI, RGB, 68,70g, Preto', 'Mouse', '- Marca: Fallen <br>\r\n- Cor: Preto <br>\r\n- Iluminação: Led RGB <br>\r\n- Bateria: 500 mAH (50h de duração com os Leds desligados) <br>\r\n- Tempo de recarga: aproximadamente 2,5 horas <br>\r\n- Proteção: Encoder TTC GOLD (preserva a durabilidade e protege contr', 'mouseC1.jpg', 'mouseC2.jpg', 'mouseC3.jpg', 'mouseC4.jpg', 449.99, 'Mouse Sem Fio Gamer Fallen Pantera PRO Wireless, 26000 DPI, RGB, 68,70g, Preto'),
(34, 'HD Interno Seagate 10TB IronWolf, NAS, 7.200 RPM, 256Mb, 3.5, SATA', 'HDD', '- Marca: Seagate <br>\r\n- Baias de disco compatíveis: 1 a 8 baias <br>\r\n- Tecnologia de gravação: CMR <br>\r\n- Design do disco (ar ou hélio): Hélio <br>\r\n- Taxa limite de carga de trabalho (WRL): 180 <br>\r\n- Sensor de vibração rotacional (VR): Sim <br> \r\n', 'hddA1.jpg', 'hddA2.jpg', 'hddA3.jpg', 'hddA4.jpg', 1699.99, 'HD Interno Seagate 10TB IronWolf, NAS, 7.200 RPM, 256Mb, 3.5, SATA'),
(35, 'HD Externo Seagate Expansion, 2TB, USB, Preto', 'HDD', '- Marca: Seagate <br>\r\n- 2TB <br>\r\n- Preto<br>\r\n- Disco rígido portátil Seagate Expansion <br>\r\n- Cabo USB 3.0 de 18 polegadas (45,72 cm)\r\n190 gramas (bruto com embalagem) <br>\r\n', 'hddb1.jpg', 'hddb2.jpg', 'hddb3.jpg', 'hddb4.jpg', 399.99, 'HD Externo Seagate Expansion, 2TB, USB, Preto'),
(36, 'HD Externo Seagate 4TB BarraCuda, 3.5\', SATA', 'HDD', '- Marca: Seagate\r\n- Capacidade: 4TB <br>\r\n- Cache: 256MB <br>\r\n- Velocidade: 5400 RPM <br>\r\n- Interface: SATA 3.5\" <br>\r\n- Taxa de transferência da interface SATA: 600 MB/s <br>\r\n', 'hddC1.jpg', 'hddC2.jpg', 'hddC3.jpg', NULL, 599.99, 'HD Seagate 4TB BarraCuda, 3.5\', SATA'),
(37, 'SSD 480 GB Kingston A400, SATA, Leitura: 500MB/s e Gravação: 450MB/s - SA400S37/480G', 'SSD', '- Marca: Kingston <br>\r\n- Formato: 2,5 pol <br> \r\n- Interface: SATA Rev. 3.0 (6Gb/s) <br>\r\n- Capacidades: 480GB <br>\r\n- NAND: TLC <br>\r\n- Performance de referência - até 500MB/s para leitura e 450MB', 'ssdA1.jpg', 'ssdA2.jpg', 'ssdA3.jpg', 'ssdA4.jpg', 219.99, 'SSD 480 GB Kingston A400, SATA, Leitura: 500MB/s e Gravação: 450MB/s '),
(38, 'SSD 1 TB Kingston Fury Renegade, M.2 2280 PCIe, NVMe, Leitura: 7300MB/s e Gravação: 6000MB/s, Preto ', 'SSD', '- Marca: Kingston Fury <br>\r\n- Capacidades: 1000 GB <br>\r\n- Resistência: 1.0 PBW <br>\r\n- MTBF: 1.800.000 de horas <br>\r\n- Formato: M.2 2280 <br>\r\n- Interface: PCIe 4.0 NVMe <br>\r\n- Controlador: Phison E18 <br>', 'ssdB1.jpg', 'ssdB2.jpg', 'ssdB3.jpg', 'ssdB4.jpg', 699.99, 'SSD 1 TB Kingston Fury Renegade, M.2 2280 PCIe, NVMe, Leitura: 7300MB/s e Gravação: 6000MB/s.'),
(39, 'SSD Lexar 480GB Sata, Leitura 550MB/s, 2.5, Cinza', 'SSD', '- Marca: Lexar <br>\r\n- Inicialização mais rápida  <br>\r\n- Resistente a choques e vibrações <br>\r\n- Fácil configuração <br>\r\n- Baixo consumo <br>\r\n- Capacidade: 480 GB <br>\r\n- Interface: 2,5\" SATA III (6Gb/s) <br>', 'sddC1.jpg', 'ssdC2.jpg', 'ssdC3.jpg', NULL, 216.99, 'SSD Lexar 480GB Sata, Leitura 550MB/s, 2.5, Cinza'),
(40, 'Cadeira Gamer KBM! GAMING Tempest CG600, Branco, Com Almofadas, Descanso Para Pernas Retrátil, Recli', 'Cadeira', '- Marca: KBM! GAMING <br>\r\n- Estrutura: Aço <br>\r\n- Base: Nylon <br>\r\n- Rodas: PP <br>\r\n- Tapeçaria: PU <br>\r\n- Densidade Espuma: 50 kg/m³ (assento) - 35 kg/m³ (encosto) <br>\r\n- Braço: Móvel em espuma <br>\r\n- Cilindro de Gás: Classe 4', 'cadeiraA1.jpg', 'cadeiraA2.jpg', 'cadeiraA3.jpg', 'cadeiraA4.jpg', 999.99, 'Cadeira Gamer KBM! GAMING Tempest CG600, Branco, Com Almofadas, Descanso Para Pernas.'),
(41, 'Cadeira Gamer ThunderX3 TGC12, Até 120kg, com Almofadas, Reclinável, Preto', 'Cadeira', '- Marca: THUNDERX3 <br>\r\n- Tipo de Espuma: Moldado por Injeção <br>\r\n- Densidade da Espuma: 50kg/m³ e 45kg/m³ <br>\r\n- Espuma assento: Molde por injeção <br>\r\n- Braços Ajustáveis: 2D (2 Direções) <br> \r\n- Tipo de Mecanismo: Butterfly  <br>\r\n- Balanço: 3~18', 'cadeiraB1.jpg', 'cadeiraB2.jpg', 'cadeiraB3.jpg', 'cadeiraB4.jpg', 1039.99, 'Cadeira Gamer ThunderX3 TGC12, Até 120kg, com Almofadas, Reclinável, Preto'),
(42, 'Monitor Gamer LG UltraGear 27\" QHD OLED, 240Hz, 0.03ms, HDMI e DisplayPort, AMD FreeSync Premium, NV', 'Monitor', '- Marca: LG <br>\r\n- Tela OLED de 27” QHD (2560 x 1440) <br>\r\n- 240Hz de frequência <br>\r\n- 0.03ms (GtG) de tempo de resposta <br>\r\n- Compatível com AMD FreeSync Premium e NVIDIA G-SYNC <br>\r\n- Saída de fone de ouvido de 4 polos com fone de ouvido DTS: X <', 'monitorA1.jpg', 'monitorA2.jpg', 'monitorA3.jpg', 'monitorA4.jpg', 5799.99, 'Monitor Gamer LG UltraGear 27\" QHD OLED, 240Hz, 0.03ms.'),
(43, 'Monitor Gamer Acer QG240Y Nitro 23.8 Full HD, 180Hz, 1ms, HDMI e DisplayPort, 95% sRGB, HDR 10, Free', 'Monitor', '- Marca: Acer <br>\r\n- Até 180 Hz <br>\r\n- 23,8\" FHD (1920 x 1080) <br>\r\n- HDMI <br>\r\n- DisplayPort <br>\r\n- Saída de Áudio <br>\r\n- Entrada de alimentação <br>', 'monitorB1.jpg', 'monitorB2.jpg', 'monitorB3.jpg', 'monitorB4.jpg', 819.99, 'Monitor Gamer Acer QG240Y Nitro 23.8 Full HD, 180Hz, 1ms, HDMI e DisplayPort.'),
(44, 'Monitor Concórdia Gamer 23.8\'\' Led Full Hd, 165hz, Freesync, HDMI E Display Port', 'Monitor', '-painel: va\r\n-área ativa: 527.04(h)x296.46(v) (mm2)\r\n-ângulo de visão: 178/178\r\n-resolução: 1920*1080165hz\r\n-dot pitch: 0,2745\r\n-cores do painel: 16.7m\r\n-brilho(máximo): 250cd/m2', 'monitorC1.jpg', 'monitorC2.jpg', 'monitorC3.jpg', 'monitorC4.jpg', 749.00, 'Monitor Concórdia Gamer 23.8\'\' Led Full Hd, 165hz, Freesync, HDMI E Display Port'),
(45, 'Fonte Gamemax GS600, 600W, 80 Plus White, PFC Ativo, com cabo, Preto - GS600', 'Fonte', '- Marca: Gamemax <br>\r\n- Potência: 600W <br>\r\n- Versão: ATX 12V 2.3 <br>\r\n- Chave Liga/Desliga <br>\r\n- Voltagem com seleção automatica (auto range): 100~240V <br>\r\n- Frequência: 50~60Hz <br>\r\n- Corrente de entrada: 8~4A <br>', 'fonteA1.jpg', 'fonteA2.jpg', 'fonteA3.jpg', 'fonteA4.jpg', 249.99, 'Fonte Gamemax GS600, 600W, 80 Plus White, PFC Ativo, com cabo, Preto - GS600'),
(46, 'Fonte XPG Core Reactor, 850W, 80 Plus Gold, Modular, com cabo, Preto - Core Reactor', 'Fonte', '- Marca: XPG <br>\r\n- Potência: 850W <br>\r\n- Voltagem: Bivolt (100 - 240VAC, 47 - 63 Hz, 12A) <br>\r\n- Dimensões: 140 x 150 x 86 mm <br>\r\n- Certificação 80 Plus: Gold <br>\r\n- Versão Intel: Intel PSDG 1.42 <br>\r\n- Ventoinhas: 120 mm FDB <br>', 'fonteB1.jpg', 'fonteB2.jpg', 'fonteB3.jpg', 'fonteB4.jpg', 679.99, 'Fonte XPG Core Reactor, 850W, 80 Plus Gold, Modular, com cabo, Preto - Core Reactor'),
(47, 'Fonte Corsair CV650, 650W, 80 Plus Bronze, com cabo, Preto - CP-9020236-BR', 'Fonte', '- Marca: Corsair <br>\r\n- AC input: 100-240V <br>\r\n- Entrada atual: 10A-5A <br>\r\n- Frequência: 47~63Hz <br>\r\n- Potência: 650W <br>\r\n- 2265 gramas (bruto com embalagem) <br>', 'fonteC1.jpg', 'fonteC2.jpg', 'fonteC3.jpg', 'fonteC4.jpg', 399.99, 'Fonte Corsair CV650, 650W, 80 Plus Bronze, com cabo, Preto.'),
(48, 'Gabinete Gamer Rise Mode Galaxy Glass, Mid Tower, Lateral e Frontal em Vidro Temperado, Preto', 'Gabinete', '- Marca: Rise Mode <br>\r\n- Cor: Preto <br>\r\n- Dimensões (L x W x H): L 440mm x W 280mm x H 427mm <br>\r\n- Fans: Suporte para 10 fans (fans não inclusos)  \r\n* Produto não acompanha fans, imagem ilustrativa <br>\r\n- Baias: 3.5” HDD (x2) | 2.5” SSD (x2) <br>\r\n', 'gabinete risemode1.jpg', 'gabinete risemode2.jpg', 'gabinete risemode3.jpg', 'gabinete risemode4.jpg', 549.90, 'Gabinete Gamer Rise Mode Galaxy Glass, Mid Tower.'),
(49, 'Gabinete Gamer Rise Mode X5 Glass, RGB, Lateral em Vidro Fumê, Preto', 'Gabinete', '- Marca: Rise Mode <br>\r\n- Cor: Preto <br>\r\n- Dimensões (L x W x H): L 378mm x W 190mm x H 447mm <br>\r\n- Baias: 3.5” HDD (x2) | 2.5” SSD (x2) <br>\r\n- Slots de Expansão: 7 <br>\r\n- Placa-Mãe: ATX / M-ATX <br>\r\n- 9131 gramas (bruto com embalagem) <br>', 'gabinetered1.jpg\r\n', 'gabineteriseazul2.jpg', 'gabineteriseazul3.jpg', 'gabineteriseazul4.jpg', 129.90, 'Gabinete Gamer Rise Mode X5 Glass, RGB, Lateral em Vidro Fumê, Preto'),
(50, 'Headset Gamer HyperX Cloud Stinger 2, Drivers 50mm, P3, Preto', 'fone de ouvido', '- Marca: HyperX <br>\r\n- Driver: dinâmico, 50 mm com ímãs de neodímio <br>\r\n- Fator de forma: sobre a orelha, circumaural, costas fechadas <br>\r\n- Resposta de frequência: 10 Hz - 28 kHz <br>\r\n- Sensibilidade: -40,5 dBV (1 V/Pa a 1 kHz) <br>\r\n- THD: ? 2% <b', 'fonehyperx1.jpg', 'fonehyperx2.jpg', 'fonehyperx3.jpg', 'fonehyperx4.jpg', 169.90, 'Headset Gamer HyperX Cloud Stinger 2, Drivers 50mm, P3, Preto'),
(51, 'Headset Gamer Fallen Morcego, Surround Virtual 7.1, Cancelamento de Ruído, Drivers 53mm', 'fone de ouvido', '- Marca: Fallen <br>\r\n- Diâmetro do Alto Falante 53 mm  <br>\r\n- Alcance da Frequencia 100-10KHz <br>\r\n- Sensibilidade do Alto Falante 64±15% OHMS (f=1KHZ) <br>\r\n- Destacável com cancelamento de ruído coberto com uma almofada  <br>\r\n- Dimensao do microfone', 'fonefallen1.jpg', 'fonefallen2.jpg', 'fonefallen3.jpg', 'fonefallen4.jpg', 299.99, 'Headset Gamer Fallen Morcego, Surround Virtual 7.1, Cancelamento de Ruído, Drivers 53mm'),
(52, 'Headset Gamer Sem Fio Astro A50 + Base Station Gen 4 com Áudio Dolby para PS4, PC, Mac - Preto/Prata', 'fone de ouvido', '- Marca: Astro <br>\r\n- Alcance sem fio: 15 metros <br>\r\n- Freqüência Sem Fio: 2.4GHz <br>\r\n- Driver: ímãs de neodimio de 40 mm <br>\r\n- Resposta de Freqüência: 20-20.000 Hz <br>\r\n- Microfone: Unidirecional de 6,0 mm <br>\r\n- Entrada USB: 5V 500 ma <br>', 'foneasrto1.jpg', 'foneasrto2.jpg', 'foneasrto3.jpg', 'foneasrto4.jpg', 1249.99, 'Headset Gamer Sem Fio Astro A50 + Base Station Gen 4 com Áudio Dolby para PS4, PC, Mac');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(108) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_phone`, `user_password`) VALUES
(10, 'paulo', 'paulo@gmail.com', 1234, '$2y$10$zUNWcEDZ2zwJMD4Z09bOi.HGO2AiOSf0w1bjLZS.B6LzYYoqP2jba');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Índices de tabela `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de tabela `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
