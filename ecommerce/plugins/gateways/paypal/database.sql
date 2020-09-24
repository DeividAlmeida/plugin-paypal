
CREATE TABLE IF NOT EXISTS `ecommerce_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `titulo` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` VARCHAR(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ecommerce_plugins` (`id`, `titulo`, `nome`, `tipo`, `path`, `img`, `status`) VALUES (NULL, 'PayPal', 'paypal', 'gateways', 'ecommerce/plugins/gateways/paypal', 'ecommerce/plugins/gateways/paypal/wa/assets/img/paypal.jpg', '');