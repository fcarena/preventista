<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupos_tabgral_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}


	/**
	 * This function saving the data in the db
	 *
	 * @access public
	 * @param array fields of the table
	 * @return integer  affected rows
	 */
	function add_m($options = array())
	{
		//code here
		$this->db->insert('grupos_tabgral', $options);
		return $this->db->insert_id();
	}


	/**
	 * This function editing the data in the db
	 *
	 * @access public
	 * @param array fields of the table
	 * @return integer  affected rows
	 */
	function edit_m($options = array())
	{
		//code here
		if(isset($options['grupos_tabgral_descripcion']))
			$this->db->set('grupos_tabgral_descripcion', $options['grupos_tabgral_descripcion']);
		if(isset($options['grupos_tabgral_created_at']))
			$this->db->set('grupos_tabgral_created_at', $options['grupos_tabgral_created_at']);
		if(isset($options['grupos_tabgral_updated_at']))
			$this->db->set('grupos_tabgral_updated_at', $options['grupos_tabgral_updated_at']);

		$this->db->where('grupos_tabgral_id', $options['grupos_tabgral_id']);

		$this->db->update('grupos_tabgral');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $grupos_tabgral_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($grupos_tabgral_id)
	{
		//code here
		$this->db->where('grupos_tabgral_id', $grupos_tabgral_id);
		$this->db->delete('grupos_tabgral');
		return $this->db->affected_rows();
	}


	/**
	 * This function get the data of the db
	 *
	 * @access public
	 * @param array fields of the table
	 * @param integer	flag to indicate if return one record or more of one record
	 * @return array  result
	 */
	function get_m($options = array(),$flag=0)
	{
		//code here
		if(isset($options['grupos_tabgral_id']))
			$this->db->where('grupos_tabgral_id', $options['grupos_tabgral_id']);
		if(isset($options['grupos_tabgral_descripcion']))
			$this->db->like('grupos_tabgral_descripcion', $options['grupos_tabgral_descripcion']);
		if(isset($options['grupos_tabgral_created_at']))
			$this->db->where('grupos_tabgral_created_at', $options['grupos_tabgral_created_at']);
		if(isset($options['grupos_tabgral_updated_at']))
			$this->db->where('grupos_tabgral_updated_at', $options['grupos_tabgral_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$query = $this->db->get('grupos_tabgral');

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['grupos_tabgral_id']) && $flag==1){
				$query->row(0)->grupos_tabgral_created_at = $this->basicrud->formatDateToHuman($query->row(0)->grupos_tabgral_created_at);
				$query->row(0)->grupos_tabgral_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->grupos_tabgral_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->grupos_tabgral_created_at = $this->basicrud->formatDateToHuman($row->grupos_tabgral_created_at);
					$row->grupos_tabgral_updated_at = $this->basicrud->formatDateToHuman($row->grupos_tabgral_updated_at);
				}
				return $query->result();
			}
		}

	}


	/**
	 * This function getting all the fields of the table
	 *
	 * @access public
	 * @return array  fields of table
	 */
	function getFieldsTable_m()
	{
		//code here
		$fields=array();
		$fields[]='grupos_tabgral_id';
		$fields[]='grupos_tabgral_descripcion';
		$fields[]='grupos_tabgral_created_at';
		$fields[]='grupos_tabgral_updated_at';
		return $fields;
	}



	/**
	 * Esta funcion obtiene los datos de la tabla 'grupos_tabgral' para luego ser cargados  
	 * en la base de datos sqlite3 para el modulo 
	 * que funciona en el telefono movil
	 *
	 * @access public
	 * @param array fields of the table
	 * @param integer	flag to indicate if return one record or more of one record
	 * @return array  result
	 */
	function getMobile($options = array(),$flag=0)
	{
		//code here
		$query = $this->db->get('grupos_tabgral');
		return $query->result();
	}



	/**
	 * Esta función obtiene los nombres de los campos de la 
	 * tabla grupos_tabgral con el proposito de que los datos de esta tabla
	 * sean grabados correctamente en la base de datos sqlite3 que 
	 * funciona en el telefono movil
	 *
	 * @access public
	 * @return array  fields of table
	 */
	function getFieldsMobile_m()
	{
		//code here
		$fields=array();
		$fields[]='grupos_tabgral_id';
		$fields[]='grupos_tabgral_descripcion';
		$fields[]='grupos_tabgral_created_at';
		$fields[]='grupos_tabgral_updated_at';
		return $fields;
	}
}