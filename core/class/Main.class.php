<?php
/*
 *-------------------------------------------------------
 *              Simple MVC - Mick Hill
 *-------------------------------------------------------
 *
 *  Front control - Arquivo que faz o fluxo MVC
 *
 */

require_once $path['core'].'config/Setup.php';

class Main {
	private $setup;

	public function __construct() {
		$this->setup = new Setup();
	}

	// Escolhe o Controller e Methodo
	public function run() {
		$this->autoload();
		removeIndexIndexUri();

		$mvc = new Mvc();
		$mvc->includeController();
	}

	private function autoload() {
		// Leitura de arquivos descriminados no setup.
		foreach ($this->setup->autoload as $pasta => $arquivos) {
			if (count($this->setup->autoload[$pasta]) > 0) {
				foreach ($this->setup->autoload[$pasta] as $nomeArquivo) {
					$arquivo = $this->setup->path['core'].$pasta.'/'.$nomeArquivo;

					if (file_exists($arquivo)) {
						require_once $arquivo;
					} else {
						exit(
							'O arquivo "'.$nomeArquivo.'" não existe!<br />
                            Crie ele na pasta "'.$this->setup->path['core'].$pasta.'",<br />
                            ou remova-o do [AUTOLOAD]['.$pasta.'] = array("'.$nomeArquivo.'");'
						);
					}
				}
			}
		}
	}
}

// Execucao da Aplicacao
$bootstrap = new Main();
$bootstrap->run();
