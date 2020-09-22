SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+03:00";

-- Estrutura da tabela `ecommerce_plugins`

CREATE TABLE IF NOT EXISTS `ecommerce_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `titulo` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ecommerce_plugins` (`id`, `titulo`, `nome`, `status`) VALUES (NULL, 'PayPal', 'paypal', '');