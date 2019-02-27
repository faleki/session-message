<?php
/**
 * SessionMessage - Classe para criar e ler mensagens de alertas no sistema.
 * Versão 1
 * PHP Versão 7.1.
 *
 * @author        Filipe Levandovski <filipelevandovski@gmail.com>
 * @license        http://www.gnu.org/copyleft/lesser.html GNU General Public License
 * @note        Este programa é distribuído na esperança de que seja útil - SEM
 * QUALQUER GARANTIA; sem mesmo a garantia implícita de COMERCIALIZAÇÃO
 * ou ADEQUAÇÃO A UM DETERMINADO FIM.
 */

class SessionMessage {
	/**
	 * Utilizada para escrever uma nova mensagem.
	 *
	 * @var    string
	 */
	private $write;

	/**
	 * Utilizada para conferir se possui alguma mensagem.
	 *
	 * @var    bool
	 */
	private $status;

	/**
	 * Utilziada para retornar a leitura das mensagens.
	 *
	 * @var    string
	 */
	private $read;

	/**
	 * Construtor
	 *
	 * Inicia uma sesão.
	 * Cria um vetor em $_SESSION["SessionMessage"]
	 */
	public function __construct() {
		$this->start_sessao();
		$_SESSION["SessionMessage"] = array();
	}

	/**
	 * Verifica se já possui uma sessão iniciada.
	 *
	 * @return    bool
	 */
	public function status_sessao() {
		if (isset($_SESSION)) {
			return true;
		} else if (!isset($_SESSION)) {
			return false;
		}
	}

	/**
	 * Verifica se possui uma sessão iniciada
	 * caso não possui, inicia a sessão
	 */
	public function start_sessao() {
		if ($this->status_sessao() == false) {
			session_start();
		}
	}

	/**
	 * Adiciona no array a mensagem enviada como parâmetro
	 *
	 * @param    string        $message    Mensagem
	 */
	public function write_session_message($message) {
		$this->write = $message;
		return array_push($_SESSION["SessionMessage"], $this->write);
	}

	/**
	 * Verifica se possui alguma mensagem
	 *
	 * @return    bool
	 */
	public function status_session_message() {
		if (isset($_SESSION["SessionMessage"])) {
			if (!empty($_SESSION["SessionMessage"])) {
				$this->status = "TRUE";
			} else {
				$this->status = "FALSE";
			}
			return $this->status;
		}
	}

	/**
	 * Faz leitura das mensagens e após apagada
	 * @return    string
	 */
	public function read_session_message() {
		if (!empty($_SESSION["SessionMessage"])) {
			$this->read = $_SESSION["SessionMessage"];
		}
		$_SESSION["SessionMessage"] = "";
		return $this->read;
	}
}
