CREATE TABLE IF NOT EXISTS `ecommerce_paypal` ( 
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `usuario` text DEFAULT NULL,
  `senha` text DEFAULT NULL,
  `token` text DEFAULT NULL,
  `moeda` text DEFAULT NULL,
  `link_retorno` text DEFAULT NULL,
  `link_cancelado` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ecommerce_paypal` (`id`, `usuario`, `senha`, `token`, `moeda`, `link_retorno`, `link_cancelado`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO `ecommerce_plugins` (`id`, `titulo`, `nome`, `tipo`, `path`, `img`, `status`) VALUES (1, 'PayPal', 'paypal', 'gateways', 'ecommerce/plugins/gateways/paypal', 'ecommerce/plugins/gateways/paypal/wa/assets/img/paypal.jpg', '');