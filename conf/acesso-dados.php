<?php
    include_once 'config.php';
    
    //mysqli_report(MYSQLI_REPORT_OFF);    // Turns reporting off
    //mysqli_report(MYSQLI_REPORT_ERROR);  // Report errors from mysqli function calls
    //mysqli_report(MYSQLI_REPORT_STRICT); // Throw mysqli_sql_exception for errors instead of warnings
    //mysqli_report(MYSQLI_REPORT_INDEX);  // Report if no index or bad index was used in a query
    //mysqli_report(MYSQLI_REPORT_ALL);    // Set all options (report all)
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    class AcessoDados{

		private static $conn;

		public static function abreTransacao(){
			try{
				self::$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				self::$conn->autocommit(FALSE);
			}catch(Exception $ex){
				throw new Exception("Erro ao abrir transação.<br>".$ex->getMessage());
			}
		}

		public static function inserir($sql){
			try{
                self::$conn->query($sql);
                $idinserido = self::$conn->insert_id;
                return $idinserido;
            }catch(mysqli_sql_exception $ex){
                self::abortaTransacao();
				throw new Exception("Ocorreu um erro ao inserir o registro. Transação abortada.<br>".$ex->getMessage());//."<br>".$sql."<br>");
			}catch(Exception $ex){
				self::abortaTransacao();
				throw new Exception("Ocorreu um erro ao inserir o registro. Transação abortada.<br>".$ex->getMessage());
			}
		}

		public static function alterar($sql){
			try{
				if(self::$conn->query($sql) == true){
					return true;
				}else{
					throw new Exception("Falha ao alterar o registro.<br>");
				}
			}catch(Exception $ex){
				self::abortaTransacao();
				throw new Exception("Ocorreu um erro ao alterar o registro. Transação abortada.<br>".$ex->getMessage());
			}
		}

		public static function confirmaTransacao(){
			try{
				self::$conn->commit();
				self::$conn->close();
			}catch(Exception $ex){
				throw new Exception("Ocorreu um erro ao executar o commit da transação.<br>".$ex->getMessage());
			}
		}

		public static function abortaTransacao(){
			try{
				self::$conn->rollback();
				self::$conn->close();
			}catch(Exception $ex){
				throw new Exception("Ocorreu um erro ao executar o rollback da transação.<br>".$ex->getMessage());
			}
		}
		
		public static function listar($sql){
			$connCons;
			try{
				$connCons = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				$resultado = $connCons->query($sql);
				if ($resultado && $resultado->num_rows > 0) {
					return $resultado;
				}else{
					return null;
				}
			}catch(Exception $ex){
				throw new Exception("Ocorreu um erro ao listar os dados.<br>".$ex->getMessage());
			}finally{
				$connCons->close();
			}
		}
	}
?>